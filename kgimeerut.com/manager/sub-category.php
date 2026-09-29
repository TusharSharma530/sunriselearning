<?php include 'config.php';
	$title = 'Sub Category';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM sub_cat WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['featured_img'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM sub_cat WHERE id = {$id}");
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

<div class="col-md-12 ">
	<div class="page-title">							
		<div class="title">
			<h3>Sub Category</h3>
		</div>
		<div class="createbtn">
			<a href="createsub-category.php"> Add New</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th>#</th>									
					<th>Subcategory Name</th>
					<th>Category Name</th>
					<th>Orders</th>
					 <th>Status</th> 
					<th class="">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $sqlsubcat  = mysqli_query($con, "SELECT * FROM sub_cat ORDER BY cat_id ASC, `order`");
			if(mysqli_num_rows($sqlsubcat)){
			$serial = 1;
			while($rwsubcat = mysqli_fetch_assoc($sqlsubcat)){
			$scid = $rwsubcat['id'];
			$catid = $rwsubcat['cat_id'];

							
			$sqlcat = mysqli_query($con, "SELECT * FROM category WHERE id = '$catid' ORDER BY `order` ASC");
			$rwcat = mysqli_fetch_array($sqlcat);

			?>
				<tr id='remove<?php echo $scid; ?>'>
					<td><?php echo $serial; ?></td>
					<td><?php echo $rwsubcat['sc_name']; ?></td>
					<td><?=$rwcat['c_name'];?></td>
					<td><?php echo $rwsubcat['order']; ?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwsubcat['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="sub_cat" ide="<?=$scid;?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-center">
						<a href="updatesub-category.php?id=<?=$scid; ?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$scid; ?>" class='delbtn ri-delete-bin-line' ></a>
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

