<?php include 'config.php';
$title = 'Add Category';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	 
	$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
	$url = seo_friendly_url($cname);
	$ctype = trim(mysqli_real_escape_string($con,$_POST['ctype']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";			

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "category");

	}else{
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM category WHERE c_name = '$cname'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO category (id, c_name, c_type, c_url, c_desc, sdesc, featured_img, meta_title, meta_keywords, meta_desc, `order`) VALUES (NULL, '$cname', '$ctype', '$url', '$cdesc', '$sdesc', '$uploadpath', '$mtitle', '$mkeywords', '$mdesc', '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createcategory.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
		echo mysqli_error($con);
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
			<h3>Add Category</h3>
		</div>
		<div class="createbtn">
			<a href="category.php">Category List</a>
		</div>
	</div>
</div>

<div class="col-md-12">

	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">
		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Category Name</label>
			<input type="text" class="form-control" id="cname" name="cname" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Category Type</label>
			<select class="form-control" id="type" name="ctype" required>
				<option value=''>-- Select Category Type --</option>
				<option value="1" selected>Top</option>
				<option value="2">Bottom</option>
				<option value="3">Other</option>									
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="tiny" name="sdesc" id="sdesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="tiny" name="cdesc" id="cdesc"></textarea>
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

		<div class="col-md-12">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
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