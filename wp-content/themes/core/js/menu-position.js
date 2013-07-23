jQuery(document).ready(function(jQuery) {
	var width = jQuery(window).width(); 
	var margin = (width-980)/2;
	
	jQuery('.superfish li.columns').each(function(index) {
	   if(!jQuery(this).parent().hasClass('sub-menu')){
	    var position = jQuery(this).position();
	    var margin_left = margin - position.left;
	    var children = jQuery(this).children('.sub-menu');
	    
	    children.each(function(index) {
	    	 jQuery(this).css('margin-left', margin_left);
	    });
	   
	    }
	});
	
	
	
});