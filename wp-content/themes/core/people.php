<?php


//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
		#menu-item-258 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
		
		#menu-item-1516 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/subnav-bg.gif") repeat-x 0 -39px transparent !important;
		}
	</style>
	<?php
}

remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_after_header', 'child_do_subnav');
function child_do_subnav() {
		$args = array(
					'theme_location' => 'home-menu', 
					'container' => '',
					'echo' => 0,
					'fallback_cb' => '', 
					'menu_class' => 'superfish'				
			);

		$subnav = wp_nav_menu( $args );

	
		$subnav_output = sprintf( '<div id="subnav">%2$s%1$s%3$s</div>', $subnav, genesis_structural_wrap( 'subnav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'subnav', '</div><!-- end .wrap -->', 0 ) );

		echo apply_filters( 'genesis_do_subnav', $subnav_output, $subnav, $args );
	
}  

remove_action( 'genesis_post_title', 'child_do_post_title' );
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h1></div><?php
}


genesis();