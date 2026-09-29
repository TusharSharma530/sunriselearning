var base_url = '//localhost/healthjagran/';
var url = window.href;
var image_type = 'main';
var data_list_item_id = '';
var data_is_update = '';
var data_editor_id = '';

$('#addmediapopup').on('show.bs.modal', function (e) {
    image_type = $(e.relatedTarget).attr('data-image-type');
    data_is_update = $(e.relatedTarget).attr('data-is-update');
    if (image_type == 'list_item') {
        data_list_item_id = $(e.relatedTarget).attr('data-list-item-id');
    }
    if (image_type == 'list_item_editor') {
        data_editor_id = $(e.relatedTarget).attr('data-editor-id');
    }
    //refresh_images();
});


$(document).on("click","#image_file_upload_response .file-box",function(){
	
	$('#image_file_upload_response .file-box').removeClass('selected');
	
    $(this).addClass('selected');
	
    $('#selected_img_file_id').val($(this).attr('data-file-id'));
    $('#selected_img_mid_file_path').val($(this).attr('data-mid-file-path'));
    $('#selected_img_default_file_path').val($(this).attr('data-default-file-path'));
    $('#selected_img_slider_file_path').val($(this).attr('data-slider-file-path'));
    $('#selected_img_big_file_path').val($(this).attr('data-big-file-path'));
    $('#btn_img_delete').show();
    $('#btn_img_select').show();
});



//select image file
$(document).on('click', '#btn_img_select', function () {
    select_image();
});

//select image file on double click
$(document).on('dblclick', '#btn_img_select .file-box', function () {
    select_image();
});

function select_image() {
    var file_id = $('#selected_img_file_id').val();
    var img_mid_file_path = $('#selected_img_mid_file_path').val();
    var img_default_file_path = $('#selected_img_default_file_path').val();
    var img_slider_file_path = $('#selected_img_slider_file_path').val();
    var img_big_file_path = $('#selected_img_big_file_path').val();

     if (image_type == 'editor') {
        tinymce.activeEditor.execCommand('mceInsertContent', false, '<p><img src="' + base_url + img_default_file_path + '" alt=""/></p>');
    }else if (image_type == 'additional') {
        var image = '<div class="additional-item additional-item-' + file_id + '"><img class="img-additional" src="' + base_url + img_mid_file_path + '" alt="">' +
            '<input type="hidden" name="additional_post_image_id[]" value="' + file_id + '">' +
            '<a class="btn btn-danger btn-sm btn-delete-additional-image" data-value="' + file_id + '">' +
            '<i class="fa fa-times"></i> ' +
            '</a>' +
            '</div>';
        $('.additional-image-list').append(image);
    }else{
        var image = '<div class="post-select-image-container">' +
            '<img src="' + base_url + img_mid_file_path + '" alt="">' +
            '<a id="btn_delete_post_main_image" class="btn btn-danger btn-sm btn-delete-selected-file-image">' +
            'x' +
            '</a>' +
            '</div>';
        document.getElementById("post_select_image_container").innerHTML = image;
        $('input[name=post_image_id]').val(file_id);
    }

    $('#addmediapopup').modal('toggle');
    $('.file-box').removeClass('selected');
    $('#btn_img_delete').hide();
    $('#btn_img_select').hide();
	
	 
}

/***************** DELETE IMAGE ****************/
//delete image file
$(document).on('click', '#btn_img_delete', function () {
    var file_id = $('#selected_img_file_id').val();
    $('#img_col_id_' + file_id).remove();
    var data = {
        "deleteimage": 1,
        "file_id": file_id
    };
    //data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
			//alert(response);
            $('#btn_img_delete').hide();
            $('#btn_img_select').hide();
        }
    });
});



/******************* IMAGE UPLOAD ********************/
 
    function init_tinymce(selector, min_height) {
        var menu_bar = 'file edit view insert format tools table help';
       /*  if (selector == '.tinyMCEQuiz') {
            menu_bar = false;
        } */
        tinymce.init({
            selector: selector,
            min_height: min_height,
            valid_elements: '*[*]',
            relative_urls: false,
            remove_script_host: false,
            
            menubar: menu_bar,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code codesample fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: 'fullscreen code preview | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent',
            content_css: ['tinymce/editor_content.css'],
        });
        tinymce.DOM.loadCSS('tinymce/editor_ui.css');
    }

    if ($('.tinyMCE').length > 0) {
        init_tinymce('.tinyMCE', 500);
    }
    if ($('.tinyMCEsmall').length > 0) {
        init_tinymce('.tinyMCEsmall', 300);
    }
    if ($('.tinyMCEQuiz').length > 0) {
        init_tinymce('.tinyMCEQuiz', 200);
    }

 

$(document).ready(function(){

  

 
	$('#UploadImage').ajaxForm({
		beforeSubmit: function() {
			$('#browseupload').hide();
		$('.imagemsg').html("<div class='processmsg'>Processing...</div>");
		 },
	    success: function(data) {
	    $('.imagemsg').html(data);
		//defaultLoadImages();
		},
	}); 
	function emptymsg(){
		$('.imagemsg').html("");
	}
	
});
$('#uploadFile').change(function() {
$("#submitbtn").click();
});  
  
	
$(document).on("click","#btn_delete_post_main_image",function(){
	$("#post_image_id").val('');
	 var image = "<label data-toggle='modal' data-target='#myModal' data-image-type='main'><span class='imageicon'><i class='material-icons'>image</i></span><span class='btnselect'>Select Image</span></label>";
        document.getElementById("post_select_image_container").innerHTML = image;	
});	
 
	
 	
/***************** IMAGE LOAD ******************/
 defaultLoadImages();
       //checkWindowSize();

        // Check if the page has enough content or not. If not then fetch records
        function checkWindowSize(){
            if($('.uploadlistproduct').height() >= $('.uploadlistproduct').height()){
                  // Fetch records
                 // fetchData();
            }
        }
$('.uploadlistproduct').on('scroll', function(e){
  var t = $(this);
  if(t[0].scrollHeight - t.scrollTop() - t.outerHeight() < 1){
    fetchData();
  } 
})
        // Fetch records
        function fetchData(){
             var start = Number($('#start').val());
             var allcount = Number($('#totalrecords').val());
             var rowperpage = Number($('#rowperpage').val());
             start = start + rowperpage;

             if(start <= allcount){
                  $('#start').val(start);

                  $.ajax({
                       url:"tinymce/ajaximage.php",
                       type: 'post',
                       data: {start:start,rowperpage: rowperpage},
                       success: function(response){

                            // Add
                            $(".post:last").after(response).show().fadeIn("slow");

                            // Check if the page has enough content or not. If not then fetch records
                            checkWindowSize();
                       }
                  });
             }
        }

        $(document).on('touchmove', onScroll); // for mobile
       
        function onScroll(){

             if($(window).scrollTop() > $(document).height() - $(window).height()-100) {

                   fetchData(); 
             }
        }

        $(window).scroll(function(){

             var position = $(window).scrollTop();
             var bottom = $(document).height() - $(window).height();

             if( position == bottom ){
                    fetchData(); 
             }

        });
function defaultLoadImages(){
	  $.ajax({
    url:url,
    type: 'post',
    data: {
		defaultloaddata:1
		},
    success: function(data){
	 $('.imagedata').html(data);
     }
                  });  
	
}


//delete additional image
$(document).on('click', '.btn-delete-additional-image', function () {
    var item_id = $(this).attr("data-value");
    $('.additional-item-' + item_id).remove();
});
