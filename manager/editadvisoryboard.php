<?php include "config.php";
$title = 'Edit Advisory Board';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqltc = mysqli_query($con, "SELECT * FROM `board` WHERE id = $id");
if(mysqli_num_rows($sqltc)){
	$rwtc = mysqli_fetch_assoc($sqltc);

}

if(isset($_POST['editRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$short_desc = trim(mysqli_real_escape_string($con,$_POST['shortdesc']));
	$long_desc = trim(mysqli_real_escape_string($con,$_POST['longdesc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$uploadpath = $rwtc['file'];
	}else{
		unlink("../{$rwtc['file']}" ?? false);
		$uploadpath = createImgWebp("img", "board");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `board` SET `title` = '$title',  `url` = '$url', `long_desc` = '$long_desc', `file` = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="createadvisoryboard.php"> Add New</a>
			<a href="advisoryboard.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-9">
				<label for="title" class="form-label">Name</label>
				<input type="text" class="form-control" name="title" required value="<?=$rwtc['title'];?>">
			</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?=$rwtc['order'];?>">
			</div>

			<div class="mb-3 col-md-12">
				<label for="longdesc" class="form-label">Long Description</label>
				<textarea type="text" class="tinyMCE"  name="longdesc"><?=$rwtc['long_desc'];?></textarea>
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