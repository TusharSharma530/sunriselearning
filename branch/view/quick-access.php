<div class="quickaccess">
<div class="container-lg">
<div class="row">
<?php $sqlaccess=mysqli_query($con,"SELECT * FROM `quickaccess` WHERE `status`=1 ORDER BY `order` ASC");
while($rwaccess=mysqli_fetch_array($sqlaccess)){ 
if(!empty($rwaccess['file'])){
	$img=$path.$rwaccess['file'];
}else{
	$img=$path."branch/images/logo/access.webp";
}
?>		
	<div class="col-md-3">
		<div class="accessbox">
			<figure>
				<img src="<?=$img;?>" alt="<?=$rwacces['title'];?>">
			</figure>
			<a href="<?=$path.$rwaccess['link'];?>"><?=$rwaccess['title'];?></a>
		</div>
	</div>
<?php } ?>
</div>
</div>
</div>