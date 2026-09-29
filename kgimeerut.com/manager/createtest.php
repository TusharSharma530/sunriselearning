<?php include 'config.php';
$title = 'Add Test';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}



if(isset($_POST['addRecord'])){	 

	$category = trim(mysqli_real_escape_string($con, $_POST['category']));
	$course = trim(mysqli_real_escape_string($con, $_POST['course']));
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
	$uploadpath = "";			

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "test");
	}else{
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM test WHERE title = '$testname'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO `test`(`id`, `title`, `type`, `courses`, `subject`, `testtype`, `url`, `totaltime`, `totalmarks`, `totalquestions`, `negativemarking`, `starttime`, `endtime`, `desc`, `sdesc`, `featured_img`, `meta_title`, `meta_keywords`, `meta_desc`, `status`, `order`) VALUES (Null,'$testname', '$category', '$course', '$subject', '$testtype', '$url', '$totaltime', '$totalmarks', '$totalquestion', '$nmarks', '$starttime', '$endtime', '$cdesc', '$sdesc', '$uploadpath', '$mtitle', '$mkeywords', '$mdesc', 1, '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createtest.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Add Test</h3>
		</div>
		<div class="createbtn">
			<a href="test.php">List</a>
		</div>
	</div>
</div>

<div class="col-md-12">

	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">
		<div class="mb-3 col-md-4">
			<label for="category" class="form-label">Course Types</label>
			<select class="form-control" id="category" name="category" required>
				<option value=''>-- Select Course Type --</option>
<?php $sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwcoursetype = mysqli_fetch_array($sqlcoursetype)){ ?>
				<option value="<?=$rwcoursetype['id'];?>"><?=$rwcoursetype['title'];?></option>
<?php } ?>				
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Course</label>
			<select class="form-control" id="course" name="course" required>
				<option value=''>-- Select Courses --</option>			
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="subject" class="form-label">Subject</label>
			<select class="form-control" id="subject" name="subject">
				<option value=''>-- Select Subject --</option>			
			</select>							
		</div>		

		<div class="mb-3 col-md-4">
			<label for="testtype" class="form-label">Assessment/Test</label>
			<select class="form-control" id="testtype" name="testtype" required>
				<option value=''>-- Select Assessment/Test --</option>
				<option value="1">Assessment</option>
				<option value="2">Test</option>
			</select>							
		</div>

		<div class="mb-3 col-md-8">
			<label for="testname" class="form-label">Test Name</label>
			<input type="text" class="form-control" id="testname" name="testname" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="totaltime" class="form-label">Total Time (In Minutes)</label>
			<input type="text" class="form-control" id="totaltime" name="totaltime" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="totalquestion" class="form-label">Total Questions</label>
			<input type="text" class="form-control" id="totalquestion" name="totalquestion" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="totalmarks" class="form-label">Total Marks</label>
			<input type="text" class="form-control" id="totalmarks" name="totalmarks" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="nmarks" class="form-label nmarkslabel">Negative Marking (if yes)</label>
			<input type="text" class="form-control" id="negativemark" name="nmarks">
		</div>

		<div class="mb-3 col-md-3">
			<label for="starttime" class="form-label">Start Date & Time</label>
			<input type="datetime-local" class="form-control" id="starttime" name="starttime" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="endtime" class="form-label">End Date & Time</label>
			<input type="datetime-local" class="form-control" id="endtime" name="endtime" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required>
		</div>


		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">General Instructions</label>
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
	$(document).on("change", "#category", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setcat : 1, catid : $id},
			success : function(data){
				$('#course').html(data);
			}
		})
	})	

$(document).on("change", "#course", function(){ 
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