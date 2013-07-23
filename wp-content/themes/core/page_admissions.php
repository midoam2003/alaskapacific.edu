<?php

// Template Name: Admissions

//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
		#menu-item-409 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
	</style>
	<?php
}

remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_after_header', 'child_do_subnav');
function child_do_subnav() {

		$args = array(
					'theme_location' => 'admissions-menu', 
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
	?> <div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>/apply/">Apply</a></h1></div><?php
}

//Add posts if query_args set
add_action( 'genesis_loop', 'template_do_loop', 10);
function template_do_loop(){
	$query = genesis_get_custom_field( 'query_args' );
	
	if($query != '') :
		$query_args = wp_parse_args( $query, array('showposts' => genesis_get_option( 'blog_cat_num' )));
		genesis_custom_loop( $query_args );
	endif;
}

genesis();