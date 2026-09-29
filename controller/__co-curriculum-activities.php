<?php $blogtitle=""; $blogid="";
if(!empty($geturl)){
$sqlblogs=mysqli_query($con, "SELECT * FROM `curriculum` WHERE `url` = '$geturl'");
$rwblogs=mysqli_fetch_array($sqlblogs);
$blogid=$rwblogs['id'];
$blogtitle=$rwblogs['title'];
$breadcrumbtitle = $rwblogs['title'];
$breadcrumblist = "<li><a href='{$path}{$caturl}'>$cattitle</a></li><li><span>$breadcrumbtitle</span></li>";
$sqlblogsimg=mysqli_query($con, "SELECT * FROM `curriculumimg` WHERE `cum_id` = $blogid");
$image="";
while($rwimage=mysqli_fetch_array($sqlblogsimg)){
    $image.="<div class='col-md-4' data-src='{$path}{$rwimage['file']}'>
    <a class='galimg'>
        <img src='{$path}{$rwimage['file']}' alt=''>
    </a>
    </div>";
}
$data = "<div class='blogcontainer'>
<div class='container-lg'>
<div class='row'>
<div class='col-md-12'>
	<div class='onblogbox'>
		<div class='content'>
			{$rwblogs['desc']}
		</div>
		<div class='gallery'>
        <div class='container-lg'>
        <div class='row' id='lightgallery'>
            {$image}
        </div>
        </div>
        </div>
	</div>	
</div>
</div>
</div>
</div>";
} 

?>