<?php include 'config.php';
$title = 'Create Achievement';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$youtube_url = trim(mysqli_real_escape_string($con,$_POST['youtube_url']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "achievements");
	}

	$sqlins = mysqli_query($con,"INSERT INTO achievements (id, title, description, file, youtube_url, `order`, status) VALUES (NULL, '$title', '$description', '$uploadpath', '$youtube_url', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createachievements.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Create Achievement</h3>
		</div>
		<div class="createbtn">
			<a href="achievements.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" enctype="multipart/form-data">
		<div class="row">

		<div class="mb-3 col-md-6">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title">
		</div>

		<div class="mb-3 col-md-6">
			<label for="youtube_url" class="form-label">YouTube Video ID</label>
			<input type="text" class="form-control" name="youtube_url" placeholder="e.g. dQw4w9WgXcQ">
		</div>

		<div class="mb-3 col-md-8">
			<label for="description" class="form-label">Description</label>
			<textarea class="form-control" name="description" rows="3"></textarea>
		</div>

		<div class="mb-3 col-md-2">
			<label for="order" class="form-label">Order</label>
			<input type="text" class="form-control" name="order" required>
		</div>

		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
			<input type="file" class="form-control" name="img" accept="image/*">
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
					<th>YouTube</th>
					<th>Order</th>
					<th>Status</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlaw = mysqli_query($con, "SELECT * FROM `achievements` ORDER BY `order` ASC");
if(mysqli_num_rows($sqlaw)){
$serial = 1;
while($rwaw = mysqli_fetch_assoc($sqlaw)){
$id = $rwaw['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td>
						<?php if(!empty($rwaw['file'])){ ?>
						<img src="<?=$path.$rwaw['file'];?>" style="width:100px;"/>
						<?php } else { ?>
						<span class="text-muted">No Image</span>
						<?php } ?>
					</td>
					<td><?=$rwaw['title'];?></td>
					<td>
						<?php if(!empty($rwaw['youtube_url'])){ ?>
						<iframe width="100" height="70" src="https://www.youtube.com/embed/<?=$rwaw['youtube_url'];?>" frameborder="0" allowfullscreen></iframe>
						<?php } else { ?>
						<span class="text-muted">No Video</span>
						<?php } ?>
					</td>
					<td><?=$rwaw['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwaw['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="achievements" ide="<?=$rwaw['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="editachievements.php?id=<?=$id;?>" class="editbtn ri-pencil-line"></a>
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

<?php 
	include "include/footer.php"; 
?>
