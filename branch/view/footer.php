<footer>
<div class="container-lg">
	<div class="row">
		
		<div class="col-md-3 footercol">
			<figure class="footerlogo"><img src="<?=$path.$logo;?>" alt="Footer Logo" style="width:180px;border-radius:5px;"></figure>
			<p style="margin-top:15px;font-size:14px;color:#ddd;line-height:1.7;"><?=$footerdesc;?></p>

			<div class="socialmedia" style="margin-top:15px;">             
	            <?php if(!empty($facebook)){ ?>
	            <a href="<?=$facebook;?>" class="sociallinks ri-facebook-fill" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($instagram)){ ?>
	            <a href="<?=$instagram;?>" class="sociallinks ri-instagram-line" target="_blank"></a>
	            <?php } ?>
	            <?php if(!empty($youtube)){ ?>
	            <a href="<?=$youtube;?>" class="sociallinks ri-youtube-fill" target="_blank"></a>
	            <?php } ?>
	        </div>
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="footerbox">
				<h4 class="footercoltitle" style="color:#b388d9;font-weight:700;text-transform:uppercase;">Program</h4>
				<ul style="list-style:none;padding:0;">
					<li style="margin-bottom:10px;"><a href="<?=$path;?>latest-achievement" style="color:#ddd;text-decoration:none;font-size:15px;">Latest Achievements</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>parent-training" style="color:#ddd;text-decoration:none;font-size:15px;">Parent Training</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>admission" style="color:#ddd;text-decoration:none;font-size:15px;">Admissions</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>online-courses" style="color:#ddd;text-decoration:none;font-size:15px;">Online Courses</a></li>
				</ul>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="footerbox">
				<h4 class="footercoltitle" style="color:#b388d9;font-weight:700;text-transform:uppercase;">Links</h4>
				<ul style="list-style:none;padding:0;">
					<li style="margin-bottom:10px;"><a href="<?=$path;?>about-us" style="color:#ddd;text-decoration:none;font-size:15px;">About Us</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>contact" style="color:#ddd;text-decoration:none;font-size:15px;">Contact</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>admission" style="color:#ddd;text-decoration:none;font-size:15px;">Admission</a></li>
					<li style="margin-bottom:10px;"><a href="<?=$path;?>gallery" style="color:#ddd;text-decoration:none;font-size:15px;">Gallery</a></li>
				</ul>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 footercol">
			<div class="footerbox">
				<h4 class="footercoltitle" style="color:#b388d9;font-weight:700;text-transform:uppercase;">Office</h4>
				<div style="font-size:15px;color:#ddd;line-height:1.8;">
					<p style="margin-bottom:15px;"><?=$address;?></p>
					<?php if(!empty($emailid)){ ?>
					<p style="margin-bottom:10px;"><span style="color:#b388d9;margin-right:8px;"><i class="bi bi-envelope"></i></span><?=$emailid;?></p>
					<?php } ?>
					<?php if(!empty($alternateemailid)){ ?>
					<p style="margin-bottom:10px;"><span style="color:#b388d9;margin-right:8px;"><i class="bi bi-envelope"></i></span><?=$alternateemailid;?></p>
					<?php } ?>
					<?php if(!empty($contactno)){ ?>
					<p style="margin-bottom:10px;"><span style="color:#b388d9;margin-right:8px;"><i class="bi bi-telephone"></i></span><?=$contactno;?></p>
					<?php } ?>
					<?php if(!empty($alternateno)){ ?>
					<p style="margin-bottom:15px;"><span style="color:#b388d9;margin-right:8px;"><i class="bi bi-telephone"></i></span><?=$alternateno;?></p>
					<?php } ?>
					<p style="font-weight:700;font-size:16px;color:#fff;"><?=$websitename;?></p>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="copyright">
    <p>
        &copy; 2024 |
        <?=$websitename;?> |
        Managed by
        <a href="https://promotionparadise.in/" target="_blank" rel="noopener noreferrer">
            Promotion Paradise
        </a>
    </p>
</div>

</footer>
    <!--
    <div class="jobbtn">
        <a href="<?=$path;?>jobs">
                Student Job Portal
            </a>    
    </div>
    -->
    <!--
    <div class="visitcount">
    <p>Visit User: <span id="visit-count"><?php echo $count;?></span></p>
    </div>
    -->
