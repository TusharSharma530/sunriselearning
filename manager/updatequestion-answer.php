<?php include 'config.php';
$title = 'Edit Question & Answer';
if(!isset($_SESSION['username'])){
	echo "<script>window.location.href='{$path}manager'</script>";
}

$testid = $_GET['testid'];
$id = $_GET['id'];
$sqlqna = mysqli_query($con, "SELECT * FROM `questions_answers` WHERE `id` = $id");
$rwqna = mysqli_fetch_array($sqlqna);


if(isset($_POST['editRecord'])){
	
	if(!empty($_FILES['questionimg']['name'])){ 
		$questionimg = createImgWebp("questionimg", "questions-answers");
	}else{
		$questionimg=$rwqna['q_img'];
	}
    $questiontitle = trim(mysqli_real_escape_string($con, $_POST['question-title']));
    $question = trim($_POST['question']);
	$question_marks = trim(mysqli_real_escape_string($con, $_POST['question-marks']));
	$ans_true = trim(mysqli_real_escape_string($con, $_POST['answer-check']));
	$ans_cat1 = trim(mysqli_real_escape_string($con, $_POST['ans_cat1']));
	$ans_cat2 = trim(mysqli_real_escape_string($con, $_POST['ans_cat2']));
	$ans_cat3 = trim(mysqli_real_escape_string($con, $_POST['ans_cat3']));
	$ans_cat4 = trim(mysqli_real_escape_string($con, $_POST['ans_cat4']));	
	$answer1 = trim($_POST['answer1']);
	if(empty($answer1)){ 
		if(!empty($_FILES['answerimg1']['name'])){
			$answerimg1 =  createImgWebp("answerimg1", "questions-answers");
		}else{
			$answerimg1 =  $rwqna['a_img1'];			
		}
	}else{
		$answerimg1 = $rwqna['a_img1'];
	}
	$answer2 = trim($_POST['answer2']);
	if(empty($answer2)){
		if(!empty($_FILES['answerimg2']['name'])){
			$answerimg2 =  createImgWebp("answerimg2", "questions-answers");
		}else{
			$answerimg2 =  $rwqna['a_img2'];			
		}

	}else{
		$answerimg2 = $rwqna['a_img2'];
	}
	$answer3 = trim($_POST['answer3']);
	if(empty($answer3)){
	 if(!empty($_FILES['answerimg3']['name'])){
			$answerimg3 =  createImgWebp("answerimg3", "questions-answers");
		}else{
			$answerimg3 =  $rwqna['a_img3'];			
		}
	}else{
		$answerimg3 = $rwqna['a_img3'];
	}
	$answer4 = $_POST['answer4'];
	if(empty($answer4)){
	 if(!empty($_FILES['answerimg4']['name'])){
			$answerimg4 =  createImgWebp("answerimg4", "questions-answers");
		}else{
			$answerimg4 =  $rwqna['a_img4'];			
		}
	}else{
		$answerimg4 = $rwqna['a_img4'];
	}


	$sqlcheck = mysqli_query($con,"SELECT * FROM `questions_answers` WHERE `question` = '$question' AND `id` != $id");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Question Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
	}else{

	$sql = mysqli_query($con, "UPDATE `questions_answers` SET `testid` = '$testid', `question_title` = '$questiontitle', `question` = '$question', `q_img` = '$questionimg', `answer1` = '$answer1', `a_img1` = '$answerimg1', `answer2` = '$answer2', `a_img2` = '$answerimg2', `answer3` = '$answer3', `a_img3` = '$answerimg3', `answer4` = '$answer4', `a_img4` = '$answerimg4', `question_mark` = '$question_marks', `ans_true`  = '$ans_true', `ans_cat1` = '$ans_cat1', `ans_cat2` = '$ans_cat2', `ans_cat3` = '$ans_cat3', `ans_cat4` = '$ans_cat4' WHERE `id` = $id");

	if($sql){
		echo "<script>swal('Updated Successfully', 'Click `OK` to Close', 'success'); </script>";
	}else{
		echo "<script>swal('Failed', 'Click `OK` to try Again', 'error'); $('#submitForm').show();</script>";
	}

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
			<h3>Edit Question & Answer</h3>
		</div>
		<div class="createbtn">
			<a href="test.php"> Test List</a>
			<a href="questions-answers.php?id=<?=$testid;?>"> Q&A List</a>
		</div>
	</div>
</div>

		

<div class="col-md-12">
	<div class="page-content">
		<div class="msgbox">

		</div>
		<form method="POST" id="submitForm" class="row">
			<div class="col-md-12">
				<div class="row">
				    <div class="col-md-12 mb-3">
						<label for="questiontag" class="form-label label-question">Question Tag (if any:)</label>
						<textarea name="question-title" id="questiontag" class="ckeditor"><?=$rwqna['question_title'];?></textarea>
					</div>
					<div class="col-md-12">
						<div class="fields fields-question">
							<label for="question" class="form-label label-question">Question :-</label>
							<div class="row">
								<div class="col-md-8">
								<textarea class="ckeditor" name="question" ><?=$rwqna['question'];?></textarea>
								<div class="question-bottom">
    								    <div class="marks">
    								        <label>Question Marks :</label>
    								        <input type='number' name='question-marks' value="<?=$rwqna['question_mark'];?>" required>
    								    </div>
    								    <div class="orimage-question">
    								        <a href="javascript:" id="addalternatequestion">Add Alternate Question</a>
    								    </div>
    								    
    								</div>
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">

										<?php $active = empty($rwqna['q_img']) ? "" : "active"; ?>

										<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
										<input hidden class="form-control imgInput" name="questionimg" type="file">
										<?php if(empty($rwqna['q_img'])){ ?>
						  				<img src="images/preview.jpg" alt="<?=$rwqna['q_img'];?>" class='preview'>
						  				<?php }else{ ?>
						  				<img src="<?=$path.$rwqna['q_img'];?>" alt="<?=$rwqna['q_img'];?>" class='preview'>
						  				<?php } ?>
						  			</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="fields fields-answer">
							<label for="question" class="form-label label-answer">Answers :-</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="fields">
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>1</p>
									<input class="" type="radio" name="answer-check" value="1" <?=$rwqna['ans_true']==1 ? "checked" : ""; ?> required>
								</div>
								<div class="col-md-8">
								<textarea name="answer1" id="answer1" class="ckeditor answer-text"><?=$rwqna['answer1'];?></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat1" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		$selected = $rwanscat['id'] == $rwqna['ans_cat1'] ? "selected" : "";
								        		echo "<option {$selected} value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
								        	}
								        	 ?>
								        	
								        	
								        </select>
								    </div>
    							</div>								
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">
										<?php $active = empty($rwqna['a_img1']) ? "" : "active"; ?>
										<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
										<input hidden class="form-control imgInput" name="answerimg1" type="file">
										<?php if(empty($rwqna['a_img1'])){ ?>
						  				<img src="images/preview.jpg" alt="preview" class='preview'>
						  				<?php }else{ ?>
						  				<img src="<?=$path.$rwqna['a_img1'];?>" alt="<?=$rwqna['a_img1'];?>" class='preview'>
						  				<?php } ?>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>2</p>
									<input class="" type="radio" name="answer-check" value="2" required <?=$rwqna['ans_true']==2 ? "checked" : ""; ?>>
								</div>
								<div class="col-md-8">
								<textarea name="answer2" id="answer2" class="ckeditor answer-text"><?=$rwqna['answer2'];?></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat2" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		$selected = $rwanscat['id'] == $rwqna['ans_cat2'] ? "selected" : "";
								        		echo "<option {$selected} value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
								        	}
								        	 ?>
								        	
								        	
								        </select>
								    </div>
    							</div>
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">
										<?php $active = empty($rwqna['a_img2']) ? "" : "active"; ?>
										<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
										<input hidden class="form-control imgInput" name="answerimg2" type="file">
						  				<?php if(empty($rwqna['a_img2'])){ ?>
						  				<img src="images/preview.jpg" alt="preview" class='preview'>
						  				<?php }else{ ?>
						  				<img src="<?=$path.$rwqna['a_img2'];?>" alt="<?=$rwqna['a_img2'];?>" class='preview'>
						  				<?php } ?>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>3</p>
									<input class="" type="radio" name="answer-check" value="3" required <?=$rwqna['ans_true']==3 ? "checked" : ""; ?>>
								</div>
								<div class="col-md-8">
								<textarea name="answer3" id="answer3" class="ckeditor answer-text"><?=$rwqna['answer3'];?></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat3" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		$selected = $rwanscat['id'] == $rwqna['ans_cat3'] ? "selected" : "";
								        		echo "<option {$selected} value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
								        	}
								        	 ?>
								        	
								        	
								        </select>
								    </div>
    							</div>
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">
										<?php $active = empty($rwqna['a_img3']) ? "" : "active"; ?>
										<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
										<input hidden class="form-control imgInput" name="answerimg3" type="file">
						  				<?php if(empty($rwqna['a_img3'])){ ?>
						  				<img src="images/preview.jpg" alt="preview" class='preview'>
						  				<?php }else{ ?>
						  				<img src="<?=$path.$rwqna['a_img3'];?>" alt="<?=$rwqna['a_img3'];?>" class='preview'>
						  				<?php } ?>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>4</p>
									<input class="" type="radio" name="answer-check" value="4" required <?=$rwqna['ans_true']==4 ? "checked" : ""; ?>>
								</div>
								<div class="col-md-8">
								<textarea name="answer4" id="answer4" class="ckeditor answer-text"><?=$rwqna['answer4'];?></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat4" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		$selected = $rwanscat['id'] == $rwqna['ans_cat4'] ? "selected" : "";
								        		echo "<option {$selected} value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
								        	}
								        	 ?>
								        	
								        	
								        </select>
								    </div>
    							</div>
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">
										<?php $active = empty($rwqna['a_img4']) ? "" : "active"; ?>
										<a href="javascript:" class="imgclose ri-close-circle-line <?=$active;?>"></a>
										<input hidden class="form-control imgInput" name="answerimg4" type="file">
						  				<?php if(empty($rwqna['a_img4'])){ ?>
						  				<img src="images/preview.jpg" alt="preview" class='preview'>
						  				<?php }else{ ?>
						  				<img src="<?=$path.$rwqna['a_img4'];?>" alt="<?=$rwqna['a_img4'];?>" class='preview'>
						  				<?php } ?>
						  			</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<input type="submit" name="editRecord" class="submitInput" value="Edit Record">
			</div>
		</form>


		
	</div>
</div>

</div>	
</div>				
</section>
<script>
    // ClassicEditor.create( document.querySelector( '.ckeditoralter' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditortitle' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditor' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditor1' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditor2' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditor3' )).catch( error => { console.error( error ); } );
    // ClassicEditor.create( document.querySelector( '.ckeditor4' )).catch( error => { console.error( error ); } );
</script>
<?php include 'include/footer.php'; ?>

	