<?php include 'config.php';
	$title = 'Activities';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM activities WHERE id = $id");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM activities WHERE id = $id");
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
			<h3>Media</h3>
		</div>
		<div class="createbtn">
			<a href="addactivities.php"> Add New</a>
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
					<th>Image</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlgallery  = mysqli_query($con, "SELECT * FROM `activities` ORDER BY `id` DESC");
if(mysqli_num_rows($sqlgallery)){
$serial = 1;
while($rwgallery = mysqli_fetch_assoc($sqlgallery )){
$id = $rwgallery['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><img src="<?=$path.$rwgallery['file'];?>" style="width: 100px;"/></td>
					<td class="text-end">
						<a href="javascript:"  ide="<?=$id;?>" class='delbtn ri-delete-bin-line' ></a>
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