<?php

// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');
require_once(CHILD_DIR.'/lib/apu-main-menu-walker.php');
require_once(CHILD_DIR . '/tools/theme-shortcodes.php');
require_once(CHILD_DIR . '/tools/theme-structure.php');
require_once(CHILD_DIR . '/campus_map.php');
require_once(CHILD_DIR . '/people_post_type.php');
require_once(CHILD_DIR . '/sundog_category_widget.php');


//Change stylesheet to all media types
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'genesis_meta', 'template_load_stylesheet' );
function template_load_stylesheet() {
	echo '<link rel="stylesheet" href="'.get_bloginfo( 'stylesheet_url' ). '?v='.filemtime( get_stylesheet_directory() . '/style.css' ).'" type="text/css" media="all" />'."\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>'."\n";
	
}

//Add page templates to admin
function set_edit_page_columns($columns) {
    return array_merge($columns, 
              array('template' => __('Page Template')));
}
add_filter('manage_edit-page_columns' , 'set_edit_page_columns');

function custom_page_columns($column)
{
	global $post;
	switch ($column)
	{
		case 'template':
			$template_name = get_post_meta( get_the_ID(), '_wp_page_template', true );
			echo $template_name; 
			break;
	}
}
add_action( 'manage_pages_custom_column' , 'custom_page_columns' );

//Call background images
add_action('genesis_before', 'theme_load_the_scripts');
function theme_load_the_scripts(){
	$background_field = genesis_get_custom_field('background');
	if($background_field == 'featured') :
		$background_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		
		if($background_image) :
	?>
	<style>
		#wrap{
			background-image: url('<?php echo $background_image[0];  ?>');
		}
	</style>
	<?php
	endif;
	endif;
}

//Mobile Functions
function load_main_menu(){
	?><div id="mobile-nav"><?php 
			get_search_form( true );
			if ( has_nav_menu( 'primary' ) ) {
				$args = array(
					'theme_location' => 'primary',
					'container' => 'primary',
					'depth' => 1,
					'menu_class' => 'menu',
					'echo' => 0
				);
			
				$nav = wp_nav_menu( $args );
						
				$nav_output = sprintf( '<div id="main-menu"><h2>Main Menu</h2>%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'nav', '</div><!-- end .wrap -->', 0 ) );
						
				echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args ); }	
}

function load_page_menu($menu_name){
	if ( has_nav_menu( $menu_name) ) {
				$args = array(
					'theme_location' => $menu_name,
					'container' => $menu_name,
					'menu_class' => 'menu superfish',
					'echo' => 0
				);
			
				$nav = wp_nav_menu( $args );
						
				$nav_output = sprintf( '<div id="section-menu"><h2>Section Menu</h2>%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'nav', '</div><!-- end .wrap -->', 0 ) );
						
				echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args ); }	
}

function load_quick_links(){

		if ( has_nav_menu( 'top-menu' ) ) {
					$args = array(
						'theme_location' => 'top-menu',
						'container' => 'top-menu',
						'depth' => 1,
						'menu_class' => 'menu',
						'echo' => 0
					);
				
					$nav = wp_nav_menu( $args );
							
					$nav_output = sprintf( '<div id="quick-links"><h2>Quick Links</h2>%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'nav', '</div><!-- end .wrap -->', 0 ) );
							
					echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args ); }
					
		?></div><?php
		
}
//Add posts if query_args set
add_action( 'genesis_loop', 'theme_do_loop', 10);
function theme_do_loop(){
	$query = genesis_get_custom_field( 'query_args' );
	
	if($query != '' && !is_page_template ( 'page_blog.php' )) :
		$category_name = get_cat_name(str_replace('cat=','', $query));
		if($category_name) echo '<h4 class="widgettitle">' . $category_name . '</h4>';
		$query_args = wp_parse_args( $query, array('showposts' => genesis_get_option( 'blog_cat_num' )));
		genesis_custom_loop( $query_args );
	endif;
}

//Load necessary scripts
add_action('genesis_before', 'child_load_scripts');
function child_load_scripts(){
	wp_register_script( 'menu-position', trailingslashit( get_bloginfo('stylesheet_directory') ).'js/menu-position.js'); 
	wp_enqueue_script( 'menu-position' );
	
	wp_register_script( 'jquery-mobile', trailingslashit( get_bloginfo('stylesheet_directory') ).'js/jquery.mobile.custom.min.js'); 
	wp_enqueue_script( 'jquery-mobile' );
	
	if(!is_home()){
		$page_ID = get_the_ID();
	}
	
	?>
		<script type="text/javascript">
		/*jQuery(document).ready(function() {
			var link = jQuery("#menu-item-330 a").attr("href");
			jQuery("#menu-item-330 a").attr("href", link+"index.php?page="+<?php echo $page_ID; ?>);
			
		});
			*/	
		jQuery(document).keyup(function(e){
		  if (e.ctrlKey && (e.keyCode == 57 || e.charCode == 57 )) {
		      jQuery("#inner").toggle();
		       jQuery("#footer-widgets").toggle();
		        jQuery("#footer").toggle();
		    };
		    
		    if (e.ctrlKey && (e.keyCode == 55 || e.charCode == 55 )) {
		        alert("Sundog Media Rocks!");
		      };
		})
		</script>
	<?php 
}


// Add widgeted top section
add_action('genesis_before_header', 'child_include_top_widgets'); 
function child_include_top_widgets() {
	 require(CHILD_DIR.'/top-widgeted.php');
}

//Customize search box language
add_filter('genesis_search_text', 'child_search_text');
function child_search_text($text) {
 	return esc_attr('search website...');
}

add_action('genesis_after', 'theme_scripts');
function theme_scripts(){
	?>
	<script type="text/javascript">
			
		jQuery(document).ready(function() {
			jQuery('#main-mobile a').click(function() {
			  jQuery("#wrap").toggleClass("hidden");
			});	
		});
		
		jQuery(document).on( "swiperight", document, function() {
		            jQuery("#wrap").addClass("hidden");
		   });
		   
		 jQuery(document).on( "swipeleft", document, function() {
		             jQuery("#wrap").removeClass("hidden");
		    });
		
		
		</script>
	<?php
}


//Customize main menu to output description
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_header', 'genesis_do_header');
add_action('genesis_header', 'child_do_header');
function child_do_nav(){
	switch_to_blog(1);
	
	if ( has_nav_menu( 'primary' ) ) {
	
				$args = array(
					'theme_location' => 'primary',
					'container' => '',
					'echo' => 0,
					'depth' => 1,
					'walker' => new APU_Main_Menu_Walker('main-menu') 
					
				);
	
				$nav = wp_nav_menu( $args );
	
			}
	
			$nav_output = sprintf( '<div id="nav">%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'nav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'nav', '</div><!-- end .wrap -->', 0 ) );
	
			echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args );
	
	restore_current_blog();
}

//Put the main menu in the header div
function child_do_header(){ ?>
	 <?php switch_to_blog(1); ?>
	 <div id="title-area">
	 <?php genesis_site_title(); ?>
	 <?php genesis_site_description(); ?>
	 </div><!-- end #title-area -->
	 
	 <div class="widget-area">
	 <?php
	 dynamic_sidebar('Header Right');
	 child_do_nav(); ?>
	 </div><!-- end .widget-area -->
		<?php restore_current_blog();
}


add_action('genesis_before_footer', 'child_do_before_footer');
function child_do_before_footer(){
	
	?>
	<div class="footer-widgets" id="footer-widgets"><div class="wrap">
		<?php switch_to_blog(1); 
		
		$args = array(
		    'numberposts'     => 5,
		   'category'        => 6 );	
		$footer_posts = get_posts( $args );
		$counter = 0;
		
		foreach($footer_posts as $post){
			?>
			<div class="post <?php if($counter == 4) echo 'end'; ?>">
			<?php
				echo $post->post_content;
			?>
			</div>
			<?php
			$counter++;
		}	
		
		restore_current_blog();?>
	</div></div>
	<?php
	
}

//Chat button
add_action('genesis_after_header', 'child_do_chat', 20);
function child_do_chat(){
	?>
	<div id="chat"><a onclick="lpButtonCTTUrl = 'http://server.iad.liveperson.net/hc/17642027/?cmd=file&amp;file=visitorWantsToChat&amp;site=17642027&amp;imageUrl=http://www.alaskapacific.edu/admissions/PublishingImages/LivePerson/&amp;referrer='+escape(document.location); lpButtonCTTUrl = (typeof(lpAppendVisitorCookies) != 'undefined' ? lpAppendVisitorCookies(lpButtonCTTUrl) : lpButtonCTTUrl); lpButtonCTTUrl = ((typeof(lpMTag)!='undefined' &amp;&amp; typeof(lpMTag.addFirstPartyCookies)!='undefined')?lpMTag.addFirstPartyCookies(lpButtonCTTUrl):lpButtonCTTUrl);window.open(lpButtonCTTUrl,'chat17642027','width=475,height=400,resizable=yes');return false;" target="chat17642027" href="http://server.iad.liveperson.net/hc/17642027/?cmd=file&amp;file=visitorWantsToChat&amp;site=17642027&amp;byhref=1&amp;imageUrl=http://www.alaskapacific.edu/admissions/PublishingImages/LivePerson/">Need Help? Click to Chat!</a></div>
	<?php
}

//Add in the the request information lin
add_action('genesis_sidebar', 'child_do_sidebar', 20);
function child_do_sidebar(){
	?>
		
		<div class="widget call-to-action"><a class="button request" href="<?php switch_to_blog(1); echo get_bloginfo('url'); restore_current_blog();?>/apply/" class="information-request">Apply Today</a></div>
		<br />
		<div class="widget call-to-action"><a class="button request" href="<?php switch_to_blog(1); echo get_bloginfo('url'); restore_current_blog();?>/info/" class="information-request">Request Information</a></div>
		<br />
		<div class="widget call-to-action"><a class="button request" href="<?php switch_to_blog(1); echo get_bloginfo('url'); restore_current_blog();?>/apply/visit-campus" class="information-request">Visit Campus</a></div>

		<br />
		
		<div class="widget"><!-- BEGIN LivePerson Button Code --><a href='http://server.iad.liveperson.net/hc/17642027/?cmd=file&file=visitorWantsToChat&site=17642027&byhref=1&imageUrl=<?php echo get_bloginfo('url'); ?>/wp-content/themes/core/images/' target='chat17642027'  onClick="lpButtonCTTUrl = 'http://server.iad.liveperson.net/hc/17642027/?cmd=file&file=visitorWantsToChat&site=17642027&imageUrl=<?php echo get_bloginfo('url'); ?>/wp-content/themes/core/images/&referrer='+escape(document.location); lpButtonCTTUrl = (typeof(lpAppendVisitorCookies) != 'undefined' ? lpAppendVisitorCookies(lpButtonCTTUrl) : lpButtonCTTUrl); lpButtonCTTUrl = ((typeof(lpMTag)!='undefined' && typeof(lpMTag.addFirstPartyCookies)!='undefined')?lpMTag.addFirstPartyCookies(lpButtonCTTUrl):lpButtonCTTUrl);window.open(lpButtonCTTUrl,'chat17642027','width=475,height=400,resizable=yes');return false;" >
		<img src='http://server.iad.liveperson.net/hc/17642027/?cmd=repstate&site=17642027&channel=web&&ver=1&imageUrl=<?php echo get_bloginfo('url'); ?>/wp-content/themes/core/images/' name='hcIcon' border=0></a><!-- END LivePerson Button code --></div>
	<?php
}

//Modify post meta, post info and post title for people
remove_action('genesis_after_post_content', 'genesis_post_meta');
add_action('genesis_after_post_content', 'child_post_meta');
function child_post_meta(){
	if(get_post_type() == 'post' && !is_search()){
		genesis_post_meta();
	}
}

remove_action('genesis_before_post_content', 'genesis_post_info');
add_action('genesis_before_post_content', 'child_post_info');
function child_post_info(){
	if(get_post_type() == 'post' && !is_search()){
		genesis_post_info();
	}
}

// Customizes go to top text and credits
add_filter('genesis_post_info', 'child_post_info_filter', 10, 3);
function child_post_info_filter($post_info) {
if (!is_page()) {
    $post_info = '[post_date] [post_comments] [post_edit]';
    return $post_info;
}}

//Campus map
add_action('genesis_post_content', 'child_add_map');
function child_add_map(){
	if(is_page(35)){ 
		do_map();
	}
}

//People pages
add_action('genesis_after_post_content', 'child_add_people');
function child_add_people(){
	$people_field = genesis_get_custom_field('people');
	
	if(get_post_type() == 'people' && has_term( 'office', 'people-department') ) :
		$office = get_post(get_the_ID());
	//	echo 'This is the name ' . $office->post_name;
		$department = get_term_by('slug', $office->post_name, 'people-department' );
	
		if($department) $people_field = $office->post_name;
	endif;
	
	if($people_field != ''){ 
		// save the original query
		global $wp_query;
		$orig_query = $wp_query;
		
		$dept = get_term_by('slug', $people_field, 'people-department');
		
		if($people_field != 'all') {
			$wp_query = new WP_Query(array('post_type'=> 'people', 'people-department' => $people_field, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
		}else{
			$wp_query = new WP_Query(array('post_type'=> 'people', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
		}
		
		$counter = 0;
		
		?><div id="people"><?php
		
		if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			$more = 0;
			$id = get_the_ID();
			$custom_fields = get_post_custom($id);
			$people_title = $custom_fields['title'][0];
			$people_phone = $custom_fields['phone'][0];
			$people_email = $custom_fields['email'][0];
			$people_resume = $custom_fields['resume'][0];
			
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
				<?php if($people_email != '') echo '<a href="'. get_bloginfo('url') . '/contact/index.php?person='. $id .'" title="Contact '. get_the_title() .'" >Contact</a><br />'; ?>
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
		?></div><?php
		
	}
}

//Contact Form
add_filter("gform_pre_render_3", "modify_form_title_desc");
function modify_form_title_desc($form){
	if($_GET["person"]) :
		$person_id = $_GET["person"];
		$name = get_the_title($person_id);
		$custom_fields = get_post_custom($person_id);
		$email = $custom_fields['email'][0];
		
		$form['title'] = 'Contact ' . $name;
		$form['description'] = 'Please fill out the form below to contact  ' . $name . '.  Thank you!';
		$form["notification"]["to"] = $email . ',kym.van.arsdale@gmail.com';
		$form["notification"]["from"] = $email;
		$form["autoResponder"]["from"] = $email;
		
		$form["fields"][4]['defaultValue'] = $person_id;
		
	endif;
	
	return $form;
}

//Feedback Form
add_filter("gform_pre_render_4", "capture_page_link");
function capture_page_link($form){
	//print_r($form);
	if($_GET["page"]) :
		$link = get_permalink($_GET["page"]);
	else :
		$link = get_bloginfo('url');
		
	endif;
			
		foreach($form["fields"] as &$field){
		        if($field["id"] == 5){            
		            $field["defaultValue"] = $link;
		        }
		}		 
		
	
	return $form;
}


//Post/Event Submittal
add_filter("gform_pre_render", "populate_dropdown");
function populate_dropdown($form){
	if($form["id"] != 5)
		 return $form;
	
	//Creating drop down item array.
	$items = array();
	
	$category_values = get_terms('events_categories', 'hide_empty=0');
	foreach($category_values as $value)
	        $items[] = array("value" => $value->name, "text" => $value->name);
	        
	foreach($form["fields"] as &$field)
	        if($field["id"] == 8){            
	            $field["choices"] = $items;
	        }
	
	    return $form;
}

add_action("gform_pre_submission_filter_3", "change_delivery_email", 10, 2);
function change_delivery_email($form){
	//print_r($_POST);
	
	if($_POST["input_6"]) :
		$person_id = $_POST["input_6"];
		$custom_fields = get_post_custom($person_id);
		$email = $custom_fields['email'][0];
		
		$form["notification"]["to"] = $email;
		
	endif;
	
	return $form;
}


add_filter("gform_post_data", "change_post_type", 10, 2);      
function change_post_type($post_data, $form){
    //only change post type on form id 5
    if($form["id"] != 5)
       return $post_data;
       
   
    if($_POST["input_5"] == 'Calendar Event'){
    	$post_data["post_type"] = "ai1ec_event";
    	
   }
    return $post_data;
}

add_action("gform_post_submission", "set_post_content", 10, 2);
function set_post_content($entry, $form){
	if($form["id"] != 5)
	   return $post_data;
	   
	//print_r($_POST);
	      
    //getting post
    $post = get_post($entry["post_id"]);

    //Add taxonomy
    wp_set_object_terms( $entry["post_id"], $_POST["input_8"], 'events_categories');
    
    //Add start date & time
    global $wpdb;
    $table_name = $wpdb->prefix . 'ai1ec_events';
    
   	$start_time = $_POST["input_7"][0]. ':' .  $_POST["input_7"][1]. ' ' .  $_POST["input_7"][2];
    $start_hours = date("H", STRTOTIME($start_time));
    $start_minutes = date("i", STRTOTIME($start_time));
    $start = convert_date(strtotime($_POST["input_6"] . " " . ($start_hours - 8). ":" . $start_minutes) + (8*60*60));
    $start_date = date("Y-m-d H:i:s",  $start);
    
    $end_time = $_POST["input_10"][0]. ':' .  $_POST["input_10"][1]. ' ' .  $_POST["input_10"][2];
    $end_hours = date("H", STRTOTIME($end_time));
    $end_minutes = date("i", STRTOTIME($end_time));
    $end = convert_date(strtotime($_POST["input_9"] . " " . ($end_hours - 8) . ":" . $end_minutes) + (8*60*60));
    $end_date = date("Y-m-d H:i:s",  $end);
    
    $venue = $_POST["input_11"];
    $cost = $_POST["input_18"];
    
    $contact_name = $_POST["input_14_3"] . ' ' . $_POST["input_14_6"];
    $contact_email = $_POST["input_15"];
    $contact_phone = $_POST["input_16"];
      
   /*$wpdb->query( $wpdb->prepare( "INSERT INTO `wp_ai1ec_events`(`post_id`, `start`, `end`, `venue`, `cost`, `contact_name`, `contact_email`, `contact_phone`) VALUES (".$entry["post_id"].",'". $start_date."','". $end_date."','".$venue ."','".$cost ."','". $contact_name."','".$contact_email ."','".$contact_phone ."');", '' ));*/
   
   $wpdb->query( $wpdb->prepare( "INSERT INTO `wp_ai1ec_events`(`post_id`, `start`, `end`, `venue`, `cost`, `contact_name`, `contact_email`, `contact_phone`) VALUES (%d,%s,%s,%s,%s,%s,%s,%s);", $entry["post_id"], $start_date, $end_date, $venue, $cost, $contact_name, $contact_email, $contact_phone ));

    //updating post
    wp_update_post($post);
}

function convert_date( $timestamp ) {
		$offset = get_option( 'gmt_offset' );
		$tz     = get_option( 'timezone_string', 'America/Los_Angeles' );

		$offset = get_timezone_offset( 'UTC', $tz, $timestamp );

		if( ! $offset )
			$offset = get_option( 'gmt_offset' ) * 3600;

		return $timestamp - $offset;
	}
	
function get_timezone_offset( $remote_tz, $origin_tz = null, $timestamp = false ) {
		// set timestamp to time now
		if( $timestamp == false ) {
			$timestamp = gmmktime();
		}

		if( $origin_tz === null ) {
			if( ! is_string( $origin_tz = date_default_timezone_get() ) ) {
				return false; // A UTC timestamp was returned -- bail out!
			}
		}

		try {
			$origin_dtz = new DateTimeZone( $origin_tz );
			$remote_dtz = new DateTimeZone( $remote_tz );

			// if DateTimeZone fails, throw exception
			if( $origin_dtz == false || $remote_dtz == false )
				throw new Exception( 'DateTimeZone class failed' );

			$origin_dt  = new DateTime( gmdate( 'Y-m-d H:i:s', $timestamp ), $origin_dtz );
			$remote_dt  = new DateTime( gmdate( 'Y-m-d H:i:s', $timestamp ), $remote_dtz );

			// if DateTime fails, throw exception
			if( $origin_dt == false || $remote_dt == false )
				throw new Exception( 'DateTime class failed' );

			$offset = $origin_dtz->getOffset( $origin_dt ) - $remote_dtz->getOffset( $remote_dt );
		} catch( Exception $e ) {
			return false;
		}

		return $offset;
	}

// Add widgeted footer section
add_action('genesis_footer', 'child_footer', 6); 
function child_footer() {
	switch_to_blog(1);
	 if ( has_nav_menu( 'sub-footer-menu' ) ) {
    		$args = array(
    			'theme_location' => 'sub-footer-menu',
    			'container' => 'sub-footer-menu',
    			'depth' => 0,
    			'menu_class' => 'sub-footer-menu',
    			'echo' => 0
    		);
    	
    		$nav = wp_nav_menu( $args );
    				
    		echo '<div id="sub-footer-nav">' . $nav . '</div>';
    	
    	}
    restore_current_blog();
}


// Customizes go to top text and credits
add_filter('genesis_footer_output', 'footer_output_filter', 10, 3);
function footer_output_filter($output, $backtotop_text, $creds_text) {
	$footer_menu = "";
	
	if ( has_nav_menu( 'footer-menu' ) ) {
			$args = array(
				'theme_location' => 'footer-menu',
				'container' => 'footer-menu',
				'depth' => 0,
				'menu_class' => 'footer-menu',
				'echo' => 0
			);
		
		$footer_menu = wp_nav_menu( $args );
	}

    $backtotop_text = '[footer_backtotop text="Return to Top of Page"]';
    $creds_text = 'Copyright [footer_copyright] <a href="'. trailingslashit( get_bloginfo('url') ) .'" title="'. esc_attr( get_bloginfo('name') ) .'">'.get_bloginfo('name').'</a>. All Rights Reserved &middot; Website by <a href="http://www.sundogmedia.com">Sundog Media</a>.';
    $output = '<div class="gototop">' . $backtotop_text . '</div>' . '<div class="creds">' .$footer_menu. $creds_text . '</div>';
    return $output;
}

//Get event time and date for event tab widget
function get_event_time($event){
	$timespan = '';
	$long_start_date = $event->long_start_date;
	$long_end_date   = $event->long_end_date;
	
	if( $event->allday ) {
			$timespan .= $long_start_date;
			if( $long_end_date != $long_start_date )
							$timespan .= " – $long_end_date";
						$timespan = esc_html( $timespan );
						$timespan .= '<span class="ai1ec-allday-label">';
						$timespan .= __( ' (all-day)', AI1EC_PLUGIN_NAME );
						$timespan .= '</span>';
					} else {
						if( $long_end_date != $long_start_date )
							$timespan .= esc_html( $event->long_start_time . ' – ' . $event->long_end_time );
						elseif( $event->start != $event->end )
							$timespan .= esc_html( $event->long_start_time . ' - ' . $event->end_time );
						else
							$timespan .= esc_html( $event->long_start_time );
					}
					
	return $timespan;
}




// Add new image sizes
add_image_size('APU Spotlight', 150, 160, FALSE);
add_image_size('Home Page Tabs', 90, 80, TRUE);
add_image_size('Footer Widget', 166, 108, TRUE);

//Register menus
register_nav_menu( 'home-menu', __( 'Home Menu', 'genesis' ) );
register_nav_menu( 'explore-menu', __( 'Explore Menu', 'genesis' ) );
register_nav_menu( 'at-a-glance-menu', __( 'At a Glance Menu', 'genesis' ) );
register_nav_menu( 'employment-menu', __( 'Employment Menu', 'genesis' ) );
register_nav_menu( 'giving-menu', __( 'Giving Menu', 'genesis' ) );
register_nav_menu( 'mission-menu', __( 'Mission & Goals Menu', 'genesis' ) );
register_nav_menu( 'president-menu', __( 'President\'s Office Menu', 'genesis' ) );
register_nav_menu( 'conferencing-menu', __( 'Conferencing Service Menu', 'genesis' ) );
register_nav_menu( 'academics-menu', __( 'Academics Menu', 'genesis' ) );
register_nav_menu( 'earth-sciences-menu', __( 'Earth Sciences', 'genesis' ) );
register_nav_menu( 'environmental-policy-menu', __( 'Environmental Policy', 'genesis' ) );
register_nav_menu( 'environmental-science-menu', __( 'Environmental Science', 'genesis' ) );
register_nav_menu( 'environmental-studies-menu', __( 'Environmental Studies', 'genesis' ) );
register_nav_menu( 'marine-menu', __( 'Marine Biology', 'genesis' ) );
register_nav_menu( 'mses-menu', __( 'MSES', 'genesis' ) );
register_nav_menu( 'accounting-menu', __( 'Accounting', 'genesis' ) );
register_nav_menu( 'anelp-menu', __( 'Alaska Native Executive Leadership Program (ANELP)', 'genesis' ) );
register_nav_menu( 'business-admin-menu', __( 'Business Admin', 'genesis' ) );
register_nav_menu( 'graduate-certificate-menu', __( 'Graduate Certificate', 'genesis' ) );
register_nav_menu( 'hsa-menu', __( 'HSA', 'genesis' ) );
register_nav_menu( 'mba-menu', __( 'MBA', 'genesis' ) );
register_nav_menu( 'counseling-menu', __( 'Counseling Psych', 'genesis' ) );
register_nav_menu( 'human-services-aa-menu', __( 'Human Services AA', 'genesis' ) );
register_nav_menu( 'human-services-ba-menu', __( 'Human Services BA', 'genesis' ) );
register_nav_menu( 'ms-counseling-menu', __( 'MS Counseling Psych', 'genesis' ) );
register_nav_menu( 'doctorate-psych-menu', __( 'Doctorate Psych', 'genesis' ) );
register_nav_menu( 'coop-menu', __( 'Teacher CO-OP', 'genesis' ) );
register_nav_menu( 'education-k8-menu', __( 'Education K-8', 'genesis' ) );
register_nav_menu( 'mat-menu', __( 'MAT', 'genesis' ) );
register_nav_menu( 'teaching-certificate-menu', __( 'Teaching Certificate', 'genesis' ) );
register_nav_menu( 'career-tech-education-menu', __( 'Career & Tech Education', 'genesis' ) );
register_nav_menu( 'sustainability-menu', __( 'Sustainability Studies', 'genesis' ) );
register_nav_menu( 'liberal-menu', __( 'Liberal Studies', 'genesis' ) );
register_nav_menu( 'ma-menu', __( 'Masters of Arts', 'genesis' ) );
register_nav_menu( 'premed-menu', __( 'Pre-Med', 'genesis' ) );
register_nav_menu( 'outdoor-studies-menu', __( 'Outdoor Studies', 'genesis' ) );
register_nav_menu( 'land-management-menu', __( 'Land Management', 'genesis' ) );
register_nav_menu( 'outdoor-education-menu', __( 'Outdoor Education', 'genesis' ) );
register_nav_menu( 'snow-science-menu', __( 'Snow Science', 'genesis' ) );
register_nav_menu( 'tourism-menu', __( 'Tourism', 'genesis' ) );
register_nav_menu( 'wilderness-therapy-menu', __( 'Wilderness Therapy', 'genesis' ) );
register_nav_menu( 'msoee-menu', __( 'MSOEE', 'genesis' ) );
register_nav_menu( 'early-honors-menu', __( 'Early Honors', 'genesis' ) );
register_nav_menu( 'campus-menu', __( 'On Campus Menu', 'genesis' ) );
register_nav_menu( 'facilities-menu', __( 'Facilities Menu', 'genesis' ) );
register_nav_menu( 'moseley-menu', __( 'Moseley Menu', 'genesis' ) );
register_nav_menu( 'nordic-menu', __( 'Nordic Ski Menu', 'genesis' ) );
register_nav_menu( 'student-life-menu', __( 'Student Life Menu', 'genesis' ) );
register_nav_menu( 'student-services-menu', __( 'Student Services Menu', 'genesis' ) );
register_nav_menu( 'admissions-menu', __( 'Apply Menu', 'genesis' ) );
register_nav_menu( 'financial-aid-menu', __( 'Financial Aid Menu', 'genesis' ) );
register_nav_menu( 'expedition-menu', __( 'Expedition Menu', 'genesis' ) );
register_nav_menu( 'top-menu', __( 'Top Menu', 'genesis' ) );
register_nav_menu( 'sub-footer-menu', __( 'Sub Footer Menu', 'genesis' ) );
register_nav_menu( 'footer-menu', __( 'Footer Menu', 'genesis' ) );

unregister_nav_menu('secondary');

// Register sidebars

genesis_register_sidebar(array(
	'name'=>'Home Slideshow Caption',
	'description' => 'This is the top right section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Home Active Learning',
	'description' => 'This is the Active Learning tab of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Home We Are APU',
	'description' => 'This is the We Are APU tab of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Home Primary Sidebar',
	'description' => 'This is the right column of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Blog Primary Sidebar',
	'description' => 'This is the right column of the blog page.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Sub Footer',
	'description' => 'This is the sub footer of all pages.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Environmental Science Slideshow Caption',
	'description' => 'This is the top right section of the Environmental Science homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Business Admin Slideshow Caption',
	'description' => 'This is the top right section of the Business Admin homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Counseling Psych Slideshow Caption',
	'description' => 'This is the top right section of the Counseling Psych homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Education Slideshow Caption',
	'description' => 'This is the top right section of the Education homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Liberal Studies Slideshow Caption',
	'description' => 'This is the top right section of the Liberal Studies homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

genesis_register_sidebar(array(
	'name'=>'Outdoor Studies Slideshow Caption',
	'description' => 'This is the top right section of the Liberal Studies homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

?>