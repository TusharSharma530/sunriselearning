<?php include 'config.php';
$title = 'Enquiry For Jobs';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}
	
	if(isset($_POST['deletedata'])){
		$id = $_POST['id'];
		$sqldelete = mysqli_query($con,"DELETE FROM applyjob WHERE id = {$id}");
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
			<h3>Enquiry For Vacancy</h3>
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
				<th>Phone</th>
				<th>Emailid</th>
				<th>Apply for</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 

			$sqlcontact  = mysqli_query($con, "SELECT * FROM applyjob ORDER BY id DESC");
			if(mysqli_num_rows($sqlcontact)){
				$serial = 1;
				while($rwcontact = mysqli_fetch_assoc($sqlcontact )){
					$cid = $rwcontact['id'];
		 ?>
			<tr id='remove<?php echo $cid; ?>'>
				<td><?php echo $serial; ?></td>									
				<td><?php echo $rwcontact['name']; ?></td>
				<td><?php echo $rwcontact['contactno']; ?></td>
				<td><?=$rwcontact['email'];?></td>		
				<td><?=__getJobTitle($con, $rwcontact['applyfor']);?></td>		
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