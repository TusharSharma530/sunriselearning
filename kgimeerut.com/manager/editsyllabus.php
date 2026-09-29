<?php include "config.php";
$title = 'Edit Syllabus';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}
$id = $_GET['id'] ?? "";
$sqlshow = mysqli_query($con, "SELECT * FROM `syllabus` WHERE id = $id");
if(mysqli_num_rows($sqlshow)){
	$rwshow = mysqli_fetch_assoc($sqlshow);

}
if(isset($_POST['updatetc'])){
	$courseid = trim(mysqli_real_escape_string($con,$_POST['courseid']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['pdf']['name'])){
		$uploadpath = $rwshow['file'];
	}else{
		$uploadpath = createImgWebp("pdf", "syllabus");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `syllabus` SET `title` = '$title', `file` = '$uploadpath', `courseid`='$courseid', `order` = '$order' WHERE id = $id");
		
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="createsyllabus.php"> Add New</a>
			<a href="syllabus.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
<div class="msgbox"></div>
<form method="POST" id="submitForm" class="row">
    <div class="mb-3 col-md-3">
		<label for="courses" class="form-label">Courses</label>
		<select class="form-control form-select" name="courseid" required>
		    <option value="">--Select Course--</option>
		<?php $sqlcourse=mysqli_query($con,"SELECT * FROM `courses` ORDER BY `order` ASC");
		while($rwcourse=mysqli_fetch_array($sqlcourse)){
		$sel= $rwcourse['id']==$rwshow['courseid'] ? "selected" : "";?>
		    <option value="<?=$rwcourse['id'];?>" <?=$sel;?>><?=$rwcourse['title'];?></option>
		<?php } ?>
		</select>
	</div>
	<div class="mb-3 col-md-8">
		<label for="sname" class="form-label">Title</label>
		<input type="text" class="form-control" name="title" value="<?php echo $rwshow['title']; ?>">
	</div>

	<div class="mb-3 col-md-1">
		<label for="order" class="form-label">Order</label>
		<input type="text" class="form-control" name="order" value="<?php echo $rwshow['order']; ?>">
	</div>
	
	<div class="mb-3 col-md-12">
	  	<label for="formFile" class="form-label">PDF File</label>
		<input class="form-control" name="pdf" type="file">
		<?php if(!empty($rwshow['file'])){ ?>
		<iframe src="<?=$path.$rwshow['file'];?>" style="width:200px; height:200px;margin: 15px 0 0;" frameborder="0"></iframe>
		<?php } ?>
	</div>

	<div class="col-md-12">
		<input type="submit" value="Edit Record" name="updatetc" class="submitInput">
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