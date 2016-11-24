var $ = jQuery.noConflict();
jQuery(document).ready(function($){
	$('.breeze-upload-button').on('click',function(e){
		var mediaUploader;
		var imgFieldId = $.trim($(this).attr('data-id'));

		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose your image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		mediaUploader.on('select',function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#'+imgFieldId).val(attachment.url);
			$('#'+imgFieldId+'_preview').attr('src', attachment.url).show();

			console.debug('#'+imgFieldId);
			console.debug(attachment);
		});
		
		mediaUploader.open();
	});
	$('.breeze-remove-button').on('click',function(e){
		var imgFieldId = $.trim($(this).attr('data-id'));
		e.preventDefault();
		var answer = confirm('Are you sure you want to remove.');
		if(answer == true){
			$('#'+imgFieldId).val('');
			$('#'+imgFieldId+'_preview').attr('src','').hide();
			$('.theme-option-form').submit();
		}
	});
	$('.color-picker').wpColorPicker();
});