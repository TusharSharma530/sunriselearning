<?php include 'config.php';
$title = 'Add Sub Category';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

	// FOR PARENT CATEGORY
	$sqlcat = mysqli_query($con,"SELECT * FROM category WHERE c_type = 1 ORDER BY `order` ASC"); 


	// FOR ADD SUB CATEGORY
	if(isset($_POST['addSubCat'])){
		$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
		$scname = trim(mysqli_real_escape_string($con,$_POST['scname']));
		$url = seo_friendly_url($scname);
		$scdesc = trim(mysqli_real_escape_string($con,$_POST['scdesc']));
		$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
		$features = trim(mysqli_real_escape_string($con,$_POST['features']));
		$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
		$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
		$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
		$order = trim(mysqli_real_escape_string($con,$_POST['order']));
		$uploadpath = "";
		$uploadpath1 = "";
		
		if(isset($_FILES['img']['name'])){
			$uploadpath = createImgWebp("img", "subcat");		
		}

		if(isset($_FILES['img1']['name'])){
			$uploadpath1 = createImgWebp("img1", "subcat");
		}

		$sqlcheck = mysqli_query($con,"SELECT * FROM sub_cat WHERE sc_name = '$scname'");
		if(mysqli_num_rows($sqlcheck)){
			echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
			
		}else{
			$sqlins = mysqli_query($con,"INSERT INTO sub_cat (id, cat_id, sc_name, sc_url, sc_desc, sdesc, features, featured_img, featured_img1, meta_title, meta_keywords, meta_desc, status, `order`) VALUES (NULL, '$cname', '$scname', '$url', '$scdesc', '$sdesc', '$features', '$uploadpath', '$uploadpath1', '$mtitle', '$mkeywords', '$mdesc', '1', '$order')");
			
		if($sqlins){
			echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
					$('#submitForm').hide();
				 </script>";
			echo "<div class='col-md-12 padd0 text-center'><a href='createsub-category.php' class=' btn btn-primary'>Create New</a></div>";
		}else{
				
			echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
			}
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
			<h3>Add Sub Category</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="sub-category.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">		
		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Category Name</label>
			<select name="cname" id="cname" class="form-control" required>
				<option selected>-- Select Category --</option>
				<?php
					if(mysqli_num_rows($sqlcat)){
					while($rwcat = mysqli_fetch_assoc($sqlcat)){
						echo "<option value='{$rwcat['id']}'>{$rwcat['c_name']}</option>";
						}
					}
				 ?>
			</select>
			
		</div>

		<div class="mb-3 col-md-4">
			<label for="scname" class="form-label">Sub Category Name</label>
			<input type="text" class="form-control" id="scname" name="scname" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="form-control tinyMCE" name="sdesc" id="sdesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="desc" class="form-label">Description</label>
			<textarea class="form-control tinyMCE" name="scdesc" id="desc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="features" class="form-label">Features</label>
			<textarea class="form-control tinyMCE" name="features" id="features"></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title">
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords">
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"></textarea>
			
		</div>


		<div class="mb-3 col-md-6">
		  	<label for="formFile" class="form-label">Banner Image</label>
		  	<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>		  	
		</div>
		
		<div class="mb-3 col-md-6">
		  	<label for="formFile" class="form-label">Main Image</label>
		  	<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img1" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>		  	
		</div>
		
		

		<div class="mt-2 mx-auto">
			<input type="submit" value="Add Sub Category" name="addSubCat" class="btn btn-primary">
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