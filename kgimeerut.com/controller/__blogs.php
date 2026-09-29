<?php $blogtitle=""; $blogid="";
if(!empty($geturl)){
$sqlblogs=mysqli_query($con, "SELECT * FROM `blogs` WHERE `url` = '$geturl'");
$rwblogs=mysqli_fetch_array($sqlblogs);
$blogid=$rwblogs['id'];
$blogtitle=$rwblogs['title'];
$blogdate=$rwblogs['date'];
$blogauthor=empty($rwblogs['author']) ? "KGI MEERUT" : $rwblogs['author'];
$metatitle = empty($rwblogs['metatitle']) ? $rwblogs['title'] : $rwblogs['metatitle'];
$metakeywords = $rwblogs['metakeywords'];
$metadesc = $rwblogs['metadesc'];
$breadcrumbtitle = $rwblogs['title'];
$data = "<div class='blogcontainer'>
<div class='blog-popups'>
    <div class='inner-popup'>
    <a href='javascript:' class='bi bi-x-lg popup-close'></a>
    <h3>Share your Review/Article</h3>
        <form id='submitForm' method='POST'>
            <div class='fields'>
                <label for=''>Name</label>
                <input type='text' name='name' required>
            </div>
            <div class='fields'>
                <label for=''>Email Id</label>
                <input type='email' name='email' required>
            </div>
            <div class='fields'>
                <label for=''>Topic</label>
                <input type='text' name='topic' required>
            </div>
            <div class='fields'>
                <label for=''>Article/View</label>
                <textarea name='article' required></textarea>
            </div>
            <div class='fields'>
                <input type='submit' name='submitArticle' value='Submit'>
            </div>
        </form>
    </div>
</div>
<div class='container-lg'>
<div class='row'>
<div class='col-md-12'>
	<div class='onblogbox'>
    	<div class='blogpagehead'>
    	    <div class='author'><p><span>Author : </span> $blogauthor</p></div>
    	    <div class='date'><p><span>$blogdate</span></p></div>
    	</div>
		<div class='content'>
			{$rwblogs['desc']}
		</div>
	</div>	
</div>
</div>
</div>
</div>";
} 




if($_POST['submitArticle']){
$name=mysqli_real_escape_string($con, $_POST['name']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$topic=mysqli_real_escape_string($con, $_POST['topic']);
$article=mysqli_real_escape_string($con, $_POST['article']);
$sqlins = mysqli_query($con, "INSERT INTO `blogarticles`(`id`, `name`, `email`, `topic`, `article`, `blogid`, `blogtitle`) VALUES(NULL, '$name', '$email', '$topic', '$article', '$blogid', '$blogtitle')");
// $senderemail = "admission@kgimeerut.com";
$senderemail = "promotionparadise42@gmail.com";
$subject = "Submit Article/View for Blog | $blogtitle";
$bodydata = "Name : $name <br>
Email : $email <br>
Topic : $blogtitle <br>
Article/View : $article";

if($sqlins){
    echo SendEmailer($senderemail,$subject,$bodydata);
	echo json_encode(["status"=>true, "msg"=>"<div class='alertdiv success'><p>Blog Review Submitted Successfully.</p></div>"]);
}else{
	echo json_encode(["status"=>false, "msg"=>"<div class='alertdiv failed'><p>Blog Review Submitted Failed.</p></div>"]);
}
exit();

}





?>