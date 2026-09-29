<?php include 'config.php';
$title = 'Subjects';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM subjects WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['featured_img'];
					unlink($imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM subjects WHERE id = {$id}");
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
			<h3>Subjects</h3>
		</div>
		<div class="createbtn">
			<a href="createsubject.php">Add New</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="msgbox"></div>
	<div class="page-content">

	<table class="table table-hover" id="myTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Subject</th>
				<th>Course Type</th>
				<th>Course</th>
				<th>Order</th>
				<th>Status</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $sqlcourses  = mysqli_query($con, "SELECT * FROM `subjects` ORDER BY id ASC");
			if(mysqli_num_rows($sqlcourses)){
				$serial = 1;
				while($rowcourses = mysqli_fetch_array($sqlcourses)){
					$id = $rowcourses['id'];
					$status = $rowcourses['status'];
					$coursetype = $rowcourses['type'];
					$courseid = $rowcourses['courses'];

			$sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `id` = $coursetype");
			$rwcoursetype = mysqli_fetch_array($sqlcoursetype);

			$sqlcourse = mysqli_query($con, "SELECT * FROM `courses` WHERE `id` = $courseid");
			$rwcourse = mysqli_fetch_array($sqlcourse);


		 ?>
			<tr id='remove<?php echo $id; ?>'>
				<td><?=$serial;?></td>									
				<td><?=$rowcourses['title'];?></td>
				<td><?=$rwcoursetype['title'];?></td>
				<td><?=$rwcourse['title'];?></td>
				<td><?=$rowcourses['order'];?></td>
				<td>
					<div class="form-check form-switch">
						<?php $checked = $rowcourses['status']==1 ? "checked" : ""; ?>
					  <input class="form-check-input" type="checkbox" data-table="subjects" ide="<?=$rowcourses['id'];?>" <?=$checked;?>>
					  <label class="form-check-label" for="status"></label>
					</div>
				</td>
				<td class="text-center">
					<a href="updatesubject.php?id=<?=$id;?>" class="editbtn ri-pencil-line" ></a> 
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
