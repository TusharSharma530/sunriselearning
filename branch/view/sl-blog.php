<?php
$sqlblogs = mysqli_query($con, "SELECT * FROM `blogs` WHERE `status`=1 ORDER BY `id` DESC");
if(mysqli_num_rows($sqlblogs)){
?>
<div class="pagewidget">
<div class="container-lg">
    <div class="text-center mb-4">
        <!-- <h2 style="font-size:32px;font-weight:700;color:#333;">SL Blog</h2> -->
    </div>
    <div class="row">
        <?php while($rwblog = mysqli_fetch_assoc($sqlblogs)){
            $blogimg = !empty($rwblog['file']) ? $rwblog['file'] : 'images/logo.jpg';
            $blogdesc = !empty($rwblog['sdesc']) ? strip_tags($rwblog['sdesc']) : '';
            $blogdesc = trim(preg_replace('/\s+/', ' ', $blogdesc));
            if(strlen($blogdesc) > 150){
                $blogdesc = substr($blogdesc, 0, 150).'...';
            }
        ?>
        <div class="col-md-4 mb-4">
            <div style="background:#f5f5f5;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,0.08);height:100%;display:flex;flex-direction:column;">
                <a href="<?=$path;?>sl-blog/<?=$rwblog['url'];?>">
                    <img src="<?=$path.$blogimg;?>" alt="<?=$rwblog['title'];?>" style="width:100%;height:250px;object-fit:cover;">
                </a>
                <div style="padding:20px;flex:1;display:flex;flex-direction:column;">
                    <h4 style="font-size:18px;font-weight:700;color:#333;margin:0 0 10px;text-transform:uppercase;"><?=$rwblog['title'];?></h4>
                    <div style="font-size:13px;color:#999;margin-bottom:10px;">
                        <i class="fa fa-user" style="color:var(--primary-color);margin-right:5px;"></i> <?=$rwblog['author'];?>
                    </div>
                    <?php if(!empty($blogdesc)){ ?>
                    <p style="font-size:14px;line-height:1.7;color:#555;margin:0;flex:1;"><?=$blogdesc;?></p>
                    <?php } ?>
                    <a href="<?=$path;?>sl-blog/<?=$rwblog['url'];?>" style="display:inline-block;margin-top:15px;padding:10px 25px;background:#3b5998;color:#fff;border-radius:5px;text-decoration:none;font-size:14px;font-weight:600;width:fit-content;">Learn more</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php }else{ ?>
<div class="pagewidget">
<div class="container-lg">
    <p class="text-center">No blogs found.</p>
</div>
</div>
<?php } ?>
