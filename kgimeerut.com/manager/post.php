<?php include 'config.php';
$title = 'Post';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['deletedata'])){
$id = $_POST['id'];
$sqldelete = mysqli_query($con,"DELETE FROM post WHERE id = $id");
if($sqldelete){
echo 'true';
}else{
echo 'false';
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
			<a href="createpost.php"> Add New</a>
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
					<th>Years</th>
					<th>Faculties</th>
					<th>Students</th>
					<th>Glorious Alumni</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlshow  = mysqli_query($con, "SELECT * FROM `post`");
if(mysqli_num_rows($sqlshow)){
$serial = 1;
while($rwshow = mysqli_fetch_assoc($sqlshow )){
$id = $rwshow['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><?=$rwshow['years'];?></td>
					<td><?=$rwshow['faculties'];?></td>					
					<td><?=$rwshow['students'];?></td>					
					<td><?=$rwshow['alumni'];?></td>					
					<td class="text-end">
						<a href="updatepost.php?id=<?=$id;?>" class="editbtn ri-pencil-line" ></a> 
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