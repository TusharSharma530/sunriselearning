<?php if(isset($_POST['updateStatus'])){
	$id = $_POST['id'];
	$tbl = $_POST['table'];

	$sql = mysqli_query($con, "SELECT * FROM `$tbl` WHERE `id` = '$id'");
	if(mysqli_num_rows($sql)){
		$rw = mysqli_fetch_array($sql);
		if($rw['status']==1){
			$sqlstatu = mysqli_query($con, "UPDATE `$tbl` SET `status` = 0 WHERE `id` = '$id'");
			echo true;
		}else{
			mysqli_query($con, "UPDATE `$tbl` SET `status` = 1 WHERE `id` = '$id'");
			echo false;
		}
	}
	exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title; ?></title>
<link rel="icon" type="image/x-icon" href="<?=$path;?>branch/images/logo/favicon.ico">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >
<!-- ========== Pe-7-icons CDN Link ========= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<link rel="icon" type="image/x-icon" href="<?=$path;?>branch/images/fav.ico">
<link href="bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/datatables.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive-style.css">

	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
	var TextEditor = function() {"use strict";
	
	var ckEditorHandler = function() {
		CKEDITOR.disableAutoInline = true;
		$('textarea.ckeditor').ckeditor();
	};

	return {
		
		init: function() {
			ckEditorHandler();
		}
	};
}();
        jQuery(document).ready(function () {
        TextEditor.init();
        });
    </script>

<!--<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>-->






</head>
<body>
	
