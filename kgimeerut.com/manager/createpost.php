<?php include 'config.php';
$title = 'Create Notice';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$years = trim(mysqli_real_escape_string($con,$_POST['years']));	
	$faculties = trim(mysqli_real_escape_string($con,$_POST['faculties']));	
	$students = trim(mysqli_real_escape_string($con,$_POST['students']));	
	$alumni = trim(mysqli_real_escape_string($con,$_POST['alumni']));	

	$sqlins = mysqli_query($con,"INSERT INTO `post` (`id`, `years`, `faculties`, `students`, `alumni`) VALUES (NULL, '$years', '$faculties', '$students', '$alumni')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success');</script>";
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
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
			<a href="post.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-3">
			<label for="years" class="form-label">Years</label>
			<input type="text" class="form-control" name="years" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="faculties" class="form-label">Faculties</label>
			<input type="text" class="form-control" name="faculties" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="students" class="form-label">Students</label>
			<input type="text" class="form-control" name="students" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="alumni" class="form-label">Alumni</label>
			<input type="text" class="form-control" name="alumni" required>
		</div>

		<div class="col-md-12">
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