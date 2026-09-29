<?php $blogtitle=""; $blogid="";
if(!empty($geturl)){
$sqlblogs=mysqli_query($con, "SELECT * FROM `curriculum` WHERE `url` = '$geturl'");
$rwblogs=mysqli_fetch_array($sqlblogs);
$blogid=$rwblogs['id'];
$blogtitle=$rwblogs['title'];
$breadcrumbtitle = $rwblogs['title'];
$data = "<div class='blogcontainer'>
<div class='container-lg'>
<div class='row'>
<div class='col-md-12'>
	<div class='onblogbox'>
		<div class='content'>
			{$rwblogs['desc']}
		</div>
	</div>	
</div>
</div>
</div>
</div>";
} 

?>