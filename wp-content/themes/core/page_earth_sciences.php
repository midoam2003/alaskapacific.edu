<?php

// Template Name: Earth Sciences

require_once(CHILD_DIR.'/academics_functions.php');
require_once(CHILD_DIR.'/degree_functions.php');


add_action('genesis_before', 'template_load_the_scripts');
function template_load_the_scripts(){
	template_load_background('earth_science');
}

//Add in the Earth Sciences menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	template_do_dept_sidebar_menu('earth-sciences-menu');
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 7);
function template_do_sidebar(){
		template_do_spotlight_sidebar(56);
}

//If the home page, add in the Earth Sciences Home widget area
add_action('genesis_after_post_content', 'template_after_post_content');
function template_after_post_content(){
	template_home_after_post_content(410, 56);
}

//Add in the Earth Sciences header tab
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(410); ?>"><?php echo get_the_title(410); ?></a></h1></div><?php
}


genesis();


