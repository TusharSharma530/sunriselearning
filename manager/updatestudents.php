<?php include "config.php";
$title = 'Edit Students';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";

$sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = $id");
$rw = mysqli_fetch_assoc($sql);


if(isset($_POST['editRecord'])){
	$fullname = trim(mysqli_real_escape_string($con, $_POST['fullname']));
	$email = trim(mysqli_real_escape_string($con, $_POST['email']));
	$mobile = trim(mysqli_real_escape_string($con, $_POST['mobile']));
	$dumppass = trim(mysqli_real_escape_string($con, $_POST['password']));
	$password = md5($dumppass);
	$studtype = trim(mysqli_real_escape_string($con, $_POST['studtype']));

	$sqlcheck = mysqli_query($con,"SELECT * FROM `users` WHERE email = '$email' AND id != $id");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";		
	}else{

		$sqlupusers = mysqli_query($con, "UPDATE `users` SET `email`= '$email',`password`= '$password',`dump_pass`='$dumppass',`full_name`='$fullname',`mobile`='$mobile',`status`=1,`type`='$studtype' WHERE id = $id");
		
		if($sqlupusers){
			echo "<script>swal('Update Successfully', 'Click `OK` to Close', 'success'); </script>";			
		}else{				
			echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); </script>";
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
			<h3>Edit Students</h3>
		</div>
		<div class="createbtn">
			<a href="createstudents.php"> Add New</a>
			<a href="students.php"> List</a>
		</div>		
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<form method="POST" id="submitForm" class="row">		
			<div class="mb-3 col-md-4">
				<label for="fullname" class="form-label">Full Name</label>
				<input type="text" class="form-control" name="fullname" id="fullname" required value="<?=$rw['full_name'];?>">
			</div>

			<div class="mb-3 col-md-4">
				<label for="email" class="form-label">Email</label>
				<input type="text" class="form-control" name="email" id="email" required value="<?=$rw['email'];?>">
			</div>

			<div class="mb-3 col-md-4">
				<label for="mobile" class="form-label">Mobile</label>
				<input type="text" class="form-control" name="mobile" id="mobile" required value="<?=$rw['mobile'];?>">
			</div>

			<div class="mb-3 col-md-4">
				<label for="password" class="form-label">Password</label>
				<input type="text" class="form-control" name="password" id="password" required value="<?=$rw['dump_pass'];?>">
			</div>

			<div class="mb-3 col-md-4">
				<label for="studtype" class="form-label">Student Type</label>
				<select name="studtype" id="studtype" class="form-control">
					<option value="">--Select Student Type--</option>
<?php if($rw['type']==0){ ?>				
					<option value="0" selected>Free</option>
					<option value="1">Paid</option>
<?php }elseif($rw['type']==0){ ?>				
					<option value="0">Free</option>
					<option value="1" selected>Paid</option>

<?php }else{ ?>				
					<option value="0">Free</option>
					<option value="1">Paid</option>
<?php } ?>
				</select>
			</div>

			<div class="col-md-12">
				<input type="submit" value="Edit Record" name="editRecord" class="submitInput">
			</div>
		</form>
	</div>
</div>
					
</div>
</div>
</section>

	
<?php 
	include "include/footer.php"; 
?>