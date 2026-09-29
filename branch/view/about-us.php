<?php
$aboutcat = mysqli_query($con, "SELECT * FROM `category` WHERE `c_url`='about-us' AND `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($aboutcat)){
$i = 0;
$allcards = array();
while($rwabout = mysqli_fetch_assoc($aboutcat)){
$aboutimg = !empty($rwabout['featured_img']) ? $rwabout['featured_img'] : 'images/logo.jpg';
$desc = !empty($rwabout['c_desc']) ? $rwabout['c_desc'] : '';
if(!empty($rwabout['card_data'])){
    $allcards[] = $rwabout;
}

$isOurApproach = ($rwabout['section_heading'] == 'OUR APPROACH');
$badges = array('#AboutUs', '#OurPrinciples', '#OurApproach');
$badge = $badges[$i % count($badges)];
$bgclass = ($i % 2 == 0) ? 'bg-light-purple' : 'bg-white';

if($isOurApproach){
?>
<!-- SECTION: OUR APPROACH & OUR LIFESPAN MODEL -->
<div class="about-page-section our-approach-section <?=$bgclass;?>" id="our-approach">
<div class="container-lg">
    <div class="row align-items-center mb-4">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="sec-badge">#OurApproach</span>
            <h2 class="sec-main-heading mb-3">OUR APPROACH</h2>
            <div class="section-desc-body">
                <p><strong>Our Unique Value Proposition (USP): Lifespan Support for Neurodiverse Learners</strong></p>
                <p>At Sunrise Learning, our core strength lies in providing holistic, lifespan-based support for individuals with autism and other developmental challenges. Unlike conventional approaches that compartmentalize services across different stages and institutions, we offer a seamless continuum of care and education — all under one roof.</p>
                <p>What a neurotypical individual typically receives through four distinct systems across their life — preschool, school, college, and professional training — a neurodiverse learner at Sunrise Learning experiences in an integrated, personalized journey that adapts to their pace, needs, and potential.</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="about-page-image">
                <figure class="card-img-wrap">
                    <img src="<?=$path.$rwabout['featured_img'];?>" alt="Our Approach - Sunrise Learning">
                </figure>
            </div>
        </div>
    </div>

    <!-- LIFESPAN MODEL SECTION (Matches https://sunriselearning.in/about-us/) -->
    <div class="lifespan-model-card">
        <div class="lifespan-header">
            <span class="lifespan-badge">Continuum of Care</span>
            <h3 class="lifespan-title"><i class="bi bi-diagram-3-fill"></i> Our Lifespan Model:</h3>
        </div>
        <div class="lifespan-grid row g-3 mt-1">
            <div class="col-md-6">
                <div class="lifespan-item">
                    <div class="item-icon"><i class="bi bi-check2-all"></i></div>
                    <div class="item-content">
                        <strong>Early Intervention (Ages 2–6):</strong>
                        <span>Equivalent to preschool, focusing on foundational skills, communication, and sensory regulation.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="lifespan-item">
                    <div class="item-icon"><i class="bi bi-check2-all"></i></div>
                    <div class="item-content">
                        <strong>Special Schooling (Ages 4–10 &amp; Ages 8–16):</strong>
                        <span>Targeted learning for early learners, and for Pre-Vocational programs – developmental progress through structured programs and individual educational plans, with Emphasis on life skills, functional academics, and open schooling to build grade-level competencies for holistic development.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="lifespan-item">
                    <div class="item-icon"><i class="bi bi-check2-all"></i></div>
                    <div class="item-content">
                        <strong>Vocational Skill Training (Ages 14–18):</strong>
                        <span>Equivalent to college-level learning, this phase offers exposure to real-life skills in hospitality, retail, IT, arts &amp; crafts, and other areas based on individual interests and strengths.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="lifespan-item">
                    <div class="item-icon"><i class="bi bi-check2-all"></i></div>
                    <div class="item-content">
                        <strong>Employment &amp; Livelihood Readiness (18+):</strong>
                        <span>Tailored pathways for job readiness, micro-enterprise creation, and supported employment — equivalent to professional certification or actual employment in the neurotypical world.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="lifespan-philosophy mt-4">
            <p>We do not follow a deficit-based model. Instead, our approach celebrates neurodiversity, fosters strengths, builds dignity, and promotes functional independence.</p>
            <p class="mb-0"><strong>Our belief is simple yet powerful:</strong> Development should not be fragmented. A break or gap in the support system can lead to regression. That’s why our integrated model ensures continuity, predictability, and a sense of belonging throughout a learner’s journey — from early childhood to adulthood.</p>
        </div>
    </div>
</div>
</div>
<?php
} else if($i % 2 == 0){
?>
<div class="about-page-section <?=$bgclass;?>">
<div class="container-lg">
<div class="row align-items-center">
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="about-page-content pe-md-4">
            <?php if($badge != '#AboutUs'){ ?>
            <span class="sec-badge"><?=$badge;?></span>
            <?php } ?>
            <?php if(!empty($rwabout['section_heading'])){ ?>
            <h2 class="sec-main-heading mb-3"><?=$rwabout['section_heading'];?></h2>
            <?php } ?>
            <?php if(!empty($desc)){ ?>
            <div class="section-desc-body">
                <?=$desc;?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="about-page-image">
            <figure class="card-img-wrap">
                <img src="<?=$path.$rwabout['featured_img'];?>" alt="<?=htmlspecialchars($rwabout['section_heading'] ?? $rwabout['c_name']);?>">
            </figure>
        </div>
    </div>
</div>
</div>
</div>
<?php } else { ?>
<div class="about-page-section <?=$bgclass;?>">
<div class="container-lg">
<div class="row align-items-center">
    <div class="col-md-6 order-2 order-md-1 mb-4 mb-md-0">
        <div class="about-page-image">
            <figure class="card-img-wrap">
                <img src="<?=$path.$rwabout['featured_img'];?>" alt="<?=htmlspecialchars($rwabout['section_heading'] ?? $rwabout['c_name']);?>">
            </figure>
        </div>
    </div>
    <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
        <div class="about-page-content ps-md-4">
            <?php if($badge != '#AboutUs'){ ?>
            <span class="sec-badge"><?=$badge;?></span>
            <?php } ?>
            <?php if(!empty($rwabout['section_heading'])){ ?>
            <h2 class="sec-main-heading mb-3"><?=$rwabout['section_heading'];?></h2>
            <?php } ?>
            <?php if(!empty($desc)){ ?>
            <div class="section-desc-body">
                <?=$desc;?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
<?php }
$i++;
}

if(!empty($allcards)){
foreach($allcards as $cardcat){
    if($cardcat['order'] == 4){ continue; }
    $cards = json_decode($cardcat['card_data'], true);
    if(!empty($cards)){
?>
<!-- SECTION: SOME MORE PRINCIPLES (CARDS) -->
<div class="about-principles-section" id="principles">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">Our Principles</span>
        <h2 class="sec-main-heading"><?=!empty($cardcat['card_heading']) ? $cardcat['card_heading'] : 'Some more principles that we use and follow at Sunrise Learning:';?></h2>
        <p class="sec-sub-title">Core methodologies that guide our individualized support and learning environment</p>
    </div>
    <div class="row g-4">
        <?php 
        $icons = array('bi-diagram-3-fill', 'bi-calendar-check-fill', 'bi-chat-heart-fill');
        $icon_classes = array('icon-blue', 'icon-red', 'icon-green');
        $c_idx = 0;
        foreach($cards as $card){ 
            $c_mod = $c_idx % 3;
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="about-principle-card card-accent-<?=$c_mod;?>">
                <div class="principle-icon-wrap <?=$icon_classes[$c_mod];?>">
                    <i class="bi <?=$icons[$c_mod];?>"></i>
                </div>
                <?php if(!empty($card['title'])){ ?>
                <h4 class="principle-card-title"><?=$card['title'];?></h4>
                <?php } ?>
                <?php if(!empty($card['desc'])){ ?>
                <p class="principle-card-desc"><?=$card['desc'];?></p>
                <?php } ?>
            </div>
        </div>
        <?php $c_idx++; } ?>
    </div>
</div>
</div>
<?php }
}
} } ?>

<!-- SECTION: STUDENT PROGRAMS (CARDS) -->
<?php
$crtable = mysqli_query($con, "SHOW TABLES LIKE 'creativity'");
if(mysqli_num_rows($crtable)){
$sqlcreativity=mysqli_query($con,"SELECT * FROM `creativity` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcreativity)){
?>
<div class="creativitysection" id="student-programs">
    <div class="container">
        <div class="row">
            <div class="widgethead text-center">
                <span class="sec-badge">#Programs</span>
    			<h2 class="sec-main-title">STUDENT PROGRAMS</h2>
                <p class="sec-sub-title">Empowering each individual through holistic, lifespan-based developmental pathways</p>
    		</div>
        </div>
        <div class="row creativityslider">
            <?php
            while($rwcreativity=mysqli_fetch_array($sqlcreativity)){
                $crimg = !empty($rwcreativity['file']) ? $rwcreativity['file'] : 'images/logo.jpg';
                $crredirect = __relativeUrl($rwcreativity['redirect_url']);
                $crlink = !empty($crredirect) ? $path.$crredirect : (!empty($rwcreativity['link']) ? $rwcreativity['link'] : 'javascript:');
            ?>
            <div class="creativity-slide-item">
                <div class="creativitycard">
                    <div class="creativitycardimg">
                        <img src="<?=$path.$crimg;?>" alt="<?=$rwcreativity['title'];?>">
                        <span class="card-program-badge">Program</span>
                    </div>
                    <div class="creativitycard-body">
                        <h4><?=$rwcreativity['title'];?></h4>
                        <a href="<?=$crlink;?>" class="btn-readmore">READ MORE <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } } ?>

<!-- SECTION: FOR PARENTS / PROFESSIONALS (CARDS) -->
<?php
$pp_cards = array();
$pp_heading = 'For parents / professionals';
if(!empty($allcards)){
    foreach($allcards as $c_item){
        if($c_item['order'] == 4 || stripos($c_item['card_heading'], 'parents') !== false || stripos($c_item['card_heading'], 'professional') !== false){
            $pp_cards = json_decode($c_item['card_data'], true);
            $pp_heading = !empty($c_item['card_heading']) ? $c_item['card_heading'] : $pp_heading;
            break;
        }
    }
}
if(!empty($pp_cards)){
?>
<div class="parents-professionals-section" id="parents-professionals">
    <div class="container-lg">
        <div class="widgethead text-center">
            <span class="sec-badge">#SupportPrograms</span>
            <h2 class="sec-main-heading"><?=$pp_heading;?></h2>
            <p class="sec-sub-title">Empowerment programs, workshops, certifications, and specialized support sessions</p>
        </div>
        <div class="row g-4">
            <?php
            $pp_icons = array('bi-people-fill', 'bi-person-hearts', 'bi-award-fill', 'bi-mortarboard-fill', 'bi-hand-thumbs-up-fill', 'bi-chat-quote-fill');
            $pp_colors = array('icon-purple', 'icon-blue', 'icon-coral', 'icon-teal', 'icon-amber', 'icon-rose');
            $pp_idx = 0;
            foreach($pp_cards as $pp_card){
                $pp_mod = $pp_idx % 6;
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="pp-card pp-card-<?=($pp_mod + 1);?>">
                    <div class="pp-icon-wrap <?=$pp_colors[$pp_mod];?>">
                        <i class="bi <?=$pp_icons[$pp_mod];?>"></i>
                    </div>
                    <?php if(!empty($pp_card['title'])){ ?>
                    <h4 class="pp-card-title"><?=$pp_card['title'];?></h4>
                    <?php } ?>
                    <?php if(!empty($pp_card['desc'])){ ?>
                    <p class="pp-card-desc"><?=$pp_card['desc'];?></p>
                    <?php } ?>
                </div>
            </div>
            <?php $pp_idx++; } ?>
        </div>
    </div>
</div>
<?php } ?>
