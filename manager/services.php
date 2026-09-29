<?php include 'config.php';
	$title = 'Services';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM services WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM services WHERE id = {$id}");
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
			<h3>Services</h3>
		</div>
		<div class="createbtn">
			<a href="createservice.php"> Add New</a>
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
					<th>Image</th>
					<th>Title</th>
					<th>Order</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqltc  = mysqli_query($con, "SELECT * FROM services ORDER BY id ASC");
				if(mysqli_num_rows($sqltc)){
					$serial = 1;
					while($rwtc = mysqli_fetch_assoc($sqltc )){
						$tcid = $rwtc['id'];
			 ?>
				<tr id='remove<?php echo $tcid; ?>'>
					<td><?php echo $serial; ?></td>
					<td><img src="<?=$path.$rwtc['file']; ?>" alt="<?=$rwtc['title'];?>" style="width: 100px;"></td>
					<td><?=$rwtc['title'];?></td>
					<td><?=$rwtc['order'];?></td>
					<td class="text-end">
						<a href="updateservice.php?tcupid=<?php echo $tcid; ?>"><i class='bx bx-edit mx-2 text-success'></i></a> 
						<a href="javascript:void(0)" class="delbtn" ide="<?php echo $tcid; ?>"><i class='bx bx-trash mx-2 text-danger'></i></a>
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