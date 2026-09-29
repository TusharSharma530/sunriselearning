<?php
$clinicalcat = mysqli_query($con, "SELECT * FROM `category` WHERE `c_url`='clinical-services' AND `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($clinicalcat)){
$allcards = array();
while($rwclinical = mysqli_fetch_assoc($clinicalcat)){
$clinicalimg = !empty($rwclinical['featured_img']) ? $rwclinical['featured_img'] : 'images/logo.jpg';
$desc = !empty($rwclinical['c_desc']) ? $rwclinical['c_desc'] : '';
$heading = !empty($rwclinical['section_heading']) ? $rwclinical['section_heading'] : '';
if(!empty($rwclinical['card_data'])){
    $allcards[] = $rwclinical;
}
?>
<div class="about-page-section" style="padding:40px 0;background:#f4f0fb;">
<div class="container-lg">
<div class="row align-items-center">
    <div class="col-md-12">
        <div style="text-align:center;">
            <figure style="margin:0;">
                <img src="<?=$path.$clinicalimg;?>" alt="<?=$rwclinical['c_name'];?>" style="max-width:100%;height:auto;border-radius:10px;">
            </figure>
        </div>
    </div>
</div>
<?php if(!empty($heading) || !empty($desc)){ ?>
<div class="row align-items-center" style="margin-top:30px;">
    <?php if(!empty($desc)){ ?>
    <div class="col-md-12">
        <div class="about-page-content">
            <?php if(!empty($heading)){ ?>
            <h2 style="font-size:20px;font-weight:700;color:#333;margin:0 0 10px;"><?=$heading;?></h2>
            <?php } ?>
            <div id="clinical-text-<?=$rwclinical['id'];?>" style="font-size:14px;line-height:1.6;color:#333;max-height:110px;overflow:hidden;">
                <?=$desc;?>
            </div>
            <a href="javascript:" onclick="document.getElementById('clinical-text-<?=$rwclinical['id'];?>').style.maxHeight='none';this.style.display='none';" style="display:inline-block;margin-top:8px;padding:6px 18px;background:#7b2d8e;color:#fff;border-radius:5px;text-decoration:none;font-size:13px;">Read More</a>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>
</div>
</div>
<?php
}
}

if(!empty($allcards)){
foreach($allcards as $cardcat){
    $cards = json_decode($cardcat['card_data'], true);
    if(!empty($cards)){
?>
<div class="about-page-section" style="padding:40px 0;background:#f4f0fb;">
<div class="container-lg">
    <?php if(!empty($cardcat['card_heading'])){ ?>
    <h2 style="text-align:center;margin-bottom:30px;font-size:26px;font-weight:700;color:#333;"><?=$cardcat['card_heading'];?></h2>
    <?php } ?>
    <div class="row">
        <?php foreach($cards as $card){ ?>
        <div class="col-md-4 mb-3">
            <div style="background:#fff;padding:25px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.08);height:100%;">
                <?php if(!empty($card['title'])){ ?>
                <h4 style="font-size:18px;font-weight:700;color:#7b2d8e;margin:0 0 10px;"><?=$card['title'];?></h4>
                <?php } ?>
                <?php if(!empty($card['desc'])){ ?>
                <p style="font-size:14px;line-height:1.7;color:#555;margin:0;"><?=$card['desc'];?></p>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php }
}
} ?>
