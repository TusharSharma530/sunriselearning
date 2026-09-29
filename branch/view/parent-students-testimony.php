<?php
$crtable = mysqli_query($con, "SHOW TABLES LIKE 'creativity'");
if(mysqli_num_rows($crtable)){
$sqlcreativity=mysqli_query($con,"SELECT * FROM `creativity` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcreativity)){
?>
<div class="creativitysection">
    <div class="container">
        <div class="row">
            <div class="widgethead">
    			<h3>Creativity by Faculty</h3>
    		</div>
        </div>
        <div class="row creativityslider">
            <?php
            while($rwcreativity=mysqli_fetch_array($sqlcreativity)){
                $crimg = !empty($rwcreativity['file']) ? $rwcreativity['file'] : 'images/logo.jpg';
                $crlink = !empty($rwcreativity['redirect_url']) ? $rwcreativity['redirect_url'] : (!empty($rwcreativity['link']) ? $rwcreativity['link'] : 'javascript:');
            ?>
            <div class="creativity-slide-item">
                <div class="creativitycard">
                    <div class="creativitycardimg">
                        <img src="<?=$path.$crimg;?>" alt="<?=$rwcreativity['title'];?>">
                    </div>
                    <h4><?=$rwcreativity['title'];?></h4>
                    <a href="<?=$crlink;?>" class="btn-readmore">READ MORE</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } } ?>
