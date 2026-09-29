<?php include 'config.php';
$title = 'Create Placement';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$subject = trim(mysqli_real_escape_string($con,$_POST['subject']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "toppers");
	}

	$sqlins = mysqli_query($con,"INSERT INTO `toppers` (`id`, `name`, `subject`, `file`, `order`, `status`) VALUES (NULL, '$name', '$subject', '$uploadpath', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createtoppers.php' class=' btn btn-primary'>Create New</a></div>";
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
			<a href="toppers.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-5">
			<label for="name" class="form-label">Name</label>
			<input type="text" class="form-control" name="name" required>
		</div>
		
		<div class="mb-3 col-md-5">
			<label for="subject" class="form-label">Name Bottom Tag</label>
			<input type="text" class="form-control" name="subject">
		</div>

		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
            <?php $sqlgallery  = mysqli_query($con, "SELECT * FROM `toppers` ORDER BY `id` DESC");
            $rwgallery = mysqli_fetch_assoc($sqlgallery ); ?>			
			<input type="text" class="form-control" name="order" placeholder="Last Order No. : <?=$rwgallery['order'];?>">
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image (400x400px)</label>
		  	<div class="imgquestion other">			  		
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
				<img src="images/preview.jpg" alt="2" class='preview'>
			</div>
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