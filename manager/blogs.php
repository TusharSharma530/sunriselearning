<?php include 'config.php';
$title = 'Blogs';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelImg = mysqli_query($con, "SELECT * FROM `blogs` WHERE id = {$id}");
		if(mysqli_num_rows($sqldelImg)){
			$rowimg = mysqli_fetch_assoc($sqldelImg);
				$imgid = $rowimg['file'];
				unlink("../".$imgid);

			$sqldelete = mysqli_query($con,"DELETE FROM `blogs` WHERE id = {$id}");
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
			<h3><?=$title;?></h3>
		</div>
		<div class="createbtn">
			<a href="createblog.php"> Add New</a>
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
					<th>Title</th>
					<th>Order</th>
					<!-- <th>Add Image</th> -->
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqlnews  = mysqli_query($con, "SELECT * FROM `blogs` ORDER BY id DESC");
				if(mysqli_num_rows($sqlnews)){
					$serial = 1;
					while($rwnews = mysqli_fetch_assoc($sqlnews)){
						$id = $rwnews['id'];
			 ?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><?=$rwnews['title'];?></td>
					<td><?=$rwnews['order'];?></td>
					<!-- <td><a href="addeventsimages.php?id=<?=$rwnews['id'];?>">Add</a></td> -->
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwnews['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="blogs" ide="<?=$id;?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-center">
						<a href="updateblog.php?id=<?=$id; ?>" class="editbtn ri-pencil-line" ></a> 
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