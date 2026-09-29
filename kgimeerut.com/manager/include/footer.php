 <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 
<script src="js/script.js"></script>
<script src="js/datatables.min.js"></script>
<!--<script src="<?=$path;?>manager/tinymce/jquery.tinymce.min.js"></script>-->
<!--<script src="<?=$path;?>manager/tinymce/tinymce.min.js"></script>-->
<!--<script src="<?=$path;?>manager/tinymce/imageload.js"></script>-->
<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
	</script><script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js"></script>
<script>
	var url = window.location.href;
	

    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea.tinyMCE',
            plugins: [
                'image', 'code', 'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview', 
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'insertdatetime', 
                'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | bullist numlist checklist ' +
                        'outdent indent | removeformat | a11ycheck code table help | image',
            image_title: true,
            automatic_uploads: false,
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '../image/');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            success(response.url);
                        } else {
                            failure(response.message);
                        }
                    } else {
                        failure('HTTP Error: ' + xhr.status);
                    }
                };
                xhr.onerror = function() {
                    failure('An error occurred during image upload.');
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave(); // This ensures that the textarea is updated on change
                });
            }
        });
    });



	(function() {
	$('#submitForm').ajaxForm({
		beforeSubmit: function() {
			$('.msgbox').html("<div class='loading-wrapper'><span class='loading_span'></span><p>Please wailt...</p></div>");
		 },
	    success: function(data) {
	     	$('.msgbox').html(data);
	    },
	}); 
	
	})(); 


		(function() {
	$('#submitForm2').ajaxForm({
		beforeSubmit: function() {
			$('.msgbox').html("<div class='loading-wrapper'><span class='loading_span'></span><p>Please wailt...</p></div>");
		 },
	    success: function(data) {
	     	$('.msgbox').html(data);
	    },
	}); 
	
	})(); 
	
	
	$(document).ready(function(){
	    
	    $('#myTable').DataTable({
			"paging": false,
			"ordering": false,
			"searching": false,
			buttons: [
		       'copy', 'csv', 'excel', 'pdf', 'print'
		    ]
		});
		
	})
	
	
	$(document).on('click', '.menu-link', function(){
			$(".submenu").each(function(){
				$(this).slideUp(500);
			})

			if($(this).next().css('display')=='block'){
				$(this).next().slideUp(500);
			}else{
				$(this).next().slideDown(500);
			}
			
		})
		
		
		
	$(document).on("click", ".delbtn", function(){
			var id = $(this).attr('ide');
			swal({
				title: "Are you sure?",
				text: "Your will not be able to recover!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false,
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
			  if (willDelete) {
			   jQuery.ajax({
					url : url,
					type : "POST",
					data : {
						deletedata : 1,
						id : id,
					},
					dataType : "html",
					success : function(data){

						if(data){
						 	$("#remove"+id).hide();
							swal('Deleted Successfully', 'Click `OK` to Close', 'success');
							// location.reload();
						}else if(data){
							swal("Failed to Deleted!", "Failed to Deleted Data.", "error");
						}
					}
				})
			  }
			});
			

			});
		
		
		
		
$(document).on("click", ".preview", function(){
	$(this).prev().click();
	
})
$(document).on("change", ".imgInput", function(){
    var $input = $(this);
    var inputFiles = this.files;
    if(inputFiles == undefined || inputFiles.length == 0) return;
    var inputFile = inputFiles[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        $input.next().attr("src", event.target.result);
    };
    reader.onerror = function(event) {
        alert("I AM ERROR: " + event.target.error.code);
    };
    reader.readAsDataURL(inputFile);

   	$(this).prev().addClass('active');

})

 // add multiple images
// $(document).on("change", ".imgInputMultiple", function(){
//     var $input = $(this);
//     var inputFiles = this.files;
//     var imglength = inputFiles.length;
//     if(inputFiles == undefined || inputFiles.length == 0) return;
//     var inputFile = inputFiles[0];
//     var reader = new FileReader();
//     reader.onload = function(event) {
//         $input.next().attr("src", event.target.result);
//     };
//     reader.onerror = function(event) {
//         alert("I AM ERROR: " + event.target.error.code);
//     };
//     reader.readAsDataURL(inputFile);

//    	$(this).prev().addClass('active');

// })


    $(document).on("change", ".imgInputMultiple", function(){
        var files = $(this)[0].files;
        $("#gal-container").empty();
        if(files.length > 0){
            for(var i = 0; i < files.length; i++){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("<div class='gal-preview'><img src='" + e.target.result + "'><a href='javascript:' class='ri-delete-bin-line delete'></a></div>").appendTo("#gal-container");
                };
                reader.readAsDataURL(files[i]);
            }
           $('.imgquestion').hide();
           $('.clearallimgdiv').show();
        }


    });
	$("#gal-container").on("click", ".delete", function(){
		var length = $('.delete').length;
        $(this).parent(".gal-preview").remove();
        $("#file-input").val(""); // Clear input value if needed
        if(length <= 1){
        	$('.imgquestion').show();
          	$('.clearallimgdiv').hide();
        }
    });
	$("#clrimgs").on("click", function(){
        $('.clearallimgdiv').hide();
        $(".delete").each(function(){
        	$("#gal-container .gal-preview").remove();
        })
        $('.imgquestion').show();
	})


// ============= remove image from file input ===================
$(document).on("click", ".imgclose", function(){
	$(this).next().val('');
	$(this).next().next().attr('src', 'images/preview.jpg');
	$(this).removeClass('active')
	
});


$(document).on("input",".answer-text", function(){
	console.log($(this).val());
})



// update table data status active or inactive
$(document).on('change', '.form-check-input', function(){
var getId = $(this).attr('ide');
var table = $(this).data('table');
// alert(getId+", "+table);
// return false;
$.ajax({
	url:url,
	type: "POST",
	data : {updateStatus: 1, id:getId, table:table},
	success: function(data){
		window.location.reload();
		
	}
});
})


</script>

</body>
</html>