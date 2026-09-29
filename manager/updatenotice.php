<?php include "config.php";
$title = 'Edit Notice';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqlgallery = mysqli_query($con, "SELECT * FROM `notice` WHERE id = $id");
if(mysqli_num_rows($sqlgallery)){
	$rwgallery = mysqli_fetch_assoc($sqlgallery);

}
if(isset($_POST['updatetc'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['pdf']['name'])){
		$uploadpath = $rwgallery['file'];
	}else{
		$uploadpath = createImgWebp("pdf", "notice");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `notice` SET `title` = '$title', `file` = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
			<a href="createnotice.php"> Add New</a>
			<a href="notice.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-9">
				<label for="sname" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwgallery['title']; ?>">
			</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwgallery['order']; ?>">
			</div>
			
			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">PDF File</label>
				<input class="form-control" name="pdf" type="file">
				<?php if(!empty($rwgallery['file'])){ ?>
				<iframe src="<?=$path.$rwgallery['file'];?>" style="width:200px; height:200px;margin: 15px 0 0;" frameborder="0"></iframe>
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