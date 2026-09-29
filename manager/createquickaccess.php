<?php include 'config.php';
$title = 'Create Quick Access';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addTc'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$link = trim(mysqli_real_escape_string($con,$_POST['link']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "quickaccess");
	}

	$sqlins = mysqli_query($con,"INSERT INTO quickaccess (`id`, `title`, `link`, `file`, `order`, `status`) VALUES (NULL, '$title', '$link', '$uploadpath', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createquickaccess.php' class=' btn btn-primary'>Create New</a></div>";
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
			<a href="quickaccess.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">
			<div class="mb-3 col-md-5">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" required>
			</div>
			
			<div class="mb-3 col-md-5">
				<label for="link" class="form-label">Link</label>
				<input type="text" class="form-control" name="link" required>
			</div>

			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" required>
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
				<div class="imgquestion other">
					<a href="javascript:" class="imgclose ri-close-circle-line"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
	  				<img src="images/preview.jpg" alt="preview" class='preview'>
	  			</div>
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