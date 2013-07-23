<?php
	//Remove Theme Support to buy other themes
	remove_theme_support('genesis-purchase-menu');  
	
	// Add new image sizes
	add_image_size('Small', 280, 210, TRUE);
	
	
	
	
	
	
	//Checks to see if specific sidebars are in use
	function is_sidebar_active( $index = 1 ) {
		global $wp_registered_sidebars;
	
		if ( is_int( $index ) ) :
			$index = "sidebar-$index";
		else :
			$index = sanitize_title( $index );
			foreach ( (array) $wp_registered_sidebars as $key => $value ) :
				if ( sanitize_title( $value['name'] ) == $index ) :
					$index = $key;
					break;
				endif;
			endforeach;
		endif;
	
		$sidebars_widgets = wp_get_sidebars_widgets();
	
		if ( empty( $wp_registered_sidebars[$index] ) || !array_key_exists( $index, $sidebars_widgets ) || !is_array( $sidebars_widgets[$index] ) || empty( $sidebars_widgets[$index] ) )
			return false;
		else
			return true;
	}
	
	// Add Title and Sticky Post to page_blog template
	/*add_action ('genesis_before_loop', 'blog_page_info');
	function blog_page_info () {
		if (is_page_template('page_blog.php') ){ 
		genesis_standard_loop();
		}
	}*/
	
	//Show Read More
	remove_action('genesis_post_content', 'genesis_do_post_content');
	add_action('genesis_post_content', 'child_do_post_content');
	function child_do_post_content(){
	if( is_singular() ) {
			the_content(); // display content on posts/pages
			wp_link_pages( array( 'before' => '<p class="pages">' . __( 'Pages:', 'genesis' ), 'after' => '</p>' ) );
			
			if( is_single() ) {
				echo '<!--'; trackback_rdf(); echo '-->' ."\n";
			}
			
			if( is_page() ) {
				edit_post_link(__('(Edit)', 'genesis'), '', '');
			}
			
		}
		elseif( genesis_get_option('content_archive') == 'excerpts' ) {
			the_excerpt();
		}
		else {
			if( genesis_get_option('content_archive_limit') )
				the_content_limit( (int)genesis_get_option('content_archive_limit'), __('Read On', 'genesis') );
			else
				the_content(__('Read On', 'genesis'));
		}
	
	}
	
?>