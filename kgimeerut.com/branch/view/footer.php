<footer>
<div class="container-lg">
	<div class="row">
		
		<div class="col-md-3 footercol">
			<figure class="footerlogo"><img src="<?=$path;?>branch/images/logo/white-logo.png" alt="Footer Logo"></figure>
			<?php $sqlaboutfooter=mysqli_query($con,"SELECT * FROM `category` WHERE `c_url`='about-us'");
            $rwaboutfooter=mysqli_fetch_array($sqlaboutfooter); ?>
			<?=$rwaboutfooter['sdesc'];?>

			<div class="socialmedia">             
	            <?php if(!empty($facebook)){ ?>
	            <a href="<?=$facebook;?>" class="sociallinks ri-facebook-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($instagram)){ ?>
	            <a href="<?=$instagram;?>" class="sociallinks ri-instagram-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($youtube)){ ?>
	            <a href="<?=$youtube;?>" class="sociallinks ri-youtube-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($linkedin)){ ?>
	            <a href="<?=$linkedin;?>" class="sociallinks ri-linkedin-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($twitter)){ ?>
	            <a href="<?=$twitter;?>" class="sociallinks ri-twitter-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($pinterest)){ ?>
	            <a href="<?=$pinterest;?>" class="sociallinks ri-pinterest-line" target="_blank"></a>
	            <?php } ?>
	        </div>
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="getintouch">
				<h4 class="footercoltitle">Get In Touch</h4>

				<ul>
					<li><p>Address : </p> <?=$address;?></li>
					<li><p>Phone : </p> +<?=$contactno;?></li>
					<li><p>Email : </p> <?=$emailid;?></li>
					<li><p>Admission Email : </p> <?=$alternateemailid;?></li>
				</ul>
			</div>
			<div class="tour footerbox">
				<h4 class="footercoltitle">Students</h4>
				<ul>
				<?php $sqlstud=mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`=5 AND `status`=1 ORDER BY `order` ASC");
				while($rwstud=mysqli_fetch_array($sqlstud)){ ?>
					<li><a href="<?=$path.'students/'.$rwstud['sc_url'];?>"><?=$rwstud['sc_name'];?></a></li>
				<?php } ?>	
				<li><a href="<?=$path;?>jobs">Student Job Portal</a></li>
				</ul>
			</div>
			<div class="tour footerbox">
				<h4 class="footercoltitle">Employee</h4>
				<ul>
					<li><a href="https://kgimeerut.com:2096" target="_blank">Employee Login</a></li>
				</ul>
			</div>			
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="footerbox learnhear">
				<h4 class="footercoltitle">Courses</h4>
				<ul>
				<?php $sqlcourse=mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`=3 AND `status`=1 ORDER BY `order` ASC");
				while($rwcourse=mysqli_fetch_array($sqlcourse)){ ?>
					<li><a href="<?=$path.'courses/'.$rwcourse['sc_url'];?>"><?=$rwcourse['sc_name'];?></a></li>
				<?php } ?>
				</ul>
			</div>
			<div class="tour footerbox">
				<h4 class="footercoltitle">Placements</h4>
				<ul>
				<?php $sqlplace=mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`=4 AND `status`=1 ORDER BY `order` ASC");
				while($rwplace=mysqli_fetch_array($sqlplace)){ ?>
					<li><a href="<?=$path.'placements/'.$rwplace['sc_url'];?>"><?=$rwplace['sc_name'];?></a></li>
				<?php } ?>				
				</ul>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="footerbox knowmore">
				<h4 class="footercoltitle">About Us</h4>
				<ul>
				<?php $sqlabout=mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`=1 AND `status`=1 ORDER BY `order` ASC");
				while($rwabout=mysqli_fetch_array($sqlabout)){ ?>
					<li><a href="<?=$path.'about-us/'.$rwabout['sc_url'];?>"><?=$rwabout['sc_name'];?></a></li>
				<?php } ?>
				</ul>
			</div>

			<div class="footerbox visithear">
				<h4 class="footercoltitle">Academic</h4>
				<ul>
				<?php $sqlacademic=mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`=18 AND `status`=1 ORDER BY `order` ASC");
				while($rwacademic=mysqli_fetch_array($sqlacademic)){ ?>
					<li><a href="<?=$path.'academic/'.$rwacademic['sc_url'];?>"><?=$rwacademic['sc_name'];?></a></li>
				<?php } ?>
				<li><a href="<?=$path;?>complains-suggestions">Complains & Suggestions</a></li>
				</ul>
			</div>
		</div>

	</div>
</div>
<div class="copyright">
	<p>© 2024 | <?=$websitename;?> | Website Conceptualised and Developed by <a href="https://www.promotionparadise.in" target="_blank">Promotion Paradise</a></p>
</div>
</footer>
    <div class="jobbtn">
        <a href="<?=$path;?>jobs">
                Student Job Portal
            </a>    
    </div>
    <div class="visitcount">
    <p>Visit User: <span id="visit-count"><?php echo $count;?></span></p>
    </div>