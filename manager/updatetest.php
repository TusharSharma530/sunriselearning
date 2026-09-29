<?php include "config.php";
$title = 'Edit Test';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}




$id = $_GET['id'] ?? "";
$sqltest = mysqli_query($con, "SELECT * FROM test WHERE id = $id");
if(mysqli_num_rows($sqltest)){
	$rwtest = mysqli_fetch_assoc($sqltest);

}

if(isset($_POST['editRecord'])){
	$coursetype = trim(mysqli_real_escape_string($con, $_POST['coursetype']));
	$courses = trim(mysqli_real_escape_string($con, $_POST['courses']));
	$subject = trim(mysqli_real_escape_string($con, $_POST['subject']));
	$testtype = trim(mysqli_real_escape_string($con, $_POST['testtype']));
	$testname = trim(mysqli_real_escape_string($con, $_POST['testname']));
	$url = seo_friendly_url($testname);
	$totaltime = trim(mysqli_real_escape_string($con, $_POST['totaltime']));
	$totalquestion = trim(mysqli_real_escape_string($con, $_POST['totalquestion']));
	$totalmarks = trim(mysqli_real_escape_string($con, $_POST['totalmarks']));
	$order = trim(mysqli_real_escape_string($con, $_POST['order']));
	$nmarks = trim(mysqli_real_escape_string($con, $_POST['nmarks']));
	$starttime = trim(mysqli_real_escape_string($con, $_POST['starttime']));
	$endtime = trim(mysqli_real_escape_string($con, $_POST['endtime']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	 
	if(empty($_FILES['img']['name'])){
		$image = $rwtest['featured_img'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "test");
		if(!empty($rwtest['featured_img']))	{
			if(file_exists("../".$rwtest['featured_img'])){
				unlink("../".$rwtest['featured_img']);
			}			
		}
	}
	$sqlcheck = mysqli_query($con,"UPDATE `test` SET `title` = '$testname', `type` = '$coursetype', `courses` = '$courses', `subject` = '$subject', `testtype` = '$testtype', `url` = '$url', `totaltime` = '$totaltime', `totalmarks` = '$totalmarks', `totalquestions` = '$totalquestion', `negativemarking` = '$nmarks', `starttime` = '$starttime', `endtime` = '$endtime', `desc` = '$cdesc', `sdesc` = '$sdesc', `featured_img` = '$uploadpath', `meta_title` = '$mtitle', `meta_keywords` = '$mkeywords', `meta_desc` = '$mdesc', `status` = 1, `order` = '$order'  WHERE id = $id");
		
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
	$output = "<option value=''>-- Select Courses --</option>";
	if(mysqli_num_rows($sql)){
		while($rw = mysqli_fetch_array($sql)){
			$output .= "<option value='{$rw['id']}'>{$rw['title']}</option>"; 
		}
	}
	echo $output;
	exit();

}


// SET SUBJECT NAME 
if(isset($_POST['setcourse'])){
	$id = $_POST['catid'];
	$sql = mysqli_query($con, "SELECT * FROM `subjects` WHERE `courses` = $id");
	$output = "<option value=''>-- Select Subject --</option>";
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
			<h3>Edit Test</h3>
		</div>
		<div class="createbtn">
			<a href="createtest.php"> Add New</a>
			<a href="test.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">

		<div class="mb-3 col-md-4">
			<label for="coursetype" class="form-label">Course Types</label>
			<select class="form-control" id="coursetype" name="coursetype" required>
				<option value=''>-- Select Course Types --</option>
<?php $sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwcoursetype = mysqli_fetch_array($sqlcoursetype)){
$selected = $rwcoursetype['id']==$rwtest['type'] ? "selected" : ""; 
	?>
				<option <?=$selected;?> value="<?=$rwcoursetype['id'];?>"><?=$rwcoursetype['title'];?></option>
<?php } ?>				
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Courses</label>
			<select class="form-control" id="courses" name="courses" required>
				<option value=''>-- Select Courses --</option>
<?php $sqlcourses = mysqli_query($con, "SELECT * FROM `courses` WHERE type = {$rwtest['courses']}");
while($rwcourses = mysqli_fetch_array($sqlcourses)){ 
$selected = $rwcourses['id']==$rwtest['courses'] ? "selected" : ""; 
?>
					<option <?=$selected;?> value='<?=$rwcourses['id'];?>'><?=$rwcourses['title'];?></option>

<?php } ?>
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="subject" class="form-label">Courses</label>
			<select class="form-control" id="subject" name="subject">
				<option value=''>-- Select Courses --</option>
<?php $sqlsubject = mysqli_query($con, "SELECT * FROM `subjects` WHERE `courses` = {$rwtest['courses']}");
while($rwsubject = mysqli_fetch_array($sqlsubject)){ 
$selected = $rwsubject['id']==$rwtest['subject'] ? "selected" : ""; 
?>
					<option <?=$selected;?> value='<?=$rwsubject['id'];?>'><?=$rwsubject['title'];?></option>

<?php } ?>
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="testtype" class="form-label">Assessment/Test</label>
			<select class="form-control" id="testtype" name="testtype" required>
				<option value=''>-- Select Assessment/Test --</option>
				<?php if($rwtest['testtype']==1){ ?>
					<option value="1" selected>Assessment</option>
					<option value="2">Test</option>
				<?php }else if($rwtest['testtype']==2){ ?>
					<option value="1">Assessment</option>
					<option value="2" selected>Test</option>
				<?php }else{ ?>
					<option value="1">Assessment</option>
					<option value="2">Test</option>
				<?php } ?>
			</select>							
		</div>




		<div class="mb-3 col-md-8">
			<label for="testname" class="form-label">Test Name</label>
			<input type="text" class="form-control" id="testname" name="testname" required value="<?=$rwtest['title'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="totaltime" class="form-label">Total Time (In Minutes)</label>
			<input type="text" class="form-control" id="totaltime" name="totaltime" required value="<?=$rwtest['totaltime'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="totalquestion" class="form-label">Total Questions</label>
			<input type="text" class="form-control" id="totalquestion" name="totalquestion" required value="<?=$rwtest['totalquestions'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="totalmarks" class="form-label">Total Marks</label>
			<input type="text" class="form-control" id="totalmarks" name="totalmarks" required value="<?=$rwtest['totalmarks'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="nmarks" class="form-label nmarkslabel">Negative Marking (if yes)</label>
			<input type="text" class="form-control" id="negativemark" name="nmarks" value="<?=$rwtest['negativemarking'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="starttime" class="form-label">Start Date & Time</label>
			<input type="datetime-local" class="form-control" id="starttime" name="starttime" required value="<?=$rwtest['starttime'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="endtime" class="form-label">End Date & Time</label>
			<input type="datetime-local" class="form-control" id="endtime" name="endtime" required value="<?=$rwtest['endtime'];?>">
		</div>

		<div class="mb-3 col-md-3">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required value="<?=$rwtest['order'];?>">
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">General Instructions</label>
			<textarea class="form-control tinyMCE" name="sdesc" id="sdesc"><?php echo $rwtest['sdesc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="form-control tinyMCE" name="cdesc" id="cdesc"><?php echo $rwtest['desc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?php echo $rwtest['meta_title']; ?>" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?php echo $rwtest['meta_keywords']; ?>" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?php echo $rwtest['meta_desc']; ?></textarea>
			
		</div>


		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
		
				<?php $active = empty($rwtest['featured_img']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
				<?php if($rwtest['featured_img'] == ''){ ?>
				<img src="images/preview.jpg" alt="2" class='preview'>
					<?php }else{ ?>
				<img src="<?=$path.$rwtest['featured_img'];?>" alt="<?=$path.$rwtest['featured_img'];?>" class='preview'>
					<?php } ?>
			</div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Update Test" name="editRecord" class="submitInput">
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
	

	$(document).on("change", "#coursetype", function(){ 
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


$(document).on("change", "#courses", function(){ 
	var $id = $(this).val();
	$.ajax({
		url : url,
		type : "POST",
		data : {setcourse : 1, catid : $id},
		success : function(data){
			$('#subject').html(data);
		}
	})
})



</script>