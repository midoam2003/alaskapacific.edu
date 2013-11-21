<?php

// Template Name: Directory

add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-position' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
}

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

remove_action( 'genesis_post_title', 'genesis_do_post_title' );
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
	?> <div class="tab-title"><h1><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h1></div><?php
}

remove_action('genesis_sidebar', 'genesis_do_sidebar');

//People pages
remove_action('genesis_after_post_content', 'child_add_people');
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
add_action('genesis_post_content', 'template_do_content');
function template_do_content(){

		?>
		<form id="search_people" action="<?php echo get_permalink(get_the_ID()); ?>/index.php" class="searchform" method="get">
					
					<input type="text" onblur="if (this.value == '') {this.value = 'search directory...';}" onfocus="if (this.value == 'search directory...') {this.value = '';}" class="s" id="search_directory" name="search" value="search directory...">
					<input type="submit" value="Search" class="searchsubmit">
				</form>
		<div id="tabs">
			<ul>
				<li><a href="#tabs-offices">Offices</a></li>
				<li><a href="#tabs-people">People</a></li>
				<li><a href="#tabs-search">Search</a></li>
			</ul>
			
			<div id="tabs-offices">
				<?php
				
					// save the original query
					global $wp_query;
					$orig_query = $wp_query;
					
					$wp_query = new WP_Query(array('post_type'=> 'people', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1', 'people-department' => 'office'));
					
					$counter = 0;
					
					
					if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
						$more = 0;
						$id = get_the_ID();
						$custom_fields = get_post_custom($id);
						$people_title = $custom_fields['title'][0];
						$people_phone = $custom_fields['phone'][0];
						$people_email = $custom_fields['email'][0];
						$people_resume = $custom_fields['resume'][0];
						
						$depts =  get_the_terms( $id, 'people-department' );
						
						genesis_before_post();
						
						?>
							<div <?php if($counter%2 > 0) post_class('second'); else post_class(); ?>>
							<a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>">
							<?php 
							if(has_post_thumbnail()){
								genesis_image(array('format'=>'html', 'size'=>'people_gallery', 'attr' => 'class=alignleft post-image'));
							} ?>
							</a>
							<h2 class="entry-title"><a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
							<p class="people-details">
							<?php if($people_title != '') echo $people_title . '<br />'; ?>
							<?php if($people_phone != '') echo $people_phone . '<br />'; ?>
							<?php if($people_email != '') echo '<a href="'. get_bloginfo('url') . '/contact/index.php?person='. $id .'" title="Email '. get_the_title() .'" >Email</a><br />'; ?>
							<?php if($people_resume != '') echo '<a href="'.$people_resume . '" title="Download CV for '. get_the_title() .'" target="_blank" >Download CV</a><br />'; ?>
							</p>
							</div>
						<?php
					$counter ++;
					genesis_after_post();	
					endwhile;
					endif;
					$wp_query = $orig_query; 
					wp_reset_query();
					?>
			</div>	
		
			<div id="tabs-people">
		<?php
	 
		// save the original query
		global $wp_query;
		$orig_query = $wp_query;
		
		$wp_query = new WP_Query(array('post_type'=> 'people', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1', 'tax_query' => array(
				array(
					'taxonomy' => 'people-department',
					'field' => 'slug',
					'terms' => 'office',
					'operator' => 'NOT IN'
				)
			)));
		
		$counter = 0;
		
		
		if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			$more = 0;
			$id = get_the_ID();
			$custom_fields = get_post_custom($id);
			$people_title = $custom_fields['title'][0];
			$people_phone = $custom_fields['phone'][0];
			$people_email = $custom_fields['email'][0];
			$people_resume = $custom_fields['resume'][0];
			
			$depts =  get_the_terms( $id, 'people-department' );
			
			genesis_before_post();
			
			?>
				<div <?php if($counter%2 > 0) post_class('second'); else post_class(); ?>>
				<a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>">
				<?php 
				if(has_post_thumbnail()){
					genesis_image(array('format'=>'html', 'size'=>'people_gallery', 'attr' => 'class=alignleft post-image'));
				} ?>
				</a>
				<h2 class="entry-title"><a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
				<h3><?php
				$counter = 0;
				foreach ( $depts as $dept ) {
						if($dept->parent == 0) {
							if($counter == 0){
								echo $dept->name;
							}else{
								echo ', ' .$dept->name;
							}
						$counter++;
						}
					}?>
				</h3>
				<p class="people-details">
				<?php if($people_title != '') echo $people_title . '<br />'; ?>
				<?php if($people_phone != '') echo $people_phone . '<br />'; ?>
				<?php if($people_email != '') echo '<a href="'. get_bloginfo('url') . '/contact/index.php?person='. $id .'" title="Email '. get_the_title() .'" >Email</a><br />'; ?>
				<?php if($people_resume != '') echo '<a href="'.$people_resume . '" title="Download CV for '. get_the_title() .'" target="_blank" >Download CV</a><br />'; ?>
				</p>
				</div>
			<?php
		$counter ++;
		genesis_after_post();	
		endwhile;
		endif;
		$wp_query = $orig_query; 
		wp_reset_query();
		?></div>
		<div id="tabs-search">
			<?php 
				if($_GET['search']){
					global $wp_query;
					$orig_query = $wp_query;
					
					$wp_query = new WP_Query(array('s' => $_GET['search'],'post_type'=> 'people', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
					
					$counter = 0;
					
					if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
						$more = 0;
						$id = get_the_ID();
						$custom_fields = get_post_custom($id);
						$people_title = $custom_fields['title'][0];
						$people_phone = $custom_fields['phone'][0];
						$people_email = $custom_fields['email'][0];
						$people_resume = $custom_fields['resume'][0];
						
						$depts =  get_the_terms( $id, 'people-department' );
						
						genesis_before_post();
						
						?>
							<div <?php if($counter%2 > 0) post_class('second'); else post_class(); ?>>
							<a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>">
							<?php 
							if(has_post_thumbnail()){
								genesis_image(array('format'=>'html', 'size'=>'people_gallery', 'attr' => 'class=alignleft post-image'));
							} ?>
							</a>
							<h2 class="entry-title"><a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
							<h3><?php
							$counter = 0;
							foreach ( $depts as $dept ) {
									if($counter == 0){
										echo $dept->name;
									}else{
										echo ', ' .$dept->name;
									}
									$counter++;
								}?>
							</h3>
							<p class="people-details">
							<?php if($people_title != '') echo $people_title . '<br />'; ?>
							<?php if($people_phone != '') echo $people_phone . '<br />'; ?>
							<?php if($people_email != '') echo '<a href="'. get_bloginfo('url') . '/contact/index.php?person='. $id .'" title="Email '. get_the_title() .'" >Email</a><br />'; ?>
							<?php if($people_resume != '') echo '<a href="'.$people_resume . '" title="Download CV for '. get_the_title() .'" target="_blank" >Download CV</a><br />'; ?>
							</p>
							</div>
						<?php
					$counter ++;
					genesis_after_post();	
					endwhile;
					else :
						?><p>No directory listings were found matching your criteria.</p><?php
					endif;
					$wp_query = $orig_query; 
					wp_reset_query();
					
				}else{
					?><p>Please input criteria into the search form.<?php
				}
			 ?>
		</div></div>
		<script>
			jQuery(document).ready(function($) {
				var availableTags = [
							<?php
								$auto_complete_people = get_posts(array('post_type'=> 'people', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
								$people_counter = 1;
								$people_length = count($auto_complete_people);
								
								foreach ($auto_complete_people as $person) {
									echo '"' . $person->post_title . '"';
									if($people_counter < $people_length){
										echo ',
										';
									}
									$people_counter++;
								}
								
								
							?>
						];
				jQuery( "#search_directory" ).autocomplete({
							source: availableTags,
							focus: function( event, ui ) {
								$j( "#search_directory" ).val( ui.item.label );
								return false;
							},
							select: function( event, ui ) {
								jQuery( "#search_directory" ).val( ui.item.label );
								jQuery("#search_people").submit();
							}
						});
				
				jQuery( "#tabs" ).tabs(
			
		<?php 
			if($_GET['search']){ echo '{ selected: 2 }';}
		?>
		);
		});
		</script>
			<?php

}



genesis();