<?php $getid=decryptIt($getparam['i']);?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Apply For Job</title>
<meta name="keywords" content="<?=$metakeywords;?>">
<meta name="description" content="<?=$metadesc;?>">
<meta name="author" content="<?=$websitename;?>">
<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
<link rel="canonical" href="<?=$actual_link;?>">
<link rel="icon" type="image/jpeg" href="<?=$path;?>branch/assets/logo/logoImg1787999510.jpg?v=2">
<!-- ========== Bootstrap CDN Link ========= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$path;?>branch/css/style.css">
<link rel="stylesheet" href="<?=$path;?>branch/css/responsive.css">
</head>
<body><div class="admission">
    <div class="container-lg">
    <div class="row">
        
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="reg-head">
    	<a href="<?=$path;?>" title="<?=$websitename;?>">
        <div class="logodiv">				
            <img src="<?=$path.$logo;?>" atl="<?=$websitename;?>">
        </div>
	    </a>
        <h3>Job Applying Form</h3>
    </div>
    </div>
    <div class="col-md-2"></div>
    
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="reg-form">
    	<form class="row" method="POST" id="submitForm">
    		<div class="col-md-6">
    			<div class="fields">
    				<label for="name">Name <span>*</span></label>
    				<input type="text" id="name" name="name" class="form-control" autocomplete="off" autofocus="on" required>
    			</div>
    		</div>
    		<div class="col-md-6">
            	<div class="fields">
            		<label for="email">Email ID <span>*</span></label>
            		<input type="text" id="email" name="email" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-6">
            	<div class="fields">
            		<label for="mobileno">Mobile No. <span>*</span></label>
            		<input type="text" id="mobileno" name="mobileno" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-6">
            	<div class="fields">
            		<label for="applyfor">Apply For<span>*</span></label>
            		<select class="form-control form-select" name="applyfor" required>
            		    <option value="">-Select Job-</option>
            		    <?php $jobs_sql = mysqli_query($con, "SELECT * FROM `jobs` WHERE `status`=1");
                        while($jobs_rw = mysqli_fetch_object($jobs_sql)){
                        $jobid=$jobs_rw->id;
                        $sel=$jobid==$getid ? 'selected' : '';
                        ?>
            		    <option value="<?=$jobid;?>" <?=$sel;?>><?=$jobs_rw->title;?></option>
            		    <?php } ?>
            		    <option value="0">Other</option>
            		</select>
            	</div>
            </div>
            <div class="col-md-6">
            	<div class="fields">
            		<label for="address">Highest Degree/Diploma <span>*</span></label>
            		<select class="form-control form-select" name="degree" required>
            		    <option value="">-Select-</option>
            		    <option value="MBA">MBA</option>
            		    <option value="B.TECH">B.TECH</option>
            		    <option value="BBA">BBA</option>
            		    <option value="BCA">BCA</option>
            		    <option value="MCA">MCA</option>
            		    <option value="B.Ed">B.Ed</option>
            		    <option value="BA">BA</option>
            		    <option value="B.Sc">B.Sc</option>
            		    <option value="B.Com">B.Com</option>
            		    <option value="Polytechnic">Polytechnic</option>
            		    <option value="ITI">ITI</option>
            		    <option value="Others">Others</option>
            		</select>
            	</div>
            </div>
            <div class="col-md-6">
            	<div class="fields">
            		<label for="resume">Upload Resume (Jpeg or Jpg, Pdf) <span>*</span></label>
            		<input type="file" id="resume" name="resume" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            
            <div class="col-md-12">
            	<div class="fields-btn">
            		<input type="submit" name="applyjob" value="Apply Now">
            	</div>
            </div>
    	</form>
    </div>
    
    </div>
    </div>
    </div>
    </div>
    
    
    <div class="msgbox"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
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
</body>
</html>
