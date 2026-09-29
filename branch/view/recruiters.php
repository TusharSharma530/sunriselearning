
<div class="placementleft pageleft">
<div class="container-lg">
<div class="row">
    
<?php $sqlrecruiters = mysqli_query($con, "SELECT * FROM `associations` ORDER BY `order` ASC");
while($rwrecruiters=mysqli_fetch_array($sqlrecruiters)){ ?>
<div class="col-lg-2 col-sm-3 col-sm-4">
<div class="recruiterbox"><img src="<?=$path.$rwrecruiters['file'];?>" alt="Recruiters" /></div>
</div>
<?php } ?>

</div>
</div>
</div>