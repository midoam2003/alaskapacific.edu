<?php

// Template Name: Counseling Psych

require_once(CHILD_DIR.'/academics_functions.php');

add_action('genesis_before', 'template_load_the_scripts');
function template_load_the_scripts(){
	template_load_background('psych');
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	template_do_mobile_degrees();
	load_quick_links();
}

add_action('genesis_before_content_sidebar_wrap', 'template_do_caption');
function template_do_caption(){
	template_do_home_caption($home_page, 'Counseling Psych Slideshow Caption');
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 1);
function template_do_sidebar(){
		template_do_degrees();
		template_do_spotlight_sidebar(29);
}

//Add in the degree header tab
add_action('genesis_before_content_sidebar_wrap', 'template_do_title', 20);
function template_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(384); ?>"><?php echo get_the_title(384); ?></a></h1></div><?php
}

genesis();