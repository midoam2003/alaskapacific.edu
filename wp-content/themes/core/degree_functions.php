<?php
	function template_do_dept_sidebar_menu($menu_name){
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
	
	
?>