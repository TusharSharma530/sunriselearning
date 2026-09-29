<?php include 'config.php';
$title = 'Advisory Board';
if(!isset($_SESSION['username'])){
echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['deletedata'])){
$id = $_POST['id'];
$sqldelImg = mysqli_query($con, "SELECT * FROM `board` WHERE id = $id");
if(mysqli_num_rows($sqldelImg)){
	$rowimg = mysqli_fetch_assoc($sqldelImg);
	$imgid = $rowimg['file'];
	unlink("../".$imgid);

	$sqldelete = mysqli_query($con,"DELETE FROM `board` WHERE id = $id");
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="createadvisoryboard.php"> Add New</a>
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
					<th>Name</th>
					<th>Order</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqltc  = mysqli_query($con, "SELECT * FROM `board` ORDER BY `order` ASC");
				if(mysqli_num_rows($sqltc)){
					$serial = 1;
					while($rwtc = mysqli_fetch_assoc($sqltc)){
						$tcid = $rwtc['id'];
			 ?>
				<tr id='remove<?php echo $tcid; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><img src="<?=$path.$rwtc['file'];?>" alt="<?=$rwtc['title'];?>" width="80px"></td>
					<td><?=$rwtc['title'];?></td>
					<td><?=$rwtc['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwtc['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="board" ide="<?=$rwtc['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="editadvisoryboard.php?id=<?=$tcid;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$tcid; ?>" class='delbtn ri-delete-bin-line' ></a>
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