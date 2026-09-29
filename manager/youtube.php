<?php include 'config.php';
	$title = 'Youtube';
	if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelete = mysqli_query($con,"DELETE FROM `youtube` WHERE id = $id");
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
			<a href="createyoutube.php"> Add New</a>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th>Youtube URL Code</th>
					<th width="10%">Order</th>
					<th width="10%">Status</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlnotice  = mysqli_query($con, "SELECT * FROM `youtube` ORDER BY `order` DESC");
if(mysqli_num_rows($sqlnotice)){
$serial = 1;
while($rwcurri = mysqli_fetch_assoc($sqlnotice )){
$id = $rwcurri['id'];
?>
				<tr id='remove<?php echo $id; ?>'>
					<td><?php echo $serial; ?></td>
					<td><iframe width="150" height="150" src="https://www.youtube.com/embed/<?=$rwcurri['youtubeurl'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></td>
					<td><?=$rwcurri['order'];?></td>
					<td>
						<div class="form-check form-switch">
							<?php $checked = $rwcurri['status']==1 ? "checked" : ""; ?>
						  <input class="form-check-input" type="checkbox" data-table="youtube" ide="<?=$rwcurri['id'];?>" <?=$checked;?>>
						  <label class="form-check-label" for="status"></label>
						</div>
					</td>
					<td class="text-end">
						<a href="edityoutube.php?id=<?=$id;?>" class="editbtn ri-pencil-line" ></a> 
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