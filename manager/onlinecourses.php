<?php include 'config.php';
	$title = 'Online Courses';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM online_courses WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					if(!empty($imgid)){
						unlink("../".$imgid);
					}

				$sqldelete = mysqli_query($con,"DELETE FROM online_courses WHERE id = {$id}");
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
			<h3>Online Courses</h3>
		</div>
		<div class="createbtn">
			<a href="createonlinecourses.php"> Add New</a>
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
					<th>Name</th>									
					<th>Title</th>
					<th>Image</th>
					<th>Order</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$sqloc  = mysqli_query($con, "SELECT * FROM online_courses ORDER BY `order` ASC");
				if(mysqli_num_rows($sqloc)){
					$serial = 1;
					while($rwoc = mysqli_fetch_assoc($sqloc)){
						$ocid = $rwoc['id'];
			 ?>
				<tr id='remove<?php echo $ocid; ?>'>
					<td><?php echo $serial; ?></td>									
					<td><?=$rwoc['name'];?></td>
					<td><?=$rwoc['title'];?></td>
					<td>
						<?php if(!empty($rwoc['file'])){ ?>
						<img src="<?=$path.$rwoc['file'];?>" alt="Image" style="width:60px;height:40px;object-fit:cover;border-radius:5px;">
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
						<a href="updateonlinecourses.php?id=<?=$ocid;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:"  ide="<?=$ocid; ?>" class='delbtn ri-delete-bin-line' ></a>
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
