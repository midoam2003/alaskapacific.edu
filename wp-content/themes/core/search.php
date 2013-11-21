<?php

// @package Core

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('home-menu');
	load_quick_links();
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
	?> <div class="tab-title"><h1>Search Results</h1></div><?php
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'search_do_loop' );
function search_do_loop() {
	
	$search_query = get_search_query();
	$page_id = 0;
	$paged   = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	
	if($paged == 1) : 
	
	$desired_results = array(array('search_term' => 'tuition', 'id' => 4893, 'type' => 'page'), array('search_term' => 'transcript', 'id' => 6162, 'type' => 'page'), array('search_term' => 'employment', 'id' => 63, 'type' => 'page'), array('search_term' => 'athletics', 'id' => 768, 'type' => 'page'), array('search_term' => 'pool', 'id' => 834, 'type' => 'page'), array('search_term' => 'housing', 'id' => 801, 'type' => 'page'), array('search_term' => 'registrar', 'id' => 4861, 'type' => 'people'), array('search_term' => 'store', 'id' => 8010, 'type' => 'people'));
	
	foreach ($desired_results as $result) {
		if(strpos($search_query, $result['search_term']) !== false){
			if($result['type'] == 'page'){
				$query_args = wp_parse_args( genesis_get_custom_field( 'query_args' ), array( 'page_id'=> $result['id']) );
			}else{
				$query_args = wp_parse_args( genesis_get_custom_field( 'query_args' ), array( 'p'=> $result['id'], 'post_type' => $result['type']) );
			}
			$page_id = $result['id'];
			genesis_custom_loop( $query_args );
			break;
		}
	}
	
	endif;
	
	$query_args = wp_parse_args( genesis_get_custom_field( 'query_args' ), array( 's'=> $search_query, 'post__not_in' => array( $page_id ), 'paged' => $paged , 'post_type' => 'any'));
	genesis_custom_loop( $query_args );
	
}

remove_action( 'genesis_post_content', 'child_do_post_content' );
add_action( 'genesis_post_content', 'search_do_post_content' );
function search_do_post_content() {
	the_content_limit( 260, __( 'Read On', 'genesis' ) );

}

remove_action( 'genesis_post_title', 'genesis_do_post_title' );
add_action( 'genesis_post_title', 'search_do_post_title' );
function search_do_post_title(){
	$title = get_the_title();
	
	$title = sprintf( '<h2 class="entry-title"><a href="%s" title="%s" rel="bookmark">%s</a></h2>', get_permalink(), the_title_attribute( 'echo=0' ), apply_filters( 'genesis_post_title_text', $title ) );
	
	echo apply_filters( 'genesis_post_title_output', $title ) . "\n";
	
}

remove_action( 'genesis_post_content', 'genesis_do_post_image' );
add_action('genesis_before_post_title', 'search_do_post_image');
function search_do_post_image() {

	if ( genesis_get_option( 'content_archive_thumbnail' ) ) {
		$img = genesis_get_image( array( 'format' => 'html', 'size' => genesis_get_option( 'image_size' ), 'attr' => array( 'class' => 'alignleft post-image' ) ) );
		printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
	}

}

add_action( 'genesis_before_post_content', 'search_post_info' );
function search_post_info(){
	if(get_post_type() == 'post'){
		genesis_post_info();
	}
}


genesis();