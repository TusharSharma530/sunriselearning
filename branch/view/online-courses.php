<style>
.lg-gallery .slick-slide{padding:0 8px;}
.lg-gallery .slick-list{margin:0 -8px;}
.lg-gallery .slick-prev, .lg-gallery .slick-next{z-index:5;background:#1a3a5c;border:none;width:40px;height:40px;border-radius:50%;}
.lg-gallery .slick-prev:before, .lg-gallery .slick-next:before{font-size:24px;color:#fff;opacity:1;}
</style>
<div class="pagewidget">
    <?php
    $sqloc = mysqli_query($con, "SELECT * FROM `online_courses` WHERE `status`=1 ORDER BY `order` ASC");
    if(mysqli_num_rows($sqloc)){
    ?>
    <div class="container-lg">
        
        <div class="lg-gallery">
            <div class="onlinecourses-slider">
                <?php while($rwoc = mysqli_fetch_assoc($sqloc)){
                    if(empty($rwoc['file'])) continue;
                    $redir = trim($rwoc['redirect_url'] ?? "");
                ?>
                <?php if(!empty($redir)){ ?>
                <div class="oc-slide">
                    <a href="<?=htmlspecialchars($redir);?>" style="display:block;">
                        <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                            <img src="<?=$path.$rwoc['file'];?>" alt="<?=htmlspecialchars($rwoc['name']);?>" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
                        </div>
                        <?php if(!empty($rwoc['title'])){ ?>
                        <p style="font-size:15px;font-weight:600;color:#333;margin-top:8px;text-align:center;"><?=$rwoc['title'];?></p>
                        <?php } ?>
                    </a>
                </div>
                <?php }else{ ?>
                <div class="lgslide-item" data-src="<?=$path.$rwoc['file'];?>" data-sub-html="<?=htmlspecialchars($rwoc['title']);?>">
                    <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                        <img src="<?=$path.$rwoc['file'];?>" alt="<?=htmlspecialchars($rwoc['name']);?>" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
                    </div>
                    <?php if(!empty($rwoc['title'])){ ?>
                    <p style="font-size:15px;font-weight:600;color:#333;margin-top:8px;text-align:center;"><?=$rwoc['title'];?></p>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="container-lg">
        <p class="text-center">No online courses found.</p>
    </div>
    <?php } ?>
</div>
