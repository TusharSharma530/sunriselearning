<?php include 'config.php';
$title = 'Create Job';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$long_desc = trim(mysqli_real_escape_string($con,$_POST['longdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));

	$sqlins = mysqli_query($con,"INSERT INTO `jobs` (`id`, `title`, `url`, `long_desc`, `order`, `status`) VALUES (NULL, '$title', '$url', '$long_desc', '$order', 1)");

	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createjobs.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="jobs.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-11">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title" required>
		</div>

		<div class="mb-3 col-md-1">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" name="order">
		</div>

		<div class="mb-3 col-md-12">
			<label for="longdesc" class="form-label">Long Description</label>
			<textarea type="text" class="tinyMCE"  name="longdesc"></textarea>
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