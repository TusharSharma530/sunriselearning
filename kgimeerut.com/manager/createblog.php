<?php include 'config.php';
$title = 'Create Blog';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}


if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$author = trim(mysqli_real_escape_string($con,$_POST['author']));
	$date = trim(mysqli_real_escape_string($con,$_POST['date']));
	$metatitle = trim(mysqli_real_escape_string($con,$_POST['metatitle']));
	$metakeywords = trim(mysqli_real_escape_string($con,$_POST['metakeywords']));
	$metadesc = trim(mysqli_real_escape_string($con,$_POST['metadesc']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){ $uploadpath = createImgWebp("img", "blogs");	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM `blogs` WHERE title = '$title'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO `blogs` (`id`, `title`, `url`, `desc`, `sdesc`, `file`, `order`, `author`, `date`, `status`, `metatitle`, `metakeywords`, `metadesc`) VALUES (NULL, '$title', '$url', '$desc', '$sdesc', '$uploadpath', '$order', '$author', '$date', 1, '$metatitle', '$metakeywords', '$metadesc')");
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createblog.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
		}
	}
	exit();
}

include 'include/header.php';
include 'include/sidebar.php'; ?>

<section class="main-dashboard">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
	<div class="page-title">
		<div class="title">
			<h3>Create Blog</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="blogs.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-12">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title" required>
		</div>

        <div class="mb-3 col-md-3">
			<label for="author" class="form-label">Author</label>
			<input type="text" class="form-control" name="author" required>
		</div>
		
		<div class="mb-3 col-md-3">
			<label for="date" class="form-label">Date</label>
			<input type="date" class="form-control" name="date" required>
		</div>
		
		<div class="mb-3 col-md-1">
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
		
		<div class="mb-3 col-md-6">
			<label for="metatitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" name="metatitle">
		</div>
		
		<div class="mb-3 col-md-6">
			<label for="metakeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" name="metakeywords">
		</div>
		
		<div class="mb-3 col-md-12">
			<label for="metadesc" class="form-label">Meta Description</label>
			<textarea type="text" rows="3" class="form-control" name="metadesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>
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