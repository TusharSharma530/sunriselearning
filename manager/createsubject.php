<?php include 'config.php';
$title = 'Create Subject';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){	 
	$subject = trim(mysqli_real_escape_string($con,$_POST['subject']));
	$url = seo_friendly_url($subject);
	$ctype = trim(mysqli_real_escape_string($con,$_POST['ctype']));
	$courses = trim(mysqli_real_escape_string($con,$_POST['courses']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";			

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "courses");
	}else{
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM subjects WHERE title = '$subject'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO subjects (id, title, type, courses, url, `desc`, sdesc, featured_img, meta_title, meta_keywords, meta_desc, `order`) VALUES (NULL, '$subject', '$ctype', '$courses', '$url', '$cdesc', '$sdesc', '$uploadpath', '$mtitle', '$mkeywords', '$mdesc', '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createsubject.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
		echo mysqli_error($con);
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
		}
	}
	exit();
} 


// SET PRODUCT NAME 
if(isset($_POST['setcat'])){
	$id = $_POST['catid'];
	$sql = mysqli_query($con, "SELECT * FROM `courses` WHERE `type` = $id");
	$output = "<option value=''>-- Select Course --</option>";
	if(mysqli_num_rows($sql)){
		while($rw = mysqli_fetch_array($sql)){
			$output .= "<option value='{$rw['id']}'>{$rw['title']}</option>"; 
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
			<h3>Create Subject</h3>
		</div>
		<div class="createbtn">
			<a href="subjects.php">List</a>
		</div>
	</div>
</div>

<div class="col-md-12">

	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">
		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Course Type</label>
			<select class="form-control" id="type" name="ctype" required>
				<option value=''>-- Select Courses Type --</option>
<?php $sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwcoursetype = mysqli_fetch_array($sqlcoursetype)){ ?>
				<option value="<?=$rwcoursetype['id'];?>"><?=$rwcoursetype['title'];?></option>
<?php } ?>				
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="courses" class="form-label">Courses</label>
			<select class="form-control" id="courses" name="courses"  required>
				<option value=''>-- Select Course --</option>
			</select>
			
		</div>
		
		<div class="mb-3 col-md-4">
			<label for="subject" class="form-label">Subject</label>
			<input type="text" class="form-control" id="subject" name="subject" required>
		</div>

		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="form-control tinyMCE" name="sdesc" id="sdesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="form-control tinyMCE" name="cdesc" id="cdesc"></textarea>
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
				<img src="images/preview.jpg" alt="2" class='preview'>
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

<script>
	

	$(document).on("change", "#type", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setcat : 1, catid : $id},
			success : function(data){
				$('#courses').html(data);
			}
		})
	})





</script>