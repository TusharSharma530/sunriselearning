<?php include 'config.php';
$title = 'Create Youtube';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$urlcode = trim(mysqli_real_escape_string($con,$_POST['urlcode']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	$sqlins = mysqli_query($con,"INSERT INTO `youtube` (`id`, `youtubeurl`, `order`, `status`) VALUES (NULL, '$urlcode', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createyoutube.php' class=' btn btn-primary'>Create New</a></div>";
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
			<a href="youtube.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-9">
			<label for="urlcode" class="form-label">Youtube URL Code</label>
			<input type="text" class="form-control" name="urlcode" required>
		</div>

		<div class="mb-3 col-md-3">
			<label for="order" class="form-label">Order</label>
            <?php $sqlcurri = mysqli_query($con, "SELECT * FROM `youtube` ORDER BY `id` DESC");
            $rwcurri = mysqli_fetch_assoc($sqlcurri); ?>			
			<input type="text" class="form-control" name="order" placeholder="Last Order No. : <?=$rwcurri['order'];?>">
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