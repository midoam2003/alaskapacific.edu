<?php

// Template Name: Employment

//Load necessary scripts
add_filter('genesis_noposts_text','employment_noposts_text');
function employment_noposts_text() {
  $noposts_text = "There are no open positions at this time.";
  return $noposts_text;

}

add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
		#menu-item-260 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
	</style>
	<?php
}

remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_after_header', 'child_do_subnav');
function child_do_subnav() {

		$args = array(
					'theme_location' => 'explore-menu', 
					'container' => '',
					'echo' => 0,
					'fallback_cb' => '', 
					'menu_class' => 'superfish'				
			);

		$subnav = wp_nav_menu( $args );

	
		$subnav_output = sprintf( '<div id="subnav">%2$s%1$s%3$s</div>', $subnav, genesis_structural_wrap( 'subnav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'subnav', '</div><!-- end .wrap -->', 0 ) );

		echo apply_filters( 'genesis_do_subnav', $subnav_output, $subnav, $args );
}

add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>/about-apu/employment/">Employment</a></h1></div><?php
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('employment-menu');
	load_quick_links();
}

//Add in the sidebar menu
add_action('genesis_sidebar', 'template_do_sidebar_menu', 2);
function template_do_sidebar_menu(){
	$menu_name = 'employment-menu';
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
	<div class="widget"><a href="<?php echo get_bloginfo('url'); ?>/apply/" class="get-started">» Apply Now</a></div>
	
	
	<?php
	
	}
}



genesis();