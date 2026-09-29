<div class="pagewidget">
<div class="container-lg">
    <div class="text-center mb-4">
        <!-- <h2 style="font-size:32px;font-weight:700;color:#333;">Latest Achievements</h2> -->
    </div>
    <?php
    if(!function_exists('getYoutubeVideoId')){
    function getYoutubeVideoId($url){
        if(preg_match('/^[A-Za-z0-9_-]{11}$/', $url)){
            return $url;
        }
        if(preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)){
            return $matches[1];
        }
        return '';
    }
    }

    $sqlach = mysqli_query($con, "SELECT * FROM `achievements` WHERE `status`=1 ORDER BY `order` ASC");
    if(mysqli_num_rows($sqlach)){
    ?>
    <div class="row">
        <?php while($rwach = mysqli_fetch_assoc($sqlach)){
            $videoId = !empty($rwach['youtube_url']) ? getYoutubeVideoId(trim($rwach['youtube_url'])) : '';
        ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                <?php if(!empty($videoId)){ ?>
                <iframe src="https://www.youtube.com/embed/<?=htmlspecialchars($videoId);?>" style="width:100%;height:250px;border:none;" allowfullscreen></iframe>
                <?php }else if(!empty($rwach['file'])){ ?>
                <a href="<?=$path.$rwach['file'];?>" data-lightbox="achievements" data-title="<?=$rwach['title'];?>">
                    <img src="<?=$path.$rwach['file'];?>" alt="<?=$rwach['title'];?>" style="width:100%;height:250px;object-fit:cover;">
                </a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php }else{ ?>
    <p class="text-center">No achievements found.</p>
    <?php } ?>
</div>
</div>
