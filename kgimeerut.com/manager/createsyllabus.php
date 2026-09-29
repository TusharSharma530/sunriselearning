<?php include 'config.php';
$title = 'Create Syllabus';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$courseid = trim(mysqli_real_escape_string($con,$_POST['courseid']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['pdf']['name'])){
		$uploadpath = createImgWebp("pdf", "syllabus");
	}

	$sqlins = mysqli_query($con,"INSERT INTO `syllabus` (`id`, `title`, `file`, `courseid`, `order`) VALUES (NULL, '$title', '$uploadpath', '$courseid', '$order')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createsyllabus.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
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
			<a href="syllabus.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
<div class="msgbox"></div>
<form method="POST" id="submitForm">
<div class="row">
    <div class="mb-3 col-md-3">
		<label for="courses" class="form-label">Courses</label>
		<select class="form-control form-select" name="courseid" required>
		    <option value="">--Select Course--</option>
		<?php $sqlcourse=mysqli_query($con,"SELECT * FROM `courses` ORDER BY `order` ASC");
		while($rwcourse=mysqli_fetch_array($sqlcourse)){ ?>
		    <option value="<?=$rwcourse['id'];?>"><?=$rwcourse['title'];?></option>
		<?php } ?>
		</select>
	</div>
	<div class="mb-3 col-md-8">
		<label for="title" class="form-label">Title</label>
		<input type="text" class="form-control" name="title" required>
	</div>

	<div class="mb-3 col-md-1">
		<label for="order" class="form-label">Order</label>
        <?php $sqlcurri = mysqli_query($con, "SELECT * FROM `notice` ORDER BY `id` DESC");
        $rwcurri = mysqli_fetch_assoc($sqlcurri); ?>			
		<input type="text" class="form-control" name="order">
	</div>


	<div class="mb-3 col-md-12">
	  	<label for="formFile" class="form-label">PDF File</label>
        <input class="form-control imgInput" name="pdf" type="file">
	</div>

	<div class="col-md-12">
		<input type="submit" value="Add Record" name="addRecord" class="submitInput">
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