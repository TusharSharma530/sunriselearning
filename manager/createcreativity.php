<?php include 'config.php';
$title = 'Create Creativity Card';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$url = seo_friendly_url($title);
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$link = trim(mysqli_real_escape_string($con,$_POST['link']));
	$cat_id = trim(mysqli_real_escape_string($con,$_POST['cat_id']));
	$subcat_id = trim(mysqli_real_escape_string($con,$_POST['subcat_id']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "creativity");
	}

	$redirect_url = '';
	if(!empty($subcat_id)){
		$rwcat = mysqli_fetch_assoc(mysqli_query($con, "SELECT c_url FROM category WHERE id=$cat_id"));
		$rwsubcat = mysqli_fetch_assoc(mysqli_query($con, "SELECT sc_url FROM sub_cat WHERE id=$subcat_id"));
		$redirect_url = $path.$rwcat['c_url'].'/'.$rwsubcat['sc_url'];
	}else if(!empty($cat_id)){
		$rwcat = mysqli_fetch_assoc(mysqli_query($con, "SELECT c_url FROM category WHERE id=$cat_id"));
		$redirect_url = $path.$rwcat['c_url'];
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM creativity WHERE title = '$title'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO creativity (id, title, url, file, `link`, `redirect_url`, `order`, status) VALUES (NULL, '$title', '$url', '$uploadpath', '$link', '$redirect_url', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createcreativity.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
		}
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
			<h3>Create Student Programs</h3>
		</div>
		<div class="createbtn">
			<a href="creativity.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-8">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title" required>
		</div>

		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" name="order" required>
		</div>

		<div class="mb-3 col-md-2">
			<label for="link" class="form-label">Link</label>
			<input type="text" class="form-control" name="link">
		</div>

		<div class="mb-3 col-md-4">
			<label for="cat_id" class="form-label">Redirect Category</label>
			<select class="form-control" name="cat_id" id="cat_id">
				<option value="">-- Select Category --</option>
				<?php $sqlcat = mysqli_query($con, "SELECT id, c_name FROM category WHERE status=1 ORDER BY `order` ASC");
				while($rwcat = mysqli_fetch_assoc($sqlcat)){ ?>
				<option value="<?=$rwcat['id'];?>"><?=$rwcat['c_name'];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="mb-3 col-md-4" id="subcat_div" style="display:none;">
			<label for="subcat_id" class="form-label">Redirect Sub Category</label>
			<select class="form-control" name="subcat_id" id="subcat_id">
				<option value="">-- Select Sub Category --</option>
			</select>
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="imgquestion other">
				<a href="javascript:" class="imgclose ri-close-circle-line"></a>
				<input hidden class="form-control imgInput" name="img" type="file">
  				<img src="images/preview.jpg" alt="preview" class='preview'>
  			</div>
		</div>
		
		<div class="mt-2 mx-auto">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
		</div>

		</div>
	</form>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th>Image</th>
					<th>Title</th>
					<th>Order</th>
					<th>Status</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlcreativity = mysqli_query($con, "SELECT * FROM `creativity` ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcreativity)){
$serial = 1;
while($rwcr = mysqli_fetch_assoc($sqlcreativity)){
$id = $rwcr['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><img src="<?=$path.$rwcr['file'];?>" style="width: 100px;"/></td>
					<td><?=$rwcr['title'];?></td>
					<td><?=$rwcr['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwcr['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="creativity" ide="<?=$rwcr['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updatecreativity.php?id=<?=$id;?>" class="editbtn ri-pencil-line"></a>
						<a href="javascript:" ide="<?=$id;?>" class='delbtn ri-delete-bin-line'></a>
					</td>
				</tr>
		<?php $serial++; }} ?>
			</tbody>
		</table>
	</div>
</div>

</div>
</div>
</section>

<script>
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
                        $('#subcat_id').append('<option value="'+item.id+'">'+item.sc_name+'</option>');
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
</script>
	
<?php 
	include "include/footer.php"; 
?>
