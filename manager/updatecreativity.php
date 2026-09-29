<?php include "config.php";
$title = 'Edit Creativity Card';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$crupid = $_GET['id'] ?? "";
$sqlcr = mysqli_query($con, "SELECT * FROM creativity WHERE id = {$crupid}");
if(mysqli_num_rows($sqlcr)){
	$rwcr = mysqli_fetch_assoc($sqlcr);

}

if(isset($_POST['editRecord'])){

	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$link = trim(mysqli_real_escape_string($con,$_POST['link']));
	$cat_id = trim(mysqli_real_escape_string($con,$_POST['cat_id']));
	$subcat_id = trim(mysqli_real_escape_string($con,$_POST['subcat_id']));
	
	 if(empty($_FILES['img']['name'])){
		$image = $rwcr['file'];
		$uploadpath = $image;
	}else{
		$uploadpath = createImgWebp("img", "creativity");
	}

	$redirect_url = '';
	if(!empty($subcat_id)){
		$rwcat2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT c_url FROM category WHERE id=$cat_id"));
		$rwsubcat2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT sc_url FROM sub_cat WHERE id=$subcat_id"));
		$redirect_url = $rwcat2['c_url'].'/'.$rwsubcat2['sc_url'];
	}else if(!empty($cat_id)){
		$rwcat2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT c_url FROM category WHERE id=$cat_id"));
		$redirect_url = $rwcat2['c_url'];
	}
	
	$sqlcheck = mysqli_query($con,"UPDATE creativity SET `title` = '$title', `url` = '$url', `file` = '$uploadpath', `link` = '$link', `redirect_url` = '$redirect_url', `order` = '$order' WHERE id = $crupid");
		
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
			<h3>Edit Creativity Card</h3>
		</div>
		<div class="createbtn">
			<a href="createcreativity.php"> Add New</a>
			<a href="creativity.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-8">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $rwcr['title']; ?>">
			</div>

			<div class="mb-3 col-md-2">
				<label for="order" class="form-label">Order</label>
				<input type="text" class="form-control" name="order" value="<?php echo $rwcr['order']; ?>">
			</div>

			<div class="mb-3 col-md-2">
				<label for="link" class="form-label">Link</label>
				<input type="text" class="form-control" name="link" value="<?php echo $rwcr['link']; ?>">
			</div>

			<?php
			$old_redirect = $rwcr['redirect_url'] ?? '';
			$old_cat_id = '';
			$old_subcat_id = '';
			if(!empty($old_redirect)){
				$redirect_parts = explode('/', trim($old_redirect, '/'));
				$redirect_cat_url = end($redirect_parts);
				$rwc = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM category WHERE c_url='$redirect_cat_url'"));
				if($rwc){
					$old_cat_id = $rwc['id'];
					$redirect_sub_parts = explode('/', trim($old_redirect, '/'));
					if(count($redirect_sub_parts) > 1){
						$redirect_sub_url = end($redirect_sub_parts);
						$rws = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM sub_cat WHERE sc_url='$redirect_sub_url' AND cat_id=$old_cat_id"));
						if($rws){
							$old_subcat_id = $rws['id'];
						}
					}
				}
			}
			?>

			<div class="mb-3 col-md-4">
				<label for="cat_id" class="form-label">Redirect Category</label>
				<select class="form-control" name="cat_id" id="cat_id">
					<option value="">-- Select Category --</option>
					<?php $sqlcat = mysqli_query($con, "SELECT id, c_name FROM category WHERE status=1 ORDER BY `order` ASC");
					while($rwcat = mysqli_fetch_assoc($sqlcat)){ ?>
					<option value="<?=$rwcat['id'];?>" <?=($old_cat_id==$rwcat['id']) ? 'selected' : '';?>><?=$rwcat['c_name'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="mb-3 col-md-4" id="subcat_div" style="<?=!empty($old_subcat_id)?'':'display:none;'?>">
				<label for="subcat_id" class="form-label">Redirect Sub Category</label>
				<select class="form-control" name="subcat_id" id="subcat_id">
					<option value="">-- Select Sub Category --</option>
				</select>
			</div>

			<div class="mb-3 col-md-12">
			  	<label for="formFile" class="form-label">Image</label>
			  	<div class="imgquestion other">
			  		
			  		<?php $active = empty($rwcr['file']) ? "" : "active"; ?>
					<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
					<input hidden class="form-control imgInput" name="img" type="file">
					<?php if($rwcr['file'] == ''){ ?>
					<img src="images/preview.jpg" alt="2" class='preview'>
			  		<?php }else{ ?>
					<img src="<?=$path.$rwcr['file'];?>" alt="<?=$path.$rwcr['file'];?>" class='preview'>
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
var oldCatId = '<?=$old_cat_id;?>';
var oldSubcatId = '<?=$old_subcat_id;?>';

$('#cat_id').change(function(){
    var cat_id = $(this).val();
    if(cat_id){
        $.ajax({
            url: 'getsubcategories.php',
            type: 'GET',
            data: {cat_id: cat_id},
            dataType: 'json',
            success:function(data){
                if(data.length > 0){
                    $('#subcat_div').show();
                    $('#subcat_id').html('<option value="">-- Select Sub Category --</option>');
                    $.each(data, function(i, item){
                        var selected = (item.id == oldSubcatId) ? 'selected' : '';
                        $('#subcat_id').append('<option value="'+item.id+'" '+selected+'>'+item.sc_name+'</option>');
                    });
                }else{
                    $('#subcat_div').hide();
                    $('#subcat_id').html('<option value="">-- Select Sub Category --</option>');
                }
            }
        });
    }else{
        $('#subcat_div').hide();
    }
});

if(oldCatId){
    $('#cat_id').trigger('change');
}
</script>

<?php 
	include "include/footer.php"; 
?>
