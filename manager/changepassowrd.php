<?php include 'config.php';
$title = 'Change Password';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}


if(isset($_POST['editRecord'])){
	$oldpass = trim(mysqli_real_escape_string($con, md5($_POST['oldpass'])));
	$newpass = trim(mysqli_real_escape_string($con, md5($_POST['newpass'])));
	$cnewpass = trim(mysqli_real_escape_string($con, md5($_POST['cnewpass'])));
    $dumppass = trim(mysqli_real_escape_string($con, $_POST['newpass']));

	  if($oldpass != '' & $newpass != '' & $cnewpass != ''){
         if($newpass == $cnewpass){
		 	$sqlcheck = mysqli_query($con, "SELECT * FROM `admin` WHERE password = '$oldpass'");
		 	if(mysqli_num_rows($sqlcheck)){
		 		$sqladd = mysqli_query($con,"UPDATE `admin` SET password = '$newpass', dump_pass = '$dumppass' WHERE password = '$oldpass'");
		 		if($sqladd){
					echo "<script>swal('Password Change Successfully', 'Click `OK` to Close', 'success'); </script>";
				}else{
					echo "<script>swal('Failed', 'Click `OK` to try Again', 'error');</script>";
				}
		 	}else{
		 		echo "<script>swal('Old Password is invalid', 'Click `OK` to try Again', 'error');</script>";
		 	}
		 	exit();
        }else{
            echo "<script>swal('New Password and Confirm New Password is not same.', 'Click `OK` to try Again', 'error');</script>";
            
        }
    }else{
        echo "<script>swal('Fill Required Fields', 'Click `OK` to try Again', 'error');</script>";
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
			<h3>Change Password</h3>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" class="row">
		<div class="mb-3 col-md-4">
			<label for="oldpass" class="form-label">Old Password</label>
			<input type="text" class="form-control" name="oldpass" id="oldpass" >
		</div>
		
		<div class="mb-3 col-md-4">
			<label for="newpass" class="form-label">New Password</label>
			<input type="text" class="form-control" name="newpass" id="newpass" required>
		</div>

		<div class="mb-3 col-md-4">
			<label for="cnewpass" class="form-label">Confirm New Password</label>
			<input type="text" class="form-control" name="cnewpass" id="cnewpass" required>
		</div>
		
		<div class="mt-2 mx-auto">
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

<script>
	

	$(document).on("change", "#category", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setcat : 1, catid : $id},
			success : function(data){
				$('#subcategory').html(data);
			}
		})
	})


	$(document).on("change", "#subcategory", function(){ 
		var $id = $(this).val();
		$.ajax({
			url : url,
			type : "POST",
			data : {setsubcat : 1, subcatid : $id},
			success : function(data){
				$('#product').html(data);
			}
		})
	})




</script>