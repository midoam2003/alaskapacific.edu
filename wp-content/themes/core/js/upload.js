jQuery(document).ready(function() {

 
jQuery('#upload_resume_button').click(function() {
		var post_id = document.getElementById('upload_post_id').value;
	
		window.send_to_editor = function(html) {
	 	pdfurl = jQuery(html).attr('href');
	 	 jQuery('#upload_data').val(pdfurl);
	 	
	 	tb_remove();
	 	}
	 
	 	tb_show('', 'media-upload.php?post_id='+post_id +'&TB_iframe=1');
	 	return false;});
 
 
});
 
