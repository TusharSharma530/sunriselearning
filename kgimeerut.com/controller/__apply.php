<?php if($_POST['applyjob'] ?? false){
$name= trim(mysqli_real_escape_string($con, $_POST['name']));
$email= trim(mysqli_real_escape_string($con, $_POST['email']));
$mobileno= trim(mysqli_real_escape_string($con, $_POST['mobileno']));
$applyfor= trim(mysqli_real_escape_string($con, $_POST['applyfor']));
$degree= trim(mysqli_real_escape_string($con, $_POST['degree']));
$filepath="";

if(!empty($_FILES['resume']['name'])){
    $file_name=$_FILES['resume']['name'];
    $file_ext=pathinfo($file_name, PATHINFO_EXTENSION);
    $filenew_name=$name.$mobileno.'.'.$file_ext;
    $filepath="branch/assets/applyjob/$filenew_name";
    move_uploaded_file($_FILES['resume']['tmp_name'], $filepath);
}
    $document = $_SERVER['DOCUMENT_ROOT']."/".$filepath;
	$sqlins = mysqli_query($con, "INSERT INTO `applyjob`(`id`, `name`, `email`, `contactno`, `applyfor`, `degree`, `file`) VALUES(NULL, '$name', '$email', '$mobileno', '$applyfor', '$degree', '$filepath')");
    $jobtitle=__getJobTitle($con, $applyfor);
    $senderemail = "admission@kgimeerut.com";
    $subject = "New Enquiry for Job";
    $bodydata = "Name : $name <br>
Email : $email <br>
Contact No. : $mobileno <br>
Degree/Diploma : $degree <br>
Job Title : $jobtitle <br>";
	if($sqlins){
        echo SendEmailer($senderemail,$subject,$bodydata, $document);
		echo json_encode(["status"=>true, "msg"=>"<div class='alertdiv success'><p>Job Applied Successfully.</p></div>"]);
	}else{
	    $err=mysqli_error($con);
		echo json_encode(["status"=>false, "msg"=>"<div class='alertdiv failed'><p>Job Applied Failed.-{$err}</p></div>"]);
	}	

exit();
}


?>