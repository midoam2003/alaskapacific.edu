<?php
add_action('admin_init', 'stag_styling_options');
function stag_styling_options(){

  $styling_options['description'] = __('Configure the visual appearance of your theme, or insert any custom CSS. You can also edit your site color scheme using <a href="'.admin_url('customize.php').'">WordPress Live Customizer</a>, if applicable.', 'stag');


  $styling_options[] = array(
    'title' => __('Background Color', 'stag'),
    'desc'  => __('Choose the background color of your site', 'stag'),
    'type'  => 'color',
    'id'    => 'style_background_color',
    'val'   => '#ffffff'
  );

  $styling_options[] = array(
    'title' => __('Body Font', 'stag'),
    'desc'  => __('Quickly add a custom Google Font for body from <a href="http://www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
               <code>Example font name: "Source Sans Pro"</code>, for including font weights type <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
    'type'  => 'text',
    'id'    => 'style_body_font',
    'val'   => 'Open Sans:300,400,700'
  );

  $styling_options[] = array(
    'title' => __('Heading Font', 'stag'),
    'desc'  => __('Quickly add a custom Google Font for Headings from <a href="http://www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
               For font type: <code>"Source Sans Pro"</code>, for including specific font weights <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
    'type'  => 'text',
    'id'    => 'style_heading_font',
    'val'   => 'Open Sans:300'
  );

  $styling_options[] = array(
    'title' => __( 'Google Font Script', 'stag' ),
    'desc' => __( 'Choose the character sets you want for Google Web Font', 'stag' ),
    'type' => 'select',
    'id' => 'style_font_script',
    'val' => 'latin',
    'options' => array(
      'cyrillic' => __( 'Cyrillic', 'stag' ),
      'cyrillic-ext' => __( 'Cyrillic Extended', 'stag' ),
      'greek' => __( 'Greek', 'stag' ),
      'greek-ext' => __( 'Greek Extended', 'stag' ),
      'khmer' => __( 'Khmer', 'stag' ),
      'latin' => __( 'Latin', 'stag' ),
      'latin,latin-ext' => __( 'Latin Extended', 'stag' ),
      'vietnamese' => __( 'Vietnamese', 'stag' ),
    )
  );

  $styling_options[] = array(
    'title' => __('Custom CSS', 'stag'),
    'desc'  => __('Quickly add some CSS to your theme by adding it to this block.', 'stag'),
    'type'  => 'textarea',
    'id'  => 'style_custom_css',
  );

  stag_add_framework_page( 'Styling Options', $styling_options, 10 );
}



/* CUSTOM STYLESHEET OUTPUT */
function stag_custom_css($content){
  $stag_values = get_option( 'stag_framework_values' );
  if( array_key_exists( 'style_custom_css', $stag_values ) && $stag_values['style_custom_css'] != '' ){
    $content .= '/* Custom CSS */' . "\n";
    $content .= stripslashes($stag_values['style_custom_css']);
    $content .= "\n\n";
  }
  return $content;
}
add_filter( 'stag_custom_styles', 'stag_custom_css' );


function stag_google_font_url() {

  $body_font = stag_get_option('style_body_font');
  $heading_font = stag_get_option('style_heading_font');

  if( $body_font === '' && $heading_font === '' )
    return;

  $fonts_url = '';
  $font_families = array();
  $protocol = ( is_ssl() ) ? 'https' : 'http';

  $font_families[] = $body_font;
  $font_families[] = $heading_font;

  $query_args = array(
    'family' => urlencode( implode( '|', $font_families ) ),
    'subset' => urlencode( stag_get_option('style_font_script') )
  );
  $fonts_url = add_query_arg( $query_args, $protocol . "://fonts.googleapis.com/css" );

  return $fonts_url;
}

if( ! function_exists( 'stag_remove_trailing_char' ) ) {
/**
 * Check if there is any space
 */
function stag_remove_trailing_char( $string, $char = ' ' ) {
  $offset = strlen( $string ) - 1;
  $trailing_char = strpos( $string, $char, $offset );
  if( $trailing_char )
    $string = substr( $string, 0, -1 );
  return $string;
}
}

function stag_get_font_face( $option ) {
  $stack = null;
  if( $option !=  '') {
    $option = explode( ':', $option );
    $name = stag_remove_trailing_char( $option[0] );
    $stack = $name;
  } else {
    $stack = '';
  }
  return $stack;
}



function stag_user_styles_push($content){
  $bodyfont = stag_get_option('style_body_font');
  $body_font_output = stag_get_font_face($bodyfont);

  $headingfont = stag_get_option('style_heading_font');
  $heading_font_output = stag_get_font_face($headingfont);

  $background_color = stag_get_option('style_background_color');

  $output = "/* Custom Styles Output */\n";

  if($background_color != ''){
    $output .= 'body{'."\n";
    $output .= "\tbackground-color: $background_color;\n";
    $output .= '}';
  }

  if($bodyfont != ''){
    $output .= 'body{'."\n";
    $output .= "\tfont-family: '$body_font_output';\n";
    $output .= '}';
  }

  if($headingfont != ''){
    $output .= "\nh1, h2, h3, h4, h5, h6, .heading{\n";
    $output .= "\tfont-family: '$heading_font_output';\n";
    $output .= '}';
  }


  $content .= $output."\n";
  return $content;
}
add_action( 'stag_custom_styles', 'stag_user_styles_push', 10);
