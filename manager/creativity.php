<?php include 'config.php';
	$title = 'Creativity Cards';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM creativity WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM creativity WHERE id = {$id}");
				if($sqldelete){
					echo 'true';
				}else{
					echo 'false';
				}	
				
			}
		
		exit();
	 }
	 


	include 'include/header.php';
	include 'include/sidebar.php';

 ?>


<section class="main-dashboard">
<div class="container-fluid">
<div class="row">

<div class="col-md-12">
	<div class="page-title">			
		<div class="title">
			<h3>Creativity Cards</h3>
		</div>
		<div class="createbtn">
			<a href="createcreativity.php"> Add New</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th>#</th>									
					<th>Title</th>									
					<th>Image</th>
					<th>Order</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqlcr  = mysqli_query($con, "SELECT * FROM creativity ORDER BY `order` ASC");
				if(mysqli_num_rows($sqlcr)){
					$serial = 1;
					while($rwcr = mysqli_fetch_assoc($sqlcr)){
						$crid = $rwcr['id'];
			 ?>
				<tr id='remove<?php echo $crid; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><?=$rwcr['title'];?></td>
					<td>
						<?php if(!empty($rwcr['file'])){ ?>
						<img src="<?=$path.$rwcr['file'];?>" alt="Image" style="width:60px;height:40px;object-fit:cover;border-radius:5px;">
						<?php } else { ?>
						<span class="text-muted">No Image</span>
						<?php } ?>
					</td>
					<td><?=$rwcr['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwcr['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="creativity" ide="<?=$rwcr['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updatecreativity.php?id=<?=$crid;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$crid; ?>" class='delbtn ri-delete-bin-line' ></a>
					</td>
				</tr>
		<?php $serial++; }} ?>
			</tbody>
		</table>
	</div>
</div>

</div>
</div>
</section>

<?php 
	include "include/footer.php"; 
?>
