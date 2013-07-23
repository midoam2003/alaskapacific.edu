<?php
/**
 *
 * @package Sundog Themes
 */

add_action('widgets_init', 'register_sundog_category_widget');
function register_sundog_category_widget(){
	register_widget('Sundog_Category_Widget');
}

class Sundog_Category_Widget extends WP_Widget {

	function Sundog_Category_Widget() {
		$widget_ops = array( 'classname' => 'category-widget', 'description' => __('Displays categories with the option to exclude.', 'sundog') );
		$this->WP_Widget( 'sundog_categories', __('Sundog Themes - Categories Widget', 'sundog'), $widget_ops );
	}

	function widget($args, $instance) {
	
		extract($args);
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base);
		$c = $instance['count'] ? '1' : '0';
		$h = $instance['hierarchical'] ? true : false;
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
			
		?>
		
		<ul>
		<?php
				$cat_args['title_li'] = '';
				$cat_args['hierarchical'] = $h;
				$cat_args['show_count'] = $c;
				if(!empty($instance['exclude'])) $cat_args['exclude'] = $instance['exclude'];
				wp_list_categories(apply_filters('widget_categories_args', $cat_args));
		?>
				</ul>
		
		
		<?php
								
		echo $after_widget;
		
		wp_reset_query();
	}

	function update($new_instance, $old_instance) {
			$instance = $old_instance;
					$instance['title'] = strip_tags($new_instance['title']);
					$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
					$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
					$instance['exclude'] = strip_tags($new_instance['exclude']);
					
			
					return $instance;
		}
	
	function form($instance) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = esc_attr( $instance['title'] );
			$count = isset($instance['count']) ? (bool) $instance['count'] :false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			$exclude = esc_attr( $instance['exclude'] );
			
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'sundog'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" /></p>
			
			<p><label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Categories to Exclude', 'sundog'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" value="<?php echo esc_attr( $instance['exclude'] ); ?>" style="width:95%;" /></p>
			
			<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
					<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />
			
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
					<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
		<?php 
		}
}
?>