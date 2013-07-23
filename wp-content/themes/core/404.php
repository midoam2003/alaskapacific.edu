<?php
/**
 * Handles display of 404 page.
 *
 */

//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
		#menu-item-258 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px !important;
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
	?> <div class="tab-title"><h1>Page Not Found</h1></div><?php
}

/** Remove default loop **/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() { ?>

	<div class="post hentry">

		<h1 class="entry-title"><?php _e( 'Not Found, Error 404', 'genesis' ); ?></h1>
		<div class="entry-content">
			<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), home_url() ); ?></p>

			<div class="archive-page">

				<h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>

				

			</div><!-- end .archive-page-->

			

		</div><!-- end .entry-content -->

	</div><!-- end .postclass -->

<?php
}

genesis();
