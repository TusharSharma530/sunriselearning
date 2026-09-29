<?php include "config.php";
$title = 'Edit Notice';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqledit = mysqli_query($con, "SELECT * FROM `post` WHERE id = $id");
$rwedit = mysqli_fetch_assoc($sqledit);


if(isset($_POST['updatetc'])){
	$years = trim(mysqli_real_escape_string($con,$_POST['years']));	
	$faculties = trim(mysqli_real_escape_string($con,$_POST['faculties']));	
	$students = trim(mysqli_real_escape_string($con,$_POST['students']));	
	$alumni = trim(mysqli_real_escape_string($con,$_POST['alumni']));	
	
	$sqlcheck = mysqli_query($con,"UPDATE `post` SET `years` = '$years', `faculties` = '$faculties', `students` = '$students', `alumni` = '$alumni' WHERE id = $id");
		
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="createpost.php"> Add New</a>
			<a href="post.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		

		<div class="mb-3 col-md-3">
			<label for="years" class="form-label">Years</label>
			<input type="text" class="form-control" name="years" value="<?=$rwedit['years'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="faculties" class="form-label">Faculties</label>
			<input type="text" class="form-control" name="faculties" value="<?=$rwedit['faculties'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="students" class="form-label">Students</label>
			<input type="text" class="form-control" name="students" value="<?=$rwedit['students'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="alumni" class="form-label">Alumni</label>
			<input type="text" class="form-control" name="alumni" value="<?=$rwedit['alumni'];?>">
		</div>

			<div class="col-md-12">
				<input type="submit" value="Edit Record" name="updatetc" class="submitInput">
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