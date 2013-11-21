<?php

// Template Name: Environmental Science

require_once(CHILD_DIR.'/academics_functions.php');
require_once(CHILD_DIR.'/degree_functions.php');


add_action('genesis_before', 'template_load_the_scripts');
function template_load_the_scripts(){
	template_load_background('environmental_science');
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('environmental-science-menu');
	load_quick_links();
}

//Add in the Environmental Science menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	template_do_dept_sidebar_menu('environmental-science-menu');
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 7);
function template_do_sidebar(){
		template_do_spotlight_sidebar(21);
}

//If the home page, add in the Environmental Science Home widget area
add_action('genesis_after_post_content', 'template_after_post_content');
function template_after_post_content(){
	template_home_after_post_content(414, 21);
}

//Add in the Environmental Science header tab
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(414); ?>"><?php echo get_the_title(414); ?></a></h1></div><?php
}

genesis();


