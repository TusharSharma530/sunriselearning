<?php include "config.php";
$pagetitle = 'Edit Courses';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqlblogs = mysqli_query($con, "SELECT * FROM `courses` WHERE id = $id");
$rwblogs = mysqli_fetch_assoc($sqlblogs);

if(isset($_POST['editRecord'])){
$title = trim(mysqli_real_escape_string($con,$_POST['title']));
$order = trim(mysqli_real_escape_string($con,$_POST['order']));

$sqlcheck = mysqli_query($con,"UPDATE `courses` SET `title` = '$title', `order` = '$order' WHERE `id` = $id");
	
if($sqlcheck){
	echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success'); </script>";
	
}else{
		
	echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); </script>";
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
			<h3><?=$pagetitle;?></h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createcourses.php"> Add New</a>
			<a href="courses.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm">
			<div class="row">
			<div class="mb-3 col-md-10">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" required value="<?=$rwblogs['title'];?>">
			</div>
			
			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="number" class="form-control" name="order" required value="<?=$rwblogs['order'];?>">
			</div>

			<div class="mt-2 mx-auto">
				<input type="submit" value="Edit Record" name="editRecord" class="btn btn-primary">
			</div>

			</div>
		</form>
	</div>
</div>
					
</div>
</div>
</section>

	
<?php 
	include "include/footer.php"; 
?>