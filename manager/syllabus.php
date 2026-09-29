<?php include 'config.php';
	$title = 'Syllabus';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelImg = mysqli_query($con, "SELECT * FROM syllabus WHERE id = $id");
			if(mysqli_num_rows($sqldelImg)){
				$rowimg = mysqli_fetch_assoc($sqldelImg);
					$imgid = $rowimg['file'];
					unlink("../".$imgid);

				$sqldelete = mysqli_query($con,"DELETE FROM syllabus WHERE id = $id");
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
			<a href="createsyllabus.php"> Add New</a>
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
					<th>Course</th>
					<th>Order</th>
					<th>View File</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlshow  = mysqli_query($con, "SELECT * FROM `syllabus` ORDER BY `order` DESC");
if(mysqli_num_rows($sqlshow)){
$serial = 1;
while($rwshow = mysqli_fetch_assoc($sqlshow )){
$id = $rwshow['id'];
$courseid=$rwshow['courseid'];
$sqlcourse=mysqli_query($con,"SELECT * FROM `courses` WHERE `id` = $courseid");
$rwcourse=mysqli_fetch_array($sqlcourse);

?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><?=$rwshow['title'];?></td>
					<td><?=$rwcourse['title'];?></td>
					<td><?=$rwshow['order'];?></td>
					<td><a href="<?=$path.$rwshow['file'];?>" class="btn btn-sm btn-success" target="_blank">View File</a></td>
					<td class="text-end">
						<a href="editsyllabus.php?id=<?=$id;?>" class="editbtn ri-pencil-line" ></a> 
						<a href="javascript:" ide="<?=$id;?>" class='delbtn ri-delete-bin-line' ></a>
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