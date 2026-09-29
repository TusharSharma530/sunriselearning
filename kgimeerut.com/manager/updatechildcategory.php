<?php include "config.php";
$title = 'Edit Child Category';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_GET['id'])){
	$tcupid = $_GET['id'];
}else{
	$tcupid = '';
}

$sqltc = mysqli_query($con, "SELECT * FROM childcategory WHERE id = {$tcupid}");
if(mysqli_num_rows($sqltc)){
	$rwtc = mysqli_fetch_assoc($sqltc);
}

if(isset($_POST['updateinfo'])){
	$category = trim(mysqli_real_escape_string($con, $_POST['category']));
	$subcategory = trim(mysqli_real_escape_string($con, $_POST['subcategory']));
	$childname = trim(mysqli_real_escape_string($con, $_POST['childname']));
	$url = seo_friendly_url($childname);
	$order = trim(mysqli_real_escape_string($con, $_POST['order']));
	$cdesc = trim(mysqli_real_escape_string($con, $_POST['cdesc']));
	$metatitle = trim(mysqli_real_escape_string($con, $_POST['meta-title']));
	$metakeywords = trim(mysqli_real_escape_string($con, $_POST['meta-keywords']));
	$metadesc = trim(mysqli_real_escape_string($con, $_POST['meta-desc']));
	
	if(empty($_FILES['img']['name'])){
		$image = $rwcat['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "childcat");
		if(!empty($rwtc['img']))	{
			if(file_exists("../".$rwtc['file'])){
				unlink("../".$rwtc['file']);
			}			
		}
	}

	$sqlcheck = mysqli_query($con,"UPDATE childcategory SET `cat_id` = '$category', `subcat_id` = '$subcategory', `childcat` = '$childname', `order` = '$order', `url` = '$url', `cdesc` = '$cdesc', `meta_title` = '$metatitle', `meta_keywords` = '$metakeywords', `meta_desc` = '$metadesc', `file` = '$uploadpath' WHERE id = $tcupid");
		
	if($sqlcheck){
		echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success'); </script>";
		
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); </script>";
		}
	
	exit();
} 


// SET CATEGORIES 
if(isset($_POST['setcat'])){
	$id = $_POST['catid'];
	$sql = mysqli_query($con, "SELECT * FROM sub_cat WHERE cat_id = $id");
	$output = "<option value=''>-- Select Sub Category--</option>";
	if(mysqli_num_rows($sql)){
		while($rw = mysqli_fetch_array($sql)){
			$output .= "<option value='{$rw['id']}'>{$rw['sc_name']}</option>"; 
		}
	}
	echo $output;
	exit();

}


// SET PRODUCT NAME 
if(isset($_POST['setsubcat'])){
	$id = $_POST['subcatid'];
	$sql = mysqli_query($con, "SELECT * FROM products WHERE subcat = $id");
	$output = "<option value=''>-- Select Product --</option>";
	if(mysqli_num_rows($sql)){
		while($rw = mysqli_fetch_array($sql)){
			$output .= "<option value='{$rw['id']}'>-{$rw['name']}</option>"; 
		}
	}
	echo $output;
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
			<h3>Edit Child Category</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createchildcategory.php"> Add New</a>
			<a href="childcategory.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
<div class="msgbox"></div>
<form method="POST" id="submitForm">
	<div class="row">

	<div class="mb-3 col-md-4">
		<label for="category" class="form-label">Category</label>
		<select name="category" class="form-control" id="category">
			<option value="">- Select Category -</option>
<?php $sqlcat = mysqli_query($con, "SELECT * FROM category WHERE c_type = 1  ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcat)){
while($rwcat = mysqli_fetch_array($sqlcat)){
// if($rwcat['id']==$rwtc['cat']){$seel}
$selected = $rwcat['id']==$rwtc['cat_id'] ? "selected" : "";
echo "<option {$selected} value='{$rwcat['id']}'>{$rwcat['c_name']}</option>";	}
}
?>									
		</select>								
	</div>

	<div class="mb-3 col-md-4">
		<label for="subcategory" class="form-label">Sub Category</label>
		<select name="subcategory" class="form-control" id="subcategory">
			<option value="">- Select Sub Category -</option>
<?php $sqlsubcat = mysqli_query($con, "SELECT * FROM sub_cat WHERE cat_id = {$rwtc['cat_id']}");
if(mysqli_num_rows($sqlsubcat)){
while($rwsubcat = mysqli_fetch_array($sqlsubcat)){
$selected = $rwsubcat['id']==$rwtc['subcat_id'] ? "selected" : "";
echo "<option {$selected} value='{$rwsubcat['id']}'>{$rwsubcat['sc_name']}</option>";	}
}
?>										
		</select>								
	</div>
	
	<div class="mb-3 col-md-4">
		<label for="name" class="form-label">Child Category</label>
		<input type="text" class="form-control" id="childname" name="childname" value="<?=$rwtc['childcat'];?>">								
	</div>

	<div class="mb-3 col-md-4">
		<label for="order" class="form-label">Order</label>
		<input type="text" class="form-control" name="order" id="order" required value="<?=$rwtc['order'];?>">
	</div>

	<div class="mb-3 col-md-12">
		<label for="desc" class="form-label">Description</label>
		<textarea class="tinyMCE" name="cdesc" id="desc"><?=$rwtc['cdesc'];?></textarea>
	</div>

	<div class="mb-3 col-md-6">
		<label for="mtitle" class="form-label">Meta Title</label>
		<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?=$rwtc['meta_title'];?>">
	</div>

	<div class="mb-3 col-md-6">
		<label for="mkeywords" class="form-label">Meta Keywords</label>
		<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?=$rwtc['meta_keywords'];?>">
	</div>

	<div class="mb-3 col-md-12">
		<label for="mdesc" class="form-label">Meta Description</label>
		<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?=$rwtc['meta_desc'];?></textarea>
		
	</div>


	<div class="mb-3 col-md-12">
	  	<label for="formFile" class="form-label">Image</label>
	  	<input class="form-control" name="img" type="file" onchange="displayimg(this)" id="mainimg">
	</div>
	
	<div class="mb-3 col-md-12">
		<?php if(empty($rwtc['file'])){$img = $path.$rwtc['file'];}else{$img = "images/preview.png";} ?>
	  	<img src="images/preview.png" alt="2" id='previmg' onclick='triggerClick()' style='width:150px;'>
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

<script>
	

	$(document).on("change", "#category", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setcat : 1, catid : $id},
			success : function(data){
				$('#subcategory').html(data);
			}
		})
	})

	$(document).on("change", "#subcategory", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setsubcat : 1, subcatid : $id},
			success : function(data){
				$('#product').html(data);
			}
		})
	})





</script>