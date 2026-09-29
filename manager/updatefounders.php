<?php include "config.php";
$title = 'Edit Founder';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$fdid = $_GET['id'] ?? "";
$sqlfd = mysqli_query($con, "SELECT * FROM founders WHERE id = {$fdid}");
if(mysqli_num_rows($sqlfd)){
	$rwfd = mysqli_fetch_assoc($sqlfd);

}

if(isset($_POST['editRecord'])){

	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwfd['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "founders");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE founders SET `name` = '$name', `title` = '$title', `description` = '$description', `file` = '$uploadpath', `order` = '$order' WHERE id = $fdid");
		
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
			<h3>Edit Founder</h3>
		</div>
		<div class="createbtn">
			<a href="createfounders.php"> Add New</a>
			<a href="founders.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" enctype="multipart/form-data" class="row">		
			<div class="mb-3 col-md-6">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $rwfd['name']; ?>">
			</div>

			<div class="mb-3 col-md-6">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwfd['title']; ?>">
			</div>

			<div class="mb-3 col-md-8">
				<label for="description" class="form-label">Description</label>
				<textarea class="form-control" name="description" rows="3"><?php echo $rwfd['description']; ?></textarea>
			</div>

			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwfd['order']; ?>">
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Image</label>
				<input type="file" class="form-control" name="img" accept="image/*">
				<?php if(!empty($rwfd['file'])){ ?>
				<img src="<?=$path.$rwfd['file'];?>" style="width:100px;margin-top:10px;">
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
