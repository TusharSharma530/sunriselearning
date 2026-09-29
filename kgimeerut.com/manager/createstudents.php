<?php include 'config.php';
$title = 'Create Student';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

if(isset($_POST['addRecord'])){
	$fullname = trim(mysqli_real_escape_string($con, $_POST['fullname']));
	$email = trim(mysqli_real_escape_string($con, $_POST['email']));
	$mobile = trim(mysqli_real_escape_string($con, $_POST['mobile']));
	$dumppass = trim(mysqli_real_escape_string($con, $_POST['password']));
	$password = md5($dumppass);
	$studtype = trim(mysqli_real_escape_string($con, $_POST['studtype']));

	$sqlcheck = mysqli_query($con,"SELECT * FROM `users` WHERE email = '$email'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
		
	}else{
		$sqlins = mysqli_query($con,"INSERT INTO `users` (`id`, `email`, `password`, `dump_pass`, `full_name`, `mobile`, `status`, `type`) VALUES (NULL, '$email', '$password', '$dumppass', '$fullname', '$mobile', 1, '$studtype')");
		
	if($sqlins){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
				$('#submitForm').hide();
			 </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='createstudents.php' class=' btn btn-primary'>Create New</a></div>";
	}else{
			
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
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
			<h3>Create Student</h3>
		</div>
		<div class="createbtn">
			<a href="students.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm">
		<div class="row">

		<div class="mb-3 col-md-4">
			<label for="fullname" class="form-label">Full Name</label>
			<input type="text" class="form-control" name="fullname" id="fullname" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="email" class="form-label">Email</label>
			<input type="text" class="form-control" name="email" id="email" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="mobile" class="form-label">Mobile</label>
			<input type="text" class="form-control" name="mobile" id="mobile" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="password" class="form-label">Password</label>
			<input type="text" class="form-control" name="password" id="password" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="studtype" class="form-label">Student Type</label>
			<select name="studtype" id="studtype" class="form-control">
				<option value="">--Select Student Type--</option>
				<option value="0">Free</option>
				<option value="1">Paid</option>
			</select>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
		</div>

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