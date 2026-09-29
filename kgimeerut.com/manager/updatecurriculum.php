<?php include "config.php";
$title = 'Edit Curriculum';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = '';
}

$sqlnews = mysqli_query($con, "SELECT * FROM `curriculum` WHERE id = $id");
$rwnews = mysqli_fetch_assoc($sqlnews);

if(isset($_POST['editRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$desc = trim(mysqli_real_escape_string($con,$_POST['idesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
    
    if(empty($_FILES['img']['name'])){
		$image = $rwnews['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "curriculum");
		if(!empty($rwnews['file']))	{
			if(file_exists("../".$rwnews['file'])){
				unlink("../".$rwnews['file']);
			}			
		}
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `curriculum` SET `title` = '$title',  `url` = '$url', `desc` = '$desc', `sdesc` = '$sdesc', `file` = '$uploadpath', `order` = '$order' WHERE `id` = $id");
		
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
			<h3>Edit Curriculum</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createcurriculum.php"> Add New</a>
			<a href="curriculum.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm">
			<div class="row">

			<div class="mb-3 col-md-11">
				<label for="sname" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwnews['title']; ?>" required>
			</div>

			<div class="mb-3 col-md-1">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwnews['order']; ?>" required>
			</div>

			<div class="mb-3 col-md-12">
				<label for="sdesc" class="form-label">Short Description</label>
				<textarea type="text" class="tinyMCE"  name="sdesc"><?php echo $rwnews['sdesc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
				<label for="sclass" class="form-label">Description</label>
				<textarea type="text" class="tinyMCE"  name="idesc"><?php echo $rwnews['desc']; ?></textarea>
			</div>
			
			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Image</label>
			  	<div class="imgquestion other">
					<?php $active = empty($rwnews['file']) ? "" : "active"; ?>
    					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
    					<input hidden class="form-control imgInput" name="img" type="file">
	  				<?php if(empty($rwnews['file'])){ ?>
	  				    <img src="images/preview.jpg" alt="preview" class='preview'>
	  				<?php }else{ ?>
	  				    <img src="<?=$path.$rwnews['file'];?>" alt="<?=$rwnews['file'];?>" class='preview'>
	  				<?php } ?>
	  			</div>
			</div>
			

			<div class="mt-2 mx-auto">
				<input type="submit" value="Edit Record" name="editRecord" class="btn btn-primary">
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