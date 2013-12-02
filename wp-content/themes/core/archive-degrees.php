<?php

// Template Name: Degree Browser

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

<div class="degrees-header"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/degree-browser-title.png"></div>
<!-- <div class="future-splash"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/future-students/future-students-header.jpg"></div> -->

  <ul class="filters"><li><a href="#showall" data-filter="*" class="activated">Show all</a></li><li><a href="#undergraduate" data-filter=".aa, .ba, .bs, .certificate">Undergraduate Programs</a></li><li><a href="#graduate" data-filter=".ms, .psyd, .ma, .mba-2">Graduate Programs</a></li></ul>
        <div id="degrees">

<?php
$custom_terms = get_terms('programs');


foreach($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array('orderby' => 'title', 'order' => 'ASC', 'post_type' => 'degrees',
        'tax_query' => array(
            array(
                'taxonomy' => 'programs',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
     );

     $loop = new WP_Query($args);
     if($loop->have_posts()) {

        $program_name = $custom_term->name;
        $i = 0;
        ?>

         <div class="box<?php
        while($loop->have_posts()) : $loop->the_post(); $levels = wp_get_post_terms( $post->ID, 'levels', array("fields" => "slugs") ); ?> <?php echo $levels[0] ?><?php
        endwhile;

        ?>">
           

        <ul class="levels">
          <?php
        while($loop->have_posts()) : $loop->the_post(); $levels = wp_get_post_terms( $post->ID, 'degrees'); ?>
        <? if ($i==0) { ?>

        <li class="header">
            
             <h2><a href="<?php echo get_permalink() ?>"><? echo $custom_term->name ?></a></h2>

        <ul class="slideshow" style="background: transparent url('<?php echo get_bloginfo('stylesheet_directory'); ?>/images/degreebrowser/<?php echo $custom_term->slug; ?>-bw.jpg') no-repeat 0 0;">

        </ul>

        </li>

         <li class="<?php $levels = wp_get_post_terms( $post->ID, 'levels', array("fields" => "slugs") );
            if ($levels[0]) { ?> <?php echo $levels[0] ?> degrees<?php } ?>"><a href="<?php echo get_permalink() ?>"><?php $levels = wp_get_post_terms( $post->ID, 'levels', array("fields" => "names") );
            if ($levels[0]) { ?><span><?php echo $levels[0] ?></span><?php } ?><?php echo $post->post_title; ?></a></li>



        <? } else { ?>
        <li class="<?php $levels = wp_get_post_terms( $post->ID, 'levels', array("fields" => "slugs") );
            if ($levels[0]) { ?> <?php echo $levels[0] ?> degrees<?php } ?>"><a href="<?php echo get_permalink() ?>"><?php $levels = wp_get_post_terms( $post->ID, 'levels', array("fields" => "names") );
            if ($levels[0]) { ?><span><?php echo $levels[0] ?></span><?php } ?><?php echo $post->post_title; ?></a></li>
          <!--   <li><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/degreebrowser/<?php echo $post->post_name; ?>.png"></li> -->


          <!--  <li><?php echo get_the_post_thumbnail( $post->ID, array(100,100) ); ?></li> -->

            <?php
          } 

          $i++;
        endwhile;
        ?> 




        </ul>

</div>


        <?php



     }
}

?>



        </div>

        <div class="alternative">
    
<!-- 
    Didn't find a program you're interested in? -->
</div>


<?php
get_footer();
