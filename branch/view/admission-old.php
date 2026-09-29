<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form for New Enrollment 2026</title>
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
        <h3>Registration Form for New Enrollment 2026</h3>
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
    		<div class="col-md-4">
            	<div class="fields">
            		<label for="email">Email ID <span>*</span></label>
            		<input type="text" id="email" name="email" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="mobileno">Mobile No. <span>*</span></label>
            		<input type="text" id="mobileno" name="mobileno" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="dob">DOB <span>*</span></label>
            		<input type="date" id="dob" name="dob" class="form-control" autocomplete="off">
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="courseapply">Course Apply <span>*</span></label>
            		<select class="form-control form-select" name="courseapply" required>
            		    <option value="">-Select Course-</option>
            		    <?php $sqlcourse=mysqli_query($con,"SELECT * FROM `courses` ORDER BY `order` ASC");
            		    while($rwcourse=mysqli_fetch_array($sqlcourse)){ ?>
            		    <option value="<?=$rwcourse['id'];?>"><?=$rwcourse['title'];?></option>
            		    <?php } ?>
            		</select>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="certificatecourse">With Certificate Courses<span></span></label>
            		<select class="form-control form-select" name="certificatecourse">
            		    <option value="">-Select Course-</option>
            		    <option value="MBA with Sports Management">MBA with Sports Management</option>
            		    <option value="BBA with Sports Management">BBA with Sports Management</option>
            		    <option value="Others">Others</option>
            		</select>
            	</div>
            </div>
            
            <div class="col-md-4">
            	<div class="fields">
            		<label for="per10">Percentage (10th) <span>*</span></label>
            		<input type="number" id="per10" name="per10" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            
            <div class="col-md-4">
            	<div class="fields">
            		<label for="per12">Percentage (12th) <span>*</span></label>
            		<input type="number" id="per12" name="per12" class="form-control" autocomplete="off" required>
            	</div>
            </div>

            <div class="col-md-4">
            	<div class="fields">
            		<label for="perug">Percentage (UG) <span>*</span></label>
            		<input type="number" id="perug" name="perug" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="graduation">Graduation <span>*</span></label>
            		<input type="text" id="graduation" name="graduation" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="passingyear">Year of Passing <span>*</span></label>
            		<input type="text" id="passingyear" name="passingyear" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="aadharno">Aadhar No.</label>
            		<input type="text" id="aadharno" name="aadharno" class="form-control" autocomplete="off">
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="fields">
            		<label for="examentrance">Any Entrance Exam</label>
            		<input type="text" id="examentrance" name="examentrance" class="form-control" autocomplete="off">
            	</div>
            </div>
            <div class="col-md-12">
            	<div class="fields">
            		<label for="address">Address <span>*</span></label>
            		<input type="text" id="address" name="address" class="form-control" autocomplete="off" required>
            	</div>
            </div>
            <div class="col-md-12">
            	<div class="fields bankdetails">
            	    <h3>Bank Details :</h3>
            	</div>
            </div>
            <div class="col-md-8">
                <div class="fields">
            		<label>Account Holder's Name <span>*</span></label>
            		<input type="text" class="form-control" readonly value="Krishna Institute of Management">
            	</div>
            </div>
            <div class="col-md-4">
                <div class="fields">
            		<label>Bank Name</label>
            		<input type="text" class="form-control" readonly value="Bank of India">
            	</div>
            </div>
            <div class="col-md-4">
                <div class="fields">
            		<label>Branch Name</label>
            		<input type="text" class="form-control" readonly value="Begum Bridge Meerut">
            	</div>
            </div>
            <div class="col-md-4">
                <div class="fields">
            		<label>Account No.</label>
            		<input type="number" class="form-control" readonly value="720520110000095">
            	</div>
            </div>
            <div class="col-md-4">
                <div class="fields">
            		<label>IFSC Code</label>
            		<input type="text" class="form-control" readonly value="BKID0007205">
            	</div>
            </div>
            <div class="col-md-4">
                <div class="fields">
            		<label>Registration Fee (Rs.)</label>
            		<input type="number" class="form-control" readonly value="1100">
            	</div>
            </div>
            <div class="col-md-12">
                <div class="fields">
            		<label>Scan for Pay Fee</label>
            		<img src="//kim.kgimeerut.com/branch/image/scanner.webp" alt="Scanner">
            	</div>
            </div>
            <div class="col-md-12">
            	<div class="fields-btn">
            		<input type="submit" name="registrationfrm" value="Registration Now">
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
