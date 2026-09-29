<?php include "config.php";
$title = 'Edit Testimonial';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$tcupid = $_GET['id'] ?? "";
$sqltc = mysqli_query($con, "SELECT * FROM testimonials WHERE id = {$tcupid}");
if(mysqli_num_rows($sqltc)){
	$rwtc = mysqli_fetch_assoc($sqltc);

}

if(isset($_POST['editRecord'])){

	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwtc['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "testimonials");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE testimonials SET `title` = '$title',  `url` = '$url', `desc` = '$desc', `file` = '$uploadpath', `order` = '$order' WHERE id = $tcupid");
		
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
			<h3>Edit Testimonial</h3>
		</div>
		<div class="createbtn">
			<a href="createtestimonial.php"> Add New</a>
			<a href="testimonials.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-9">
				<label for="sname" class="form-label">Name</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwtc['title']; ?>">
			</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwtc['order']; ?>">
			</div>

			<div class="mb-3 col-md-12">
				<label for="sclass" class="form-label">Description</label>
				<textarea type="text" class="tinyMCE"  name="idesc" required><?php echo $rwtc['desc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
			  	<div class="imgquestion other">
			  		
			  		<?php $active = empty($rwtc['file']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
					<?php if($rwtc['file'] == ''){ ?>
					<img src="images/preview.jpg" alt="2" class='preview'>
			  		<?php }else{ ?>
					<img src="<?=$path.$rwtc['file'];?>" alt="<?=$path.$rwtc['file'];?>" class='preview'>
			  		<?php } ?>
				</div>
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