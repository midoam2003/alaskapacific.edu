<?php

/* Set Max Content Width ---------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 940;

/* Set Max Content Width ---------------------------------------------------*/
global $is_retina;
(isset($_COOKIE['retina'])) ? $is_retina = true : $is_retina = false;

/*-----------------------------------------------------------------------------*/
/* Theme Setup
/*-----------------------------------------------------------------------------*/
if(!function_exists('stag_theme_setup')){
  function stag_theme_setup(){

    /* Load translation domain --------------------------------------------------*/
    load_theme_textdomain('stag', get_template_directory().'/languages');

    $locale = get_locale();
    $locale_file = get_template_directory()."/languages/$locale.php";
    if(is_readable($locale_file)){
      require_once($locale_file);
    }

    /* Register Menus ---------------------------------------------------*/
    register_nav_menu('primary-menu', __('Primary Menu', 'stag'));

    add_editor_style('framework/assets/css/editor-style.css');
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );

    /* Add support for post formats ---------------------------------------------*/
    add_theme_support( 'post-formats', array('aside', 'gallery', 'image','link', 'quote', 'video', 'audio', 'status', 'chat') );

  }
}
add_action('after_setup_theme', 'stag_theme_setup');


/*-----------------------------------------------------------------------------*/
/* Register Sidebars
/*-----------------------------------------------------------------------------*/
if(!function_exists('stag_sidebar_init')){
  function stag_sidebar_init(){

    register_sidebar(array(
      'name' => __('Header Sidebar', 'stag'),
      'id' => 'sidebar-main',
      'before_widget' => '<div class="grid-12 widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
      'description'   => __('Widget area for top header overlay. Only static widgets are allowed.', 'stag')
    ));
    register_sidebar(array(
      'name' => __('Footer Widgets', 'stag'),
      'id' => 'sidebar-footer',
      'before_widget' => '<div class="grid-4 widget %3s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
      'description'   => __('Widget area for footer', 'stag')
    ));

  }
}
add_action('widgets_init', 'stag_sidebar_init');


/*-----------------------------------------------------------------------------*/
/* WordPress Title Filter
/*-----------------------------------------------------------------------------*/
if ( !function_exists( 'stag_wp_title' ) ) {
    function stag_wp_title($title, $sep) {
        if( !stag_check_third_party_seo() ){
            $title .= get_bloginfo( 'name' );

            $site_desc = get_bloginfo( 'description', 'display' );
            if( $site_desc && ( is_home() || is_front_page() ) ) {
                $title = "$title $sep $site_desc";
            }
        }
        return $title;
    }
}
add_filter('wp_title', 'stag_wp_title', 10, 2);


/*---------------------------------------------------------------------------------------------------------------------------------*/
/* Register and load scripts
/*---------------------------------------------------------------------------------------------------------------------------------*/
function stag_enqueue_scripts(){
  if(!is_admin()){
    global $is_IE, $wp_query;

    $protocol = ( is_ssl() ) ? 'https' : 'http';

    /* Register Scripts ---------------------------------------------------*/
    wp_register_script('script', get_template_directory_uri().'/assets/js/jquery.custom.js', array('jquery', 'superfish'), '', true);
    wp_register_script('modernizr', get_template_directory_uri().'/assets/js/modernizr.js', '', '2.6.2', true);
    wp_register_script('superfish', get_template_directory_uri().'/assets/js/superfish.js', array('jquery'), '', true);
    wp_register_script('jplayer', $protocol . '://cdnjs.cloudflare.com/ajax/libs/jplayer/2.4.0/jquery.jplayer.min.js', array('jquery'), '2.4.0', true);
    wp_register_script('backstretch', $protocol . '://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js', array('jquery'), '2.0.4', true);
    wp_register_script('flexslider', get_template_directory_uri().'/assets/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);
    wp_register_script('stag-plugins', get_template_directory_uri().'/assets/js/plugins.js', array('jquery', 'modernizr'), '', true);

    /* Enqueue Scripts ---------------------------------------------------*/
    wp_enqueue_script('jquery');
    wp_enqueue_script('script');
    wp_enqueue_script('modernizr');
    wp_enqueue_script('superfish');
    wp_enqueue_script('jplayer');
    wp_enqueue_script('backstretch');
    wp_enqueue_script('flexslider');
    wp_enqueue_script('stag-plugins');

    if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments

    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    wp_localize_script('script', 'stag', array(
      'ajaxurl'         => admin_url('admin-ajax.php'),
      'nonce'           => wp_create_nonce('stag-ajax'),
      'animDuration'    => stag_get_option('overlay_duration'),
      'category'        => get_query_var( 'cat' ),
      'search'          => get_query_var( 's' ),
      'alreadyLikeText' => __('You already like this', 'stag')
    ));

    /* Enqueue Styles ---------------------------------------------------*/
    wp_dequeue_style( 'stag-shortcode-styles' );
    wp_enqueue_style( 'shortcode-styles', get_template_directory_uri().'/assets/css/shortcodes.css', '', STAG_THEME_VERSION );

    wp_enqueue_style( 'stag-font', get_template_directory_uri().'/assets/fonts/fonts.css' );
    wp_enqueue_style( 'flexslider', get_template_directory_uri().'/assets/css/flexslider.css' );
    wp_enqueue_style( 'stag-style', get_stylesheet_uri() );
    wp_enqueue_style( 'stag-custom-style', get_template_directory_uri().'/assets/css/stag-custom-styles.php', 'stag-style', STAG_THEME_VERSION );
    wp_enqueue_style( 'shift-fonts', stag_google_font_url(), array(), null );
  }
}
add_action('wp_enqueue_scripts', 'stag_enqueue_scripts');


/*---------------------------------------------------------------------------------------------------------------------------------*/
/* Admin Scripts
/*---------------------------------------------------------------------------------------------------------------------------------*/
function stag_admin_enqueue_scripts(){
  wp_enqueue_script('stag-custom-admin', get_template_directory_uri().'/includes/js/custom.admin.js', 'jquery');
}
add_action( 'admin_enqueue_scripts', 'stag_admin_enqueue_scripts' );


/* Pagination */
function pagination(){
  global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if($total_pages > 1){
      if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        $return = paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_next' => false
          ));
        echo "<div class='pages'>{$return}</div>";
        }
  }else{
    return false;
  }
}


/*-----------------------------------------------------------------------------*/
/* Stag Comment Styling
/*-----------------------------------------------------------------------------*/
function stag_comments($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the-comment">

     <div class="comment-body clearfix">
        <div class="avatar-wrap">
          <?php
            global $is_retina;
            if($is_retina){
              echo get_avatar($comment,$size='140');
            }else{
              echo get_avatar($comment,$size='70');
            }
          ?>
        </div>
        <div class="comment-area">
            <div class="row">
              <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text' => __('Reply', 'stag'), 'max_depth' => $args['max_depth']))) ?>
              <h3 class="comment-author"><?php echo get_comment_author_link(); ?></h3>
              <p class="comment-date"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) .' '. __('ago', 'stag'); ?></p>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
               <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'stag') ?></em>
            <?php endif; ?>
            <div class="comment-text">
              <?php comment_text() ?>
            </div>
        </div>
      </div>

     </div>
   </li>

<?php
}

function stag_list_pings($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


/* A little math stuff ---------------------------------------------------*/
function is_multiple($number, $multiple){
  return ($number % $multiple) == 0;
}


/* Custom Excerpt -------------------------------------------------------*/
if(!function_exists('custom_excerpt_length')){
  function custom_excerpt_length( $length ) {
    return stag_get_option('general_post_excerpt_length');
  }
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}

if(!function_exists('new_excerpt_more')){
  function new_excerpt_more($more) {
    global $post;
    return ' <a class="read-more" href="'. get_permalink($post->ID) . '">'.stag_get_option('general_post_excerpt_text').'</a>';
  }
  add_filter('excerpt_more', 'new_excerpt_more');
}

/* Check if specific sidebar is active -------------------------------------------------------*/
function is_sidebar_active( $index = 1){
  $sidebars = wp_get_sidebars_widgets();
  $count = count($sidebars['sidebar-'.$index]);
  if($count === 0){
    return false;
  }else{
    return true;
  }
}


/**
 * @package StagFramework
 * @param bool $postid - Post ID
 * @return Audio Player
 */
function stag_audio_player($postid){
  $mp3 = get_post_meta($postid, '_stag_audio_mp3', true);
  $ogg = get_post_meta($postid, '_stag_audio_oga', true);

  // I can guarantee you some safety
  if($mp3 === "" && $ogg === "") return;

  ?>

  <script type="text/javascript">

  jQuery(document).ready(function($){
    if( $().jPlayer ){
      $('#jquery-jplayer-audio-<?php echo $postid; ?>').jPlayer({
        ready: function(){
          $(this).jPlayer("setMedia", {
            <?php if($mp3 != '') : ?>
            mp3: "<?php echo $mp3; ?>",
            <?php endif; ?>
            <?php if($ogg != '') : ?>
            oga: "<?php echo $ogg; ?>",
            <?php endif; ?>
            end: ""
          });
        },
        play: function() { // To avoid both jPlayers playing together.
          $(this).jPlayer("pauseOthers");
        },
        swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
        cssSelectorAncestor: "#jp-audio-interface-<?php echo $postid; ?>",
        supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3<?php endif; ?>",
      });
    }
  });

  </script>

  <div id="jp-container-<?php echo $postid; ?>" class="jp-audio">
    <div class="jp-type-single">
      <div id="jquery-jplayer-audio-<?php echo $postid; ?>" class="jp-jplayer"></div>
      <div id="jp-audio-interface-<?php echo $postid; ?>" class="jp-interface">
          <ul class="jp-controls">
              <li><a href="#" class="jp-play" tabindex="1" title="play"><i class="icon icon-play"></i></a></li>
              <li><a href="#" class="jp-pause" tabindex="1" title="pause"><i class="icon icon-pause"></i></a></li>
              <li><a href="#" class="jp-mute" tabindex="1" title="mute"><i class="icon icon-volume"></i></a></li>
              <li><a href="#" class="jp-unmute" tabindex="1" title="unmute"><i class="icon icon-volume"></i></a></li>
              <li><a href="#" class="jp-duration" tabindex="1" title="duration"></a></li>
          </ul>
          <div class="jp-progress">
              <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
              </div>
          </div>
          <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
          </div>
      </div>
    </div>
  </div>

  <?php

}


/**
 * @package StagFramework
 * @param bool $postid - Post ID
 * @return Video Player
 */
function stag_video_player($postid){
  $m4v = get_post_meta(get_the_ID(), '_stag_video_m4v', true);
  $ogv = get_post_meta(get_the_ID(), '_stag_video_ogv', true);

  if($m4v === "" && $ogv === "") return;

  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($){

    if( $().jPlayer ) {
      $("#jquery-jplayer-video-<?php echo $postid; ?>").jPlayer({
        ready: function(){
          $(this).jPlayer("setMedia",{
            <?php if( $m4v != '' ) : ?>
            m4v: "<?php echo $m4v; ?>",
            <?php endif; ?>
            <?php if( $ogv != '' ) : ?>
            ogv: "<?php echo $ogv; ?>",
            <?php endif; ?>
          });
        },
        size: {
          cssClass: "jp-video-normal",
          width: "100%",
        },
        autohide:{
          restored: false,
          full: true
        },
        play: function() { // To avoid both jPlayers playing together.
          $('#jp-video-container-<?php echo $postid; ?> .jp-jplayer').css('padding-bottom', '56.25%');
        },
        swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
        cssSelectorAncestor: "#jp-video-container-<?php echo $postid; ?>",
        supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv<?php endif; ?>"
      });
    }

  });
  </script>

  <div id="jp-video-container-<?php echo $postid; ?>" class="jp-video jp-video-normal">
      <div class="jp-type-single">
          <div id="jquery-jplayer-video-<?php echo $postid; ?>" class="jp-jplayer" data-orig-width="700" data-orig-height="300"></div>
          <div class="jp-gui">
          <div id="jp-video-interface-<?php echo $postid; ?>" class="jp-interface">
              <ul class="jp-controls">
                  <li><a href="#" class="jp-play" tabindex="1"><i class="icon-play"></i></a></li>
                  <li><a href="#" class="jp-pause" tabindex="1"><i class="icon icon-pause"></i></a></li>
                  <li><a href="#" class="jp-mute" tabindex="1"><i class="icon icon-volume"></i></a></li>
                  <li><a href="#" class="jp-unmute" tabindex="1"><i class="icon icon-volume"></i></a></li>
                  <li><a href="#" class="jp-duration" tabindex="1" title="duration">time</a></li>
              </ul>
              <div class="jp-progress">
                  <div class="jp-seek-bar">
                      <div class="jp-play-bar"></div>
                  </div>
              </div>
              <div class="jp-volume-bar">
                  <div class="jp-volume-bar-value"></div>
              </div>
          </div>
      </div>
      </div>
  </div>

  <?php
}

/**
* Relative Date for comments
*/
// add_filter( 'get_comment_date', 'get_the_relative_time' );
function get_the_relative_time($time = null){
    if(is_null($time)) $time = get_the_time("U");

    $time_diff = date("U") - $time; // difference in second

    $second = 1;
    $minute = 60;
    $hour = 60*60;
    $day = 60*60*24;
    $week = 60*60*24*7;
    $month = 60*60*24*7*30;
    $year = 60*60*24*7*30*365;

    if ($time_diff <= 120) {
        $output = __('now', 'stag');
    } elseif ($time_diff > $second && $time_diff < $minute) {
        $output = round($time_diff/$second)." " . __('second', 'stag');
    } elseif ($time_diff >= $minute && $time_diff < $hour) {
        $output = round($time_diff/$minute)." ". __('minute', 'stag');
    } elseif ($time_diff >= $hour && $time_diff < $day) {
        $output = round($time_diff/$hour)." ". __('hour', 'stag');
    } elseif ($time_diff >= $day && $time_diff < $week) {
        $output = round($time_diff/$day)." ".__('day', 'stag');
    } elseif ($time_diff >= $week && $time_diff < $month) {
        $output = round($time_diff/$week)." ".__('week', 'stag');
    } elseif ($time_diff >= $month && $time_diff < $year) {
        $output = round($time_diff/$month)." ".__('month', 'stag');
    } elseif ($time_diff >= $year && $time_diff < $year*10) {
        $output = round($time_diff/$year)." ".__('year', 'stag');
    } else{ $output = " ".__('more than a decade ago', 'stag'); }

    if ($output <> "now") {
      $output = (substr($output,0,2)<>"1 ") ? $output."s" : $output;
      $output .= " ".__('ago', 'stag');
    }

    return $output;
}


/* Load More Posts Thing -------------------------------------------------------------------------------------------*/
function stag_load_more_posts(){

  if( !wp_verify_nonce($_POST['nonce'], 'stag-ajax') ) die('Invalid nonce');
  if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');

  $query_args = '';
  if( isset($_POST['archive']) && $_POST['archive'] ) $query_args = $_POST['archive'] .'&';
  
  if(isset($_POST['category'])) $query_args .= 'cat='.$_POST['category'] .'&';

  if(isset($_POST['search'])) $query_args .= 's='.$_POST['search'] .'&';

  $query_args .= 'post_status=publish&posts_per_page='. get_option('posts_per_page') .'&paged='. $_POST['page'];

  if( isset($_POST['archive']) && $_POST['archive'] && strlen(strstr($_POST['archive'],'post-format'))> 0 ){
    $query_args = array(
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => $_POST['archive']
            )
        ),
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $_POST['page']
    );
  }

  ob_start();
  $query = new WP_Query($query_args);

  while ( $query->have_posts() ) : $query->the_post();

  stag_post_before(); ?>
  <!-- BEGIN .hentry -->
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <script>
    jQuery(document).ready(function($){
      $('#primary').fitVids();

      jQuery('[data-role="slider"]').each(function(){
          jQuery('#'+jQuery(this).attr('id')).flexslider({
              smoothHeight: true,
              directionNav: false,
              after: function(){
                  jQuery(window).resize();
              },
              start: function(){
                  jQuery(window).resize();
              }
          });
      });
    });
    </script>

    <?php get_template_part('content', 'background'); ?>

    <?php stag_post_start(); ?>

    <?php
        $format = get_post_format();
        get_template_part('content', $format);
    ?>

    <?php stag_post_end(); ?>

  <!-- END .hentry-->
  </article>
  <?php stag_post_after();

  endwhile;
  wp_reset_postdata();
  $content = ob_get_contents();

  ob_end_clean();

  echo json_encode(array(
      'pages' => $query->max_num_pages,
      'content' => $content
  ));
  exit;
}
add_action('wp_ajax_stag_load_more_posts', 'stag_load_more_posts');
add_action('wp_ajax_nopriv_stag_load_more_posts', 'stag_load_more_posts');


/* Theme Shortcode for social links ------------------------------------------------------------------------------------*/
function stag_social_shortcode( $atts ){
 extract( shortcode_atts( array(
    'url' => '',
  ), $atts ) );

  $output = '<div class="social-icons">';
  $url = explode(',', $url);

  foreach($url as $u){
    $u = trim($u);

    if($u === 'email' || $u === ' email'){
      $output .= "<a href='mailto:". stag_get_option('general_contact_email') ."'><i class='icon icon-{$u}'></i></a>";
    }
    if($u === 'rss' || $u === ' rss'){
      $output .= "<a href='". get_bloginfo('rss_url') ."'><i class='icon icon-{$u}'></i></a>";
    }

    if(stag_get_option('social_'.$u) != ''){
      $output .= "<a href='". stag_get_option('social_'.$u) ."'><i class='icon icon-{$u} accent-color'></i></a>";
    }
  }

  $output .= '</div>';

 return $output;
}
add_shortcode( 'social', 'stag_social_shortcode' );

/**
 * Delete custom generated CSS cache when a post is updated, created or deleted
 * 
 * @since 1.7
 */
function stag_post_change() {
  delete_transient( 'stag_custom_post_color' );
  delete_transient( 'stag_custom_page_color' );
}

add_action('wp_trash_post', 'stag_post_change', 0);
add_action('publish_post', 'stag_post_change', 0);
add_action('edit_post', 'stag_post_change', 0);
add_action('delete_post', 'stag_post_change', 0);
add_action('publish_phone', 'stag_post_change', 0);

/**
 * Check if there is any third party plugin active
 * 
 * @since 1.8
 */
function stag_check_third_party_seo() {
  include_once(ABSPATH .'wp-admin/includes/plugin.php');
  
  if( is_plugin_active('headspace2/headspace.php') ) return true;
  if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
  if( is_plugin_active('wordpres-seo/wp-seo.php') ) return true;
  
  return false;
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 * 
 * @since 1.8
 */
function stag_required_plugins() {
  $plugins = array(

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'StagTools',
      'slug'    => 'stagtools',
      'required'  => true,
    ),

  );

  tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'stag_required_plugins' );


/**
 * Include framework and other files
 */

include_once ( get_template_directory() . '/framework/stag-framework.php' );
include_once ( get_template_directory() . '/includes/_init.php' );
