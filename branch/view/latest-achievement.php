<style>
.lg-gallery .slick-slide{padding:0 8px;}
.lg-gallery .slick-list{margin:0 -8px;}
.lg-gallery .slick-prev, .lg-gallery .slick-next{z-index:5;background:#1a3a5c;border:none;width:40px;height:40px;border-radius:50%;}
.lg-gallery .slick-prev:before, .lg-gallery .slick-next:before{font-size:24px;color:#fff;opacity:1;}
</style>
<div class="pagewidget">

    <?php
    $sqlawards = mysqli_query($con, "SELECT * FROM `awards` WHERE `status`=1 ORDER BY `order` ASC");
    if(mysqli_num_rows($sqlawards)){
    ?>
    <div class="container-lg">
        <div class="text-center mb-4">
            <h2 style="font-size:32px;font-weight:700;color:#333;">Awards</h2>
        </div>
        <div class="lg-gallery">
            <div class="awards-slider">
                <?php while($rwawards = mysqli_fetch_assoc($sqlawards)){ if(empty($rwawards['file'])) continue; ?>
                <div class="lgslide-item" data-src="<?=$path.$rwawards['file'];?>" data-sub-html="Award">
                    <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                        <img src="<?=$path.$rwawards['file'];?>" alt="<?=$rwawards['name'];?>" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    $sqlach = mysqli_query($con, "SELECT * FROM `achievement_images` WHERE `status`=1 ORDER BY `id` DESC");
    if(mysqli_num_rows($sqlach)){
    ?>
    <div class="container-lg" style="margin-top:50px;">
        <div class="text-center mb-4">
            <h2 style="font-size:32px;font-weight:700;color:#333;">Latest Achievements</h2>
        </div>
        <div class="lg-gallery">
            <div class="achievements-slider">
                <?php while($rwach = mysqli_fetch_assoc($sqlach)){ if(empty($rwach['file'])) continue; ?>
                <div class="lgslide-item" data-src="<?=$path.$rwach['file'];?>" data-sub-html="Achievement">
                    <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                        <img src="<?=$path.$rwach['file'];?>" alt="Achievement" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if(!mysqli_num_rows($sqlawards) && !mysqli_num_rows($sqlach)){ ?>
    <p class="text-center">No achievements found.</p>
    <?php } ?>

</div>
