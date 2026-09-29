<?php include 'config.php';
	$title = 'Founders';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM founders WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM founders WHERE id = {$id}");
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
			<h3>Founders</h3>
		</div>
		<div class="createbtn">
			<a href="createfounders.php"> Add New</a>
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
					<th>Name</th>									
					<th>Image</th>
					<th>Title</th>
					<th>Order</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqlfd  = mysqli_query($con, "SELECT * FROM founders ORDER BY `order` ASC");
				if(mysqli_num_rows($sqlfd)){
					$serial = 1;
					while($rwfd = mysqli_fetch_assoc($sqlfd)){
						$fdid = $rwfd['id'];
			 ?>
				<tr id='remove<?php echo $fdid; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><?=$rwfd['name'];?></td>
					<td>
						<?php if(!empty($rwfd['file'])){ ?>
						<img src="<?=$path.$rwfd['file'];?>" alt="Image" style="width:60px;height:40px;object-fit:cover;border-radius:5px;">
						<?php } else { ?>
						<span class="text-muted">No Image</span>
						<?php } ?>
					</td>
					<td><?=$rwfd['title'];?></td>
					<td><?=$rwfd['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwfd['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="founders" ide="<?=$rwfd['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updatefounders.php?id=<?=$fdid;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$fdid; ?>" class='delbtn ri-delete-bin-line' ></a>
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
