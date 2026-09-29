<?php include "config.php";
$title = 'Edit Achievement';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$awid = $_GET['id'] ?? "";
$sqlaw = mysqli_query($con, "SELECT * FROM achievements WHERE id = {$awid}");
if(mysqli_num_rows($sqlaw)){
	$rwaw = mysqli_fetch_assoc($sqlaw);
}

if(isset($_POST['editRecord'])){

	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$youtube_url = trim(mysqli_real_escape_string($con,$_POST['youtube_url']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwaw['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "achievements");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE achievements SET `title` = '$title', `description` = '$description', `file` = '$uploadpath', `youtube_url` = '$youtube_url', `order` = '$order' WHERE id = $awid");
		
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
			<h3>Edit Achievement</h3>
		</div>
		<div class="createbtn">
			<a href="createachievements.php"> Add New</a>
			<a href="achievements.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" enctype="multipart/form-data" class="row">		
			<div class="mb-3 col-md-6">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwaw['title']; ?>">
			</div>

			<div class="mb-3 col-md-6">
				<label for="youtube_url" class="form-label">YouTube Video ID</label>
				<input type="text" class="form-control" name="youtube_url" value="<?php echo $rwaw['youtube_url']; ?>" placeholder="e.g. dQw4w9WgXcQ">
			</div>

			<div class="mb-3 col-md-8">
				<label for="description" class="form-label">Description</label>
				<textarea class="form-control" name="description" rows="3"><?php echo $rwaw['description']; ?></textarea>
			</div>

			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwaw['order']; ?>">
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Image</label>
				<input type="file" class="form-control" name="img" accept="image/*">
				<?php if(!empty($rwaw['file'])){ ?>
				<img src="<?=$path.$rwaw['file'];?>" style="width:100px;margin-top:10px;">
				<?php } ?>
			</div>

			<div class="col-md-12">
				<input type="submit" value="Edit Record" name="editRecord" class="submitInput">
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
