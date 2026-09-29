<?php include "config.php";
$title = 'Update Category';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = '';
}

$sqlcat = mysqli_query($con, "SELECT * FROM category WHERE id = {$id}");
if(mysqli_num_rows($sqlcat)){
	$rwcat = mysqli_fetch_assoc($sqlcat);
}

$existingcats = mysqli_query($con, "SELECT DISTINCT c_name, c_type FROM category WHERE c_type IN (1,2) ORDER BY c_name ASC");

if(isset($_POST['editRecord'])){
	$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
	$url = seo_friendly_url($cname);
	$ctype = trim(mysqli_real_escape_string($con,$_POST['ctype']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$card_heading = trim(mysqli_real_escape_string($con,$_POST['card_heading'] ?? ''));
	$section_heading = trim(mysqli_real_escape_string($con,$_POST['section_heading'] ?? ''));
	$card_count = intval($_POST['card_count'] ?? 0);
	 
	if(empty($_FILES['img']['name'])){
		$image = $rwcat['featured_img'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "category");
		if(!empty($rwcat['img']))	{
			if(file_exists("../".$rwcat['featured_img'])){
				unlink("../".$rwcat['featured_img']);
			}			
		}
	}

	$cards = array();
	if($card_count > 0){
		for($c=1; $c<=$card_count; $c++){
			$ctitle = trim(mysqli_real_escape_string($con, $_POST['card_title_'.$c] ?? ''));
			$cdesc2 = trim(mysqli_real_escape_string($con, $_POST['card_desc_'.$c] ?? ''));
			if(!empty($ctitle) || !empty($cdesc2)){
				$cards[] = array('title'=>$ctitle, 'desc'=>$cdesc2);
			}
		}
	}
	$card_data = json_encode($cards);

	$sqlcheck = mysqli_query($con,"UPDATE category SET c_name = '$cname', c_url = '$url', c_type = '$ctype', c_desc = '$cdesc', sdesc = '$sdesc', featured_img = '$uploadpath', meta_title = '$mtitle', meta_keywords = '$mkeywords', meta_desc = '$mdesc', `order` = '$order', card_heading = '$card_heading', card_data = '$card_data', section_heading = '$section_heading'  WHERE id = $id");
		
	if($sqlcheck){
		echo "<script>alert('Updated Successfully'); window.location.href='category.php';</script>";
		
	}else{
			
		echo "<script>alert('Failed'); window.history.back();</script>";
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
			<h3>Edit Category</h3>
		</div>
		<div class="createbtn">
			<a href="createcategory.php"> Add New</a>
			<a href="category.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="categoryForm" class="row" enctype="multipart/form-data">

	<div class="mb-3 col-md-4">
		<label for="cname" class="form-label">Category Name</label>
	<select class="form-control" id="catMode" onchange="toggleCatMode()">
		<option value="existing">Existing Category</option>
		<option value="edit">Edit Category Name</option>
		<option value="new">Add New</option>
	</select>
	<select class="form-control mt-2" id="existingCat" name="cname" style="display:block;">
		<option value="">-- Select Category --</option>
		<option value="Home" <?=($rwcat['c_name'] == 'Home') ? 'selected' : '';?>>Home</option>
		<?php while($rwcat2 = mysqli_fetch_assoc($existingcats)){ ?>
		<option value="<?=$rwcat2['c_name'];?>" <?=($rwcat2['c_name'] == $rwcat['c_name']) ? 'selected' : '';?>><?=$rwcat2['c_name'];?></option>
		<?php } ?>
	</select>
	<input type="text" class="form-control mt-2" id="editCat" name="cname" placeholder="Edit category name" value="<?=htmlspecialchars($rwcat['c_name']);?>" style="display:none;">
	<input type="text" class="form-control mt-2" id="newCat" placeholder="Enter new category name" style="display:none;">
	</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Category Type</label>
			<select class="form-control" id="type" name="ctype"  required>
				<option value=''>-- Select Category Type --</option>
				<option value="1" <?=$rwcat['c_type'] == 1 ? "selected" : "";?>>Top</option>
				<option value="2" <?=$rwcat['c_type'] == 2 ? "selected" : "";?>>Bottom</option>
				<option value="3" <?=$rwcat['c_type'] == 3 ? "selected" : "";?>>Other (Homepage Cards)</option>
			</select>
			
		</div>

		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" value="<?php echo $rwcat['order']; ?>" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="form-control" name="sdesc" id="sdesc" rows="3"><?php echo $rwcat['sdesc']; ?></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="form-control tinyMCE" name="cdesc" id="cdesc" rows="5"><?php echo $rwcat['c_desc']; ?></textarea>
		</div>

		<div id="heading-field" style="display:none;" class="mb-3 col-md-12">
			<label class="form-label">Section Heading</label>
			<input type="text" class="form-control" name="section_heading" value="<?=htmlspecialchars($rwcat['section_heading'] ?? '');?>" placeholder="Enter heading">
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" value="<?php echo $rwcat['meta_title']; ?>" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" value="<?php echo $rwcat['meta_keywords']; ?>" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"><?php echo $rwcat['meta_desc']; ?></textarea>
		</div>


		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<?php $active = empty($rwcat['featured_img']) ? "" : "active"; ?>
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<?php if(empty($rwcat['featured_img'])){ ?>
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  				<?php }else{ ?>
				<img src="<?=$path.$rwcat['featured_img'];?>" alt="<?=$rwcat['c_name'];?>" class='preview'>
  				<?php } ?>
  			</div>
		</div>

		<?php
		$old_cards = array();
		if(!empty($rwcat['card_data'])){
			$old_cards = json_decode($rwcat['card_data'], true);
		}
		$old_card_count = count($old_cards);
		$old_card_heading = $rwcat['card_heading'] ?? '';
		?>
		<div id="card-section" style="display:none;border:2px dashed #ccc;padding:20px;border-radius:10px;margin-bottom:20px;background:#f9f9f9;">
			<h4 style="margin-bottom:15px;">Cards Section</h4>
			<div class="mb-3 col-md-6">
				<label class="form-label">Card Heading</label>
				<input type="text" class="form-control" name="card_heading" value="<?=htmlspecialchars($old_card_heading);?>">
			</div>
			<div class="mb-3 col-md-6">
				<label class="form-label">Number of Cards</label>
				<input type="number" class="form-control" id="card_count" name="card_count" min="0" max="10" value="<?=$old_card_count;?>">
			</div>
			<div id="card-inputs">
				<?php for($c=0; $c<$old_card_count; $c++){ ?>
				<div class="row mb-2">
					<div class="col-md-5">
						<input type="text" class="form-control" name="card_title_<?=($c+1);?>" placeholder="Card <?=($c+1);?> Title" value="<?=htmlspecialchars($old_cards[$c]['title'] ?? '');?>">
					</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="card_desc_<?=($c+1);?>" placeholder="Card <?=($c+1);?> Description" value="<?=htmlspecialchars($old_cards[$c]['desc'] ?? '');?>">
					</div>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Edit Record" name="editRecord" class="submitInput">
		</div>
	</form>
	</div>
</div>
					
</div>
</div>
</section>

<script>
function toggleCatMode(){
	var mode = document.getElementById('catMode').value;
	if(mode == 'existing'){
		document.getElementById('existingCat').style.display = 'block';
		document.getElementById('existingCat').name = 'cname';
		document.getElementById('editCat').style.display = 'none';
		document.getElementById('editCat').name = '';
		document.getElementById('newCat').style.display = 'none';
		document.getElementById('newCat').name = '';
	} else if(mode == 'edit'){
		document.getElementById('existingCat').style.display = 'none';
		document.getElementById('existingCat').name = '';
		document.getElementById('editCat').style.display = 'block';
		document.getElementById('editCat').name = 'cname';
		document.getElementById('newCat').style.display = 'none';
		document.getElementById('newCat').name = '';
	} else {
		document.getElementById('existingCat').style.display = 'none';
		document.getElementById('existingCat').name = '';
		document.getElementById('editCat').style.display = 'none';
		document.getElementById('editCat').name = '';
		document.getElementById('newCat').style.display = 'block';
		document.getElementById('newCat').name = 'cname';
	}
}
document.getElementById('existingCat').addEventListener('change', function(){
	if(this.value == 'Home'){
		document.getElementById('type').value = '3';
	}
});
toggleCatMode();
$('#card-section').show();
$('#heading-field').show();

$(document).on('change','#card_count',function(){
    var count = parseInt($(this).val()) || 0;
    var html = '';
    for(var i=1; i<=count; i++){
        html += '<div class="row mb-2">';
        html += '<div class="col-md-5"><input type="text" class="form-control" name="card_title_'+i+'" placeholder="Card '+i+' Title"></div>';
        html += '<div class="col-md-7"><input type="text" class="form-control" name="card_desc_'+i+'" placeholder="Card '+i+' Description"></div>';
        html += '</div>';
    }
    $('#card-inputs').html(html);
});
</script>

<?php 
	include "include/footer.php"; 
?>