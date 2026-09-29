<div class="pagewidget">
<div class="container-lg">
    <div class="text-center mb-4">
        <!-- <h2 style="font-size:32px;font-weight:700;color:#333;">Awards</h2> -->
    </div>
    <?php
    $sqlawards = mysqli_query($con, "SELECT * FROM `awards` WHERE `status`=1 ORDER BY `order` ASC");
    if(mysqli_num_rows($sqlawards)){
    ?>
    <div class="row" id="lightgallery">
        <?php while($rwawards = mysqli_fetch_assoc($sqlawards)){ ?>
        <div class="col-md-3 col-sm-6 mb-4" data-src="<?=$path.$rwawards['file'];?>">
            <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                <img src="<?=$path.$rwawards['file'];?>" alt="<?=$rwawards['name'];?>" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
            </div>
        </div>
        <?php } ?>
    </div>
    <?php }else{ ?>
    <p class="text-center">No awards found.</p>
    <?php } ?>
</div>
</div>
