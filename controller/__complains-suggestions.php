<?php if($_POST['submitcomplain'] ?? false){
$regToken= trim(mysqli_real_escape_string($con, $_POST['regToken']));
$name= trim(mysqli_real_escape_string($con, $_POST['name']));
$email= trim(mysqli_real_escape_string($con, $_POST['email']));
$enrollment= trim(mysqli_real_escape_string($con, $_POST['enrollment']));
$course= trim(mysqli_real_escape_string($con, $_POST['course']));
$academicsession= trim(mysqli_real_escape_string($con, $_POST['academicsession']));
$message= trim(mysqli_real_escape_string($con, $_POST['message']));


if($regToken==$_SESSION['reg_token']){
	$sqlins = mysqli_query($con, "INSERT INTO `complain`(`id`, `name`, `emailid`, `enrollment`, `course`, `session`, `message`) VALUES(NULL, '$name', '$email', '$enrollment', '$course', '$academicsession', '$message')");
    $senderemail = "vijay@kgimeerut.com";
    $subject = "Complains & Suggestions";
    $bodydata = "Name : $name <br>
Email : $email <br>
Enrollment No. : $enrollment <br>
Course : $course <br>
Academic Session : $academicsession <br>
Message : $message <br>
";

	if($sqlins){
        echo SendEmailer($senderemail,$subject,$bodydata);
		echo json_encode(["status"=>true, "msg"=>"<div class='alertdiv success'><p>Complains & Suggestions Submitted Successfully.</p></div>"]);
	}else{
		echo json_encode(["status"=>false, "msg"=>"<div class='alertdiv failed'><p>Complains & Suggestions Submitted Failed.</p></div>"]);
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