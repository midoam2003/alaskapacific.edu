<?php

// Template Name: Health Services Administration

//Add in academics and degree functions
require_once(CHILD_DIR.'/academics_functions.php');
require_once(CHILD_DIR.'/degree_functions.php');

//Call the function for background images
add_action('genesis_before', 'template_load_the_scripts');
function template_load_the_scripts(){
	template_load_background('hsa');
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('hsa-menu');
	load_quick_links();
}

//Add in the degree sidebar menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	template_do_dept_sidebar_menu('hsa-menu');
}

//Add in the spotlight sidebar widget, pass category id
remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 7);
function template_do_sidebar(){
		template_do_spotlight_sidebar(64);
}

//If the home page, add in the blog items
add_action('genesis_after_post_content', 'template_after_post_content');
function template_after_post_content(){
	template_home_after_post_content(2524, 64);
}

//Add in the degree header tab
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(2524); ?>"><?php echo get_the_title(2524); ?></a></h1></div><?php
}

genesis();


