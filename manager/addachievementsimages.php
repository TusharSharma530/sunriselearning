<?php include 'config.php';
$title = 'Add Achievement Images';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'] ?? "";

if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelImg = mysqli_query($con, "SELECT * FROM `achievements` WHERE id = $id");
		if(mysqli_num_rows($sqldelImg)){
			$rowimg = mysqli_fetch_assoc($sqldelImg);
				$imgid = $rowimg['file'];
				if(!empty($imgid)){
					unlink("../".$imgid);
				}

			$sqldelete = mysqli_query($con,"DELETE FROM `achievements` WHERE id = $id");
			if($sqldelete){
				echo 'true';
			}else{
				echo 'false';
			}	
			
		}
	
	exit();
 }



if(isset($_POST['addRecord'])){
$sqlins = "";
$i=0;
foreach ($_FILES['img']["name"] as $row=>$name){
    $images = $name;                                
    $images_content = explode(".", $images);
    $imagename = round(microtime(true)) .$i. '.' . end($images_content);
    $uploadpath = "branch/assets/achievements/".$imagename;
    move_uploaded_file($_FILES["img"]["tmp_name"][$i], "../branch/assets/achievements/" . $imagename);
    $i++;
    $sqlins = mysqli_query($con,"INSERT INTO `achievements` (`id`, `title`, `description`, `file`, `youtube_url`, `order`, `status`) VALUES (NULL, '', '', '$uploadpath', '', $i, 1)");
}  

if($sqlins){
echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); 
		$('#submitForm').hide();
	 </script>";
echo "<div class='col-md-12 padd0 text-center'><a href='addachievementsimages.php?id=$id' class=' btn btn-primary'>Create New</a></div>";
}else{	
	echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
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
			<h3>Add Achievement Images</h3>
		</div>
		<div class="createbtn">
			<a href="achievements.php"> List</a>
		</div>
	</div>
</div>

<div class="col-md-12">
<div class="page-content">
	<div class="msgbox"></div>
	<form method="POST" id="submitForm" enctype="multipart/form-data">
		<div class="row">

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

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox"></div>
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th>Image</th>
					<th width="10%" class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
<?php $sqlach = mysqli_query($con, "SELECT * FROM `achievements` ORDER BY `id` DESC");
if(mysqli_num_rows($sqlach)){
$serial = 1;
while($rwach = mysqli_fetch_assoc($sqlach)){
	$achid = $rwach['id'];
?>
				<tr id='remove<?php echo $achid; ?>'>
					<td><?php echo $serial; ?></td>
					<td><img src="<?=$path.$rwach['file'];?>" style="width: 100px;"/></td>
					<td class="text-end">
						<a href="javascript:" ide="<?=$achid;?>" class='delbtn ri-delete-bin-line'></a>
					</td>
				</tr>
		<?php $serial++; }} ?>
			</tbody>
		</table>
	</div>
</div>

</div>
</div>
</section>

	
<?php 
	include "include/footer.php"; 
?>
