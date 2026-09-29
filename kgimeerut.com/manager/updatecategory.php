<?php include "config.php";
$title = 'Update Category';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = '';
}

$sqlcat = mysqli_query($con, "SELECT * FROM category WHERE id = {$id}");
if(mysqli_num_rows($sqlcat)){
	$rwcat = mysqli_fetch_assoc($sqlcat);

}

if(isset($_POST['editRecord'])){
	$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
	$url = seo_friendly_url($cname);
	$ctype = trim(mysqli_real_escape_string($con,$_POST['ctype']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	 
	if(empty($_FILES['img']['name'])){
		$image = $rwcat['featured_img'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "category");
		if(!empty($rwcat['img']))	{
			if(file_exists("../".$rwcat['featured_img'])){
				unlink("../".$rwcat['featured_img']);
			}			
		}
	}
	$sqlcheck = mysqli_query($con,"UPDATE category SET c_name = '$cname', c_url = '$url', c_type = '$ctype', c_desc = '$cdesc', sdesc = '$sdesc', featured_img = '$uploadpath', meta_title = '$mtitle', meta_keywords = '$mkeywords', meta_desc = '$mdesc', `order` = '$order'  WHERE id = $id");
		
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
			<h3>Edit Category</h3>
		</div>
		<div class="createbtn">
			<a href="createcategory.php"> Add New</a>
			<a href="category.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">

		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Category Name</label>
			<input type="text" class="form-control" id="cname" name="cname" value="<?php echo $rwcat['c_name']; ?>" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Category Type</label>
			<select class="form-control" id="type" name="ctype"  required>
				<option value=''>-- Select Category Type --</option>
				<option value="1" <?=$rwcat['c_type'] == 1 ? "selected" : "";?>>Top</option>
				<option value="2" <?=$rwcat['c_type'] == 2 ? "selected" : "";?>>Bottom</option>
				<option value="3" <?=$rwcat['c_type'] == 3 ? "selected" : "";?>>Other</option>
			</select>
			
		</div>

		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" value="<?php echo $rwcat['order']; ?>" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="tiny" name="sdesc" id="sdesc"><?php echo $rwcat['sdesc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="tiny" name="cdesc" id="cdesc"><?php echo $rwcat['c_desc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?php echo $rwcat['meta_title']; ?>" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?php echo $rwcat['meta_keywords']; ?>" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?php echo $rwcat['meta_desc']; ?></textarea>
			
		</div>


		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<?php $active = empty($rwcat['featured_img']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<?php if(empty($rwcat['featured_img'])){ ?>
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  				<?php }else{ ?>
  				<img src="<?=$path.$rwcat['featured_img'];?>" alt="<?=$rwcat['c_name'];?>" class='preview'>
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