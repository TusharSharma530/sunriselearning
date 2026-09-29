<?php include 'config.php';
$title = 'Create Answer Category';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['desc']));
	$sqlanscatcheck = mysqli_query($con, "SELECT * FROM `ans_category` WHERE `title` = '$title'");
	if(mysqli_num_rows($sqlanscatcheck)){
		echo "<script>swal('Answer Category Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO `ans_category` (id, title, `desc`, `status`) VALUES (NULL, '$title', '$desc', 1)");			
		if($sqlins){
			echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
					$('#submitForm').hide();
				 </script>";
			echo "<div class='col-md-12 padd0 text-center'><a href='createanscat.php' class=' btn btn-primary'>Create New</a></div>";
		}else{
				
			echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
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
			<h3>Create Answer Category</h3>
		</div>
		<div class="createbtn">
			<a href="anscat.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-12">
			<label for="title" class="form-label">Name</label>
			<input type="text" class="form-control" name="title" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="desc" class="form-label">Description</label>
			<textarea type="text" class="tinyMCE"  name="desc"></textarea>
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