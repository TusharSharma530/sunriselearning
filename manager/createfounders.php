<?php include 'config.php';
$title = 'Create Founder';

if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$name = trim(mysqli_real_escape_string($con,$_POST['name']));
	$title = trim(mysqli_real_escape_string($con,$_POST['title']));
	$description = trim(mysqli_real_escape_string($con,$_POST['description']));
	$order = trim(mysqli_real_escape_string($con,$_POST['order']));
	$uploadpath = "";

	if(isset($_FILES['img']['name'])){
		$uploadpath = createImgWebp("img", "founders");
	}

	$sqlcheck = mysqli_query($con,"SELECT * FROM founders WHERE name = '$name'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO founders (id, name, file, title, description, `order`, status) VALUES (NULL, '$name', '$uploadpath', '$title', '$description', '$order', 1)");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createfounders.php' class=' btn btn-primary'>Create New</a></div>";
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
			<h3>Create Founder</h3>
		</div>
		<div class="createbtn">
			<a href="founders.php"> List</a>
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
			<input type="text" class="form-control" name="name" required>
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
			<?php if(!empty($rwfd['file'])){ ?>
			<img src="<?=$path.$rwfd['file'];?>" style="width:100px;margin-top:10px;">
			<?php } ?>
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
					<th>Name</th>
					<th>Title</th>
					<th>Order</th>
					<th>Status</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlfounders = mysqli_query($con, "SELECT * FROM `founders` ORDER BY `order` ASC");
if(mysqli_num_rows($sqlfounders)){
$serial = 1;
while($rwfd = mysqli_fetch_assoc($sqlfounders)){
$id = $rwfd['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><img src="<?=$path.$rwfd['file'];?>" style="width: 100px;"/></td>
					<td><?=$rwfd['name'];?></td>
					<td><?=$rwfd['title'];?></td>
					<td><?=$rwfd['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwfd['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="founders" ide="<?=$rwfd['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="updatefounders.php?id=<?=$id;?>" class="editbtn ri-pencil-line"></a>
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
