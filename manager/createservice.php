<?php include 'config.php';
$title = 'Create Service';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addTc'])){


	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "services");
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM services WHERE title = '$title'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO services (id, title, url, `desc`, `sdesc`, file, `order`) VALUES (NULL, '$title', '$url', '$desc', '$sdesc', '$uploadpath', '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createservice.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Create Service</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="services.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">
		
		<div class="mb-3 col-md-8">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title" required>
		</div>
	
		<div class="mb-3 col-md-4">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="desc" class="form-label">Short Description</label>
			<textarea type="text" class="tinyMCE"  name="sdesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="desc" class="form-label">Description</label>
			<textarea type="text" class="tinyMCE"  name="idesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Featured Image</label>
		  	<input  class="form-control" name="img" type="file" onchange="displayimg(this)" id="mainimg">
		</div>
		
		<div class="mb-3 col-md-12">
		  	<img src="images/preview.png" alt="2" id='previmg' onclick='triggerClick()' style='width:150px;'>
		</div>

		<div class="mt-2 mx-auto">
			<input type="submit" value="Add Record" name="addTc" class="btn btn-primary">
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