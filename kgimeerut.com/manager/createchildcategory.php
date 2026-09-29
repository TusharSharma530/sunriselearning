<?php include 'config.php';
$title = 'Create Child Category';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addTc'])){	
	$category = trim(mysqli_real_escape_string($con, $_POST['category']));
	$subcategory = trim(mysqli_real_escape_string($con, $_POST['subcategory']));
	$childname = trim(mysqli_real_escape_string($con, $_POST['childname']));
	$url = seo_friendly_url($childname);
	$order = trim(mysqli_real_escape_string($con, $_POST['order']));
	$cdesc = trim(mysqli_real_escape_string($con, $_POST['cdesc']));
	$metatitle = trim(mysqli_real_escape_string($con, $_POST['meta-title']));
	$metakeywords = trim(mysqli_real_escape_string($con, $_POST['meta-keywords']));
	$metadesc = trim(mysqli_real_escape_string($con, $_POST['meta-desc']));
	$uploadpath = "";			
	
	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "childcat");
	}

	$sqlins = mysqli_query($con,"INSERT INTO `childcategory`(`id`, `cat_id`, `subcat_id`, `childcat`, `url`, `cdesc`, `order`, `meta_title`, `meta_keywords`, `meta_desc`, `file`, `status`) VALUES (NULL, '$category', '$subcategory', '$childname', '$url', '$cdesc', '$order', '$metatitle', '$metakeywords', '$metadesc', '$uploadpath', 1)");
		
	if($sqlins){
	echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
	$('#submitForm').hide();
	</script>";
	echo "<div class='col-md-12 padd0 text-center'><a href='createchildcategory.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
	echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
	}
	exit();
} 

// SET CATEGORIES 
if(isset($_POST['setcat'])){
	$id = $_POST['catid'];
	$sql = mysqli_query($con, "SELECT * FROM sub_cat WHERE cat_id = $id ORDER BY `order` ASC");
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
			$output .= "<option value='{$rw['id']}'>{$rw['pro_code']}-{$rw['name']}</option>"; 
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
			<h3>Create Child Category</h3>
		</div>
		<div class="createbtn">
			<a href="childcategory.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">


		<div class="mb-3 col-md-4">
			<label for="category" class="form-label">Category</label>
			<select name="category" class="form-control" id="category">
				<option value="">- Select Category -</option>
<?php $sqlcat = mysqli_query($con, "SELECT * FROM category WHERE c_type = 1 AND id NOT IN ('25', '32') ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcat)){
while($rwcat = mysqli_fetch_array($sqlcat)){
echo "<option value='{$rwcat['id']}'>{$rwcat['c_name']}</option>";	}
}
?>
			</select>								
		</div>

		<div class="mb-3 col-md-4">
			<label for="subcategory" class="form-label">Sub Category</label>
			<select name="subcategory" class="form-control" id="subcategory">
				<option value="">- Select Sub Category -</option>
			</select>								
		</div>
		
		<div class="mb-3 col-md-4">
			<label for="name" class="form-label">Child Category</label>
			<!-- <select name="name" class="form-control" id="product">
				<option value="">- Select Product -</option>
			</select> -->
			<input type="text" class="form-control" name="childname" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" name="order" id="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="desc" class="form-label">Description</label>
			<textarea class="tinyMCE" name="cdesc" id="desc"></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"></textarea>
			
		</div>


		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>		  	
		</div>
		
		<div class="mt-2 mx-auto">
			<input type="submit" value="Add Record" name="addTc" class="btn btn-primary">
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