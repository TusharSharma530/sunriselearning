<?php include "config.php";
$title = 'Edit Youtube';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqlshow = mysqli_query($con, "SELECT * FROM `youtube` WHERE id = $id");
$rwshow = mysqli_fetch_assoc($sqlshow);

if(isset($_POST['recordedit'])){
	$youtubeurl = trim(mysqli_real_escape_string($con,$_POST['urlcode']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	$sqlcheck = mysqli_query($con,"UPDATE `notice` SET `youtubeurl` = '$youtubeurl',  `order` = '$order' WHERE id = $id");
		
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
			<a href="createyoutube.php"> Add New</a>
			<a href="youtube.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-9">
				<label for="urlcode" class="form-label">Title</label>
				<input type="text" class="form-control" name="urlcode" value="<?php echo $rwshow['youtubeurl']; ?>">
			</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwshow['order']; ?>">
			</div>
			
			<div class="col-md-12">
				<input type="submit" value="Edit Record" name="recordedit" class="submitInput">
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