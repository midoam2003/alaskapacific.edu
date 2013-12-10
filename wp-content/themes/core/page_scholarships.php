<?php

// Template Name: Scholarships

//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');

function template_load_scripts(){
?>



<style>
		#menu-item-409 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
	</style>
	<?php
}


add_action('genesis_after', 'template_load_js');
function template_load_js() { 

    ?>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/jquery.isotope.min.js"></script>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/jquery-responsive-headlines.min.js"></script>

<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/degreebrowser.js"></script>
<?php
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('admissions-menu');
	load_quick_links();
}
?>

<?

 get_header(); 

// content here
 ?>

 <h1>APU Scholarship Application</h1>
s
sdf


 <h1>Other Scholarship Opportunities</h1>


<?php query_posts('cat=141'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   <?php the_title(); ?>
<?php endwhile; endif; ?>

<?php
get_footer();
