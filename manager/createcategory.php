<?php include 'config.php';
$title = 'Add Category';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

	$existingcats = mysqli_query($con, "SELECT DISTINCT c_name FROM category WHERE c_type = 1 ORDER BY c_name ASC");

	if(isset($_POST['addRecord'])){
	 
	$cname = trim(mysqli_real_escape_string($con,$_POST['cname']));
	$url = seo_friendly_url($cname);
	$ctype = trim(mysqli_real_escape_string($con,$_POST['ctype']));
	$cdesc = trim(mysqli_real_escape_string($con,$_POST['cdesc']));
	$sdesc = trim(mysqli_real_escape_string($con,$_POST['sdesc']));
	$mtitle = trim(mysqli_real_escape_string($con,$_POST['meta-title']));
	$mkeywords = trim(mysqli_real_escape_string($con,$_POST['meta-keywords']));
	$mdesc = trim(mysqli_real_escape_string($con,$_POST['meta-desc']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$section_heading = trim(mysqli_real_escape_string($con,$_POST['section_heading'] ?? ''));
	$card_heading = trim(mysqli_real_escape_string($con,$_POST['card_heading'] ?? ''));
	$card_count = intval($_POST['card_count'] ?? 0);
	$uploadpath = "";			

	if(!empty($_FILES['img']['name'])){
		if($_FILES['img']['error'] === 0){
			$uploadpath = createImgWebp("img", "category");
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

	$sqlins = mysqli_query($con,"INSERT INTO category (id, c_name, c_type, c_url, c_desc, sdesc, featured_img, meta_title, meta_keywords, meta_desc, `order`, section_heading, card_heading, card_data) VALUES (NULL, '$cname', '$ctype', '$url', '$cdesc', '$sdesc', '$uploadpath', '$mtitle', '$mkeywords', '$mdesc', '$order', '$section_heading', '$card_heading', '$card_data')");
		
	if($sqlins){
		echo "<script>alert('Added Successfully'); window.location.href='createcategory.php';</script>";
	}else{
		echo "<script>alert('Failed: ".mysqli_error($con)."'); window.history.back();</script>";
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
			<h3>Add Category</h3>
		</div>
		<div class="createbtn">
			<a href="category.php">Category List</a>
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
				<option value="new">Add New</option>
			</select>
		<select class="form-control mt-2" id="existingCat" name="cname" style="display:block;">
			<option value="">-- Select Category --</option>
			<option value="Home">Home</option>
			<?php while($rwcat = mysqli_fetch_assoc($existingcats)){ ?>
			<option value="<?=$rwcat['c_name'];?>"><?=$rwcat['c_name'];?></option>
			<?php } ?>
		</select>
			<input type="text" class="form-control mt-2" id="newCat" placeholder="Enter new category name" style="display:none;">
		</div>

		<div class="mb-3 col-md-4">
			<label for="type" class="form-label">Category Type</label>
			<select class="form-control" id="type" name="ctype" required>
				<option value=''>-- Select Category Type --</option>
				<option value="1" selected>Top</option>
				<option value="2">Bottom</option>
				<option value="3">Other (Homepage Cards)</option>									
			</select>							
		</div>

		<div class="mb-3 col-md-4">
			<label for="cname" class="form-label">Order</label>
			<input type="text" class="form-control" id="order" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
			<label for="sdesc" class="form-label">Short Description</label>
			<textarea class="form-control" name="sdesc" id="sdesc" rows="3"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label for="cdesc" class="form-label">Description</label>
			<textarea class="form-control" name="cdesc" id="cdesc" rows="5"></textarea>
		</div>

		<div class="mb-3 col-md-6">
			<label for="mtitle" class="form-label">Meta Title</label>
			<input type="text" class="form-control" id="mtitle" name="meta-title" >
		</div>

		<div class="mb-3 col-md-6">
			<label for="mkeywords" class="form-label">Meta Keywords</label>
			<input type="text" class="form-control" id="mkeywords" name="meta-keywords" >
		</div>

		<div class="mb-3 col-md-12">
			<label for="mdesc" class="form-label">Meta Description</label>
			<textarea class="form-control" rows='3' name="meta-desc" id="mdesc"></textarea>
		</div>

		<div class="mb-3 col-md-12">
			<label class="form-label">Section Heading</label>
			<input type="text" class="form-control" name="section_heading" placeholder="Enter section heading">
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
			<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>
		</div>

		<div id="card-section" style="border:2px dashed #ccc;padding:20px;border-radius:10px;margin-bottom:20px;background:#f9f9f9;" class="col-md-12">
			<h4 style="margin-bottom:15px;">Cards Section</h4>
			<div class="row">
				<div class="mb-3 col-md-6">
					<label class="form-label">Card Heading</label>
					<input type="text" class="form-control" name="card_heading" placeholder="Enter card heading">
				</div>
				<div class="mb-3 col-md-6">
					<label class="form-label">Number of Cards</label>
					<input type="number" class="form-control" id="card_count" name="card_count" min="0" max="10" value="0">
				</div>
			</div>
			<div id="card-inputs"></div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
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
<script>
function toggleCatMode(){
	var mode = document.getElementById('catMode').value;
	if(mode == 'existing'){
		document.getElementById('existingCat').style.display = 'block';
		document.getElementById('existingCat').name = 'cname';
		document.getElementById('newCat').style.display = 'none';
		document.getElementById('newCat').name = '';
	} else {
		document.getElementById('existingCat').style.display = 'none';
		document.getElementById('existingCat').name = '';
		document.getElementById('newCat').style.display = 'block';
		document.getElementById('newCat').name = 'cname';
	}
}
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