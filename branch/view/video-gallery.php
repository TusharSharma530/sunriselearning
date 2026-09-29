<div class="videogallery">
<div class="container-lg">
<div class="row">
<?php
if(!function_exists('getYoutubeVideoId')){
function getYoutubeVideoId($url){
    if(preg_match('/^[A-Za-z0-9_-]{11}$/', $url)){
        return $url;
    }
    if(preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)){
        return $matches[1];
    }
    return '';
}
}

$sqlshow=mysqli_query($con,"SELECT * FROM `youtube` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwshow=mysqli_fetch_array($sqlshow)){
    $videoId = getYoutubeVideoId(trim($rwshow['youtubeurl']));
    if(empty($videoId)){ continue; }
?>
	<div class="col-md-3">
	    <div class="vbox">
	        <iframe src="https://www.youtube.com/embed/<?=htmlspecialchars($videoId);?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	    </div>
	</div>
<?php } ?>	
	
</div>
</div>
</div>
