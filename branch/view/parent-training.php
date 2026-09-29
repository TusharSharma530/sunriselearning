<?php
$parentcat = mysqli_query($con, "SELECT * FROM `category` WHERE `c_url`='parent-training' AND `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($parentcat)){
$allcards = array();
while($rwparent = mysqli_fetch_assoc($parentcat)){
    $c_dec = json_decode($rwparent['card_data'] ?? '', true);
    if(!empty($c_dec)){
        $allcards[] = $rwparent;
    }
    
    // Row 3: Hero Quotes
    if($rwparent['id'] == 3){
        $parentimg = !empty($rwparent['featured_img']) ? $rwparent['featured_img'] : 'branch/assets/category/img1788427114.webp';
?>
<!-- SECTION 1: PARENTS TRAINING HERO -->
<div class="about-page-section bg-light-purple" id="parent-training-hero">
<div class="container-lg">
<div class="row align-items-center">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="about-page-content pe-lg-4">
            <span class="sec-badge">#ParentTraining</span>
            <h1 class="sec-main-heading mb-3"><?=!empty($rwparent['section_heading']) ? $rwparent['section_heading'] : 'Parents Training';?></h1>
            <div class="parent-lead-quote-wrap">
                <p class="parent-lead-quote">"People will walk in and walk out of a child's life. But a parent will stay."</p>
                <div class="parent-lead-quote highlight">
                    <i class="bi bi-quote quote-icon"></i>
                    <span>"Therefore, a parent is the BEST RESOURCE PERSON for a child with autism"</span>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?=$path;?>admission" class="btn-enquire-now">Enquire Now <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="about-page-image">
            <figure class="card-img-wrap">
                <img src="<?=$path.$parentimg;?>" alt="Parents Training - Sunrise Learning">
            </figure>
        </div>
    </div>
</div>
</div>
</div>
<?php
    }

    // Row 63: Feature Course: Management & Education in school & home
    if($rwparent['id'] == 63){
        $courseimg = !empty($rwparent['featured_img']) ? $rwparent['featured_img'] : 'branch/assets/category/img1788427600.webp';
?>
<!-- SECTION 2: MANAGEMENT & EDUCATION COURSE -->
<div class="about-page-section bg-white" id="autism-course">
<div class="container-lg">
<div class="row align-items-stretch">
    <div class="col-lg-6 order-2 order-lg-1 mb-4 mb-lg-0">
        <div class="about-page-image pe-lg-3 h-100">
            <figure class="card-img-wrap " style="margin:0;overflow:hidden;border-radius:15px;">
                <img src="<?=$path.$courseimg;?>" alt="Autism Management Course" style="width:100%;height:100%;object-fit:cover;display:block;">
            </figure>
        </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
        <div class="about-page-content ps-lg-3">
            <span class="sec-badge">#Certification</span>
            <h2 class="sec-main-heading mb-3" style="font-size:26px;"><?=!empty($rwparent['section_heading']) ? $rwparent['section_heading'] : 'Management & Education of persons with AUTISM in school & HOME environment';?></h2>
            
            <div class="section-desc-body">
                <?=$rwparent['c_desc'];?>
            </div>

            <div class="course-note-box mt-3">
                <i class="bi bi-shield-check" style="font-size:20px;color:#d97706;flex-shrink:0;"></i>
                <div>
                    <strong>Important Note:</strong>
                    <span>These courses are basically and primarily meant for "empowering parents". They do not provide you a license to work as professionals in Special Education.</span>
                </div>
            </div>

            <!-- <div class="course-mode-banner mt-3">
                <strong>Certificate Courses in Autism Spectrum Conditions (CC-ASC) &amp; Shadow Teacher Training</strong>
                <span>For Parents &amp; Professionals | Regular, Saturdays &amp; Distance Learning Modes</span>
            </div> -->
        </div>
    </div>
</div>
</div>
</div>
<?php
    }
}

// 3. Training Programs Cards (PES, PEP, Workshops)
$cards_list = array();
if(!empty($allcards)){
    foreach($allcards as $c_item){
        if(!empty($c_item['card_data'])){
            $cards_list = json_decode($c_item['card_data'], true);
            $cards_heading = $c_item['card_heading'];
            break;
        }
    }
}
if(!empty($cards_list)){
?>
<!-- SECTION 3: TRAINING PROGRAMS CARDS (PES, PEP, WORKSHOPS) -->
<div class="about-page-section bg-light-purple" id="training-modes">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#TrainingModes</span>
        <h2 class="sec-main-heading"><?=!empty($cards_heading) ? $cards_heading : 'Training Programs & Workshops';?></h2>
        <p class="sec-sub-title">Structured learning pathways for parents to empower and support their children</p>
    </div>
    <div class="row g-4">
        <?php
        $card_icons = array('bi-calendar-week-fill', 'bi-clock-history', 'bi-mortarboard-fill');
        $card_colors = array('icon-purple', 'icon-blue', 'icon-rose');
        $card_badges = array('Saturdays (10 AM - 1 PM)', '6-8 Weeks Regular (Daily 2-3 Hrs)', 'Quarterly & Annual Events');
        $ci = 0;
        foreach($cards_list as $card){
            $c_mod = $ci % 3;
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="pp-card pp-card-<?=($c_mod + 1);?>">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="pp-icon-wrap <?=$card_colors[$c_mod];?> mb-0">
                            <i class="bi <?=$card_icons[$c_mod];?>"></i>
                        </div>
                        <span class="badge rounded-pill bg-light text-dark px-3 py-2 border" style="font-size:11.5px;font-weight:700;">
                            <?=$card_badges[$c_mod];?>
                        </span>
                    </div>
                    <h4 class="pp-card-title"><?=$card['title'];?></h4>
                    <p class="pp-card-desc mb-0"><?=$card['desc'];?></p>
                </div>
            </div>
        </div>
        <?php $ci++; } ?>
    </div>
</div>
</div>
<?php } ?>

<?php } ?>
