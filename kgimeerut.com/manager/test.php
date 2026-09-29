<?php include 'config.php';
$title = 'Test';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM test WHERE id = {$id}");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['featured_img'];
					unlink($imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM test WHERE id = {$id}");
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
			<h3>Test</h3>
		</div>
		<div class="createbtn">
			<a href="createtest.php">Add New</a>
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
				<th>Test Title</th>
				<th>Course Type</th>
				<th>Course Name</th>
				<th>T. Time (Min.)</th>
				<th>T. Marks</th>
				<th>T. Ques.</th>
				<th>Add Q & A</th>
				<th>Status</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php  $sqltest  = mysqli_query($con, "SELECT * FROM `test` ORDER BY id DESC");
			if(mysqli_num_rows($sqltest)){
			$serial = 1;
			while($rwtest = mysqli_fetch_array($sqltest)){
			$cid = $rwtest['id'];
			$status = $rwtest['status'];
			$coursetype = $rwtest['type'];
			$course = $rwtest['courses'];

			$sqlcoursetype = mysqli_query($con, "SELECT * FROM `coursetype` WHERE `id` = $coursetype");
			$rwcoursetype = mysqli_fetch_array($sqlcoursetype);

			$sqlcourses = mysqli_query($con, "SELECT * FROM `courses` WHERE `id` = $course");
			$rwcourses = mysqli_fetch_array($sqlcourses);


		 ?>
			<tr id='remove<?php echo $cid; ?>'>
				<td><?=$serial;?></td>									
				<td><?=$rwtest['title'];?></td>
				<td><?=$rwcoursetype['title'];?></td>
				<td><?=$rwcourses['title'];?></td>
				<td><?=$rwtest['totaltime'];?></td>
				<td><?=$rwtest['totalmarks'];?></td>
				<td><?=$rwtest['totalquestions'];?></td>
				<td align="center">
					<a href="addquestion-answer.php?id=<?=$rwtest['id'];?>" class="ri-add-circle-line" style="font-size: 20px; color: green;"></a>
					<a href="questions-answers.php?id=<?=$rwtest['id'];?>" class="ri-list-unordered" style="font-size: 20px; color: green;"></a>
				</td>
				<td>
					<div class="form-check form-switch">
						<?php $checked = $rwtest['status']==1 ? "checked" : ""; ?>
					  <input class="form-check-input" type="checkbox" data-table="test" ide="<?=$rwtest['id'];?>" <?=$checked;?>>
					  <label class="form-check-label" for="status"></label>
					</div>
				</td>
				<td class="text-center">
					<a href="updatetest.php?id=<?=$cid;?>" class="editbtn ri-pencil-line" ></a> 
					<a href="javascript:"  ide="<?=$cid;?>" class='delbtn ri-delete-bin-line' ></a>
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
