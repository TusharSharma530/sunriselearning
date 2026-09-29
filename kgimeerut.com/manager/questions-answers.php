<?php include 'config.php';
$title = 'Questions & Answers List';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
}

$id = $_GET['id'];

if(isset($_POST['deletedata'])){
	$id = $_POST['id'];
	$sqldelImg = mysqli_query($con, "SELECT * FROM `questions_answers` WHERE id = $id");
	$sqldelete = mysqli_query($con,"DELETE FROM `questions_answers` WHERE `id` = $id");
		if($sqldelete){
			echo 'true';
		}else{
			echo 'false';
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
			<h3>Questions & Answers List</h3>
		</div>
		<div class="createbtn">
			<a href="test.php">Test List</a>
			<a href="addquestion-answer.php?id=<?=$id;?>">Add New</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="msgbox"></div>
	<div class="page-content">

	<table class="table table-hover" id="myTable">
		<thead>
			<tr>
				<th style="width: 4%;">#</th>
				<th>Questions & Answers</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$sqlques_ans  = mysqli_query($con, "SELECT * FROM `questions_answers` WHERE `testid` = $id ORDER BY `id` DESC");
			if(mysqli_num_rows($sqlques_ans)){
				$serial = 1;
				while($rwques_ans = mysqli_fetch_assoc($sqlques_ans )){
					$qaid = $rwques_ans['id'];					
		 ?>
			<tr id="remove<?=$qaid;?>" style="padding: 10px;">									
				<td style="vertical-align: top; font-weight: bold;"><?=$serial;?></td>
				<td>
					<div class="tbl-question">		
					    <h5><?=$rwques_ans['question_title'];?></h5>
						<h4><?php echo $rwques_ans['question']; ?> <span>[<?=$rwques_ans['question_mark'];?>]</span></h4>
						<?php if(!empty($rwques_ans['q_img'])){ ?>
						<img src="<?=$path.$rwques_ans['q_img'];?>" alt="<?=$rwques_ans['id'];?>">
						<?php } ?>
					</div>

					<div class="tbl-answers">
					    <div class="ans1 answers">
    						<?php if(!empty($rwques_ans['answer1']) || !empty($rwques_ans['a_img1'])){
    						    $ans1 = $rwques_ans['ans_true']==1 ? "right" : "";
    						if(!empty($rwques_ans['answer1'])){ ?>
    							<span class="<?=$ans1;?>"><b>(A)</b> <?=$rwques_ans['answer1'];?></span>
    						<?php }else{ ?>
    							<span><b>(A)</b>
    								<img 
    								src="<?=$path.$rwques_ans['a_img1'];?>" 
    								alt="<?=$rwques_ans['a_img1'];?>" 
    								class="<?=$ans1;?>">
    							</span>
    						<?php }  } ?>
                        </div>
                        
                        <div class="ans2 answers">
    						<?php if(!empty($rwques_ans['answer2']) || !empty($rwques_ans['a_img2'])){
    						    $ans2 = $rwques_ans['ans_true']==2 ? "right" : "";
    						if(!empty($rwques_ans['answer2'])){ ?>
    							<p class="<?=$ans2;?>"><b>(B)</b> <?=$rwques_ans['answer2'];?></p>
    						<?php }else{ ?>
    							<span><b>(B)</b>
    								<img 
    								src="<?=$path.$rwques_ans['a_img2'];?>" 
    								alt="<?=$rwques_ans['a_img2'];?>" 
    								class="<?=$ans2;?>">
    							</span>
    						<?php } } ?>
                        </div>

                        <div class="ans3 answers">
    						<?php if(!empty($rwques_ans['answer3']) || !empty($rwques_ans['a_img3'])){
    						    $ans3 = $rwques_ans['ans_true']==3 ? "right" : "";
    						if(!empty($rwques_ans['answer3'])){ ?>
    							<p class="<?=$ans3;?>"><b>(C)</b> <?=$rwques_ans['answer3'];?></p>
    						<?php }else{ ?>
    							<span><b>(C)</b>
    								<img 
    								src="<?=$path.$rwques_ans['a_img3'];?>" 
    								alt="<?=$rwques_ans['a_img3'];?>" 
    								class="<?=$ans3;?>">
    							</span>
    						<?php } } ?>
                        </div>

                        <div class="ans4 answers">
    						<?php if(!empty($rwques_ans['answer4']) || !empty($rwques_ans['a_img4'])){
    						    $ans4 = $rwques_ans['ans_true']==4 ? "right" : "";
    						if(!empty($rwques_ans['answer4'])){ ?>
    							<p class="<?=$ans4;?>"><b>(D)</b> <?=$rwques_ans['answer4'];?></p>
    						<?php }else{ ?>
    							<span><b>(D)</b>
    								<img 
    								src="<?=$path.$rwques_ans['a_img4'];?>" 
    								alt="<?=$rwques_ans['a_img4'];?>" 
    								class="<?=$ans4;?>">
    							</span>
    						<?php } } ?>
						</div>
					</div>


				</td>
				<td class="text-center">
					<a href="updatequestion-answer.php?id=<?=$qaid;?>&testid=<?=$id;?>" class="editbtn ri-pencil-line" ></a> 
					<a href="javascript:"  ide="<?=$qaid; ?>" class='delbtn ri-delete-bin-line' ></a>
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


