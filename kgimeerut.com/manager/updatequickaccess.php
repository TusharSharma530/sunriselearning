<?php include "config.php";
$title = 'Edit Quick Access';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";

$sqltc = mysqli_query($con, "SELECT * FROM quickaccess WHERE id = $id");
$rwtc = mysqli_fetch_assoc($sqltc);

if(isset($_POST['updateinfo'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$link = trim(mysqli_real_escape_string($con,$_POST['link']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	
	 if(empty($_FILES['img']['name'])){
		$uploadpath = $rwtc['file'];
	}else{
		$uploadpath = createImgWebp("img", "quickaccess");
		$imgid = $rwtc['file'];
		unlink("../".$imgid);

	}
	
	$sqlcheck = mysqli_query($con,"UPDATE quickaccess SET `title` = '$title', `link` = '$link', `file` = '$uploadpath', `order` = '$order' WHERE id = $id");
		
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
		<div class="createbtn d-flex">
			<a href="createquickaccess.php"> Add New</a>
			<a href="quickaccess.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm">
			<div class="row">

			<div class="mb-3 col-md-5">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwtc['title']; ?>" required>
			</div>

			<div class="mb-3 col-md-5">
				<label for="link" class="form-label">Link</label>
				<input type="text" class="form-control" name="link" value="<?php echo $rwtc['link']; ?>" required>
			</div>
						
			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwtc['order']; ?>" required>
			</div>

			<div class="mb-2 col-md-3">
			  	<label for="formFile" class="form-label">Image</label>
			  	<div class="imgquestion other">
					<?php $active = empty($rwtc['file']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
	  				<?php if(empty($rwtc['file'])){ ?>
	  				<img src="images/preview.jpg" alt="preview" class='preview'>
	  				<?php }else{ ?>
	  				<img src="<?=$path.$rwtc['file'];?>" alt="<?=$rwtc['file'];?>" class='preview'>
	  				<?php } ?>
	  			</div>
			</div>

			<div class="mt-2 mx-auto">
				<input type="submit" value="Edit Record" name="updateinfo" class="btn btn-primary">
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