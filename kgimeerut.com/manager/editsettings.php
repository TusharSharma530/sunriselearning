<?php include 'config.php';
$title = 'Edit Settings';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$sqlpinfo = mysqli_query($con, "SELECT * FROM `settings` WHERE id = '1'");
if(mysqli_num_rows($sqlpinfo)){
	$rwpinfo = mysqli_fetch_assoc($sqlpinfo);
}

if(isset($_POST['editRecord'])){
	$web_name = mysqli_real_escape_string($con, $_POST['web_name']);
	$headercenterline = mysqli_real_escape_string($con, $_POST['headercenterline']);
	$email_id = mysqli_real_escape_string($con, $_POST['email_id']);
	$alternate_email_id = mysqli_real_escape_string($con, $_POST['alternate_email_id']);
	$contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
	$alternate_no = mysqli_real_escape_string($con, $_POST['alternate_no']);
	$whatsapp_no = mysqli_real_escape_string($con, $_POST['whatsapp_no']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$youtubelink = mysqli_real_escape_string($con, $_POST['youtubelink']);
	$facebook = mysqli_real_escape_string($con, $_POST['facebook']);
	$youtube = mysqli_real_escape_string($con, $_POST['youtube']);
	$instagram = mysqli_real_escape_string($con, $_POST['instagram']);
	$twitter = mysqli_real_escape_string($con, $_POST['twitter']);
	$linkedin = mysqli_real_escape_string($con, $_POST['linkedin']);
	$googletag = mysqli_real_escape_string($con, $_POST['googletag']);
	$map_iframe = mysqli_real_escape_string($con, $_POST['map_iframe']);
	$footerdesc = mysqli_real_escape_string($con, $_POST['footerdesc']);
	$meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
	$meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
	$meta_desc = mysqli_real_escape_string($con, $_POST['meta_desc']);

	if(empty($_FILES['logoImg']['name'])){
		$image = $rwpinfo['logo'];
		$imgpath = $image;
	}else{
		
		$imgpath = createImgWebp("logoImg", "logo");
	}	

	$sqlabout = mysqli_query($con, "UPDATE settings SET 
		web_name = '$web_name',
		headercenterline = '$headercenterline',
		email_id = '$email_id',
		alternate_email_id = '$alternate_email_id',
		contact_no = '$contact_no',
		alternate_no = '$alternate_no',
		whatsapp_no = '$whatsapp_no',
		address = '$address ',
		youtubelink = '$youtubelink ',
		facebook = '$facebook',
		youtube = '$youtube' ,			
		instagram = '$instagram ',
		twitter = '$twitter', 
		linkedin = '$linkedin', 
		map_iframe = '$map_iframe',
		googletag = '$googletag',
		footerdesc = '$footerdesc',
		meta_title = '$meta_title',
		meta_keywords = '$meta_keywords',
		meta_desc = '$meta_desc',
		logo = '$imgpath'
		WHERE id = '1'");
	
		
		if($sqlabout){
			echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success');</script>";
			
		}else{
			echo mysqli_error($con);
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
			<h3>Edit Settings</h3>
		</div>													
	</div>
</div>
<div class="msgbox"></div>
<div class="col-md-12">
	<div class="page-content">
	<form method="POST" id="submitForm">
	<div class="row">
		<div class="col-md-4 mb-3">
			<label for="webname" >Website Name</label>
			<input type="text" name="web_name" class="form-control" value="<?php echo $rwpinfo['web_name']; ?>">
		</div>	
		<div class="col-md-8 mb-3">
			<label for="headercenterline" >Header Center Line</label>
			<input type="text" name="headercenterline" class="form-control" value="<?php echo $rwpinfo['headercenterline']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="email" >Email ID</label>
			<input type="email" id="email" name="email_id" class="form-control" value="<?php echo $rwpinfo['email_id']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="alertnateemail" >Other Email ID (Optional)</label>
			<input type="text" id="alertnateemail" name="alternate_email_id" class="form-control" value="<?php echo $rwpinfo['alternate_email_id']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="contact" >Contact No.</label>
			<input type="text" id="contact" name="contact_no" class="form-control" value="<?php echo $rwpinfo['contact_no']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="alertnatecontact" >Other Contact No. (Optional) </label>
			<input type="text" id="alertnatecontact" name="alternate_no" class="form-control" value="<?php echo $rwpinfo['alternate_no']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="whatsapp" >Whatsapp</label>
			<input type="text" id="whatsapp" name='whatsapp_no' class="form-control" value="<?php echo $rwpinfo['whatsapp_no']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="facebook" >Facebook</label>
			<input type="text" id="facebook" name='facebook' class="form-control" value="<?php echo $rwpinfo['facebook']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="youtube" >Youtube</label>
			<input type="text" id="youtube" name='youtube'  class="form-control" value="<?php echo $rwpinfo['youtube']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="linkedin" >Linkedin</label>
			<input type="text" id="linkedin" name='linkedin'  class="form-control" value="<?php echo $rwpinfo['linkedin']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="twitter" >Twitter</label>
			<input type="text" id="twitter" name='twitter'  class="form-control" value="<?php echo $rwpinfo['twitter']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="instagram" >Instagram</label>
			<input type="text" id="instagram" name='instagram'  class="form-control" value="<?php echo $rwpinfo['instagram']; ?>">
		</div>

		<div class="col-md-3 mb-3">
			<label for="youtubelink" >Youtube Video Embed Code</label>
			<input type="text" id="youtubelink" name="youtubelink" class="form-control" value="<?php echo $rwpinfo['youtubelink']; ?>">
		</div>

		<div class="col-md-12 mb-3">
			<label for="address" >Address</label>
			<input type="text" id="address" name="address" class="form-control" value="<?php echo $rwpinfo['address']; ?>">
		</div>

		<div class="col-md-12 mb-3">
			<label for="map_iframe" >Map Iframe</label>
			<textarea class="form-control" name="map_iframe" rows="5"><?php echo $rwpinfo['map_iframe']; ?></textarea>
		</div>

		<div class="col-md-12 mb-3">
			<label for="googletag" >Google Tag</label>
			<textarea class="form-control" name="googletag" rows="5"><?php echo $rwpinfo['googletag']; ?></textarea>
		</div>

		<div class="col-md-12 mb-3">
			<label for="footerdesc" >Footer Description</label>
			<input class="form-control" name="footerdesc" value="<?php echo $rwpinfo['footerdesc']; ?>">
		</div>									

		<div class="col-md-6 mb-3">
			<label for="meta_title" >Meta Title</label>
			<input type="text" id="meta_title" name="meta_title" class="form-control" value="<?php echo $rwpinfo['meta_title']; ?>">
		</div>

		<div class="col-md-6 mb-3">
			<label for="meta_keywords" >Meta Keywords</label>
			<input type="text" id="meta_keywords" name="meta_keywords" class="form-control" value="<?php echo $rwpinfo['meta_keywords']; ?>">
		</div>

		<div class="col-md-12 mb-3">
			<label for="meta_desc" >Meta Description</label>
			<textarea class="form-control" name="meta_desc"><?php echo $rwpinfo['meta_desc']; ?></textarea>
		</div>



		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Logo Image</label>
		  	<div class="imgquestion other">
				<?php $active = empty($rwpinfo['logo']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="logoImg" type="file">
  				<?php if(empty($rwpinfo['logo'])){ ?>
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  				<?php }else{ ?>
  				<img src="<?=$path.$rwpinfo['logo'];?>" alt="<?=$rwpinfo['logo'];?>" class='preview'>
  				<?php } ?>
  			</div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Edit Record" name="editRecord" class="submitInput">
		</div>
	</div>							
	</form>
</div>	
</div>

</div>
</div>
</section>

<?php include 'include/footer.php'; ?>