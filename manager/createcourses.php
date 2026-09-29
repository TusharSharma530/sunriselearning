<?php include 'config.php';
$pagetitle = 'Create Course';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}


if(isset($_POST['addRecord'])){
$title = trim(mysqli_real_escape_string($con,$_POST['title']));
$order = trim(mysqli_real_escape_string($con,$_POST['order']));

$sqlins = mysqli_query($con,"INSERT INTO `courses`(`id`, `title`, `order`) VALUES (null, '$title', '$order')");
	
if($sqlins){
	echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success');$('#submitForm').remove();  </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createcourses.php' class='btn btn-primary'>Create New</a></div>";
}else{
		
	echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>" . mysqli_error($con);
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
			<input type="text" class="form-control" name="title" required>
		</div>
		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
			<input type="number" class="form-control" name="order" required>
		</div>

		<div class="mt-2 mx-auto">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
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