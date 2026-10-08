<div class="widget-slider">
<div class="slider">
<?php $sqlslider=mysqli_query($con,"SELECT * FROM `web_banner` WHERE `status`=1 ORDER BY `wb_order` ASC");
while($rwslider=mysqli_fetch_array($sqlslider)){ ?>
	<a href="javascript:" class="sliderimg">
		<img src="<?=$path.$rwslider['wb_img'];?>" alt="<?=$rwslider['wb_order'];?>">
	</a>
<?php } ?>
</div>
</div>




<?php
$sqlgold=mysqli_query($con,"SELECT * FROM `category` WHERE `c_type`=3 AND `status`=1 AND `c_name`='Home' AND `order` IN (1,2) ORDER BY `order` ASC");
if(mysqli_num_rows($sqlgold)){
while($rwgold=mysqli_fetch_array($sqlgold)){
    $goldimg = !empty($rwgold['featured_img']) ? $rwgold['featured_img'] : 'home1.jpg';
    if($rwgold['order'] == 2){
?>
<!-- SECTION ORDER 2: ABOUT SUNRISE LEARNING -->
<div class="goldmedalist order2" id="about-sunrise">
<div class="container-lg">
<div class="row align-items-center">
	<div class="col-md-6">
	    <div class="goldmedalist-right">
            <div class="section-tag-badge">
                <img src="<?=$path;?>images/logo.jpg" alt="Logo" class="badge-mini-logo">
                <span>A unit of Sunrise Learning Foundation</span>
            </div>
            <span class="section-sub-tag">SUNRISE LEARNING SPECIAL SCHOOL NOIDA</span>
            <h2 class="section-heading-main"><?=!empty($rwgold['section_heading']) ? $rwgold['section_heading'] : 'ABOUT SUNRISE LEARNING';?></h2>
            
            <div class="section-desc-body">
                <?php if(!empty($rwgold['c_desc'])){ ?>
                <?=$rwgold['c_desc'];?>
                <?php } else { ?>
                <p>SUNRISE LEARNING is a special school in Noida that offers school programs to children &amp; adults with autism &amp; other special needs. We work with children as young as 2 years (in Early Intervention) to adults 30+ years (for Employment Readiness Trainings). We offer several school programs that nurture holistic development of children, and provide an inclusive social environment for learners to progress towards independence &amp; dignity.</p>
                <?php } ?>
            </div>

            <div class="section-actions mt-3">
                <a href="#student-programs" class="btn-school-programs">School Programs <i class="bi bi-chevron-right"></i></a>
            </div>
	    </div>
	</div>
	<div class="col-md-6">
	    <div class="goldmedalist-left">
	        <figure class="card-img-wrap"><img src="<?=$path.$goldimg;?>" alt="<?=!empty($rwgold['section_heading']) ? $rwgold['section_heading'] : $rwgold['c_name'];?>"/></figure>
	    </div>
	</div>
</div>
</div>
</div>
<?php } else { ?>
<!-- SECTION ORDER 1: HERO / SUNRISE LEARNING SPECIAL SCHOOL NOIDA -->
<div class="goldmedalist order1">
<div class="container-lg">
<div class="row align-items-center">
	<div class="col-md-6">
	    <div class="goldmedalist-left">
	        <figure class="card-img-wrap"><img src="<?=$path.$goldimg;?>" alt="<?=!empty($rwgold['section_heading']) ? $rwgold['section_heading'] : $rwgold['c_name'];?>"/></figure>
	    </div>
	</div>
	<div class="col-md-6">
	    <div class="goldmedalist-right">
            <span class="hero-top-badge">Special School NOIDA</span>
            <h1 class="hero-main-title"><?=!empty($rwgold['section_heading']) ? $rwgold['section_heading'] : 'Sunrise Learning';?></h1>
            <p class="hero-unit-text">A unit of Sunrise Learning Foundation</p>
            
            <div class="hero-quote-box">
                <?=!empty($rwgold['sdesc']) ? $rwgold['sdesc'] : '"Empowering Special Lives Towards Independence and Dignity Since 2014"';?>
            </div>

            <div class="hero-desc-content">
                <?php if(!empty($rwgold['c_desc'])){ ?>
                <?=$rwgold['c_desc'];?>
                <?php } else { ?>
                <p>Special School &amp; Vocational Training Center for children &amp; adults with special needs (autism, ADHD, Intellectual Disability, Downs Syndrome &amp; other neurodevelopmental conditions)</p>
                <p><strong>Age groups:</strong> 2+ to 30+ years</p>
                <?php } ?>
            </div>

            <div class="hero-action-buttons">
                <a href="<?=$path;?>admission" class="btn-enquire-now">Enquire Now <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="hero-contact-strip row g-2 mt-3">
                <div class="col-sm-6">
                    <div class="strip-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <strong>Plot No - SD 01, Sector 116</strong>
                            <small>( Next to Sec 77 ) Noida<br>Ph: 8585928038, 7042979118</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="strip-item email-strip">
                        <i class="bi bi-envelope-fill"></i>
                        <div>
                            <strong class="email-text">contactus@sunriselearning.in</strong>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</div>
</div>
</div>
</div>
<?php } } } ?>

<!--
<?php
$sqlaboutsec=mysqli_query($con,"SELECT * FROM `category` WHERE `c_type`=4 AND `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlaboutsec)){
while($rwaboutsec=mysqli_fetch_array($sqlaboutsec)){
    $aboutimg = !empty($rwaboutsec['featured_img']) ? $rwaboutsec['featured_img'] : 'about.jpg';
?>
<div class="school-building">
<div class="container-lg">
<div class="row align-items-center">
	<div class="col-md-6">
	    <div class="school-building-right">
	        <h3><?=$rwaboutsec['c_name'];?></h3>
            <?php if(!empty($rwaboutsec['c_desc'])){ ?>
            <?=$rwaboutsec['c_desc'];?>
            <?php } ?>
	    </div>
	</div>
	<div class="col-md-6">
	    <div class="school-building-left">
	        <figure><img src="<?=$path.$aboutimg;?>" alt="<?=$rwaboutsec['c_name'];?>"/></figure>
	    </div>
	</div>
</div>
</div>
</div>
<?php } } ?>
-->

<?php
$crtable = mysqli_query($con, "SHOW TABLES LIKE 'creativity'");
$hasCreativity = false;
if(mysqli_num_rows($crtable)){
$sqlcreativity=mysqli_query($con,"SELECT * FROM `creativity` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlcreativity)){
$hasCreativity = true;
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

<!-- SECTION ORDER 3: SUNRISE LEARNING OVERVIEW -->
<?php
$sqlgold3=mysqli_query($con,"SELECT * FROM `category` WHERE `c_type`=3 AND `status`=1 AND `c_name`='Home' AND `order`=3");
if(mysqli_num_rows($sqlgold3)){
$rwgold3=mysqli_fetch_array($sqlgold3);
    $goldimg3 = !empty($rwgold3['featured_img']) ? $rwgold3['featured_img'] : 'home1.jpg';
?>
<div class="school-building school-building-order3" id="sunrise-overview">
<div class="container-lg">
<div class="row align-items-start">
	<div class="col-lg-6 col-md-6">
	    <div class="school-building-left">
	        <figure class="card-img-wrap"><img src="<?=$path.$goldimg3;?>" alt="<?=!empty($rwgold3['section_heading']) ? $rwgold3['section_heading'] : $rwgold3['c_name'];?>"/></figure>
	    </div>
	</div>
	<div class="col-lg-6 col-md-6">
	    <div class="school-building-right">
            <span class="sec-badge">#SpecialSchool</span>
            <h2 class="section-heading-main"><?=!empty($rwgold3['section_heading']) ? $rwgold3['section_heading'] : 'SUNRISE LEARNING';?></h2>
            <?php if(!empty($rwgold3['sdesc'])){ ?>
            <h5 class="section-sub-heading"><?=$rwgold3['sdesc'];?></h5>
            <?php } ?>
            <div class="section-desc-body desc-truncate" id="order3Desc">
                <?php if(!empty($rwgold3['c_desc'])){ ?>
                <?=$rwgold3['c_desc'];?>
                <?php } ?>
            </div>
            <button class="btn-readmore-toggle" onclick="toggleOrder3Desc()">Read More <i class="bi bi-chevron-down"></i></button>
	    </div>
	</div>
</div>
</div>
</div>
<?php } ?>

<!-- VIDEO TESTIMONIALS -->
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

$ytable = mysqli_query($con, "SHOW TABLES LIKE 'youtube'");
if(mysqli_num_rows($ytable)){
$sqlyt=mysqli_query($con,"SELECT * FROM `youtube` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlyt)){
?>
<div class="testimonials-section">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Profile</span>
        <h2 class="sec-main-title">Testimonials</h2>
    </div>
    <div class="testimonials-slider">
        <?php while($rwyt=mysqli_fetch_array($sqlyt)){
            $videoId = getYoutubeVideoId(trim($rwyt['youtubeurl']));
            if(empty($videoId)){ continue; }
        ?>
        <div class="testimonial-card">
            <div class="testimonial-video">
                <iframe src="https://www.youtube.com/embed/<?=htmlspecialchars($videoId);?>" title="Testimonial" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php } } ?>

<!-- SECTION ORDER 4: MEET THE FOUNDER -->
<?php
$sqlgold4=mysqli_query($con,"SELECT * FROM `category` WHERE `c_type`=3 AND `status`=1 AND `c_name`='Home' AND `order`=4");
if(mysqli_num_rows($sqlgold4)){
$rwgold4=mysqli_fetch_array($sqlgold4);
    $goldimg4 = !empty($rwgold4['featured_img']) ? $rwgold4['featured_img'] : 'images/dr sonali.PNG';
?>
<div class="school-building school-building-founder" id="meet-founder">
<div class="container-lg">
<div class="row align-items-center">
	<div class="col-md-7 order-2 order-md-1">
	    <div class="school-building-right">
            <span class="sec-badge">Meet the Founder</span>
            <h2 class="section-heading-main"><?=!empty($rwgold4['section_heading']) ? $rwgold4['section_heading'] : 'Dr. Sonali Kataria Sirohi';?></h2>
            
            <div class="founder-social-links">
                <a href="https://twitter.com" target="_blank" class="f-social ri-twitter-x-line" title="Twitter"></a>
                <a href="https://www.facebook.com/share/1AU1ejBgvo/" target="_blank" class="f-social ri-facebook-fill" title="Facebook"></a>
                <a href="<?=$path;?>sl-blog" target="_blank" class="f-social ri-article-line" title="Blog"></a>
                <a href="https://youtube.com/@sunriselearningnoida?si=IP2oai7WFvF-Cd9b" target="_blank" class="f-social ri-youtube-fill" title="YouTube"></a>
            </div>

            <div class="founder-credentials">
                <?php if(!empty($rwgold4['c_desc'])){ ?>
                <?=$rwgold4['c_desc'];?>
                <?php } ?>
            </div>

            <div class="founder-action-btn mt-3">
                <a href="<?=$path;?>contact" class="btn-founder-contact">Contact <i class="bi bi-arrow-right"></i></a>
            </div>
	    </div>
	</div>
	<div class="col-md-5 order-1 order-md-2 mb-4 mb-md-0">
	    <div class="school-building-left founder-img-col">
	        <figure class="card-img-wrap founder-fig"><img src="<?=$path.$goldimg4;?>" alt="<?=!empty($rwgold4['section_heading']) ? $rwgold4['section_heading'] : 'Dr. Sonali Kataria Sirohi';?>"/></figure>
	    </div>
	</div>
</div>
</div>
</div>
<?php } ?>

<div class="parents-testimonials">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Testimonials</span>
        <h2 class="sec-main-title"><span>Parents</span> Testimonials</h2>
    </div>
    <div class="testimonials-cards">
        <?php 
        $colors = array(
            'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
            'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
            'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
            'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
            'linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%)',
            'linear-gradient(135deg, #fccb90 0%, #d57eeb 100%)',
            'linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%)'
        );
        $sqltesti=mysqli_query($con,"SELECT * FROM `testimonials` WHERE `status`=1 ORDER BY `order` ASC");
        $i=0;
        while($rwtesti=mysqli_fetch_array($sqltesti)){ 
            $colorIndex = $i % count($colors);
        ?>
        <div class="testimonial-slide-item">
            <div class="testimonial-text-card" style="background:<?=$colors[$colorIndex];?>;">
                <div class="stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p><?=$rwtesti['desc'];?></p>
                <strong><?=$rwtesti['title'];?></strong>
            </div>
        </div>
        <?php $i++; } ?>
    </div>
</div>
</div>

<div class="media-gallery-section">
<div class="container-lg">
    <div class="widgethead text-center">
        <span class="sec-badge">#Gallery</span>
        <h2 class="sec-main-title">Media & Activities</h2>
    </div>
    <?php 

    $gallerycatid = 0;
    $sqlgallerycat = mysqli_query($con, "SELECT `id` FROM `category` WHERE `c_url` = 'gallery' LIMIT 1");
    if(mysqli_num_rows($sqlgallerycat)){
        $rwgallerycat = mysqli_fetch_assoc($sqlgallerycat);
        $gallerycatid = intval($rwgallerycat['id']);
    }
    $sqlmedia = $gallerycatid ? mysqli_query($con, "SELECT * FROM `media` WHERE `cat_id` = $gallerycatid AND `status` = 1 ORDER BY `id` DESC LIMIT 48") : false;
    if($sqlmedia && mysqli_num_rows($sqlmedia)){
    ?>
    <div class="media-gallery-slider" id="lightgallery">
        <?php while($rwmedia=mysqli_fetch_array($sqlmedia)){ ?>
        <div class="media-gallery-item" data-src="<?=$path;?><?=$rwmedia['file'];?>">
            <div class="media-gallery-card">
                <img src="<?=$path;?><?=$rwmedia['file'];?>" alt="Media Gallery">
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
</div>

<?php
$stoptable = mysqli_query($con, "SHOW TABLES LIKE 'toppers'");
if(mysqli_num_rows($stoptable)){
$ssqltoppers=mysqli_query($con,"SELECT * FROM `toppers` WHERE `status`=1 ORDER BY `order` ASC");
if(mysqli_num_rows($ssqltoppers)){
?>
<div class="media-gallery-section">
<div class="container-lg">
    <div class="widgethead" style="text-align:center;">
        <h1>Toppers</h1>
    </div>
    <div class="media-gallery-slider">
        <?php while($rwtoppers=mysqli_fetch_array($ssqltoppers)){ ?>
        <div class="media-gallery-card">
            <img src="<?=$path;?><?=$rwtoppers['file'];?>" alt="<?=$rwtoppers['name'];?>">
            <h4 style="text-align:center;margin-top:8px;font-size:16px;font-weight:600;"><?=$rwtoppers['name'];?></h4>
            <p style="text-align:center;font-size:14px;color:#666;margin-top:2px;"><?=$rwtoppers['subject'];?></p>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php } } ?>

<!--
<div class="widget-points">
<div class="container-lg">
<div class="row">
	<div class="col-md-6">
		<div class="widgethead">
			<span>#About Us</span>
			<h1>Sunrise Learning - Special School NOIDA</h1>
			<h5>“The 21st century Management Education in India” <a href="https://kim.kgimeerut.com/messages/group-advisor" class="bi bi-c-circle" target="_blank"></a> </h5>
		</div>
		<div class="widgetpoint-data">
			<?php $sqlabout=mysqli_query($con,"SELECT * FROM `category` WHERE c_url='about-us'");
$rwabout=mysqli_fetch_array($sqlabout); ?>
			<?=$rwabout['sdesc'];?>
						

			
			<div class="experience">
			    <h3><i class="bi bi-trophy"></i> 15 years of Education Experience.</h3>
			</div>
			<a href="<?=$path;?>about-us/history-of-college">Read More <i class="bi bi-arrow-right-short"></i></a>
		</div>
	</div>
<?php $sqlpoints=mysqli_query($con,"SELECT * FROM `post`");
$rwpoints=mysqli_fetch_array($sqlpoints); ?>
	<div class="col-md-6">
		<div class="widgetboxes">
		<div class="widgetbox">
			<span>Early Intervention (Ages 2-6)</span>
			<p>Equivalent to preschool, focusing on foundational skills, communication, and sensory regulation for young learners.</p>
		</div>
		<div class="widgetbox">
			<span>Special Schooling (Ages 4-16)</span>
			<p>Developmental progress through structured programs and individual educational plans, with emphasis on life skills, functional academics, and open schooling.</p>
		</div>
		<div class="widgetbox">
			<span>Vocational Skill Training (Ages 14-18)</span>
			<p>Exposure to real-life skills in hospitality, retail, IT, arts & crafts, and other areas based on individual interests and strengths.</p>
		</div>
		<div class="widgetbox">
			<span>Employment & Livelihood Readiness (18+)</span>
			<p>Tailored pathways for job readiness, micro-enterprise creation, and supported employment for independence and dignity.</p>
		</div>
		</div>
	</div>
</div>
</div>
-->


<div class="widget-news">
<div class="container-lg">
<div class="row">
	<div class="col-md-12">
		<div class="widgethead d-flex justify-content-between align-items-center">
            <div>
                <span class="sec-badge">#Updates</span>
                <h3 class="sec-main-title mb-0">News & Events</h3>
            </div>
			<a href="<?=$path;?>news" class="viewall">View All <i class="bi bi-arrow-right-short"></i></a>
		</div>
	</div>
</div>
<div class="row widget-news-row">
<?php $sqlnews=mysqli_query($con,"SELECT * FROM `news_events` WHERE `status`=1 ORDER BY `id` DESC LIMIT 0,5");
while($rwnews=mysqli_fetch_array($sqlnews)){ ?>
	<div class="col-md-4">
		<div class="newsbox">
			<figure>
				<?php if(!empty($rwnews['file']) && file_exists($rwnews['file'])){ ?>
				<img src="<?=$path;?><?=$rwnews['file'];?>" alt="<?=$rwnews['title'];?>">
				<?php } else { ?>
				<img src="<?=$path;?>images/logo.jpg" alt="<?=$rwnews['title'];?>">
				<?php } ?>
			</figure>
			<a href="<?=$path;?>admission" class="heading"><?=$rwnews['title'];?></a>
		</div>
	</div>
<?php } ?>	
</div>
</div>
</div>






<div class="widget-notice">
<div class="container-lg">
<div class="row">

<div class="col-md-6">
	<div class="widgethead">
		<h3>Notice</h3>
		<!-- <a href="<?=$path;?>notice">View All <i class="bi bi-arrow-right-short"></i></a> -->
	</div>
	<ul class="widgetcontent">
<?php $sqlnews=mysqli_query($con,"SELECT * FROM `notice` WHERE `status`=1 ORDER BY `order` ASC");
while($rwnews=mysqli_fetch_array($sqlnews)){ ?>		
		<li class="list">
			<h4><?=$rwnews['title'];?></h4>
			<?php //$path.$rwnews['file'];?>
			<a href="<?=$path.$rwnews['file'];?>" target="_blank">Read More </a>
		</li>
<?php } ?>
	</ul>
</div>

<div class="col-md-6">
	<div class="widgethead">
		<h3>Announcements</h3>
	</div>
	<div class="widgetcontent announceslider">
<?php $sqlannounce=mysqli_query($con,"SELECT * FROM `announce` WHERE `status`=1 ORDER BY `order` ASC");
while($rwannounce=mysqli_fetch_array($sqlannounce)){ ?>
		<a href="<?=$path;?>announcements">
			<img src="<?=$path.$rwannounce['file'];?>" alt="Announce">
		</a>
<?php } ?>		
	</div>

</div>

</div>
</div>
</div>


<!--<div class="widget-campustour pb-0">-->
<!--<div class="container-fluid">-->
<!--<div class="row">-->

<!--<div class="col-md-12 p-0">-->
<!--	<div class="widgethead">-->
<!--		<h3>KGI Campus Tour</h3>-->
<!--	</div>-->
<!--	<div class="widgetcontent">-->
<!--		<iframe src="https://www.youtube.com/embed/<?=$youtubeembedcode;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>-->
<!--	</div>-->
<!--</div>-->

<!--</div>-->
<!--</div>-->
<!--</div>-->





<!--<div class="widget-placements">-->
<!--<div class="container-lg">-->
<!--<div class="row">-->
<!--	<div class="col-md-12">-->
<!--		<div class="widgethead">-->
<!--			<h3>Incredibly Outstanding Placements</h3>-->
<!--		</div>-->
<!--	</div>-->
<?php // $sqlplacements=mysqli_query($con,"SELECT * FROM `toppers` WHERE `status`=1 ORDER BY `order` ASC");
// while($rwplacements=mysqli_fetch_array($sqlplacements)){ ?>	
	<!--<div class="col-lg-4 col-md-6 col-sm-6 placementbox">-->
	<!--	<figure><img src="<?=$path.$rwplacements['file'];?>" alt="<?=$rwplacements['name'];?>"></figure>-->
	<!--	<span>Congratulations</span>-->
	<!--	<h3><?=$rwplacements['name'];?></h3>-->
	<!--	<p><?=$rwplacements['subject'];?></p>-->
	<!--</div>-->
<?php // } ?>
<!--</div>-->
<!--</div>-->
<!--</div>-->


<div class="widget-association">
<div class="container-lg">
<div class="row">
	<div class="col-md-12">
		<div class="widgethead">
			<h3>Our Associations</h3>
		</div>
	</div>
</div>
<div class="association-img">
<?php $sqlasso=mysqli_query($con,"SELECT * FROM `associations` WHERE `status`=1 ORDER BY `order` ASC");
while($rwasso=mysqli_fetch_array($sqlasso)){ ?>
	<div>
	<figure>
		<img src="<?=$path.$rwasso['file'];?>" alt="<?=$rwasso['order'];?>">
	</figure>
	</div>
<?php } ?>	

</div>
</div>
</div>


