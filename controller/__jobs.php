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
    $senderemail = "promotionparadise42@gmail.com";
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


if($_POST['setJobs'] ?? false){
$query = mysqli_real_escape_string($con, $_POST['query']);
$jobs="";
if(!empty($query)){
$jobs_sql=mysqli_query($con, "SELECT * FROM `jobs` WHERE `status`=1 AND `title` LIKE '%$query%'");
}else{
$jobs_sql=mysqli_query($con, "SELECT * FROM `jobs` WHERE `status`=1");
}
if(mysqli_num_rows($jobs_sql)){
while($jobs_rw = mysqli_fetch_array($jobs_sql)){
    $jobid=$jobs_rw['id'];
    $jobs.="<div class='col-md-4'>
    <div class='job-box'>
        <h3>{$jobs_rw['title']}</h3>
        {$jobs_rw['long_desc']}
        <a href='{$path}apply?i={$jobid}'>Apply Now</a>
    </div>
</div>";
}
echo $jobs;
}else{
    echo "<div class='col-md-4'><h5>No Job Found</h5></div>";
}
exit();
}



if($_POST['setSearchJobs'] ?? false){
$query = mysqli_real_escape_string($con, $query);
$jobs="";
while($jobs_rw = mysqli_fetch_array($jobs_sql)){
    $jobid=$jobs_rw['id'];
    $jobs.="<div class='col-md-4'>
    <div class='job-box'>
        <h3>{$jobs_rw['title']}</h3>
        {$jobs_rw['long_desc']}
        <a href='{$path}apply?i={$jobid}'>Apply Now</a>
    </div>
</div>";
}

echo $jobs;
exit();
}


?>