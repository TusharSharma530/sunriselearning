<?php include 'config.php';
	$title = 'Add Questions & Answers';
if(!isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager'</script>";
	}




$id = $_GET['id'];

if(isset($_POST['addRecord'])){
	$testid = $id;


	if(!empty($_FILES['questionimg']['name'])){ $questionimg = createImgWebp("questionimg", "questions-answers");}else{$questionimg='';}
	$questiontitle = trim(mysqli_real_escape_string($con, $_POST['question-title']));
	$question = $_POST['question'];
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
			$answerimg1 =  "";			
		}
	}else{
		$answerimg1 = "";
	}
	$answer2 = trim($_POST['answer2']);
	if(empty($answer2)){
		if(!empty($_FILES['answerimg2']['name'])){
			$answerimg2 =  createImgWebp("answerimg2", "questions-answers");
		}else{
			$answerimg2 =  "";			
		}

	}else{
		$answerimg2 = "";
	}
	$answer3 = trim($_POST['answer3']);
	if(empty($answer3)){
	 if(!empty($_FILES['answerimg3']['name'])){
			$answerimg3 =  createImgWebp("answerimg3", "questions-answers");
		}else{
			$answerimg3 =  "";			
		}
	}else{
		$answerimg3 = "";
	}
	$answer4 = trim($_POST['answer4']);
	if(empty($answer4)){
	 if(!empty($_FILES['answerimg4']['name'])){
			$answerimg4 =  createImgWebp("answerimg4", "questions-answers");
		}else{
			$answerimg4 =  "";			
		}
	}else{
		$answerimg4 = "";
	}


	$sqlcheck = mysqli_query($con,"SELECT * FROM `questions_answers` WHERE `question` = '$question'");
	if(mysqli_num_rows($sqlcheck)){
		echo "<script>swal('Question Already in Record', 'Click `OK` to try Again', 'warning'); $('#submitForm').show();  </script>";
	}else{

	$sql = mysqli_query($con, "INSERT INTO `questions_answers` (`id`, `testid`, `question_title`, `question`, `q_img`, `answer1`, `a_img1`, `answer2`, `a_img2`, `answer3`, `a_img3`, `answer4`, `a_img4`, `question_mark`, `ans_true`, `ans_cat1`, `ans_cat2`, `ans_cat3`, `ans_cat4`) VALUES(Null, '$testid', '$questiontitle', '$question', '$questionimg', '$answer1', '$answerimg1', '$answer2', '$answerimg2', '$answer3', '$answerimg3', '$answer4', '$answerimg4','$question_marks', '$ans_true', '$ans_cat1', '$ans_cat2', '$ans_cat3', '$ans_cat4')");

	if($sql){
		echo "<script>swal('Added Successfully', 'Click `OK` to Close', 'success'); $('#submitForm').remove();  </script>";
		echo "<div class='col-md-12 padd0 text-center'><a href='addquestion-answer.php?id={$id}' class='btn btn-primary'>Create New</a></div>";
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
			<h3>Add Questions & Answers</h3>
		</div>
		<div class="createbtn">
			<a href="test.php"> Test List</a>
			<a href="questions-answers.php?id=<?=$id;?>"> Q&A List</a>
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
						<textarea name="question-title" id="questiontag" class="ckeditor"></textarea>
					</div>
					<div class="col-md-12">
						<div class="fields fields-question">
							<label for="question" class="form-label label-question">Question :-</label>
							<div class="row">
								<div class="col-md-8">
								<textarea name="question" class="ckeditor"></textarea>
    								<div class="question-bottom">
    								    <div class="marks">
    								        <label>Question Marks :</label>
    								        <input type='number' name='question-marks' required>
    								    </div>
    								    
    								    <div class="orimage-question">
    								        <a href="javascript:" id="addalternatequestion">Add Alternate Question</a>
    								    </div>
    								</div>
    								<!--<div class="alternatequestion">-->
							     <!--       <label class="form-label label-question">Alternate Question</label>-->
    								<!--    <textarea name="alternatequestion" class="ckeditoralter"></textarea>-->
    								<!--</div>-->
								</div>
								<div class="col-md-1">
									<div class="or text-center">
										<span>OR</span>									
									</div>
								</div>
								<div class="col-md-3">
									<div class="imgquestion">
										<a href="javascript:" class="imgclose ri-close-circle-line"></a>
										<input hidden class="form-control imgInput" name="questionimg" type="file">
						  				<img src="images/preview.jpg" alt="2" class='preview'>
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
									<input class="" type="radio" name="answer-check" value="1" required checked>
								</div>
								<div class="col-md-8">
								<textarea name="answer1" class="ckeditor answer-text"></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat1" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		echo "<option value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
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
										<a href="javascript:" class="imgclose ri-close-circle-line"></a>
										<input hidden class="form-control imgInput" name="answerimg1" type="file">
						  				<img src="images/preview.jpg" alt="2" class='preview'>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>2</p>
									<input class="" type="radio" name="answer-check" value="2" required>
								</div>
								<div class="col-md-8">
								<textarea name="answer2" class="ckeditor answer-text"></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat2" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		echo "<option value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
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
										<a href="javascript:" class="imgclose ri-close-circle-line"></a>
										<input hidden class="form-control imgInput" name="answerimg2" type="file">
						  				<img src="images/preview.jpg" alt="2" class='preview'>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>3</p>
									<input class="" type="radio" name="answer-check" value="3" required>
								</div>
								<div class="col-md-8">
								<textarea name="answer3" class="ckeditor answer-text"></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat3" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		echo "<option value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
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
										<a href="javascript:" class="imgclose ri-close-circle-line"></a>
										<input hidden class="form-control imgInput" name="answerimg3" type="file">
						  				<img src="images/preview.jpg" alt="2" class='preview'>
						  			</div>
								</div>
							</div>
							<div class="row row-answer">
								<div class="answer-no-input">
									<p>4</p>
									<input class="" type="radio" name="answer-check" value="4" required>
								</div>
								<div class="col-md-8">
								<textarea name="answer4" class="ckeditor answer-text"></textarea>
								<div class="question-bottom">
								    <div class="marks">
								        <label>Answer Category</label>
								        <select name="ans_cat4" required>
								        	<option value="">--Select--</option>
								        	<?php $sqlanscat = mysqli_query($con, "SELECT * FROM `ans_category` ORDER BY `id` DESC");
								        	while($rwanscat = mysqli_fetch_array($sqlanscat)){
								        		echo "<option value='{$rwanscat['id']}'>{$rwanscat['title']}</option>";
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
										<a href="javascript:" class="imgclose ri-close-circle-line"></a>
										<input hidden class="form-control imgInput" name="answerimg4" type="file">
						  				<img src="images/preview.jpg" alt="2" class='preview'>
						  			</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<input type="submit" name="addRecord" class="submitInput" value="Add Record">
			</div>
		</form>


		
	</div>
</div>

</div>	
</div>				
</section>
<script>
    //  ClassicEditor.create( document.querySelector( '.ckeditoralter' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditortitle' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditor' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditor1' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditor2' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditor3' )).catch( error => { console.error( error ); } );
    //  ClassicEditor.create( document.querySelector( '.ckeditor4' )).catch( error => { console.error( error ); } );
</script>

	<?php include 'include/footer.php'; ?>


