<?php include 'config.php';
$title = 'Contact';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelete = mysqli_query($con,"DELETE FROM contact WHERE id = {$id}");
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
			<h3>Contact</h3>
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
				<th>Email ID</th>
				<th>Phone</th>
				<th>Status</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 

			$sqlcontact  = mysqli_query($con, "SELECT * FROM contact ORDER BY id DESC");
			if(mysqli_num_rows($sqlcontact)){
				$serial = 1;
				while($rwcontact = mysqli_fetch_assoc($sqlcontact )){
					$cid = $rwcontact['id'];
		 ?>
			<tr id='remove<?php echo $cid; ?>'>
				<td><?php echo $serial; ?></td>									
				<td><?php echo $rwcontact['name']; ?></td>
				<td><?php echo $rwcontact['email']; ?></td>
				<td><?=$rwcontact['phone'];?></td>		
				<td>
					<div class="form-check form-switch">
						<?php $checked = $rwcontact['status']==1 ? "checked" : ""; ?>
					  <input class="form-check-input" type="checkbox" data-table="contact" ide="<?=$rwcontact['id'];?>" <?=$checked;?>>
					  <label class="form-check-label" for="status"></label>
					</div>
				</td>						
				<td class="text-center"> 
					<a href="javascript:" class='editbtn ri-eye-line' ></a>
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



<script>
    var url = window.location.href;
     $(document).on("click", ".status_btn", function(){
 	var $this = $(this).attr('ide');
    // alert($this);
 	$.ajax({
 		url : url,
 		type : "POST",
 		data : {ide : $this, st : 1},
 		success : function(data){
 			location.reload();
 		}
 	})

 });
</script>