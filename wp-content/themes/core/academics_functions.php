<?php

//Highlight academics in menu
add_action('genesis_before', 'template_load_styles');
function template_load_styles(){
	?><style>
		#menu-item-259 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px !important;
		}
	</style>
	<?php
}


//Load the background images
function template_load_background($directory){
	$dir = '/home/alaskapa/public_html/wp-content/themes/core/images/backgrounds/' . $directory . '/';
	$number = -2;
	// Open a known directory, and proceed to read its contents
	   if ($dh = opendir($dir)) {
	    	while (($file = readdir($dh)) !== false) {
	           $number++;
	        }
	        closedir($dh);
	    }
	    
	 if($number > 0) :
	?>
	<style>
		#wrap{
			background-image: none;
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var random = Math.floor(Math.random()*<?php echo $number; ?>);
		    $('.bg1').css('background-image', 'url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/backgrounds/<?php echo $directory; ?>/'+random+'.jpg)');  

		    $('.bg1').scrollingParallax({
			        bgHeight : '250%',
			        staticSpeed : .25,
			        staticScrollLimit : false
			    });
		});
	</script>
	<?php
	endif;
}


//Add Academics menu bar
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_after_header', 'template_do_subnav');
function template_do_subnav() {

		$args = array(
					'theme_location' => 'academics-menu', 
					'container' => '',
					'echo' => 0,
					'fallback_cb' => '', 
					'menu_class' => 'superfish'				
			);

		$subnav = wp_nav_menu( $args );

	
		$subnav_output = sprintf( '<div id="subnav">%2$s%1$s%3$s</div>', $subnav, genesis_structural_wrap( 'subnav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'subnav', '</div><!-- end .wrap -->', 0 ) );

		echo apply_filters( 'genesis_do_subnav', $subnav_output, $subnav, $args );
}


//Add home caption
function template_do_home_caption($home_page, $widget_name){
	if(is_page($home_page)):
		?><style>
				#inner {
				    margin-top: 30px;
				}
			</style>
			<div id="slideshow-caption"><?php
		if (!dynamic_sidebar($widget_name)) : 
			?>
			<div class="widget widget_text"><h4 class="widgettitle">Strong Statement Here</h4>			<div class="textwidget"><p>See, Do, Become. <br> 
			Only at APU</p>
			
			<a href="<?php echo get_bloginfo('url'); ?>/apply" class="get-started">» Let's Get Started</a></div>
					</div>
			<?php		
		endif;
		?></div>
		<?php
	endif;
}

function template_do_degrees(){
	$locations = get_nav_menu_locations();
	$menu_id = $locations['academics-menu'];
	$items = wp_get_nav_menu_items( $menu_id);
	$parent_id;
	$page = get_page(get_the_ID());
	
	$menu_HTML = '<div id="sidebar-nav">';
	$menu_HTML .= '<ul class="menu"><li id="'.$page->post_name.'-home"><a href="' . get_permalink(get_the_ID()) . '" title="'.get_the_title() . '">' .get_the_title() . '</a></li>';
	
	foreach ($items as $key => $item) {
		if($item->object_id == get_the_ID()){ 
			$parent_id = $item->ID;	
		}elseif($item->menu_item_parent == $parent_id){
			$menu_HTML .= '<li id="menu-item-'. $item->ID .'"><a href="' . $item->url . '" title="'.$item->title . '">' .$item->title . '</a></li>';
		}
	}
	
	$menu_HTML .= '</ul></div><div class="widget"><a class="get-started" href="'. get_bloginfo('url') .'/apply/">» Let\'s Get Started</a></div>';
		
	echo $menu_HTML;
	
}

function template_do_spotlight_sidebar($blog_category){
		$category = get_category($blog_category);
		
		$wp_query = new WP_Query(array( 'category__and' => array( $blog_category, 12 ), 'posts_per_page' => '1'));	
		if($wp_query->have_posts()) : 
		?>
		<div class="widget featuredpost">
			<h4 class="widgettitle"><?php echo $category->name; ?> Spotlight</h4>
			<?php 
			while($wp_query->have_posts()) : $wp_query->the_post(); 
			?>
				<div class="post">
					<?php 
					if(has_post_thumbnail()){
						?><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title(); ?>"><?php
						genesis_image(array('format'=>'html', 'size'=>'Home Page Tabs', 'attr' => 'class=alignleft post-image'));
						?></a><?php
					}
					?>
					<h2><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
					
					<?php 
					the_content_limit( 200, 'Read On'); 
					
					?>
					
				</div>
			<?php endwhile; 
				$category = get_category($blog_category); 
				echo '<p class="more-from-category"><a href="'.get_category_link($category->term_id ).'">See More from '.$category->cat_name.'</a></p>';
				
			?>
		</div>
		<?php	
		endif; 
}

function template_home_after_post_content($home_page, $blog_category){
	if(is_page($home_page)) :
	
		
		$wp_query = new WP_Query(array( 'category__and' => array( $blog_category, 27 ), 'posts_per_page' => '3'));	
			if($wp_query->have_posts()) : 
			?>
			<div class="widget featuredpost">
				<h4 class="widgettitle">Featured Items</h4>
				<?php 
				while($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<div class="post">
						<?php 
						if(has_post_thumbnail()){
							?><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title(); ?>"><?php
							genesis_image(array('format'=>'html', 'size'=>'Home Page Tabs', 'attr' => 'class=alignleft post-image'));
							?></a><?php
						}
						?>
						<h2><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
						
						<?php 
						the_content_limit( 200, 'Read On'); 
						
						?>
						
					</div>
				<?php 
				endwhile; 
				
				$category = get_category($blog_category); 
				echo '<p style="text-align: right"><a class="more-link" href="'.get_category_link($category->term_id ).'">See More from '.$category->cat_name.'</a></p>';
				
				?>
			</div>
			<?php	
			endif; 
			 wp_reset_query();
	endif;
	
}


?>