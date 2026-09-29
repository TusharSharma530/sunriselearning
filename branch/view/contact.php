<?php
$settings = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings LIMIT 1"));
?>
<div class="contact" style="padding-bottom:0;">
<div class="container-lg">
<div class="row">

	<div class="col-md-9">
		<div class="contactleft">
			<div class="contactleft-title">
				<h2>Get in Touch</h2>
				<p>If you have query regarding admission, programs, therapies, or any other information, you can contact us on the following address. You can drop a mail or call us. We will be happy to assist you in best possible way.</p>
			</div>
			<form method="POST" class="row contactform">
				<div class="col-md-6">
					<div class="fields">
						<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fields">
						<input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fields">
						<input type="email" name="email" id="email" class="form-control" placeholder="Email ID" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="fields">
						<textarea name="message" id="" class="form-control" placeholder="Message"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="fields-btn">						
						<input type="submit" name="contactfrm" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contactright">
			<div class="rightbox address">
				<h5><i class="bi bi-house"></i> Address</h5>
				<a href="javascript:"><?=$settings['address'];?></a>
			</div>
			<div class="rightbox contact">
				<h5><i class="bi bi-telephone"></i> Contact No.</h5>
				<a href="tel:<?=$settings['contact_no'];?>"> <?=$settings['contact_no'];?></a>
				<?php if(!empty($settings['alternate_no'])){ ?>
				<a href="tel:<?=$settings['alternate_no'];?>"> <?=$settings['alternate_no'];?></a>
				<?php } ?>
			</div>
			<div class="rightbox email">
				<h5><i class="bi bi-envelope"></i> Email ID</h5>
				<a href="mailto:<?=$settings['email_id'];?>"> <?=$settings['email_id'];?></a>
				<?php if(!empty($settings['alternate_email_id'])){ ?>
				<a href="mailto:<?=$settings['alternate_email_id'];?>"> <?=$settings['alternate_email_id'];?></a>
				<?php } ?>
			</div>
		</div>		
	</div>

</div>
</div>
</div>
<?php
$map = $settings['map_iframe'];
$map = str_replace('style="border:0;"', 'style="border:0;width:100%;height:450px;"', $map);
$map = preg_replace('/width="[^"]*"/', 'width="100%"', $map);
$map = preg_replace('/height="[^"]*"/', 'height="450"', $map);
?>
<div style="margin:10px 0 0;padding:0;overflow:hidden;width:100%;height:450px;">
	<?=$map;?>
</div>
