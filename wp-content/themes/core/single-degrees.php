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
add_action('genesis_before_content_sidebar_wrap', 'section_do_title', 20);
function section_do_title(){
    ?> <div class="tab-title"><h1><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h1></div><?php
}

add_action( 'genesis_post_content', 'template_add_custom_content', 3 );
function template_add_custom_content(){
    if(has_post_thumbnail()){
        genesis_image(array('format'=>'html', 'size'=>'people_bio', 'attr' => 'class=alignleft post-image'));
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


    <a href="<? echo get_bloginfo('url');?>/apply/<? echo $level ?>" class="button" style="font-size: 24px !important;">Apply Today</a>
    <? echo $the_content; ?>
    <?
    
    $custom_fields = get_post_custom($id);

    $people_title = $custom_fields['title'][0];
    $people_phone = $custom_fields['phone'][0];
    $people_email = $custom_fields['email'][0];
    $people_resume = $custom_fields['resume'][0];
    
    ?>
    
    <p class="people-details">
    <?php if($people_title != '') echo $people_title . '<br />'; ?>
    <?php if($people_phone != '') echo $people_phone . '<br />'; ?>
    <?php if($people_email != '') echo '<a href="'. get_bloginfo('url') . '/contact/index.php?person='. $id .'" title="Contact '. get_the_title() .'" >Contact</a><br />'; ?>
    <?php if($people_resume != '') echo '<a href="'.$people_resume . '" title="Download CV for '. get_the_title() .'" target="_blank" >Download CV</a><br />'; ?>
    </p>
    
    <?php
}

remove_action( 'genesis_after_post', 'genesis_get_comments_template' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
genesis();