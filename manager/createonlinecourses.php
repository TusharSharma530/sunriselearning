<?php include 'config.php';
$title = 'Create Online Course';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$redirect_url = trim(mysqli_real_escape_string($con,$_POST['redirect_url']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "online-courses");
	}

	if(!empty($name)){
	$sqlcheck = mysqli_query($con,"SELECT * FROM online_courses WHERE name = '$name'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		exit();
	}
	}

	$sqlins = mysqli_query($con,"INSERT INTO online_courses (id, name, title, description, file, redirect_url, `order`, status) VALUES (NULL, '$name', '$title', '$description', '$uploadpath', '$redirect_url', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createonlinecourses.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Create Online Course</h3>
		</div>
		<div class="createbtn">
			<a href="onlinecourses.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" enctype="multipart/form-data">
		<div class="row">

		<div class="mb-3 col-md-6">
			<label for="name" class="form-label">Name</label>
			<input type="text" class="form-control" name="name">
		</div>

		<div class="mb-3 col-md-6">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" name="title">
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

		<div class="mb-3 col-md-12">
			<label for="redirect_url" class="form-label">Redirect URL</label>
			<input type="text" class="form-control" name="redirect_url" placeholder="https://example.com">
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
					<th>Name</th>
					<th>Title</th>
					<th>Image</th>
					<th>Order</th>
					<th>Status</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqloc = mysqli_query($con, "SELECT * FROM `online_courses` ORDER BY `order` ASC");
if(mysqli_num_rows($sqloc)){
$serial = 1;
while($rwoc = mysqli_fetch_assoc($sqloc)){
$id = $rwoc['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><?=$rwoc['name'];?></td>
					<td><?=$rwoc['title'];?></td>
					<td>
						<?php if(!empty($rwoc['file'])){ ?>
						<img src="<?=$path.$rwoc['file'];?>" style="width: 100px;"/>
						<?php } else { ?>
						<span class="text-muted">No Image</span>
						<?php } ?>
					</td>
					<td><?=$rwoc['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwoc['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="online_courses" ide="<?=$rwoc['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updateonlinecourses.php?id=<?=$id;?>" class="editbtn ri-pencil-line"></a>
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
