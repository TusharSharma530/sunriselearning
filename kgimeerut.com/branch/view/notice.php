<div class="notice">
<div class="container-lg">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="noticetbl">
		<table class="table table-bordered table-hover">
		<thead>
			<tr class="text-center">
				<th>Sr. No.</th>
				<th>Title</th>
				<th>Date</th>
				<th>View Notice</th>
			</tr>
		</thead>
		<tbody>
<?php $notice=mysqli_query($con,"SELECT * FROM `notice` WHERE `status`=1 ORDER BY `id` DESC");
$sr=0;
while($rwnotice=mysqli_fetch_array($notice)){
$sr++;
$date=$rwnotice['date'];
$date=date_create($date);
$day=date_format($date,"d");
$month=date_format($date,"M");
$year=date_format($date,"Y");
?>
			<tr>
				<td class="text-center"><?=$sr;?></td>
				<td><?=$rwnotice['title'];?></td>
				<td class="text-center"><?=$year;?>-<?=$month;?>-<?=$day;?></td>
				<?php //$path.$rwnotice['file'];?>
				<td class="text-center"><a href="javascript:" class="bi bi-file-pdf" target="_blank"></a></td>
			</tr>
<?php  } ?>			
		</tbody>
		</table>
	</div>
</div>
</div>
</div>
</div>