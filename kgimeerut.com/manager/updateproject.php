<?php include "config.php";
$title = 'Edit Projects';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_GET['tcupid'])){
	$tcupid = $_GET['tcupid'];
}else{
	$tcupid = '';
}

$sqltc = mysqli_query($con, "SELECT * FROM projects WHERE id = {$tcupid}");
if(mysqli_num_rows($sqltc)){
	$rwtc = mysqli_fetch_assoc($sqltc);

}

if(isset($_POST['updateinfo'])){

	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwtc['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "projects");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE projects SET title = '$title',  url = '$url', `desc` = '$desc', `sdesc` = '$sdesc', file = '$uploadpath', `order` = '$order' WHERE id = $tcupid");
		
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
			<h3>Edit Projects</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createproject.php"> Add New</a>
			<a href="projects.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm">
			<div class="row">
			
			<div class="mb-3 col-md-8">
				<label for="sname" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwtc['title']; ?>" required>
			</div>
			
			<div class="mb-3 col-md-4">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwtc['order']; ?>" required>
			</div>

			<div class="mb-3 col-md-12">
				<label for="sdesc" class="form-label">Short Description</label>
				<textarea type="text" class="tinyMCE"  name="sdesc"><?php echo $rwtc['sdesc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
				<label for="sclass" class="form-label">Description</label>
				<textarea type="text" class="tinyMCE"  name="idesc"><?php echo $rwtc['desc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
			  	<input class="form-control" name="img" type="file" onchange="displayimg(this)" id="mainimg">
			</div>
			
			<div class="mb-3 col-md-12">
			  	<img src="../<?php echo $rwtc['file']; ?>" alt="2" id='previmg' onclick='triggerClick()' style='width:150px;'>
			</div>

			<div class="mt-2 mx-auto">
				<input type="submit" value="Edit Record" name="updateinfo" class="btn btn-primary">
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