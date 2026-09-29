<?php include 'config.php';
$title = 'Category';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM category WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['featured_img'];
					unlink($imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM category WHERE id = {$id}");
				if($sqldelete){
					echo 'true';
				}else{
					echo 'false';
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
			<h3>Category</h3>
		</div>
		<div class="createbtn">
			<a href="createcategory.php">Add New</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="msgbox"></div>
	<div class="page-content">
	<div class="category-type">
		<a href="<?=$path;?>manager/category.php?type=1" class="<?=$_GET['type']==1 || empty($_GET['type']) ? 'active' : '';?>">Top Category</a>
		<a href="<?=$path;?>manager/category.php?type=2" class="<?=$_GET['type']==2 ? 'active' : '';?>">Bottom Category</a>
		<a href="<?=$path;?>manager/category.php?type=3" class="<?=$_GET['type']==3 ? 'active' : '';?>">Other Category</a>
	</div>
	<table class="table table-hover" id="myTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Category Name</th>
				<th>Category Type</th>
				<th>Order</th>
				<th>Status</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$typeurl = $_GET['type'] ?? 1;
			$sqlcat  = mysqli_query($con, "SELECT * FROM category WHERE c_type = $typeurl ORDER BY id ASC");
			if(mysqli_num_rows($sqlcat)){
				$serial = 1;
				while($rwcat = mysqli_fetch_assoc($sqlcat )){
					$id = $rwcat['id'];
					$status = $rwcat['status'];
		 ?>
			<tr id='remove<?php echo $id; ?>'>
				<td><?php echo $serial; ?></td>									
				<td><?php echo $rwcat['c_name']; ?></td>
				<td><?php if($rwcat['c_type'] == 1){
						echo 'Top Menu';
					}else if($rwcat['c_type'] == 2){
						echo 'Bottom Menu';
					}else if($rwcat['c_type'] == 3){
						echo 'Other Menu';
					}

				?></td>
				<td><?=$rwcat['order'];?></td>
				<td>
					<div class="form-check form-switch">
						<?php $checked = $rwcat['status']==1 ? "checked" : ""; ?>
					  <input class="form-check-input" type="checkbox" data-table="category" ide="<?=$rwcat['id'];?>" <?=$checked;?>>
					  <label class="form-check-label" for="status"></label>
					</div>
				</td>
				<td class="text-center">
					<a href="updatecategory.php?id=<?=$id; ?>" class="editbtn ri-pencil-line" ></a> 
					<a href="javascript:"  ide="<?=$id; ?>" class='delbtn ri-delete-bin-line' ></a>
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


