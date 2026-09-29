<?php include 'config.php';
$title = 'Dashboard';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager/index.php'</script>";
}
include 'include/header.php';
include 'include/sidebar.php';
?>


<section class="main-dashboard">
<div class="container-fluid">
<div class="row">
	
<div class="col-md-12">
	<div class="page-title">
		<div class="title">
			<h3>Dashboard</h3>
			<span><?php echo $_SESSION['username']; ?></span>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
<div class="row">
	<div class="col-md-3">
		<a href="<?=$path;?>manager/banner.php" class="dashboard-box">
			<p>Banners</p>
			<i class="pe-7s-photo"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/gallery.php" class="dashboard-box">
			<p>Gallery</p>
			<i class="pe-7s-photo-gallery"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/staff.php" class="dashboard-box">
			<p>Staff</p>
			<i class="pe-7s-users"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/news-events.php" class="dashboard-box">
			<p>News & Events</p>
			<i class="pe-7s-news-paper"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/curriculum.php" class="dashboard-box">
			<p>Curriculum</p>
			<i class="pe-7s-note2"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/testimonials.php" class="dashboard-box">
			<p>Testimonials</p>
			<i class="pe-7s-like2"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/toppers.php" class="dashboard-box">
			<p>Toppers</p>
			<i class="pe-7s-like2"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/enquiry.php" class="dashboard-box">
			<p>Enquiry</p>
			<i class="pe-7s-add-user"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/enquiryforvacancies.php" class="dashboard-box">
			<p>Enquiry For Vacancy</p>
			<i class="pe-7s-study"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/contact.php" class="dashboard-box">
			<p>Contact</p>
			<i class="pe-7s-id"></i>
		</a>
	</div>
	<div class="col-md-3">
		<a href="<?=$path;?>manager/editsettings.php" class="dashboard-box">
			<p>Settings</p>
			<i class="pe-7s-settings"></i>
		</a>
	</div>	
</div>
</div>
</div>

</div>
</div>
</section>


<?php include 'include/footer.php';	 ?>