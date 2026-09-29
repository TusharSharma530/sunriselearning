<?php
$slcat = mysqli_query($con, "SELECT * FROM `category` WHERE `c_url`='s-l-foundation' AND `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($slcat)){
$allcards = array();
while($rwsl = mysqli_fetch_assoc($slcat)){
    if(!empty($rwsl['card_data'])){
        $allcards[] = $rwsl;
    }
    // Render main intro section (order 2 / id 2)
    if($rwsl['order'] == 2 || $rwsl['id'] == 2){
        $aboutimg = !empty($rwsl['featured_img']) ? $rwsl['featured_img'] : 'branch/assets/category/img1788350626.webp';
?>
<!-- SECTION: ABOUT SUNRISE LEARNING FOUNDATION -->
<div class="about-page-section bg-light-purple" id="about-foundation">
<div class="container-lg">
<div class="row align-items-center">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="about-page-content pe-lg-4">
            <span class="sec-badge">#AboutUs</span>
            <h2 class="sec-main-heading mb-3"><?=!empty($rwsl['section_heading']) ? $rwsl['section_heading'] : 'About Sunrise Learning Foundation';?></h2>
            <div class="section-desc-body">
                <?php if(!empty($rwsl['c_desc'])){ ?>
                <?=$rwsl['c_desc'];?>
                <?php } else { ?>
                <p>We are a not-for-profit non-Government organization dedicated towards providing employment, empowerment, inclusion, independence-Vocational training, education and support services to differently-abled people and their families.</p>
                <p>The organization is registered as a Trust, under The Indian Trusts Act, 1882 and NITI Aayog, DARPAN, FCRA, CSR-1.</p>
                <p>It is also registered under section 80G and 12A of Income Tax Act, 1961.</p>
                <p>With a head-office in New Delhi and a Special School at Noida, the Foundation works with families pan India through various out-reach programs for providing direct therapeutic support and Vocational Training to differently abled persons.</p>
                <?php } ?>
            </div>
            <div class="mt-3">
                <a href="https://sunrise-learning-foundation.danamojo.org/dm/general-fund-7301" target="_blank" class="btn-donate-now">Donate Now <i class="bi bi-heart-fill"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="about-page-image">
            <figure class="card-img-wrap">
                <img src="<?=$path.$aboutimg;?>" alt="About Sunrise Learning Foundation">
            </figure>
        </div>
    </div>
</div>
</div>
</div>
<?php 
    }
}
?>

<!-- SECTION: TWIN PILLARS CARDS -->
<?php
$pillar_cards = array();
if(!empty($allcards)){
    foreach($allcards as $c_item){
        if($c_item['id'] == 2 || stripos($c_item['card_heading'], 'twin') !== false){
            $pillar_cards = json_decode($c_item['card_data'], true);
            $pillar_heading = $c_item['card_heading'];
            break;
        }
    }
}
if(!empty($pillar_cards)){
?>
<div class="about-page-section bg-white" id="pillars">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#OurPillars</span>
        <h2 class="sec-main-heading"><?=!empty($pillar_heading) ? $pillar_heading : 'We support neurodiverse persons from ages 2 to 30+ years with our twin pillars:';?></h2>
        <p class="sec-sub-title">Providing progressive, multifaceted learning and pan-India outreach support</p>
    </div>
    <div class="row g-4">
        <?php
        $p_icons = array('bi-building', 'bi-globe2', 'bi-compass-fill');
        $p_colors = array('icon-purple', 'icon-blue', 'icon-rose');
        $p_idx = 0;
        foreach($pillar_cards as $p_card){
            $p_mod = $p_idx % 3;
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="pillar-card pillar-<?=$p_mod;?>">
                <div class="pillar-icon-wrap <?=$p_colors[$p_mod];?>">
                    <i class="bi <?=$p_icons[$p_mod];?>"></i>
                </div>
                <h4 class="pillar-card-title"><?=$p_card['title'];?></h4>
                <p class="pillar-card-desc"><?=$p_card['desc'];?></p>
            </div>
        </div>
        <?php $p_idx++; } ?>
    </div>
</div>
</div>
<?php } ?>

<!-- SECTION: OUR ACHIEVEMENTS -->
<?php
function extractYoutubeId($url){
    if(preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\?]+)/', $url, $matches)){
        return $matches[1];
    }
    return $url;
}

$achievementsq = mysqli_query($con, "SELECT `id`, `title`, `description`, `youtube_url`, `order` FROM `achievements` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($achievementsq)){
?>
<div class="about-page-section bg-white" id="achievements">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Milestones</span>
        <h2 class="sec-main-heading">Our Achievements</h2>
        <p class="sec-sub-title">Milestones that reflect our dedication to empowering differently-abled individuals</p>
    </div>
    <div class="row g-4 justify-content-center">
        <?php while($rwach = mysqli_fetch_assoc($achievementsq)){ 
            $hasVideo = !empty($rwach['youtube_url']);
            $videoId = $hasVideo ? extractYoutubeId($rwach['youtube_url']) : '';
        ?>
        <div class="col-lg-6 col-md-6">
            <div class="achievement-card" style="background:#000;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.15);">
                <?php if($hasVideo && $videoId){ ?>
                <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
                    <iframe src="https://www.youtube.com/embed/<?=$videoId;?>" title="<?=$rwach['title'];?>" style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <?php } ?>
                <?php if(!empty($rwach['title']) || !empty($rwach['description'])){ ?>
                <div style="padding:15px 20px;background:#fff;">
                    <?php if(!empty($rwach['title'])){ ?>
                    <h5 style="font-size:16px;font-weight:700;color:#1a3a5c;margin:0 0 5px;"><?=$rwach['title'];?></h5>
                    <?php } ?>
                    <?php if(!empty($rwach['description'])){ ?>
                    <p style="font-size:13px;color:#666;margin:0;line-height:1.5;"><?=substr($rwach['description'], 0, 120);?>...</p>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php } ?>

<!-- SECTION: THE FOUNDERS -->
<?php
$foundersq = mysqli_query($con, "SELECT * FROM founders WHERE status=1 ORDER BY `order` ASC");
if(mysqli_num_rows($foundersq)){
?>
<div class="about-page-section bg-light-purple" id="founders">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Leadership</span>
        <h2 class="sec-main-heading">THE FOUNDERS</h2>
        <p class="sec-sub-title">The foundation was established by doctor parents of a child on the autism spectrum.</p>
    </div>
    <div class="row g-4 justify-content-center">
        <?php while($rwfd = mysqli_fetch_assoc($foundersq)){ ?>
        <div class="col-lg-4 col-md-6">
            <div class="founder-profile-card">
                <?php if(!empty($rwfd['file'])){ ?>
                <div class="founder-profile-img">
                    <img src="<?=$path.$rwfd['file'];?>" alt="<?=$rwfd['name'];?>">
                </div>
                <?php } ?>
                <h4><?=$rwfd['name'];?></h4>
                <?php if(!empty($rwfd['title'])){ ?>
                <p class="founder-role"><?=$rwfd['title'];?></p>
                <?php } ?>
                <?php if(!empty($rwfd['description'])){ ?>
                <p class="mt-2 text-muted" style="font-size:13.5px;line-height:1.6;"><?=$rwfd['description'];?></p>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <p class="text-center mt-4 mb-0" style="font-size:15px;color:#666;font-style:italic;">
        <i class="bi bi-info-circle me-1"></i> The Board is constituted by eminent doctors, educationists and professionals from the corporate world.
    </p>
</div>
</div>
<?php } ?>

<!-- SECTION: AWARDS -->
<?php
$awardsq = mysqli_query($con, "SELECT * FROM awards WHERE status=1 ORDER BY `order` ASC");
if(mysqli_num_rows($awardsq)){
?>
<div class="about-page-section bg-white" id="awards">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Honors</span>
        <h2 class="sec-main-heading">Awards</h2>
        <p class="sec-sub-title">Recognized for our commitment to excellence, innovation, and empowerment</p>
    </div>
    <div class="row g-4 justify-content-center">
        <?php while($rwaw = mysqli_fetch_assoc($awardsq)){ ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="award-card">
                <?php if(!empty($rwaw['file'])){ ?>
                <div class="award-card-img">
                    <img src="<?=$path.$rwaw['file'];?>" alt="<?=$rwaw['name'];?>">
                </div>
                <?php } ?>
                <?php if(!empty($rwaw['name'])){ ?>
                <h5 class="mt-3 mb-1" style="font-size:16px;font-weight:700;color:#1a1a4e;"><?=$rwaw['name'];?></h5>
                <?php } ?>
                <?php if(!empty($rwaw['title'])){ ?>
                <p class="text-muted mb-0" style="font-size:13px;"><?=$rwaw['title'];?></p>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php } ?>

<!-- SECTION: THE IMPACT WE ARE WORKING TO CREATE -->
<div class="about-page-section bg-light-purple" id="impact">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#OurImpact</span>
        <h2 class="sec-main-heading">THE IMPACT WE ARE WORKING TO CREATE</h2>
        <p class="sec-sub-title">Holistic growth, empowerment, and independence for every neurodiverse individual</p>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <p><strong>Holistic Child Empowerment:</strong> Empowering differently-abled children with education, social skill development, speech therapy, gross &amp; fine motor skills, Occupational therapies, ADLs, and computer training with an expressive multi-disciplinary curriculum (art, yoga, dance, music).</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-briefcase-fill"></i></div>
                <p><strong>Vocational &amp; Livelihood Training:</strong> Comprehensive pre-vocational and vocational skill training combining hard and soft skills for sustainable livelihood readiness and independent living.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-people-fill"></i></div>
                <p><strong>Parent Empowerment Programs:</strong> Offering free and paid sessions for awareness, acceptance, skill development, and counseling to equip parents to be the primary support system for their wards.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-megaphone-fill"></i></div>
                <p><strong>Mainstream Awareness &amp; Inclusion:</strong> Organizing in-person and digital community campaigns highlighting the strengths and challenges of people with Autism, fostering true social inclusion.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-chat-heart-fill"></i></div>
                <p><strong>Digital Counseling &amp; Family Support:</strong> Conducting regular online counseling sessions, webinars, and supportive social media initiatives for ongoing emotional guidance and parental mental health.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="impact-item-card">
                <div class="impact-icon"><i class="bi bi-trophy-fill"></i></div>
                <p><strong>Talent &amp; Ability Showcasing:</strong> Organizing prestigious events and campaigns to showcase the remarkable abilities of specially-abled individuals in sports, arts, and creative production.</p>
            </div>
        </div>
    </div>
</div>
</div>

<!-- SECTION: OTHER RECOGNITIONS -->
<?php
$rec_cards = array();
if(!empty($allcards)){
    foreach($allcards as $c_item){
        if($c_item['id'] == 61 || stripos($c_item['card_heading'], 'recognition') !== false){
            $rec_cards = json_decode($c_item['card_data'], true);
            break;
        }
    }
}
if(!empty($rec_cards)){
?>
<div class="about-page-section bg-white" id="recognitions">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Recognitions</span>
        <h2 class="sec-main-heading">Other Recognitions</h2>
        <p class="sec-sub-title">National and international accolades honoring our decade of pioneering work</p>
    </div>
    <div class="row g-3">
        <?php foreach($rec_cards as $rec){ ?>
        <div class="col-lg-6">
            <div class="recognition-item-card">
                <i class="bi bi-trophy-fill rec-trophy"></i>
                <div>
                    <?php if(!empty($rec['title'])){ ?>
                    <strong><?=$rec['title'];?></strong>
                    <?php } ?>
                    <span><?=$rec['desc'];?></span>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php } ?>

<!-- SECTION: JOIN US BANNER -->
<div class="container-lg pb-5">
    <div class="join-us-banner">
        <h2>If you want to be a part, Join us in the journey of Educating, empowering and employing special persons.</h2>
        <a href="https://forms.gle/iF4tFeQaDfU2KTzJ7" target="_blank" class="btn-join-us">Join Us <i class="bi bi-arrow-right"></i></a>
    </div>
</div>

<?php } ?>
