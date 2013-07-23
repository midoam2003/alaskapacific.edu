<?php

// Template Name: Academics

require_once(CHILD_DIR.'/academics_functions.php');

add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>/academics/">Academics</a></h1></div><?php
}

//Add in the sidebar menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	$menu_name = 'academics-menu';
	if ( has_nav_menu( $menu_name ) ) {
	
	$args = array(
					'theme_location' => $menu_name,
					'container' => '',
					'echo' => 0,
					'depth' => 1, 
					'fallback_cb' => '', 
					'menu_class' => 'superfish menu',
					'items_wrap'      => '%3$s',	
				);
	
	$nav = wp_nav_menu( $args );
	
	$nav_output = sprintf( '<div id="sidebar-nav"><ul class="superfish menu sf-js-enabled"><li class="menu-item" id="academics-home"><a href="'. get_permalink(6) .'">'. get_the_title(6) .'</a></li>%2$s%1$s%3$s</ul></div>', $nav, genesis_structural_wrap( 'sidebar-nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'sidebar-nav', '</div><!-- end .wrap -->', 0 ) );
	
	
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	
	echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args );
	
	?>
	<div class="widget"><a href="<?php echo get_bloginfo('url'); ?>/apply/" class="get-started">» Let's Get Started</a></div>
	
	
	<?php
	
	}
	
}



genesis();