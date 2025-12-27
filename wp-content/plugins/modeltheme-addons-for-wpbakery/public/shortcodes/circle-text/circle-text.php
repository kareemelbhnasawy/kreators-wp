<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_circle_text($params, $content) {
  extract( shortcode_atts( 
    array(
      'text_animate'               => '',
      'section_align' => '',
      'circle_color'    =>'#111',
      'text_circle_size'    =>'63px',
      'y_offset'    =>'',
      'static_text'  =>'',
      'text_static_size'  =>'',
      'text_static_color'  =>'',
      'static_sub_text'  =>'',
      'text_sub_static_size'  =>'',
      'text_sub_static_color'  =>'',
      'subtitle_x_offset'  =>'200',
      'title_x_offset'  =>'210',
      'title_y_offset'  =>'250',
      'subtitle_y_offset'  =>'300',
      'subtitle_x_offset'  =>'200',
      'letter_spacing'  =>'70',
      'text_length'  =>'1220',
      'circle_width'  =>'100%',
      'top_percent'  =>'',
      'left_percent'  =>'',

      



    ), $params ) );
    
   
    wp_enqueue_style( 'mt-circle-text', plugins_url( '../../css/circle-text.css' , __FILE__ ));


    ob_start(); ?>

    <div class="mt-addons-circle-svg-text" style="left:<?php echo esc_attr($left_percent);?>%;top:<?php echo esc_attr($top_percent);?>px;">
      <svg xmlns="http://www.w3.org/2000/svg"xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2300 1000" width="<?php echo $circle_width; ?>%">
        <defs>
          <path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle">
              <animateTransform 
              attributeName="transform" 
              begin="0s" 
              dur="30s" 
              type="rotate" 
              from="0 250 250" 
              to="360 250 250" 
              repeatCount="indefinite"/>
          </path>
        </defs>
        <g fill="<?php echo esc_attr($circle_color); ?>">
          <text font-size = "<?php echo $text_circle_size; ?>px" dy="<?php echo esc_attr($y_offset); ?>" textLength="<?php echo esc_attr($text_length); ?>"letter-spacing="<?php echo esc_attr($letter_spacing); ?>"><textPath xlink:href="#textcircle"><?php echo esc_html__($text_animate); ?></textPath>
          </text>
        </g>
        <g fill="<?php echo esc_attr($text_static_color); ?>">     
          <text font-size = "<?php echo $text_static_size; ?>px" class="mt-addons-circle-svg-text-static" x="<?php echo esc_attr($title_x_offset); ?>" y="<?php echo esc_attr($title_y_offset); ?>" ><?php echo esc_html__($static_text); ?></text>
        </g>
        <g fill="<?php echo esc_attr($text_sub_static_color); ?>">     
          <text font-size = "<?php echo $text_sub_static_size; ?>px" class="mt-addons-circle-svg-subtitle" x="<?php echo esc_attr($subtitle_x_offset); ?>" y="<?php echo esc_attr($subtitle_y_offset); ?>" ><?php echo esc_html__($static_sub_text); ?></text>
        </g>
      </svg>
    </div>
<?php }
add_shortcode('mt-addons-circle-text', 'modeltheme_addons_for_wpbakery_circle_text');

//VC Map
if (function_exists('vc_map')) {
      
  $params = array(
    array(
      "group" => "Text Circle",
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( "Text Animate", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "text_animate"
    ),
   array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Let (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "left_percent"
    ),
     array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "class" => "",
      "heading" => esc_attr__("Top (%) - Do not write the '%'", "modeltheme_addons_for_wpbakery"),
      "param_name" => "top_percent",
  ),
    array(
      "group" => "Text Circle",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Color Text Animate", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "circle_color"
    ),
    array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( "Text Animate - Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "text_circle_size"
    ),
    array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( "Defines the y offset", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "y_offset"
    ),
    array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Title - Text Length", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "text_length"
    ),
    array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Title - Letter Spacing", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "letter_spacing"
    ),
    array(
      "group" => "Text Circle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Circle - Width", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "circle_width"
    ),
    
    array(
      "group" => "Title Middle",
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( "Title Text", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "static_text"
    ),
    array(
      "group" => "Title Middle",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( "Title  - Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "text_static_size"
    ),
    array(
      "group" => "Title Middle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Title - x offset", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_x_offset"
    ),
    array(
      "group" => "Title Middle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Title - y offset", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_y_offset"
    ),
    array(
      "group" => "Title Middle",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Title Color ", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "text_static_color"
    ),
    array(
      "group" => "Subtitle Middle",
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( "Subtitle Text", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "static_sub_text"
    ),
    array(
      "group" => "Subtitle Middle",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( "Subtitle - Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "text_sub_static_size"
    ),
    array(
      "group" => "Subtitle Middle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Subtitle - x offset", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_x_offset"
    ),
    array(
      "group" => "Subtitle Middle",
      "type" => "vc_number",
      "suffix" => "%",
      "class" => "",
      "heading" => esc_attr__( "Subtitle - y offset", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_y_offset"
    ),
    array(
      "group" => "Subtitle Middle",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Subtitle Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "text_sub_static_color"
    ),
  );


  vc_map(
    array(
      "name" => esc_attr__('MT: Circle Text', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-circle-text",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/clients.svg', __FILE__ ),
      "params" => $params,
  ));
}