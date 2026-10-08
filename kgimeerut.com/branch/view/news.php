<div class="news">
<div class="container-lg">
<div class="row" id="lightgallery">

<?php $sqlnews=mysqli_query($con,"SELECT * FROM `news_events` WHERE `status`=1 ORDER BY `id` DESC");
while($rwnews=mysqli_fetch_array($sqlnews)){
if(empty($rwnews['file'])){
$img=$path.'branch/images/logo/access.webp';
}else{
$img=$path.$rwnews['file'];
}?>	
<div class="col-md-4" data-src="<?=$img;?>">
	<div class="newsbox">
		<figure>
			<img src="<?=$img;?>" alt="<?=$rwnews['title'];?>">
		</figure>
		<span><?=$rwnews['title'];?></span>
	</div>
</div>
<?php } ?>

</div>
</div>
</div>
