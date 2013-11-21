<div id="top-widgeted">
		<div class="wrap">
			<div class="widget widget_search">
			<?php get_search_form( true ); ?>
			</div>
			<?php switch_to_blog(1); ?>
			<?php if (!dynamic_sidebar('Top Right')) :
			?><div class="widget widget_text">			
				<div class="textwidget">1.800.252.7528</div>
					</div><?php 		
			endif;?>
			<div id="main-mobile"><a href="javascript: void(0);">Menu</a></div>
			<?php 
				
				if ( has_nav_menu( 'top-menu' ) ) {
					$args = array(
						'theme_location' => 'top-menu',
						'container' => 'top-menu',
						'depth' => 1,
						'menu_class' => 'top-menu',
						'echo' => 0
					);
				
					$nav = wp_nav_menu( $args );
							
					$nav_output = sprintf( '<div id="top-nav">%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'nav', '</div><!-- end .wrap -->', 0 ) );
							
					echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args );
				
				}
			 ?>
				</div><!-- end .wrap -->
	</div><!-- end #top-widgeted -->
	<?php restore_current_blog(); ?>