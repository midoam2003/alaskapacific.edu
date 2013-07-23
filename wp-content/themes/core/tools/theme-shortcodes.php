<?php
	//Add Google Map shortcode
	function fn_googleMaps($atts, $content = null) {
	   extract(shortcode_atts(array(
	      "width" => '',
	      "height" => '',
	      "address" => '',
	      "scrolling" => ''
	   ), $atts));
	
	return '<div id="map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="'.$scrolling.'" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=' .$address.'&amp;output=embed"></iframe></div>';
	}
	add_shortcode("googlemap", "fn_googleMaps");

?>