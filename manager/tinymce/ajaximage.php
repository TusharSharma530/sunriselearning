<?php

// configuration
include '../database/_database.php';

$start = 0; $rowperpage = 4;
if(isset($_POST['start'])){
    $start = mysqli_real_escape_string($con,$_POST['start']);    
}
if(isset($_POST['rowperpage'])){
    $rowperpage = mysqli_real_escape_string($con,$_POST['rowperpage']);    
}

// selecting posts
$query = 'SELECT * FROM images ORDER BY id DESC limit '.$start.','.$rowperpage;

$result = mysqli_query($con,$query);

$html = '';

while($row = mysqli_fetch_array($result)){
    $imgid = $row['id'];
	$imageurl = $row['image_big'];
	$pathimage = BASE_PATH.$imageurl;
	
   $html .="<div class='col-media-list post' id='img_col_id_$imgid'>
		 <div class='file-box' data-file-id='$imgid' data-mid-file-path='$imageurl' data-default-file-path='$imageurl' data-slider-file-path='$imageurl' data-big-file-path='$imageurl'><div class='image-container'><img src='$pathimage' alt='' class='img-responsive'></div><span class='file-name'>$imgid</span></div> </div>
		 ";
   

}

echo $html;
?>