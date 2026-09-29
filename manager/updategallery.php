<?php include "config.php";
$title = 'Edit Gallery';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqlgallery = mysqli_query($con, "SELECT * FROM `gallery` WHERE id = $id");
if(mysqli_num_rows($sqlgallery)){
	$rwgallery = mysqli_fetch_assoc($sqlgallery);

}
if(isset($_POST['updatetc'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	echo $title;
	exit();
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$uploadpath = $rwgallery['file'];
	}else{
		$uploadpath = createImgWebp("img", "gallery");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `gallery` SET `title` = '$title',  `url` = '$url', `desc` = '$desc', `file` = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
			<h3>Edit Gallery</h3>
		</div>
		<div class="createbtn">
			<a href="creategallery.php"> Add New</a>
			<a href="gallery.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-9">
				<label for="sname" class="form-label">Name</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwgallery['title']; ?>">
			</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwgallery['order']; ?>">
			</div>

			<div class="mb-3 col-md-12">
				<label for="sclass" class="form-label">Description</label>
				<textarea type="text" class="tinyMCE"  name="idesc" required><?php echo $rwgallery['desc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
			  	<div class="imgquestion other">
			  		
			  		<?php $active = empty($rwgallery['file']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
					<?php if($rwgallery['file'] == ''){ ?>
					<img src="images/preview.jpg" alt="2" class='preview'>
			  		<?php }else{ ?>
					<img src="<?=$path.$rwgallery['file'];?>" alt="<?=$path.$rwgallery['file'];?>" class='preview'>
			  		<?php } ?>
				</div>
			</div>

			<div class="col-md-12">
				<input type="submit" value="Edit Record" name="updatetc" class="submitInput">
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