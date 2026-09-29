<div class="boards">
<div class="container-lg">
<div class="row">
<?php $sqlboard=mysqli_query($con, "SELECT * FROM `board` WHERE `status` = 1 ORDER BY `order` ASC");
while($rwboard=mysqli_fetch_array($sqlboard)){ ?>
	<div class="col-md-3">
		<div class="boardbox">
			<figure>
				<img src="<?=$path.$rwboard['file'];?>" alt="<?=$rwboard['title'];?>">
			</figure>
			<div class="content">
				<h3><?=$rwboard['title'];?></h3>
				<?=$rwboard['long_desc'];?>
			</div>
		</div>
	</div>
<?php } ?>	
</div>
</div>
</div>