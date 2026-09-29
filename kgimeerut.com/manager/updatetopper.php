<?php include "config.php";
$title = 'Edit Placement';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqledit = mysqli_query($con, "SELECT * FROM `toppers` WHERE id = $id");
$rwedit = mysqli_fetch_assoc($sqledit);

if(isset($_POST['updatetc'])){
	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$subject = trim(mysqli_real_escape_string($con,$_POST['subject']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$type = trim(mysqli_real_escape_string($con,$_POST['type']));
	
	 if(empty($_FILES['img']['name'])){
		$uploadpath = $rwedit['image'];
	}else{
		$uploadpath = createImgWebp("img", "toppers");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `toppers` SET `name` = '$name', `subject` = '$subject', `file` = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
			<a href="createtoppers.php"> Add New</a>
			<a href="toppers.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-5">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" name="name" required value="<?php echo $rwedit['name']; ?>">
			</div>
			
			<div class="mb-3 col-md-5">
				<label for="subject" class="form-label">Subject</label>
				<input type="text" class="form-control" name="subject" value="<?php echo $rwedit['subject']; ?>">
			</div>

			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwedit['order']; ?>">
			</div>
			
			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
			  	<div class="imgquestion other">
			  		
			  		<?php $active = empty($rwedit['file']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
					<?php if($rwedit['file'] == ''){ ?>
					<img src="images/preview.jpg" alt="2" class='preview'>
			  		<?php }else{ ?>
					<img src="<?=$path.$rwedit['file'];?>" alt="<?=$path.$rwedit['file'];?>" class='preview'>
			  		<?php } ?>
				</div>
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