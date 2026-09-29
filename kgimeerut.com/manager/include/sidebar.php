<aside class="sidebar-menu-dashboard">
<!-- logo and toggle btn start here -->
<div class="logo-n-toggle">
	<a href="dashboard.php"><?=$websitename;?></a>		
</div>
<!-- logo and toggle btn end here -->

<!-- dashborad menu start here -->
<nav class="menu">
<ul class="aside-menu">
<li class="menu-item ">
	<a href="dashboard.php" class="menu-link">							
	<span class="link-text"><i class="ri-dashboard-line"></i> Dashboard</span>
	</a>
</li>

<li class="menu-item has-submenu">
	<a href="javascript:" class="menu-link" id="parent-menu">
	<span class="link-text"><i class="ri-list-check"></i>Category</span>
	<i class='bx bx-chevron-down'></i>
	</a>
<!-- sub menu start here -->
<div class="submenu" id="child-menu">
<ul class="submenu-list">
<li class="submenu-item">
<a href="category.php" class="submenu-link">Category</a>
</li>
<li class="submenu-item">
<a href="sub-category.php" class="submenu-link">Sub Category</a>
</li>
<li class="submenu-item">
<a href="childcategory.php" class="submenu-link">Child Category</a>
</li>
</ul>
</div>
<!-- sub menu end here -->
</li>
<li class="menu-item ">
	<a href="advisoryboard.php" class="menu-link">							
	<span class="link-text"><i class="ri-group-line"></i> Advisory Board</span>
	</a>
</li>
<li class="menu-item ">
	<a href="jobs.php" class="menu-link">							
	<span class="link-text"><i class="ri-group-line"></i> Jobs</span>
	</a>
</li>
<li class="menu-item has-submenu">
<a href="javascript:" class="menu-link orders" id="parent-menu">
							
<span class="link-text"><i class="ri-gallery-view"></i> Banners</span>

<i class='bx bx-chevron-down'></i>
</a>
<!-- sub menu start here -->
<div class="submenu orders" id="child-menu">
<ul class="submenu-list">
<li class="submenu-item">
<a href="banner.php" class="submenu-link">Banner</a>
</li>
</ul>
</div>
<!-- sub menu end here -->
</li>


<li class="menu-item has-submenu">
<a href="javascript:" class="menu-link" id="parent-menu">
<div>							
<span class="link-text"><i class="ri-list-check-2"></i> Widget</span>
</div>
<i class='bx bx-chevron-down'></i>
</a>

<div class="submenu" id="child-menu">
<ul class="submenu-list">
<li class="submenu-item">
<a href="blogs.php" class="submenu-link">Blogs</a>
</li>
<li class="submenu-item">
<a href="curriculum.php" class="submenu-link">Curriculum</a>
</li>
<li class="submenu-item">
<a href="courses.php" class="submenu-link">Courses</a>
</li>
<li class="submenu-item">
<a href="news-events.php" class="submenu-link">News & Events</a>
</li>
<li class="submenu-item">
<a href="addgalleryimages.php" class="submenu-link">Gallery</a>
</li>
<li class="submenu-item">
<a href="addmedia.php" class="submenu-link">Media</a>
</li>
<li class="submenu-item">
<a href="syllabus.php" class="submenu-link">Syllabus</a>
</li>
<li class="submenu-item">
<a href="addactivities.php" class="submenu-link">Activities</a>
</li>
<li class="submenu-item">
<a href="youtube.php" class="submenu-link">Youtube Video</a>
</li>
<li class="submenu-item">
<a href="associations.php" class="submenu-link">Associations</a>
</li>
<li class="submenu-item">
<a href="notice.php" class="submenu-link">Notice</a>
</li>
<li class="submenu-item">
<a href="announce.php" class="submenu-link">Announce</a>
</li>
<li class="submenu-item">
<a href="quickaccess.php" class="submenu-link">Quick Access</a>
</li>
<!--
<li class="submenu-item">
<a href="teams.php" class="submenu-link">Our Team</a>
</li>
<li class="submenu-item">
<a href="students.php" class="submenu-link">Students</a>
</li>
 <li class="submenu-item">
<a href="blogs.php" class="submenu-link">News & Events</a>
</li> -->
<li class="submenu-item">
<a href="testimonials.php" class="submenu-link">Testimonials</a>
</li> 
<li class="submenu-item">
<a href="toppers.php" class="submenu-link">Toppers</a>
</li>
</ul>
</div>
</li>

<li class="menu-item has-submenu">
<a href="javascript:" class="menu-link orders" id="parent-menu">
<div>							
<span class="link-text"><i class="ri-contacts-book-2-line"></i> Contacts</span>
</div>
<i class='bx bx-chevron-down'></i>
</a>
<!-- sub menu start here -->
<div class="submenu orders" id="child-menu">
<ul class="submenu-list">
<li class="submenu-item">
<a href="contact.php" class="submenu-link">Contact</a>
</li>
<li class="submenu-item">
<a href="enquiry.php" class="submenu-link">Enquiry</a>
</li>
<li class="submenu-item">
<a href="enquiryforvacancies.php" class="submenu-link">Enquiry 4 Vacancy</a>
</li>
</ul>
</div>
<!-- sub menu end here -->
</li>


<li class="menu-item has-submenu">
<a href="javascript:" class="menu-link orders" id="parent-menu">
<div>							
<span class="link-text"><i class="ri-settings-2-line"></i> Settings</span>
</div>
<i class='bx bx-chevron-down'></i>
</a>
<!-- sub menu start here -->
<div class="submenu orders" id="child-menu">
<ul class="submenu-list">
<li class="submenu-item">
<a href="editsettings.php" class="submenu-link">Setting</a>
</li>
<li class="submenu-item">
<a href="changepassowrd.php" class="submenu-link">Change Password</a>
</li>
</ul>
</div>
<!-- sub menu end here -->
</li>

</ul>
</nav>
<!-- dashborad menu end here -->
<a href="logout.php" class="logout-fixed"><i class="ri-logout-box-line"></i> Logout</a>
</aside>