<?php include "config.php";
$title = 'Edit Subject';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}


$id = $_GET['id'] ?? "";
$sqlsubjects = mysqli_query($con, "SELECT * FROM subjects WHERE id = $id");
if(mysqli_num_rows($sqlsubjects)){
	$rwsubjects = mysqli_fetch_assoc($sqlsubjects);
}

if(isset($_POST['editRecord'])){
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
	 
	if(empty($_FILES['img']['name'])){
		$image = $rwsubjects['featured_img'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "subjects");
		if(!empty($rwsubjects['img']))	{
			if(file_exists("../".$rwsubjects['featured_img'])){
				unlink("../".$rwsubjects['featured_img']);
			}			
		}
	}
	$sqlcheck = mysqli_query($con,"UPDATE `subjects` SET title = '$subject', url = '$url', type = '$ctype', `courses` = '$courses', `desc` = '$cdesc', sdesc = '$sdesc', featured_img = '$uploadpath', meta_title = '$mtitle', meta_keywords = '$mkeywords', meta_desc = '$mdesc', `order` = '$order'  WHERE id = $id");
		
	if($sqlcheck){
		echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success'); </script>";
		
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); </script>";
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
			<h3>Edit Subject</h3>
		</div>
		<div class="createbtn">
			<a href="createsubject.php"> Add New</a>
			<a href="subjects.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Course Type</label>
			<select class="form-control" id="type" name="ctype"  required>
				<option value=''>-- Select Courses Type --</option>
<?php $sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwcoursetype = mysqli_fetch_array($sqlcoursetype)){ 
$selected = $rwcoursetype['id']==$rwsubjects['type'] ? "selected" : "";
?>
				<option <?=$selected;?> value="<?=$rwcoursetype['id'];?>"><?=$rwcoursetype['title'];?></option>
<?php } ?>
				
			 
				
			</select>
			
		</div>

		<div class="mb-3 col-md-4">
			<label for="courses" class="form-label">Courses</label>
			<select class="form-control" id="courses" name="courses"  required>
				<option value=''>-- Select Course --</option>
<?php $sqlcourses = mysqli_query($con, "SELECT * FROM `courses` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwcourses = mysqli_fetch_array($sqlcourses)){ 
$selected = $rwcourses['id']==$rwsubjects['courses'] ? "selected" : "";
?>
				<option <?=$selected;?> value="<?=$rwcourses['id'];?>"><?=$rwcourses['title'];?></option>
<?php } ?>
				
			 
				
			</select>
			
		</div>

		<div class="mb-3 col-md-4">
			<label for="subject" class="form-label">Subject</label>
			<input type="text" class="form-control" id="subject" name="subject" value="<?php echo $rwsubjects['title']; ?>" required>
		</div>

		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" value="<?php echo $rwsubjects['order']; ?>" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="form-control tinyMCE" name="sdesc" id="sdesc"><?php echo $rwsubjects['sdesc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="form-control tinyMCE" name="cdesc" id="cdesc"><?php echo $rwsubjects['desc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?php echo $rwsubjects['meta_title']; ?>" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?php echo $rwsubjects['meta_keywords']; ?>" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?php echo $rwsubjects['meta_desc']; ?></textarea>
			
		</div>


		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				
				<?php $active = empty($rwsubjects['featured_img']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
				<?php if($rwsubjects['featured_img'] == ''){ ?>
				<img src="images/preview.jpg" alt="2" class='preview'>
					<?php }else{ ?>
				<img src="<?=$path.$rwsubjects['featured_img'];?>" alt="<?=$path.$rwsubjects['featured_img'];?>" class='preview'>
					<?php } ?>
			</div>
		</div>
		

		<div class="mt-2 mx-auto">
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