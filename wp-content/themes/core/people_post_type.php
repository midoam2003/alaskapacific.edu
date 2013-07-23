<?php


class People {
	var $meta_fields = array("title", "phone", "email", "resume");
	
	function People()
	{
		// Register custom post types
		register_post_type('people', array(
			'labels' => array (
							'name' => _x('People', 'post type general name'),
							'singular_name' => _x('Person', 'post type singular name'),
							'add_new' => _x('Add New', 'people'),
							'add_new_item' => __('Add New Person'),
							'edit_item' => __('Edit Person'),
							'new_item' => __('New Person'),
							'view_item' => __('View People'),
							'search_items' => __('Search People'),
							'not_found' =>  __('No people found'),
							'not_found_in_trash' => __('No people found in Trash'), 
							'parent_item_colon' => ''
						),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false, 
			'_edit_link' => 'post.php?post=%d',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "people"), 
			'query_var' => "people", 
			'menu_position' => 5,
			'menu_icon' => get_bloginfo('url') . '/wp-content/themes/core/images/staff.png',
			'supports' => array('title', 'thumbnail', 'editor', 'excerpt')
		));
		
		add_filter("manage_edit-people_columns", array(&$this, "edit_columns"));
		add_action("manage_posts_custom_column", array(&$this, "custom_columns"));
		add_action("admin_init", array(&$this, "admin_init"));
		add_action("wp_insert_post", array(&$this, "wp_insert_post"), 10, 2);
		
		// Register custom taxonomy
		register_taxonomy("people-department", array("people"), array("hierarchical" => true, "label" => "Departments", "singular_label" => "Department", "rewrite" => true));
		
		register_taxonomy("people-featured", array("people"), array("hierarchical" => true, "label" => "Features", "singular_label" => "Feature", "rewrite" => true));
	}
	
	function edit_columns($columns)
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"photo" => 'People Photo',
			"title" => "People Member Name",
			"people-department" => "Department" );
		return $columns;
	}
	
	function custom_columns($column)
	{
		global $post;
		switch ($column)
		{
			case 'photo':
				the_post_thumbnail('people_thumbnail'); 
				break;
		
			case "people-department":
				$people_departments = get_the_terms(0, "people-department");
				$people_departments_html = array();
				foreach ($people_departments as $people_department)
					array_push($people_departments_html, '<a href="' . get_term_link($people_department->slug, "people-department") . '">' . $people_department->name . '</a>');
				
				echo implode($people_departments_html, ", ");
				break;
		}
	}
	

	// When a post is inserted or updated
	function wp_insert_post($post_id, $post = null)
	{
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX )
		    return;	
		    
		if ($post->post_type == "people")
		{
			// Loop through the POST data
			foreach ($this->meta_fields as $key)
			{
				$value = @$_POST[$key];
				if (empty($value))
				{
					delete_post_meta($post_id, $key);
					continue;
				}

				// If value is a string it should be unique
				if (!is_array($value))
				{
					
					// Update meta
					if (!update_post_meta($post_id, $key, $value))
					{
						// Or add the meta data
						add_post_meta($post_id, $key, $value);
					}
				}
				else
				{
					// If passed along is an array, we should remove all previous data
					delete_post_meta($post_id, $key);
					
					// Loop through the array adding new values to the post meta as different entries with the same name
					foreach ($value as $entry)
						add_post_meta($post_id, $key, $entry);
				}
			}
		}
	}
	
	function admin_init() 
	{
		// Custom meta boxes for the edit podcast screen
		add_meta_box("people-meta", "People Information", array(&$this, "meta_options"), "people", "normal", "high");
	}
	
	// Admin post meta contents
	function meta_options()
	{
		global $post;
		$custom = get_post_custom($post->ID);
		$title = $custom["title"][0];
		$phone = $custom["phone"][0];
		$email = $custom["email"][0];
		$resume = $custom["resume"][0];
?>
		<p><label style="width: 140px; display: inline-block;" for="title">Title</label> <input  name="title" size="100" value="<?php echo $title; ?>" /></p>
		<p><label style="width: 140px; display: inline-block;" for="phone">Phone Number</label> <input  name="phone" size="12" value="<?php echo $phone; ?>" /></p>
		<p><label style="width: 140px; display: inline-block;" for="email">Email</label> <input  name="email" size="100" value="<?php echo $email; ?>" /></p>
		<p><label style="width: 140px; display: inline-block;"  for="resume">Resume</label> <input   name="resume" id="upload_data" type="text" size="50"  value="<?php echo $resume; ?>" /><input id="upload_resume_button" type="button" value="Upload File" /><input type="hidden" value="<?php echo $post->ID; ?>" id="upload_post_id" /></p>

<?php
	}
}

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('apu_upload', get_bloginfo('stylesheet_directory') . '/js/upload.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('apu_upload');
}

add_action('admin_print_scripts', 'my_admin_scripts');

// Initiate the plugin
add_action("init", "PeopleInit");
function PeopleInit() { global $apu_people; $apu_people = new People(); }


add_image_size('people_thumbnail', 46, 46, TRUE);
add_image_size('people_gallery', 100, 100, TRUE);
add_image_size('people_bio', 286, 180, TRUE);


