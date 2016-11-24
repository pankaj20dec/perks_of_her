$(document).ready(function(){
	$('.re-control.re-del img').click(function(){
		alert('Changes will not reflect on frontend until you press the "Update" button !');
		$(this).closest('.at-repater-block').remove();		
	})
	
});