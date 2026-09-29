<?php include 'config.php';
$title = 'Students';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['deletedata'])){
$id = $_POST['id'];
$sqldelete = mysqli_query($con,"DELETE FROM `users` WHERE id = $id");
if($sqldelete){
	echo 'true';
}else{
	echo 'false';
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
			<h3>Students</h3>
		</div>
		<div class="createbtn">
			<a href="createstudents.php"> Add New</a>
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
					<th>Student Name</th>
					<th>Student Email</th>
					<th>Student Mobile</th>
					<th>Student Type</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqlstudents  = mysqli_query($con, "SELECT * FROM `users` ORDER BY id ASC");
				if(mysqli_num_rows($sqlstudents)){
					$serial = 1;
					while($rwstudents = mysqli_fetch_assoc($sqlstudents )){
						$userid = $rwstudents['id'];
						if($rwstudents['type']==0){
							$type = "<span>Free Student</span>";
						}elseif($rwstudents['type']==1){
							$type = "<span>Paid Student</span>";							
						}
			 ?>
				<tr id='remove<?php echo $userid; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><?=$rwstudents['full_name'];?></td>
					<td><?=$rwstudents['email'];?></td>
					<td><?=$rwstudents['mobile'];?></td>
					<td><?=$type;?></td>
					<td>
						<div class="form-check form-switch">
						<?php $checked = $rwstudents['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="users" ide="<?=$rwstudents['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updatestudents.php?id=<?=$userid;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$userid;?>" class='delbtn ri-delete-bin-line' ></a>
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