<?php include "config.php";
$title = 'Edit Award';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$awid = $_GET['id'] ?? "";
$sqlaw = mysqli_query($con, "SELECT * FROM awards WHERE id = {$awid}");
if(mysqli_num_rows($sqlaw)){
	$rwaw = mysqli_fetch_assoc($sqlaw);

}

if(isset($_POST['editRecord'])){

	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwaw['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "awards");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE awards SET `name` = '$name', `title` = '$title', `description` = '$description', `file` = '$uploadpath', `order` = '$order' WHERE id = $awid");
		
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
			<h3>Edit Award</h3>
		</div>
		<div class="createbtn">
			<a href="createawards.php"> Add New</a>
			<a href="awards.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" enctype="multipart/form-data" class="row">		
			<div class="mb-3 col-md-6">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $rwaw['name']; ?>">
			</div>

			<div class="mb-3 col-md-6">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwaw['title']; ?>">
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
