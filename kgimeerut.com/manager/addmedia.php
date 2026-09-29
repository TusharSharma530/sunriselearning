<?php include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = 'Add Media';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";

if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelImg = mysqli_query($con, "SELECT * FROM `media` WHERE id = $id");
		if(mysqli_num_rows($sqldelImg)){
			$rowimg = mysqli_fetch_assoc($sqldelImg);
				$imgid = $rowimg['file'];
				unlink("../".$imgid);

			$sqldelete = mysqli_query($con,"DELETE FROM `media` WHERE id = $id");
			if($sqldelete){
				echo 'true';
			}else{
				echo 'false';
			}	
			
		}
	
	exit();
 }



if(isset($_POST['addRecord'])){
    $galid = mysqli_real_escape_string($con, $_POST['galid']);
    $month = mysqli_real_escape_string($con, $_POST['month']);
    $year  = mysqli_real_escape_string($con, $_POST['year']);

    $i = 0;

    foreach ($_FILES['img']['name'] as $row => $name){

        // File Extension
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // Allow all image types including WEBP
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if(!in_array($ext, $allowed)){
            continue;   // skip invalid files
        }

        // New File name
        $gallery_imagename = round(microtime(true)).$i.".".$ext;

        // Upload path
        $uploadpath = "branch/assets/media_img/".$gallery_imagename;

        // Upload file
        move_uploaded_file($_FILES['img']['tmp_name'][$i], "../".$uploadpath);

        // Insert query
        $sqlins = mysqli_query($con, "
            INSERT INTO `media` (`gal_id`,`file`,`month`,`year`)
            VALUES ('$galid', '$uploadpath', '$month', '$year')
        ");

        $i++;
    }


    if($sqlins){
        echo "<script>swal('Added Successfully','','success'); $('#submitForm').hide();</script>";
        echo "<div class='col-md-12 padd0 text-center'><a href='addmedia.php' class=' btn btn-primary'>Create New</a></div>";
    } else {
        echo "<script>swal('Failed','','error'); $('#submitForm').show();</script>";
    }

    exit();
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
			<h3>Add Media</h3>
		</div>
		<div class="createbtn">
			<a href="media.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" enctype="multipart/form-data">
		<div class="row">
        <div class="col-md-6">
            <label for='galid'>Type</label>
            <select class='form-control' required name='galid'>
                <option value="">--Select Month--</option>
                <option value="0">Media</option>
                <option value="1">Gallery</option>
                <option value="2">Activites</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for='month'>Month</label>
            <select class='form-control' required name='month'>
                <option value="">--Select Month--</option>
                <?php $currentMonth = date('n'); // Get current month number without leading zero (1 to 12)
                for ($i = 1; $i <= 12; $i++) {
                    $selected = ($i == $currentMonth) ? 'selected' : '';
                    echo "<option value='{$i}' $selected>" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
                } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for='year'>Year</label>
<select class='form-control' required name='year'>
    <option value="">--Select Year--</option>

    <?php 
        $selectedYear = date("Y");      // 2025
        $previousYear = $selectedYear - 1; // 2024

        echo "<option value='$previousYear'>$previousYear</option>";
        echo "<option selected value='$selectedYear'>$selectedYear</option>";
    ?>
</select>
        </div>
		<div class="mb-3 col-md-12">
		  	<label for="formFile" class="form-label">Image</label>
		  	<div class="clearallimgdiv" style="display: none;">
		  		<a href="javascript:" id="clrimgs">Clear All</a>
		  	</div>
		  	<div class="imgquestion other">			  		
				<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
				<input hidden class="form-control imgInputMultiple" name="img[]" type="file" multiple>
				<img src="images/preview.jpg" alt="2" class='preview'>
			</div>
			<div id="gal-container"></div>
		</div>

		<div class="col-md-12">
			<input type="submit" value="Add Record" name="addRecord" class="submitInput">
		</div>

		</div>
	</form>
</div>
</div>
</div>
</section>

	
<?php 
	include "include/footer.php"; 
?>