<?php 
error_reporting(E_ERROR);
add_action('genesis_before', 'child_load_more_scripts');
function child_load_more_scripts(){
	global $blog_id;
	if ( $blog_id == 1) :
	
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	
	$dir = get_bloginfo('stylesheet_directory') . '/images/backgrounds/home/';
	$number = -2;
	// Open a known directory, and proceed to read its contents

		$front = true;
	   // if ($dh = opendir($dir)) {
	   //  	while (($file = readdir($dh)) !== false) {
	   //         $number++;
	           
	   //      }
	   //      closedir($dh);
	   //  }
	    
	 if($front) :
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			//var random = Math.floor(Math.random()*<?php echo $number; ?>);
			var random = Math.floor(Math.random() * 8) + 1;
		    $('#wrap').css('background-image', 'url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/backgrounds/home/' + random + '.jpg)');  
		});
	</script>
	<?php
	endif;
	
	else:
	switch_to_blog(1);
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			 $('#wrap').css('background-image', 'url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/backgrounds/home/0.jpg)'); 
			 $('#header ul.menu li.current-menu-item a').css('background-position', 'right bottom');
		});
	</script>
	<?php
	 restore_current_blog();
	endif;
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

get_header(); 

genesis_home(); 

global $blog_id;

if (is_sidebar_active('Home Slideshow Caption') && $blog_id == 1) :
 ?>
<div id="slideshow-caption">
	<?php if (!dynamic_sidebar('Home Slideshow Caption')) : ?>		
		<?php endif; ?>
</div><!-- end #slideshow-caption -->

<?php elseif($blog_id == 5): ?> 

<div class="tab-title"><h1><a href="<?php echo get_bloginfo('url'); ?>">News &amp; Events</a></h1></div>

<?php endif; ?> 

<div id="content-sidebar-wrap">
	<div id="content" class="hfeed">
			<div id="home-bottom-left">
				<?php 
				
				if (!dynamic_sidebar('Home Bottom Left') && $blog_id == 1) :
				 ?>
				
				<div id="tabs"><div class="wrap">
					<ul>
					<li><a href="#tabs-this-week">Events</a></li>
					<li><a href="#tabs-we-are-apu">We Are APU</a></li>
					<li><a href="#tabs-active-learning">Active Learning</a></li>
					<li><a href="#tabs-faculty">Faculty</a></li>
					
					
					</ul>
					
					<div id="tabs-this-week">
						<?php  
						
						
						//$events = get_posts(array('post_type' => 'ai1ec_event', 'numberposts' => -1, 'events_categories' => 'this-week'));
						
						global $wpdb;
						
						$querystr = "
						    SELECT $wpdb->posts.* 
						    FROM $wpdb->posts, wp_ai1ec_events
						    WHERE $wpdb->posts.post_type = 'ai1ec_event'
						    AND $wpdb->posts.ID = wp_ai1ec_events.post_id 
						    AND $wpdb->posts.post_status = 'publish'
						    AND wp_ai1ec_events.start > DATE_ADD(CURDATE(), INTERVAL 8 HOUR)
						    ORDER BY wp_ai1ec_events.start ASC
						    LIMIT 0, 6
						 ";
						
						 $events = $wpdb->get_results($querystr, OBJECT);
						
						if ($events) :
						
						foreach ($events as $key => $event) {
								setup_postdata($event);
								$event_instance = new Ai1ec_Event($event->ID); 
								
								?><div class="post event">
								<?php $images = get_posts(array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $event->ID )); 
									if ($images) {
										?><a title="<?php echo $event->post_title; ?>" href="<?php echo get_permalink($event->ID); ?>"><?php
										echo wp_get_attachment_image( $images[0]->ID, 'Home Page Tabs' );
										?></a><?php
									} 
								?>
								
								<h2><a title="<?php echo $event->post_title; ?>" href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title ?></a></h2>
								<p class="post-info"><span class="date"><?php echo get_event_time($event_instance);?></span><br /><span class="location"><?php echo $event_instance->venue;?></span></p>
								<?php echo the_content_limit(200, ''); ?> 
								<a class="more-link" title="Read On" href="<?php echo get_permalink($event->ID); ?>">Read On</a>
								</div><?php
								wp_reset_postdata();
							}
						else :
						
						?><p>There are no events currently scheduled.<?php
							
						endif;
							
						?>
						<p class="more-from-category"><a href="<?php echo get_bloginfo('url'); ?>/university-calendar" title="See More Events">See More Events</a></p>
						
					</div>
					
					<div id="tabs-active-learning">
						<?php if (!dynamic_sidebar('Home Active Learning')) : ?>
						<?php endif; ?>
					</div>
					
					<div id="tabs-faculty">
									<?php $people = get_posts(array('post_type' => 'people', 'numberposts' => 10, 'people-featured' => 'home-tab'));
									
									foreach ($people as $key => $person) {
											setup_postdata($person);
											
											?><div class="post event">
											<a title="<?php echo $person->post_title; ?>" href="<?php echo get_permalink($person->ID); ?>"><?php 	echo get_the_post_thumbnail( $person->ID, 'Home Page Tabs' );  ?></a>
											
											<h2><a title="<?php echo $person->post_title; ?>" href="<?php echo get_permalink($person->ID); ?>"><?php echo $person->post_title ?></a></h2>
											<p><?php echo $person->post_excerpt; ?> 
											<a class="more-link" title="Read On" href="<?php echo get_permalink($person->ID); ?>">Read On</a></p>
											</div><?php
											wp_reset_postdata();
										}
										
									?>
									<p class="more-from-category"><a href="<?php echo get_bloginfo('url'); ?>/academics/faculty" title="See More Faculty">See More Faculty</a></p>
									</div>
					
					<div id="tabs-we-are-apu">
						<?php if (!dynamic_sidebar('Home We Are APU')) : ?>
						<?php endif; ?>						</div>
					
				</div></div>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$( "#tabs" ).tabs();
					});
					</script>	
				<?php  
					else :  genesis_do_loop(); 
					
					endif;
				?>
			</div><!-- end #home-bottom-left -->
   </div><!-- end #content -->
    
    <div id="sidebar" class="home-sidebar">
    	<?php if (!dynamic_sidebar('Home Primary Sidebar')) : ?>
    	<?php genesis_do_sidebar(); ?>
       	<?php endif; ?>
    </div><!-- end #sidebar -->
    
</div><!-- end #content-sidebar-wrap -->



<?php get_footer(); ?>