<div class="pagewidget">
<div class="container-lg">
    <div class="text-center mb-4">
        <!-- <h2 style="font-size:32px;font-weight:700;color:#333;">Latest Achievements</h2> -->
    </div>
    <?php
    $sqlach = mysqli_query($con, "SELECT * FROM `achievement_images` WHERE `status`=1 ORDER BY `id` DESC");
    if(mysqli_num_rows($sqlach)){
    ?>
    <div class="row" id="lightgallery">
        <?php while($rwach = mysqli_fetch_assoc($sqlach)){ if(empty($rwach['file'])) continue; ?>
        <div class="col-md-3 col-sm-6 mb-4" data-src="<?=$path.$rwach['file'];?>" data-sub-html="Achievement">
            <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                <img src="<?=$path.$rwach['file'];?>" alt="Achievement" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
            </div>
        </div>
        <?php } ?>
    </div>
    <?php }else{ ?>
    <p class="text-center">No achievements found.</p>
    <?php } ?>
</div>
</div>
