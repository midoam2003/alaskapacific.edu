<?php

// Template Name: Expedition

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('expedition-menu');
	load_quick_links();
}

//Add in the sidebar menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	$menu_name = 'expedition-menu';
	if ( has_nav_menu( $menu_name ) ) {
	
	$args = array(
					'theme_location' => $menu_name,
					'container' => '',
					'echo' => 0,
					'depth' => 0, 
					'fallback_cb' => '', 
					'menu_class' => 'superfish menu'	
				);
	
	$nav = wp_nav_menu( $args );
	
	$nav_output = sprintf( '<div id="sidebar-nav">%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'sidebar-nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'sidebar-nav', '</div><!-- end .wrap -->', 0 ) );
	
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	
	echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args );
	
	?>
	<div class="widget call-to-action"><a href="<?php echo get_bloginfo('url'); ?>/apply/" class="get-started">» Apply Now</a></div>
	<div class="widget call-to-action"><a href="<?php echo get_bloginfo('url'); ?>/info/" class="get-started">» Request Info</a></div>
	<div class="widget call-to-action"><a href="<?php echo get_bloginfo('url'); ?>/apply/visit-campus" class="get-started">» Visit Campus</a></div>

	<br />
	
	
	<?php
	
	}
	
	
}

genesis();