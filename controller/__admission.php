<?php if($_POST['registrationfrm'] ?? false){
$regToken= trim(mysqli_real_escape_string($con, $_POST['regToken']));
$name= trim(mysqli_real_escape_string($con, $_POST['name']));
$email= trim(mysqli_real_escape_string($con, $_POST['email']));
$mobileno= trim(mysqli_real_escape_string($con, $_POST['mobileno']));
$dob= trim(mysqli_real_escape_string($con, $_POST['dob']));
$graduation= trim(mysqli_real_escape_string($con, $_POST['graduation']));
$passingyear= trim(mysqli_real_escape_string($con, $_POST['passingyear']));
$aadharno= trim(mysqli_real_escape_string($con, $_POST['aadharno']));
$examentrance= trim(mysqli_real_escape_string($con, $_POST['examentrance']));
$address= trim(mysqli_real_escape_string($con, $_POST['address']));
$courseapply= trim(mysqli_real_escape_string($con, $_POST['courseapply']));
$certificatecourse= trim(mysqli_real_escape_string($con, $_POST['certificatecourse']));
$per10= trim(mysqli_real_escape_string($con, $_POST['per10']));
$per12= trim(mysqli_real_escape_string($con, $_POST['per12']));
$perug= trim(mysqli_real_escape_string($con, $_POST['perug']));

if($regToken==$_SESSION['reg_token']){
	$sqlins = mysqli_query($con, "INSERT INTO `registration`(`id`, `name`, `email`, `contactno`, `dob`, `graduation`, `passingyear`, `aadharno`, `entranceexam`, `address`, `courseapply`, `certificatecourse`, `per10`, `per12`, `perug`) VALUES(NULL, '$name', '$email', '$mobileno', '$dob', '$graduation', '$passingyear', '$aadharno', '$examentrance', '$address', '$courseapply', '$certificatecourse', '$per10', '$per12', '$perug')");
    $coursename="M.B.A";
    $senderemail = "admission@kgimeerut.com";
    $subject = "Registration Enquiry for New Enrollment 2025";
    $bodydata = "Name : $name <br>
Email : $email <br>
Contact No. : $mobileno <br>
DOB : $dob <br>
Graduation : $graduation <br>
Passing Year : $passingyear <br>
Aadhar No. : $aadharno <br>
Entrance Exam  : $examentrance <br>
Address : $address <br>
Course Apply : $coursename<br>
Certificate Course : $certificatecourse<br>
Percentage (10th) : $per10<br>
Percentage (12th) : $per12<br>
Percentage (UG) : $perug";
	if($sqlins){
        echo SendEmailer($senderemail,$subject,$bodydata);
		echo json_encode(["status"=>true, "msg"=>"<div class='alertdiv success'><p>Registration Successfully.</p></div>"]);
	}else{
		echo json_encode(["status"=>false, "msg"=>"<div class='alertdiv failed'><p>Registration Failed.</p></div>"]);
	}	
}else{
	echo json_encode(["status"=>false, "msg"=>"<div class='alertdiv failed'><p>Invalid Token! Please refresh page.</p></div>"]);
}
exit();
}



$_SESSION['reg_token'] = bin2hex(random_bytes(32));
$token=$_SESSION['reg_token'];
$_SESSION['reg_token_expiry']=time() + 3600;
?>