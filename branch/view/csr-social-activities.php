<div class="socialactivities">
<div class="container-lg">
<div class="row">
    <?=$data;?>
</div>
</div>
</div>


<div class="gallery">
<div class="container-lg">
<div class="row">
    <div class="col-md-12">
    </div>
</div>
</div>   
<div class="container-lg">
<div class="row" id="lightgallery">
<?php $sqlmonth = mysqli_query($con, "SELECT DISTINCT month, year FROM media WHERE gal_id=2 ORDER BY id DESC");
while($rwmonth=mysqli_fetch_array($sqlmonth)){
$year = $rwmonth['year'];
$month = $rwmonth['month'];
$monthid = $rwmonth['month'];
for ($i = 1; $i <= 12; $i++) {
    if($i == $month){
        $month = date("F", mktime(0, 0, 0, $i, 1));
    }
}?>
<div class="col-md-12">
    <div class="mediamonth"><h2><?=$month;?>, <?=$rwmonth['year']?></h2></div>
</div>
<?php $sqlmedia=mysqli_query($con, "SELECT * FROM `media` WHERE `month` = $monthid AND `year`=$year AND gal_id=2 ORDER BY `id` DESC");
while($rwmedia=mysqli_fetch_array($sqlmedia)){ ?>
	<div class="col-md-4" data-src="<?=$path.$rwmedia['file'];?>">
		<a href="javascript:" class="galimg" >
			<img src="<?=$path.$rwmedia['file'];?>" alt="Media">
		</a>
	</div>
<?php }  } ?>
</div>
</div>