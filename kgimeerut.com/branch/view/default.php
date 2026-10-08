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

<div class="moving-text">
<span class="whatsnew">What's New</span>
<marquee onmouseover="(this.stop());" onmouseout="(this.start());">
<a href=''>Welcome To Krishna Group Of Institutions| KGI</a>
<a href=''>Admissions are Open For M.B.A ( Eligibility &amp; Admission Procedure &amp; Syllabus )</a>
<a href=''>Admissions are Open For B.ED ( Eligibility &amp; Admission Procedure &amp; Syllabus )</a>
<a href=''>Admissions are Open For B.B.A ( Eligibility &amp; Admission Procedure &amp; Syllabus )</a>
<a href=''>Admissions are Open For D.EI.ED ( Eligibility &amp; Admission Procedure &amp; Syllabus )</a>
<a href=''>Admissions are Open For D.Pharma ( Eligibility &amp; Admission Procedure &amp; Syllabus )</a>
<a href=''>Apply For Admission</a>
<a href=''>Krishna Group Of Institutions Recruiters</a>
<a href=''>Krishna Group Of Institutions Rules&amp;Regulations</a>
</marquee>
</div>
<div class="recruiters">
    <a href="javascript:">
        <img src="<?=$path;?>branch/images/logo/r1.png" alt="1">
    </a>
    <a href="https://aktu.ac.in/" target="_blank">
        <img src="<?=$path;?>branch/images/logo/r2.png" alt="2">
    </a>
    <a href="https://www.ccsuniversity.ac.in/" target="_blank">
        <img src="<?=$path;?>branch/images/logo/r3.png" alt="3">
    </a>
    <a href="javascript:">
        <img src="<?=$path;?>branch/images/logo/r4.png" alt="4">
    </a>
    <a href="javascript:">
        <img src="<?=$path;?>branch/images/logo/r5.png" alt="5">
    </a>
    <a href="http://www.spaaindia.in/" target="_blank">
        <img src="<?=$path;?>branch/images/logo/spaaindia.png" alt="6">
    </a>
</div>


<div class="goldmedalist">
<div class="container-lg">
<div class="row">
	<div class="col-md-6">
	    <div class="goldmedalist-left">
	        <figure><img src="<?=$path;?>branch/images/medalist/medalist1.webp"/></figure>
	        <figure><img src="<?=$path;?>branch/images/medalist/medalist2.webp"/></figure>
	        <figure><img src="<?=$path;?>branch/images/medalist/medalist3.webp"/></figure>
	    </div>
	</div>
	<div class="col-md-6">
	    <div class="goldmedalist-right">
	        <h3>#KGI Gold Medalist</h3>
	        <strong>Sanjana Chaudhary, a brilliant postgraduate student from Krishna Group of Institutions, has been awarded the prestigious Gold Medal by Her Excellency Honorable Governor Smt Aanandiben of Uttar Pradesh, India!</strong>
            <p>This achievement is a testament to Sanjana's hard work, dedication, and academic excellence. Krishna Group of Institutions takes pride in nurturing talented students like Sanjana, who consistently strive for excellence.</p>
            <span>Congratulations to Sanjana Chaudhary on this remarkable achievement!</span>
	    </div>
	</div>
</div>
</div>
</div>

<div class="creativitysection">
    <div class="container">
        <div class="row">
            <div class="widgethead">
    			<h3>Creativity by Faculty</h3>
    		</div>
        </div>
        <div class="row creativityslider" id="lightgallery">
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg1.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg1.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg2.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg2.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg3.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg3.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg4.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg4.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg5.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg5.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
            <div class="creativitybox" data-src="<?=$path;?>branch/images/creativityimg6.webp">
                <a href="javascript:" class="galimg">
                    <div class="creativityimg">
                        <img src="<?=$path;?>branch/images/creativityimg6.webp" alt="Creativity Image">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="widget-points">
<div class="container-lg">
<div class="row">
	<div class="col-md-6">
		<div class="widgethead">
			<span>#About Us</span>
			<h1>KGI Meerut - Krishna Group of Institutions | Krishna Institute</h1>
			<h5>“The 21st century Management Education in India” <a href="https://kim.kgimeerut.com/messages/group-advisor" class="bi bi-c-circle" target="_blank"></a> </h5>
		</div>
		<div class="widgetpoint-data">
<?php $sqlabout=mysqli_query($con,"SELECT * FROM `category` WHERE `c_url`='about-us'");
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
			<span>360-Degree Development</span>
			<p>KGI Meerut offers a holistic approach to education, focusing on overall personality development, cultural values, and employability skills.</p>
		</div>
		<div class="widgetbox">
			<span>Rural Empowerment and Corporate Readiness</span>
			<p>KGI Meerut bridges the gap between rural upbringing and corporate expectations, transforming students into confident, employable, and corporate-ready individuals.</p>
		</div>
		<div class="widgetbox">
			<span>Affordable Quality Education</span>
			<p>KGI Meerut provides high-quality education at an affordable cost, making it an attractive option for students from all backgrounds.</p>
		</div>
		<div class="widgetbox">
			<span>Strong Industry Connect and Placement Support</span>
			<p>KGI Meerut has strong ties with the industry, ensuring students receive hands-on training, internships, and placement opportunities in top companies.</p>
		</div>
		</div>
	</div>
</div>
</div>
</div>



<div class="widget-news">
<div class="container-lg">
<div class="row">
	<div class="col-md-12">
		<div class="widgethead">
			<h3>News & Events</h3>
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
				<img src="<?=$path;?>branch/images/logo/access.webp" alt="<?=$rwnews['title'];?>">
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
			<a href="javascript:" target="_blank">Read More </a>
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


