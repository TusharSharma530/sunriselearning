<?php include 'config.php';
$title = 'Child Category';
if(!isset($_SESSION['username'])){
echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['deletedata'])){
$id = $_POST['id'];

	$sqldelete = mysqli_query($con,"DELETE FROM childcategory WHERE id = {$id}");
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
			<h3>Child Category</h3>
		</div>
		<div class="createbtn d-flex">
			<a href="createchildcategory.php"> Add New</a>
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
									<th>Child Category</th>
									<th>Category</th>
									<th>Sub Category</th>
									<th>Order</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
<?php $sqlchildcat  = mysqli_query($con, "SELECT * FROM childcategory ORDER BY id DESC");
if(mysqli_num_rows($sqlchildcat)){
$serial = 1;
while($rwchildcat = mysqli_fetch_assoc($sqlchildcat )){
$id = $rwchildcat['id'];
$sqlcat = mysqli_query($con, "SELECT * FROM category WHERE id = '{$rwchildcat['cat_id']}'");
$rwcat = mysqli_fetch_array($sqlcat);
$sqlsubcat = mysqli_query($con, "SELECT * FROM sub_cat WHERE id = '{$rwchildcat['subcat_id']}'");
$rwsubcat = mysqli_fetch_array($sqlsubcat);
 ?>
<tr id='remove<?php echo $id; ?>'>
<td><?php echo $serial; ?></td>
<td><?=$rwchildcat['childcat'];?></td>
<td><?=$rwcat['c_name'];?></td>
<td><?=$rwsubcat['sc_name'];?></td>
<td><?=$rwchildcat['order'];?></td>
<td class="text-center">
<a href="updatechildcategory.php?id=<?=$id;?>"><i class='bx bx-edit mx-2 text-success'></i></a> 
<a href="javascript:" class="delbtn" ide="<?=$id;?>"><i class='bx bx-trash mx-2 text-danger'></i></a>
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