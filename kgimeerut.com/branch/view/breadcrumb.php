<?php if($gettype!='jobs'){ ?>
<div class="pagebreadcrumb">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-col">
	<h1><?=$breadcrumbtitle;?></h1>
	<?php if($gettype=='krishna-institution' && $geturl=='krishna-institute-of-management'){ ?>
	<span class="breadtagline">Affiliated to Dr. A.K Technical University, Lucknow</span>
	<?php }else if($gettype=='krishna-institution' && $geturl=='krishna-institute-of-education'){ ?>
	<span class="breadtagline">Affiliated to C.C.S. University, Meerut (NAAC Accredited A++)</span>
	<?php }else if($gettype=='krishna-institution' && $geturl=='krishna-institute-of-higher-education'){ ?>
	<span class="breadtagline">Affiliated to Pareeksha Niyamak Pradhikari, Allahabad</span>
	<?php }else if($gettype=='krishna-institution' && $geturl=='krishna-institute-of-pharmacy'){ ?>
	<span class="breadtagline">Affiliated to Board of Technical Education, Lucknow</span>
	<?php } ?>
</div>
</div>
</div>
</div>
</div>
<div class="breadcrumb-bottom">
<div class="container-lg">
<div class="row">
<div class="col-md-12">
<ul>
	<li><a href="<?=$path;?>">Home</a></li><?=$breadcrumblist;?>
</ul>
</div>
</div>
</div>
</div>
<?php } ?>