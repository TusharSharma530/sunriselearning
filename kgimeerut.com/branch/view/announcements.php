<div class="announcements">
<div class="container-lg">
<div class="row" id="lightgallery">
<?php $sqlaccess=mysqli_query($con,"SELECT * FROM `announce` WHERE `status`=1 ORDER BY `id` DESC");
while($rwaccess=mysqli_fetch_array($sqlaccess)){ 
if(!empty($rwaccess['file'])){
	$img=$path.$rwaccess['file'];
}else{
	$img=$path."branch/images/logo/access.webp";
}
?>		
	<div class="col-md-3" data-src="<?=$img;?>">
		<div class="announcebox">
			<figure>
				<img src="<?=$img;?>" alt="<?=$rwacces['title'];?>">
			</figure>
		</div>
	</div>
<?php } ?>
</div>
</div>
</div>