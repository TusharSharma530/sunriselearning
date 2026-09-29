<div class="syllabus">
<div class="container-lg">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<?php $sqlcourses=mysqli_query($con,"SELECT * FROM `courses` ORDER BY `order` ASC");
while($rwcourse=mysqli_fetch_array($sqlcourses)){
$courseid=$rwcourse['id']; 
$sqlsyllabus=mysqli_query($con,"SELECT * FROM `syllabus` WHERE `courseid` = '$courseid'");
if(mysqli_num_rows($sqlsyllabus)){ ?>
	<div class="syllabustbl">
    	<div class="title">
    	    <h3><i class="bi bi-journals"></i> <?=$rwcourse['title'];?></h3>
	    </div>
	<table class="table table-bordered table-hover">
	<thead>
		<tr class="text-center">
			<th width="15%">Sr. No.</th>
			<th>Subject's Name</th>
			<th width="25%">Download Syllabus</th>
		</tr>
	</thead>
	<tbody>
<?php $sr=0;
while($rwsyllabus=mysqli_fetch_array($sqlsyllabus)){
$sr++;
?>
		<tr>
			<td class="text-center"><?=$sr;?>.</td>
			<td><?=$rwsyllabus['title'];?></td>
			<td class="text-center"><a href="<?=$path.$rwsyllabus['file'];?>" class="bi bi-file-earmark-arrow-down" title="Download Syllabus" target="_blank"></a></td>
		</tr>
<?php  } ?>			
	</tbody>
	</table>
	</div>
<?php } } ?>
</div>
</div>
</div>
</div>