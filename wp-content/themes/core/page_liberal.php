<?php

// Template Name: Liberal Studies

require_once(CHILD_DIR.'/academics_functions.php');

add_action('genesis_before', 'template_load_the_scripts');
function template_load_the_scripts(){
	template_load_background('liberal');
}

add_action('genesis_before_content_sidebar_wrap', 'template_do_caption');
function template_do_caption(){
	template_do_home_caption($home_page, 'Liberal Studies Slideshow Caption');
}


remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 1);
function template_do_sidebar(){
		template_do_degrees();
		template_do_spotlight_sidebar(25);
}

//Add in the degree header tab
add_action('genesis_before_content_sidebar_wrap', 'template_do_title', 20);
function template_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(388); ?>"><?php echo get_the_title(388); ?></a></h1></div><?php
}

//If the home page, add in the blog items
add_action('genesis_after_post_content', 'template_after_post_content');
function template_after_post_content(){
	template_home_after_post_content(get_the_ID(), 25);
	
}

genesis();