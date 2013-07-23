<?php

//Load necessary scripts

add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
	global $blog_id;
	if ($blog_id == 1) :
?><style>
		#menu-item-258 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px !important;
		}
	</style>
	<?php
	endif;
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

add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	global $blog_id;
	if ($blog_id == 1) :
	?> <div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>/apu-blog">APU Blog</a></h1></div><?php
	elseif  ($blog_id == 5) :
	?> <div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>">News & Events</a></h1></div><?php
	
	endif;
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_sidebar', 'template_do_sidebar', 4);
function template_do_sidebar(){
	if (!dynamic_sidebar('Blog Primary Sidebar')) : 
	endif;
}

genesis();