<?php include 'config.php';
$title = "Edit Banner";
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	

$id = $_GET['id'] ?? "";



	$querysel = mysqli_query($con, "SELECT * FROM web_banner WHERE id = $id");
	if(mysqli_num_rows($querysel)){
		$row = mysqli_fetch_assoc($querysel);
	}

	 if(isset($_POST['editRecord'])){
		$order = trim(mysqli_real_escape_string($con,$_POST['order']));

		if(empty($_FILES['img']['name'])){
			$image = $row['wb_img'];
			$imagepath = $image;
		}else{
			$imagepath = createImgWebp("img", "banner");

		}	

		$sqlins = mysqli_query($con,"UPDATE web_banner SET wb_order = '$order', wb_img = '$imagepath' WHERE id = $id");
			
		if($sqlins){
			echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success');  </script>";
		}else{
				
			echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); </script>";
		}
		
		exit();
	}





	include 'include/header.php';
	include 'include/sidebar.php';

 ?>


<section class="main-dashboard" style="overflow: auto; height: 100vh;">
<div class="container-fluid">
<div class="row">

<div class="col-md-12">
	<div class="page-title">
		<div class="title">
			<h3>Edit Banner</h3>
		</div>
		<div class="createbtn">
			<a href="createbanner.php"> Add New</a>
			<a href="banner.php"> List</a>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">
		<div class="mb-2 col-md-3">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<?php $active = empty($row['wb_img']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<?php if(empty($row['wb_img'])){ ?>
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  				<?php }else{ ?>
  				<img src="<?=$path.$row['wb_img'];?>" alt="<?=$row['wb_img'];?>" class='preview'>
  				<?php } ?>
  			</div>
		</div>
		<div class="mb-3 col-md-9">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" value="<?php echo $row['wb_order']; ?>" required>
		</div>
						
		<div class="col-md-12">
			<input type="submit" name="editRecord" class="submitInput" value="Edit Record">
		</div>
	</form>
	</div>
</div>

</div>
</div>				
</section>

<?php include 'include/footer.php'; ?>