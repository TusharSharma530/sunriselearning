<?php include "config.php";
$title = 'Edit Staff';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";
$sqlgallery = mysqli_query($con, "SELECT * FROM `staff` WHERE id = $id");
if(mysqli_num_rows($sqlgallery)){
	$rwgallery = mysqli_fetch_assoc($sqlgallery);

}
if(isset($_POST['updatetc'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
// 	$url = seo_friendly_url($title);
	$designation = trim(mysqli_real_escape_string($con,$_POST['designation']));
	$type = trim(mysqli_real_escape_string($con,$_POST['type']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$type = trim(mysqli_real_escape_string($con,$_POST['type']));
	
	 if(empty($_FILES['img']['name'])){
		$uploadpath = $rwgallery['image'];
	}else{
		$uploadpath = createImgWebp("img", "staff");
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE `staff` SET name = '$title', designation = '$designation', type = '$type', image = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
			<h3>Edit Topper</h3>
		</div>
		<div class="createbtn">
			<a href="createstaff.php"> Add New</a>
			<a href="staff.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-3">
    			<label for="title" class="form-label">Name</label>
    			<input type="text" class="form-control" name="title" required value="<?php echo $rwgallery['name']; ?>">
    		</div>
    		
    		<div class="mb-3 col-md-3">
    			<label for="designation" class="form-label">Designation</label>
    			<input type="text" class="form-control" name="designation" value="<?php echo $rwgallery['designation']; ?>">
    		</div>
    		
    		<div class="mb-3 col-md-3">
    			<label for="type" class="form-label">Type</label>
    			<input type="text" class="form-control" name="type" value="<?php echo $rwgallery['type']; ?>">
    		</div>

			<div class="mb-3 col-md-3">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwgallery['order']; ?>">
			</div>
			
			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Featured Image</label>
			  	<div class="imgquestion other">
			  		
			  		<?php $active = empty($rwgallery['image']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
					<?php if($rwgallery['image'] == ''){ ?>
					<img src="images/preview.jpg" alt="2" class='preview'>
			  		<?php }else{ ?>
					<img src="<?=$path.$rwgallery['image'];?>" alt="<?=$path.$rwgallery['image'];?>" class='preview'>
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