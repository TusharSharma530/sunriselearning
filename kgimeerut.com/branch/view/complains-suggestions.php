<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complains & Suggestions</title>
<meta name="keywords" content="<?=$metakeywords;?>">
<meta name="description" content="<?=$metadesc;?>">
<meta name="author" content="<?=$websitename;?>">
<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
<link rel="canonical" href="<?=$actual_link;?>">
<link rel="icon" type="image/x-icon" href="<?=$path;?>branch/images/logo/favicon.ico">
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
        <h3>Complains & Suggestions</h3>
    </div>
    </div>
    <div class="col-md-2"></div>
    
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="reg-form">
    	<form class="row" method="POST" id="submitForm">
    		<div class="col-md-12">
    		    <input type="hidden" value="<?=$_SESSION['reg_token'];?>" name="regToken">
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
            		<label for="enrollment">Enrollment No. <span>*</span></label>
            		<input type="text" id="enrollment" name="enrollment" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-6">
            	<div class="fields">
            		<label for="course">Course<span>*</span></label>
            		<input type="text" id="course" name="course" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            
            <div class="col-md-6">
            	<div class="fields">
            		<label for="academicsession">Academic Session<span>*</span></label>
            		<input type="number" id="academicsession" name="academicsession" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            
            <div class="col-md-12">
            	<div class="fields">
            		<label for="per10">Message<span>*</span></label>
            		<textarea name="message" class="form-control"></textarea>
            	</div>
            </div>

            <div class="col-md-12">
            	<div class="fields-btn">
            		<input type="submit" name="submitcomplain" value="Submit">
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