<?php include "config.php";
	$title = 'Edit Sub Category';

	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path2}manager'</script>";
	}
	
	if(isset($_GET['id'])){
		$scupid = $_GET['id'];
	}else{
		$scupid = '';
	}

	// FOR PARENT CATEGORY
	$sqlcat = mysqli_query($con,"SELECT * FROM category ORDER BY `order` ASC"); 

	// FOR UPDATE SUB CATEGORY
	$sqlsc = mysqli_query($con, "SELECT * FROM sub_cat WHERE id = {$scupid}");
	if(mysqli_num_rows($sqlsc)){
		$rwsc = mysqli_fetch_assoc($sqlsc);

	}

	if(isset($_POST['updateSubCat'])){
		$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
		$scname = trim(mysqli_real_escape_string($con,$_POST['scname']));
		$url = seo_friendly_url($scname);
		$scdesc = trim(mysqli_real_escape_string($con,$_POST['scdesc']));
		$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
		$features = "";
		$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
		$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
		$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
		$order = trim(mysqli_real_escape_string($con,$_POST['order']));
		 
		if(empty($_FILES['img']['name'])){
			$image = $rwsc['featured_img'];
			$uploadpath = $image;
		}else{
			$uploadpath = createImgWebp("img", "subcat");
			if(!empty($rwsc['img']))	{
				if(file_exists("../".$rwsc['featured_img'])){
					unlink("../".$rwsc['featured_img']);
				}			
			}
		}

		if(empty($_FILES['img1']['name'])){
			$image1 = $rwsc['featured_img1'];
			$uploadpath1 = $image1;
		}else{
			$uploadpath1 = createImgWebp("img1", "subcat");
			if(!empty($rwsc['img1']))	{
				if(file_exists("../".$rwsc['featured_img1'])){
					unlink("../".$rwsc['featured_img1']);
				}			
			}
		}

		$sqlcheck = mysqli_query($con,"UPDATE sub_cat SET cat_id = '$cname', sc_url = '$url', sc_name = '$scname', sc_desc = '$scdesc',`sdesc` = '$sdesc', featured_img = '$uploadpath', featured_img1 = '$uploadpath1', `features` ='$features', meta_title = '$mtitle', meta_keywords = '$mkeywords', meta_desc = '$mdesc', `order` = '$order' WHERE id = $scupid");
			
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

<section class="main-dashboard" style="overflow: auto; height: 100vh;">

<div class="container-fluid">
<div class="row">

<div class="col-md-12">
	<div class="page-title">
		<div class="title">
			<h3>Edit Sub Category</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createsub-category.php"> Add New</a>
			<a href="sub-category.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm"class="row">
			<div class="mb-3 col-md-4">
				<label for="cname" class="form-label">Category Name</label>
				<select name="cname" id="cname" class="form-control" required>
					<option selected>-- Select Category --</option>
					<?php
						if(mysqli_num_rows($sqlcat)){
						while($rwcat = mysqli_fetch_assoc($sqlcat)){
							if($rwcat['id'] == $rwsc['cat_id']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							echo "<option {$selected} value='{$rwcat['id']}'>{$rwcat['c_name']}</option>";
							}
						}
					 ?>
				</select>
			</div>

			<div class="mb-3 col-md-4">
				<label for="scname" class="form-label">Sub Category Type</label>
				<input type="text" class="form-control" id="scname" name="scname" value="<?php echo $rwsc['sc_name']; ?>" required>
			</div>

			<div class="mb-3 col-md-4">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" id="order" name="order" value="<?php echo $rwsc['order']; ?>" required>
			</div>

			<div class="mb-3 col-md-12">
				<label for="sdesc" class="form-label">Short Description</label>
				<textarea class="form-control" name="sdesc" id="sdesc"><?php echo $rwsc['sdesc']; ?></textarea>
			</div>

			<div class="mb-3 col-md-12">
				<label for="scdesc" class="form-label">Description</label>
				<textarea class="form-control tinyMCE" name="scdesc" id="scdesc"><?php echo $rwsc['sc_desc']; ?></textarea>
			</div>


			<div class="mb-3 col-md-6">
				<label for="mtitle" class="form-label">Meta Title</label>
				<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?php echo $rwsc['meta_title']; ?>" >
			</div>

			<div class="mb-3 col-md-6">
				<label for="mkeywords" class="form-label">Meta Keywords</label>
				<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?php echo $rwsc['meta_keywords']; ?>" >
			</div>

			<div class="mb-3 col-md-12">
				<label for="mdesc" class="form-label">Meta Description</label>
				<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?php echo $rwsc['meta_desc']; ?></textarea>
				
			</div>


			<div class="mb-3 col-md-6">
			  	<label for="formFile" class="form-label">Banner Image</label>
			  	<div class="imgquestion other">
					<?php $active = empty($rwsc['featured_img']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="answerimg4" type="file">
	  				<?php if(empty($rwsc['featured_img'])){ ?>
	  				<img src="images/preview.jpg" alt="preview" class='preview'>
	  				<?php }else{ ?>
	  				<img src="<?=$path.$rwsc['featured_img'];?>" alt="<?=$rwsc['featured_img'];?>" class='preview'>
	  				<?php } ?>
	  			</div>
			  
			</div>

			<div class="mb-3 col-md-6">
			  	<label for="formFile" class="form-label">Main Image</label>
			  	<div class="imgquestion other">
					<?php $active = empty($rwsc['a_img4']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="answerimg4" type="file">
	  				<?php if(empty($rwsc['a_img4'])){ ?>
	  				<img src="images/preview.jpg" alt="preview" class='preview'>
	  				<?php }else{ ?>
	  				<img src="<?=$path.$rwsc['a_img4'];?>" alt="<?=$rwsc['a_img4'];?>" class='preview'>
	  				<?php } ?>
	  			</div>
			</div>

			<div class="mt-2 mx-auto">
				<input type="submit" value="Update Sub Category" name="updateSubCat" class="btn btn-primary">
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