<?php include 'config.php';
$title = 'Add Gallery Image';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";

if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelImg = mysqli_query($con, "SELECT * FROM `gallery_imgs` WHERE id = $id");
		if(mysqli_num_rows($sqldelImg)){
			$rowimg = mysqli_fetch_assoc($sqldelImg);
				$imgid = $rowimg['file'];
				unlink("../".$imgid);

			$sqldelete = mysqli_query($con,"DELETE FROM `gallery_imgs` WHERE id = $id");
			if($sqldelete){
				echo 'true';
			}else{
				echo 'false';
			}	
			
		}
	
	exit();
 }



if(isset($_POST['addRecord'])){
$sqlins = "";
$i=0;
foreach ($_FILES['img']["name"] as $row=>$name){
    $gallery_images = $name;                                
    $images_content = explode(".", $gallery_images);
    $gallery_imagename = round(microtime(true)) .$i. '.' . end($images_content);
    $uploadpath = "branch/assets/gallery_img/".$gallery_imagename;
    move_uploaded_file($_FILES["img"]["tmp_name"][$i], "../branch/assets/gallery_img/" . $gallery_imagename);
    $i++;
    $sqlins = mysqli_query($con,"INSERT INTO `gallery_imgs` (`id`, `file`) VALUES (NULL, '$uploadpath')");
}  

if($sqlins){
echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
		$('#submitForm').hide();
	 </script>";
echo "<div class='col-md-12 padd0 text-center'><a href='addgalleryimages.php?id=$id' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Add Gallery Image</h3>
		</div>
		<div class="createbtn">
			<a href="gallery.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" enctype="multipart/form-data">
		<div class="row">

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="clearallimgdiv" style="display: none;">
		  		<a href="javascript:" id="clrimgs">Clear All</a>
		  	</div>
		  	<div class="imgquestion other">			  		
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInputMultiple" name="img[]" type="file" multiple>
				<img src="images/preview.jpg" alt="2" class='preview'>
			</div>
			<div id="gal-container"></div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
		</div>

		</div>
	</form>
</div>
</div>
</div>
</section>

	
<?php 
	include "include/footer.php"; 
?>