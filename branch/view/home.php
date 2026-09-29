<?php include("manager/database/db.php"); 
$url = explode("/", $_GET['type']);
$gettype = $url[0];
$geturl = $url[1] ?? "";
$geturl1 = $url[2] ?? "";

if($geturl=='b-ed-course-in-meerut-become-a-certified-teacher'){
    echo "<script>window.location.href='{$path}blogs/b-ed-course-in-meerut'</script>";
    exit();
}
if($geturl=='bba-course-in-meerut-elevate-your-business-education'){
    echo "<script>window.location.href='{$path}blogs/bba-course-in-meerut'</script>";
    exit();
}
if($geturl=='bca-course-in-meerut-for-a-successful-it-career'){
    echo "<script>window.location.href='{$path}blogs/bca-course-in-meerut'</script>";
    exit();
}
if($geturl=='b-sc-agriculture-in-meerut-top-college-courses'){
    echo "<script>window.location.href='{$path}blogs/b-sc-agriculture-in-meerut'</script>";
    exit();
}
if($geturl=='d-pharma-course-in-meerut-become-a-pharmacist'){
    echo "<script>window.location.href='{$path}blogs/d-pharma-course-in-meerut'</script>";
    exit();
}
if($geturl=='mba-degree-course-in-meerut-advance-your-career'){
    echo "<script>window.location.href='{$path}blogs/mba-degree-course-in-meerut'</script>";
    exit();
}
if($geturl=='b-sc-agriculture-in-meerut'){
    echo "<script>window.location.href='{$path}blogs/b-sc-agriculture-course-in-meerut'</script>";
    exit();
}


// Admission - normal category page (same as other menus)
// if($gettype=='admission'){
//     if(empty($geturl)){
//         include("controller/__admission.php");
//         include("branch/view/admission.php");
//     }else{
//         echo "<script>window.location.href='{$path}admission'</script>";
//     }
//     exit();
// }

if($gettype=='complains-suggestions'){
    if(empty($geturl)){
        include("controller/__complains-suggestions.php");
        include("branch/view/complains-suggestions.php");
    }else{
        echo "<script>window.location.href='{$path}complains-suggestions'</script>";
    }
    exit();
}

if($gettype=='apply'){
    if(empty($geturl)){
        include("controller/__apply.php");
        include("branch/view/apply.php");
    }else{
        echo "<script>window.location.href='{$path}apply'</script>";
    }
    exit();
}


$sqlcat = mysqli_query($con, "SELECT * FROM `category` WHERE `c_url`  = '$gettype' AND `status` = 1");
if(mysqli_num_rows($sqlcat)){
$rwcat = mysqli_fetch_array($sqlcat);
$catid = $rwcat['id'];
$caturl = $rwcat['c_url'];
$cattitle = $rwcat['c_name'];
$metatitle = empty($rwcat['meta_title']) ? $rwcat['c_name'] : $rwcat['meta_title'];
$metakeywords = $rwcat['meta_keywords'];
$metadesc = $rwcat['meta_desc'];
$breadcrumbtitle = $cattitle;
$breadcrumblist = "<li><span>$breadcrumbtitle</span></li>";
$data = $rwcat['c_desc'];
}

$sqlsubcat = mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `sc_url`  = '$geturl'");
if(mysqli_num_rows($sqlsubcat)){
$rwsubcat = mysqli_fetch_array($sqlsubcat);
$subid = $rwsubcat['id'];
$subtitle = $rwsubcat['sc_name'];
$suburl = $rwsubcat['sc_url'];
$metatitle = empty($rwsubcat['meta_title']) ? $rwsubcat['sc_name'] : $rwsubcat['meta_title'];
$metakeywords = $rwsubcat['meta_keywords'];
$metadesc = $rwsubcat['meta_desc'];
$breadcrumbtitle = $subtitle;
$breadcrumblist = "<li><a href='{$path}{$caturl}'>$cattitle</a></li><li><span>$breadcrumbtitle</span></li>";
$data = $rwsubcat['sc_desc'];
}
if(isset($subid)){
    $web = "AND `subcat_id` = $subid";
}

$sqlchildcat = mysqli_query($con, "SELECT * FROM `childcategory` WHERE `url`  = '$geturl1' AND `status` = 1 $web");
if(mysqli_num_rows($sqlchildcat)){
$rwchildcat = mysqli_fetch_array($sqlchildcat);
$childid = $rwchildcat['id'];
$childtitle = $rwchildcat['childcat'];
$childurl = $rwchildcat['url'];
$metatitle = empty($rwchildcat['meta_title']) ? $rwchildcat['childcat'] : $rwchildcat['meta_title'];
$metakeywords = $rwchildcat['meta_keywords'];
$metadesc = $rwchildcat['meta_desc'];
$breadcrumbtitle = $rwchildcat['childcat'];
$breadcrumblist = "<li><a href='{$path}{$caturl}'>$cattitle</a></li><li><a href='{$path}{$caturl}/{$suburl}'>$subtitle</a></li><li><span>$childtitle</span></li>";
$data = $rwchildcat['cdesc'];
}

if($gettype=='manager'){
    echo "<script>window.location.href='{$path}manager/index.php'</script>";
}

$counterquery = mysqli_query($con, "SELECT * FROM counter WHERE id=1");
$counterqueryrow = mysqli_fetch_assoc($counterquery);
$count = $counterqueryrow['count'];
$count = $count + 1;
$countersql = "UPDATE counter SET count = $count WHERE id = 1";
mysqli_query($con, $countersql);

if(file_exists("controller/__$gettype.php")){
    include("controller/__$gettype.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$metatitle;?></title>
<meta name="keywords" content="<?=$metakeywords;?>">
<meta name="description" content="<?=$metadesc;?>">
<meta name="author" content="<?=$websitename;?>">
<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
<link rel="canonical" href="<?=$actual_link;?>">
<link rel="icon" type="image/jpeg" href="<?=$path;?>branch/assets/logo/logoImg1787999510.jpg?v=2">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- ========== Light Gallery CDN Link ========= -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css"/>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery-bundle.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
<!-- ========== Slick Slider CSS CDN Link ========= -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
<!-- ========== Bootstrap CDN Link ========= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$path;?>branch/css/style.css">
<link rel="stylesheet" href="<?=$path;?>branch/css/responsive.css">
<?=$googletag;?>


<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "LocalBusiness",
  "name": "Krishna Institute",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Km. Milestone, 11, Mawana Rd, Bana, Meerut, Uttar Pradesh 250001",
    "addressLocality": "Meerut",
    "postalCode": "250001",
    "addressCountry": "IN"
  },
  "telephone": "+91-9557777501",
  "url": "https://kgimeerut.com",
  "openingHours": "Mo-Sa 09:00-17:00"
}
</script>

</head>
<body>
<header>
<div class="topheader">
<div class="container-fluid">
<div class="row">
         
<div class="col-md-12">
    <ul class="topmenu">
<?php $sqltopmenu = mysqli_query($con, "SELECT * FROM `category` WHERE `status` = 1 AND `c_type` = 2 ORDER BY `order` ASC");
if(mysqli_num_rows($sqltopmenu)){
while($rwtopmenu = mysqli_fetch_array($sqltopmenu)){ ?>
        <li><a href='<?=$path.$rwtopmenu['c_url'];?>'><?=$rwtopmenu['c_name'];?></a></li>
<?php } } ?>
    </ul>
</div>

</div>
</div>
</div>




<div class="centerheader">
<div class="container-lg">
<div class="row">
    <div class="col-lg-4 col-md-6 col-10">
        <div class="weblogo">
            <a href="<?=$path;?>" class="centerheaderlogo"><img src="<?=$path.$logo;?>" alt="<?=$websitename;?>"></a>
        </div>
    </div>
    <div class="col-lg-8 col-md-6  col-2 text-end">
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
        <ul class="centerheader-menu">
            <li class="menu-list"><a href="<?=$path;?>admission" class="menu-anchor">Online Registration 2026-27</a></li>
            <?php $broucherurl = !empty($brochurefile) ? $path.$brochurefile : $path.'branch/images/brochure.pdf'; ?>
            <li class="menu-list"><a href="<?=$broucherurl;?>" class="menu-anchor" target="_blank">Broucher</a></li>
        </ul>
        <div class="mobmenutoggle">
            <a href="javascript:" class="bi bi-list"></a>
        </div>
    </div>
</div>
</div>
</div>
<!--<a href="<?=$path;?>1st-smart-classroom" class="smartclassroom"><img src="<?=$path;?>branch/images/star.png"> 1st Smart Classroom</a>-->
<div class="bottomheader">
<div class="container-lg">
<div class="row">
    <div class="col-md-12">
    <ul class="bottomheadermenu">
        <a href="javascript:" class="mobmenuclose bi bi-x-lg"></a>
        <li class="menu-list home1"><a href="<?=$path;?>" class="menu-anchor bi bi-house"></a></li>
        <li class="menu-list menutitle">Menu</li>
        <li class="menu-list home2"><a href="<?=$path;?>" class="menu-anchor">Home</a></li>
<?php $sqlmenu = mysqli_query($con, "SELECT * FROM `category` WHERE `status` = 1 AND `c_type` = 1 ORDER BY `order` ASC");
if(mysqli_num_rows($sqlmenu)){
$menu = "";
while($rwmenu = mysqli_fetch_array($sqlmenu)){
    $menuid = $rwmenu['id'];
    $menuurl = $path.$rwmenu['c_url'];
    $menuicon = "";
    $submenu = "";
    // SUBCATEGORY START 
        $sqlsubmenu = mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id` = $menuid AND `status` = 1 ORDER BY `order` ASC");
        if(mysqli_num_rows($sqlsubmenu)){
            $blank="";
            $menuicon = "<i class='bi bi-chevron-down'></i>";
            $submenu = "<ul class='submenu'><li class='sublist menutitle'><a href='javascript:' class='sublist-back bi bi-arrow-left'></a>{$rwmenu['c_name']}</li>";
            while($rwsubmenu = mysqli_fetch_array($sqlsubmenu)){
                $submenuid = $rwsubmenu['id'];
                if($rwmenu['c_url']=='krishna-institution'){
                    $submenuurl = $rwsubmenu['sc_url'];
                    $blank="target='_blank'";
                }else{
                    $submenuurl = $path.$rwmenu['c_url']."/".$rwsubmenu['sc_url'];
                    $blank="";
                }
                $menuurl = "javascript:";
                $subimg = "";
                $subicon = "";
                $childmenu = "";

                // CHILDCATEGORY START 
                $sqlchildmenu = mysqli_query($con, "SELECT * FROM `childcategory` WHERE `cat_id` = $menuid AND `subcat_id` = $submenuid AND `status` = 1 ORDER BY `order` ASC");
                if(mysqli_num_rows($sqlchildmenu)){
                    $subicon = "<i class='bi bi-chevron-down'></i>";
                    $childmenu .= "<ul class='childmenu_list'>";
                    $submenuurl = "JavaScript:";
                    while($rwchildmenu = mysqli_fetch_array($sqlchildmenu)){
                        $childurl = $path.$rwmenu['c_url']."/".$rwsubmenu['sc_url']."/".$rwchildmenu['url'];
                        $childmenu .= " <li class='mob_child_li'><a href='{$childurl}' class='child_link'>{$rwchildmenu['childcat']}</a></li>";
                    }
                    $childmenu .= "</ul>";
                }

                $submenu .= "<li class='sublist'>
                                <a href='{$submenuurl}' class='sublink' {$blank}><i class='ri-school-line'></i> {$rwsubmenu['sc_name']} {$subicon}</a>
                                {$childmenu}
                            </li>";
            }
            $submenu .= "</ul>";
        }
    

    $menu .= "<li class='menu-list'><a href='{$menuurl}' class='menu-anchor'>{$rwmenu['c_name']} {$menuicon}</a>
    {$submenu}
    </li>";

}
echo $menu;
}
?>
    </ul>
    </div>
</div>
</div>
</div>
</header>

<!--<a href="<?=$path;?>admission" class="admissionopen">Online Registration 2024-25</a>-->

<div class="sidemenu">
    <a href="<?=$path;?>quick-access" class="sidelink">
        <span>Quick Access</span>
        <img src="<?=$path;?>branch/images/icons/quick-access.svg" alt="Quick Access">
    </a>
    <a href="javascript:" class="sidelink">
        <span>Notice</span>
        <img src="<?=$path;?>branch/images/icons/notice.svg" alt="Notice">
    </a>
    <a href="javascript:" class="sidelink">
        <span>+91-8585928038</span>
        <img src="<?=$path;?>branch/images/icons/support.svg" alt="Support">
    </a>
    <a href="javascript:" class="sidelink">
        <span>+91-8585928038</span>
        <img src="<?=$path;?>branch/images/icons/phone.svg" alt="Phone">
    </a>
    <a href="mailto:admission@schoollearning.com" class="sidelink">
        <span>admission@schoollearning.com</span>
        <img src="<?=$path;?>branch/images/icons/email.svg" alt="Email" class="email-icon">
    </a>
</div>  
     
<?php if(empty($gettype)){
include("branch/view/default.php");
}else{
include("branch/view/breadcrumb.php");

if($gettype == 'sl-blog' && !empty($geturl)){
    $sqlblogdetail = mysqli_query($con, "SELECT * FROM `blogs` WHERE `url` = '$geturl' AND `status` = 1");
    if(mysqli_num_rows($sqlblogdetail)){
        $rwblogdetail = mysqli_fetch_assoc($sqlblogdetail);
    }
    include("branch/view/blog-detail.php");
    exit();
}

if(file_exists("branch/view/$gettype.php") && empty($geturl)){
    include("branch/view/$gettype.php");
}else if(file_exists("branch/view/$geturl.php")){
    include("branch/view/$geturl.php");
}else{
    $pagesaray=array('departments', 'courses', 'placements', 'students', 'facilities', 'blogs', 'research-publications');
    if(in_array($gettype, $pagesaray) && $gettype!='blogs'){
?>
<div class="<?=$gettype;?> pagewidget">
<div class="container-lg">
<div class="row">
    <div class="col-md-9">
        <?=$data;?>
    </div>
    <?php if($gettype=='research-publications'){ ?>
    <div class="col-md-3">
        <div class="<?=$gettype;?>right pageright">
            <h4 class="rightitle">Publications</h4>
            <div class="rightlistbox">
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research10.pdf" target='_blank'>
                        <p>Multi-Objective Optimization of Software Testing Using Artificial Intelligence Techniques</p>
                        <span>Author : <br>Amitesh Arya, Aarzu Chaudhary, Laksh Raj, Anshika Chaudhary</span>
                    </a>
                    <a href="<?=$path;?>branch/images/research/research9.pdf" target='_blank'>
                        <p>Economic Impact of Short-Term Horticulture Crops and Agricultural Technologies on Small Farmers</p>
                        <span>Author : <br>Vijay Raj, Aman Chauhan, Abhishek kumar, Prof. Devendra Arora</span>
                    </a>
                    <a href="<?=$path;?>branch/images/research/research8.pdf" target='_blank'>
                        <p>Economic and Employment Impact of the ICC Men's T20 World Cup 2026 (India and Srilanka)</p>
                        <span>Author : <br>Vijay Raj  and Prof Dr Devendra Arora and others</span>
                    </a>
                    <a href="<?=$path;?>branch/images/research/research7.pdf" target='_blank'>
                        <p>Predictive Modeling for Home Loan Default Prediction Using Machine Learning Algorithms</p>
                        <span>Author : <br>Kanika Chopra, Ekta Tyagi, Vijay Raj , Raju Tyagi</span>
                    </a>
                    <a href="<?=$path;?>branch/images/research/research6.pdf" target='_blank'>
                        <p>The Impact on Revenue of Countries through Global Trade and Shipping Lanes: Suez Canal, Panama Canal, and the Geography of Connectivity</p>
                        <span>Author : <br>Prof. Dr. Devendra Arora, Prof. Vijay Raj & Simran Dev Arora</span>
                    </a>
                </div>
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research5.pdf" target='_blank'>
                        <p>Leveraging Artificial Intelligence in Banking for Sports Finance: Opportunities, challenges, and policy implications</p>
                        <span>Author : <br>Simran Dev Arora, Prof. Dr. Devendra Kumar Sharma, Prof. Vijay Raj & Prof. Dr. Devendra Arora</span>
                    </a>
                </div>
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research1.pdf" target='_blank'>
                        <p>Decentralized Finance (DeFi) and Its Impact on Traditional Financial Institutions: A Paradigm Shift in Banking and Investment</p>
                        <span>Author : <br>Prof. Dr. Devendra Arora</span>
                    </a>
                </div>
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research2.pdf" target='_blank'>
                        <p>“Financial Growth of Global Sports Tourism (2013–2023): Role of India, Promotion & Economic Impact, and employment opportunity for humanresources</p>
                        <span>Author : <br>Prof. Dr. Devendra Arora & Vijay Raj Kakran</span>
                    </a>
                </div>
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research3.pdf" target='_blank'>
                        <p>Journal of Management and Entrepreneurship</p>
                        <span>Author : <br>Manoj Kumar Saini & Dr. Abhimanyu Upadhyay</span>
                    </a>
                </div>
                <div class="listbox">
                    <a href="<?=$path;?>branch/images/research/research4.pdf" target='_blank'>
                        <p>E - Branding Strategy in Educational Sectors in Meerut Region</p>
                        <span>Author : <br>Manoj Kumar Saini &  Dr. Abhimanyu Upadhyay</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="col-md-3">
        <div class="<?=$gettype;?>right pageright">
            <h4 class="rightitle">Quick Links</h4>
            <ul class="rightlistbox">
                <?php $sqlsubcatside = mysqli_query($con, "SELECT * FROM `sub_cat` WHERE `cat_id`  = $catid AND `status` = 1");
                while($rwsubcatside = mysqli_fetch_array($sqlsubcatside)){ ?>
                <li class="list"><a href="<?=$path.$caturl.'/'.$rwsubcatside['sc_url'];?>" class="link"><?=$rwsubcatside['sc_name'];?></a></li>
                <?php } ?>
            </ul>
        </div>  
    </div>
    <?php } ?>

</div>
</div>
</div>        
<?php
        }else{
            echo '<div class="pagewidget"><div class="container-lg"><div class="row"><div class="col-md-12"><div class="pagedesc">'.$data.'</div></div></div></div></div>';
        }
    }
} 
?>


<?php include("footer.php"); ?>

<div class="msgbox"></div>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/zoom/lg-zoom.min.js"></script>
<script>
    var lightGalleryElement = document.getElementById('lightgallery');
    if(lightGalleryElement){
        lightGallery(lightGalleryElement);
    }
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
<script src="<?=$path;?>branch/js/script.js"></script>
<?php if(!empty($gettype)){ ?>
<script>
    $('#submitForm').ajaxForm({
    beforeSubmit: function() {
    $('.msgbox').html("<div class='loading-wrapper'><span class='loading_span'></span><p>Please wailt...</p></div>");
     },
    success: function(data) {
        var data = JSON.parse(data);
        if(data.status){
            $("#submitForm").trigger('reset');
        }
        $('.msgbox').html(data.msg);
        setTimeout(function(){$('.msgbox').html('');},1500);
    },
});
</script>
<?php } ?>
<script>
function toggleOrder3Desc(){
    var el = document.getElementById('order3Desc');
    var btn = el.nextElementSibling;
    el.classList.toggle('expanded');
    if(el.classList.contains('expanded')){
        btn.innerHTML = 'Read Less <i class="bi bi-chevron-up"></i>';
    } else {
        btn.innerHTML = 'Read More <i class="bi bi-chevron-down"></i>';
    }
}
</script>
</body>
</html>


