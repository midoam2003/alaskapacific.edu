<?php


//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
        #menu-item-258 a{
            background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
        }
        
        #menu-item-1516 a{
            background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/subnav-bg.gif") repeat-x 0 -39px transparent !important;
        }
    </style>
    <?php
}

//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
    load_main_menu();
    load_page_menu('home-menu');
    load_quick_links();
}

remove_action('genesis_after_header', 'genesis_do_subnav');
// add_action('genesis_after_header', 'child_do_subnav');
// function child_do_subnav() {
//         $args = array(
//                     'theme_location' => 'home-menu', 
//                     'container' => '',
//                     'echo' => 0,
//                     'fallback_cb' => '', 
//                     'menu_class' => 'superfish'             
//             );

//         $subnav = wp_nav_menu( $args );

    
//         $subnav_output = sprintf( '<div id="subnav">%2$s%1$s%3$s</div>', $subnav, genesis_structural_wrap( 'subnav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'subnav', '</div><!-- end .wrap -->', 0 ) );

//         echo apply_filters( 'genesis_do_subnav', $subnav_output, $subnav, $args );
    
// }  

remove_action( 'genesis_post_title', 'genesis_do_post_title' );

 remove_action( 'genesis_post_content', 'genesis_do_post_content' );
 

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
    remove_action( 'genesis_post_content', 'genesis_do_post_content' );
 remove_action( 'genesis_post_content', 'the_content' );

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'template_add_custom_content');
function custom_do_cat_loop() {
print_r($post);
    the_content();
global $query_args; // any wp_query() args
$args= array('cat' => '30');
genesis_custom_loop(wp_parse_args($query_args, $args));
}


//add_action( 'genesis_post_content', 'template_add_custom_content', 3 );
function template_add_custom_content(){


    if(has_post_thumbnail()){
        genesis_image(array('format'=>'html', 'size'=>'full', 'attr' => 'class=post-image'));
    }





$id = get_the_ID();
    $terms = wp_get_post_terms( $id, 'levels');

    if ($terms[0]->slug == 'aa' || $terms[0]->slug == 'ba' || $terms[0]->slug == 'bs') {

        $level = "undergraduate";;
    } else {

        $level = "graduate";
    }

    if (get_post($id)->post_name == "early-honors") {

        $level = "early-honors";
    }
?>
    <div class="header-image"></div>

    <div class="title"><h2 class="return"><a href="<? echo get_bloginfo('url');?>/degrees">&larr; Return to Degrees</a></h2><h1><?php echo get_the_title(); ?></h1></div>
    <div class="body-copy">
 <?php while( have_posts() ): the_post(); the_content(); endwhile;?>
 </div>


    <a href="<? echo get_bloginfo('url');?>/apply/<? echo $level ?>" class="apply-button call-to-action" style="font-size: 24px !important;">Apply Now</a>

    <a href="<? echo get_bloginfo('url');?>/info" class="apply-button call-to-action" style="font-size: 24px !important;">Request Information</a>

    <a href="<? echo get_bloginfo('url');?>/apply/visit-campus" class="apply-button call-to-action" style="font-size: 24px !important;">Visit Campus</a>

 <!--    <div class="extras">

        <div class="list program">
            <h2>Degree Levels</h2>

            <ul>

                <li>df</li>
            </ul>


        </div>

        <div class="list interests">
            <h2>You might also like...</h2>

            <ul>

                <li>df</li>
            </ul>



        </div>

    </div> -->
    
    
    <?php
}
remove_action('genesis_post_content', 'genesis_do_post_content');
remove_action( 'genesis_after_post', 'genesis_get_comments_template' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
genesis();