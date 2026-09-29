<?php include 'config.php';
$title = 'Create Staff';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
// 	$url = seo_friendly_url($title);
	$designation = trim(mysqli_real_escape_string($con,$_POST['designation']));
	$type = trim(mysqli_real_escape_string($con,$_POST['type']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "staff");
	}

	$sqlins = mysqli_query($con,"INSERT INTO `staff` (id, name, designation, type, image, `order`) VALUES (NULL, '$title', '$designation', '$type', '$uploadpath', '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createstaff.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Create Staff</h3>
		</div>
		<div class="createbtn">
			<a href="staff.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-3">
			<label for="title" class="form-label">Name</label>
			<input type="text" class="form-control" name="title" required>
		</div>
		
		<div class="mb-3 col-md-3">
			<label for="designation" class="form-label">Desgination</label>
			<input type="text" class="form-control" name="designation">
		</div>
		
		<div class="mb-3 col-md-3">
			<label for="type" class="form-label">Type</label>
			<input type="text" class="form-control" name="type">
		</div>

		<div class="mb-3 col-md-3">
			<label for="order" class="form-label">Order</label>
            <?php $sqlgallery  = mysqli_query($con, "SELECT * FROM `staff` ORDER BY `id` DESC");
            $rwgallery = mysqli_fetch_assoc($sqlgallery ); ?>			
			<input type="text" class="form-control" name="order" placeholder="Last Order No. : <?=$rwgallery['order'];?>">
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image (400x400px)</label>
		  	<div class="imgquestion other">			  		
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
				<img src="images/preview.jpg" alt="2" class='preview'>
			</div>
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