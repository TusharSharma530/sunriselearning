<div class="videogallery">
<div class="container-lg">
<div class="row">
<?php $sqlshow=mysqli_query($con,"SELECT * FROM `youtube` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwshow=mysqli_fetch_array($sqlshow)){ ?>
	<div class="col-md-3">
	    <div class="vbox">
	        <iframe src="https://www.youtube.com/embed/<?=$rwshow['youtubeurl'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	    </div>
	</div>
<?php } ?>	
	
</div>
</div>
</div>