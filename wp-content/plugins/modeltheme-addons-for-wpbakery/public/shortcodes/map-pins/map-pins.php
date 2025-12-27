<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_map_pins($params,  $content = NULL) {
    extract( shortcode_atts( 
      array(
        'page_builder'          => '',
        'el_class'              => '',
        'el_custom_id'          => '',
        'item_image_map'        => '' 
    ), $params ) );
    wp_enqueue_style( 'map-pins', plugins_url( '../../css/map-pins.css' , __FILE__ ));
    wp_enqueue_script( 'map-pins-js', plugins_url( '../../js/map-pins.js' , __FILE__));
    
    ob_start(); ?>
      <div class="mt-addons-map-pins">
        <div class="mt-addons-map-pins-container">
            <div class="mt-addons-map-pins-wrapper">
                <?php $img = wp_get_attachment_image_src($item_image_map, 'full'); 
                if (isset($item_image_map)) { ?>
                  <img class="mt-addons-map-pins-image" src="<?php echo esc_attr($img[0]); ?>" alt="" />
                <?php } ?>
                <ul>
                  <?php echo do_shortcode($content); ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt_addons_map_pins_short', 'modeltheme_addons_for_wpbakery_map_pins');
/**
||-> Shortcode: Child Shortcode v1
*/
function modeltheme_addons_for_wpbakery_map_pins_items($params, $content = NULL) {

    extract( shortcode_atts( 
        array(
            'title'               => '',
            'subtitle'            => '',
            'image'               => '',
            'coordinates_x'       => '',
            'coordinates_y'       => '',
            'el_class'            => '',
            'el_custom_id'        => '',
            'featured_image_size' => '',
            'pin_color'           =>'',
            'pin_bg_color'        => ''
        ), $params ) );
    wp_enqueue_style( 'map-pins', plugins_url( '../../css/map-pins.css' , __FILE__ ));
    wp_enqueue_script( 'map-pins-js', plugins_url( '../../js/map-pins.js' , __FILE__));
    ob_start(); 
    $uniqid = 'mt-addons-replace'.uniqid();

    ?>
    <li class="mt-addons-map-single-point" id="<?php echo esc_attr($uniqid); ?>" style="top:<?php echo esc_attr($coordinates_x);?>%;right:<?php echo esc_attr($coordinates_y);?>%;">
      <a  class="mt-addons-replace" style="background:<?php echo esc_attr($pin_bg_color);?>"></a></i>
      <?php if($el_class) {
        $class_pin = $el_class;
      } else {
        $class_pin = 'bottom';
      } 
      $image_size = 'full';
      if ($featured_image_size) {
        $image_size = $featured_image_size;
      }
      ?>
      <div class="mt-addons-map-info pin-<?php echo esc_attr($class_pin); ?>">
        <?php $img = wp_get_attachment_image_src($image, $image_size); ?>
        <?php if (isset($img[0])) { ?>
          <img class="mt-addons-image" src="<?php echo esc_attr($img[0]);?>" alt="<?php echo esc_attr__('Pin', 'modeltheme-addons-for-wpbakery'); ?>" />
        <?php } ?>
        <h3 class="mt-addons-pin-title"><?php echo esc_attr($title);?></h3>
        <p class="mt-addons-pin-content"><?php echo esc_attr($subtitle); ?></p>
        <a href="#0" class="mt-addons-pin-close"><?php echo esc_html__('Close','modeltheme-addons-for-wpbakery'); ?></a>
      </div> 
      <style id="<?php  echo esc_attr($uniqid); ?>" type="text/css" media="screen">
        <?php echo esc_attr('#'.$uniqid); ?>.mt-addons-map-single-point a::after,
        <?php echo esc_attr('#'.$uniqid); ?>.mt-addons-map-single-point a:before{
          background-color: <?php echo esc_attr($pin_color);?>!important;
        }
      </style> 
    </li>
    <?php
    return ob_get_clean();
}
add_shortcode('mt_addons_map_pins_short_item', 'modeltheme_addons_for_wpbakery_map_pins_items');

/**
||-> Map Shortcode in Visual Composer with: vc_map();
*/
if (function_exists('vc_map')) {

  $params_parent = array();
  $params_shortcode = array(
    array(
      "type"          => "attach_image",
      "heading"       => esc_attr__( "Background", 'modeltheme-addons-for-wpbakery' ),
      "param_name"    => "item_image_map",
      "description"   => ""
    )
  );

  if ($params_shortcode) {
    foreach ($params_shortcode as $param) {
      $params_parent[] = $param;
    }
  }

  $extras_vc_fields = modeltheme_addons_extras_vc_fields();
  if ($extras_vc_fields) {
    foreach ($extras_vc_fields as $extra_param) {
      $params_parent[] = $extra_param;
    }
  }

  vc_map( 
    array(
      "name" => esc_attr__("MT: Map Pins", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt_addons_map_pins_short",
      "as_parent" => array('only' => 'mt_addons_map_pins_short_item'), 
      "content_element" => true,
      "show_settings_on_create" => true,
      "icon" => plugins_url( 'images/map_pins.svg', __FILE__ ),
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "is_container" => true,
      "params" => $params_parent,
      "js_view" => 'VcColumnView'
    ) 
  );

  $params_child = array();
  $params_child_shortcode = array(
    array(
      "type"         => "textfield",
      "holder"       => "div",
      "class"        => "",
      "param_name"   => "title",
      "heading"      => esc_attr__("Title", "modeltheme-addons-for-wpbakery"),
      "description"  => esc_attr__("Enter title for current menu item(Eg: Italian Pizza)", "modeltheme-addons-for-wpbakery"),
    ),
    array(
      "type"         => "textarea",
      "holder"       => "div",
      "class"        => "",
      "param_name"   => "subtitle",
      "heading"      => esc_attr__("Content", 'modeltheme-addons-for-wpbakery'),
      "description"  => esc_attr__("Enter title for current menu item(Eg: 30x30cm with cheese, onion rings, olives and tomatoes)", "modeltheme-addons-for-wpbakery"),
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Pin Color", "modeltheme-addons-for-wpbakery"),
      "param_name" => "pin_color"
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Pin Bg Color", "modeltheme-addons-for-wpbakery"),
      "param_name" => "pin_bg_color"
    ),
    array(
      "type"          => "attach_image",
      "holder"        => "div",
      "class"         => "",
      "heading"       => esc_attr__( "Thumbnail", "modeltheme-addons-for-wpbakery" ),
      "param_name"    => "image",
      "description"   => ""
    ),
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Featured Image size", "modeltheme-addons-for-wpbakery"),
      "param_name" => "featured_image_size",
      "std" => 'full',
      "value" => modeltheme_addons_image_sizes_array()
    ),
    array(
        "type"         => "vc_number",
        "holder"       => "div",
        "class"        => "",
        "param_name"   => "coordinates_x",
        "heading"      => esc_attr__("Coordinates on x axis", "modeltheme-addons-for-wpbakery"),
        "description"  => esc_attr__("Enter coordinates on x axis in percentange", "modeltheme-addons-for-wpbakery"),
    ),
    array(
        "type"         => "vc_number",
        "holder"       => "div",
        "class"        => "",
        "param_name"   => "coordinates_y",
        "heading"      => esc_attr__("Coordinates on y axis", "modeltheme-addons-for-wpbakery"),
        "description"  => esc_attr__("Enter coordinates on y axis in percentange", "modeltheme-addons-for-wpbakery"),
    ),
  );

  if ($params_child_shortcode) {
    foreach ($params_child_shortcode as $param_child) {
      $params_child[] = $param_child;
    }
  }

  if ($extras_vc_fields) {
    foreach ($extras_vc_fields as $extra_param) {
      $params_child[] = $extra_param;
    }
  }


  vc_map( 
    array(
      "name" => esc_attr__("MT: Pin", "modeltheme-addons-for-wpbakery"),
      "base" => "mt_addons_map_pins_short_item",
      "content_element" => true,
      "as_child" => array('only' => 'mt_addons_map_pins_short'),
      "params" => $params_child
    ) 
  );
  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_mt_addons_map_pins_short extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_mt_addons_map_pins_short_item extends WPBakeryShortCode {
      }
  }
}