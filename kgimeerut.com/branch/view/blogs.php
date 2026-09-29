<div class="blogcontainer">
<div class="container-lg">
<div class="row">
<?php $sqlblogs=mysqli_query($con, "SELECT * FROM `blogs` WHERE `status` = 1 ORDER BY `id` DESC");
while($rwblogs=mysqli_fetch_array($sqlblogs)){ ?>    
<div class="col-md-4">
	<a href="<?=$path.'blogs/'.$rwblogs['url'];?>" class="blogbox">
		<figure>
			<img src="<?=$path.$rwblogs['file'];?>" alt="<?=$rwblogs['title'];?>">
		</figure>
		<div class="content">
			<h3><?=$rwblogs['title'];?></h3>
			<?=$rwblogs['sdesc'];?>
			<span>Read More</span>
		</div>
	</a>	
</div>
<?php } ?>
</div>
</div>
</div>