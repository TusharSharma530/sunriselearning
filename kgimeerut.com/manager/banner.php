<?php include 'config.php';
	$title = 'Banners';
	
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path2}manager'</script>";
	}

		if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM web_banner WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['wb_img'];
					$featimg = $rowimg['featuredimg'];
					unlink("../".$imgid);
					unlink("../".$featimg);

				$sqldelete = mysqli_query($con,"DELETE FROM web_banner WHERE id = {$id}");
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
			<h3>Banners</h3>
		</div>
		<div class="createbtn">
			<a href="createbanner.php"> Add New</a>
		</div>
	</div>
</div>
					
<div class="col-md-12">
<div class="page-content">
	<table class="table table-hover" id="myTable">
		<thead>
			<tr>
				<th width="5%" class="text-center">#</th>
				<th>Banner Img</th>
				<th>Status</th>
				<th class="text-end">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $sqlbanner = mysqli_query($con, "SELECT * FROM web_banner");
				if(mysqli_num_rows($sqlbanner)){
					$serial = 1;
					while($rwbanner = mysqli_fetch_assoc($sqlbanner)){
			 ?>
			<tr id="remove<?php echo $rwbanner['id']; ?>">
				<td style="vertical-align: middle;" class="text-center"><?php echo $serial; ?></td>
				<td><img src="../<?php echo $rwbanner['wb_img']; ?>" alt="" width="80px;"></td>
				<td>
					<div class="form-check form-switch">
						<?php $checked = $rwbanner['status']==1 ? "checked" : ""; ?>
					  <input class="form-check-input" type="checkbox" data-table="web_banner" ide="<?=$rwbanner['id'];?>" <?=$checked;?>>
					  <label class="form-check-label" for="status"></label>
					</div>
				</td>
				<td style="vertical-align:middle;" class="text-end">
					<a href="updatebanner.php?id=<?=$rwbanner['id']; ?>" class="editbtn ri-pencil-line" ></a> 
					<a href="javascript:"  ide="<?=$rwbanner['id']; ?>" class='delbtn ri-delete-bin-line' ></a>
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

<?php include 'include/footer.php'; ?>