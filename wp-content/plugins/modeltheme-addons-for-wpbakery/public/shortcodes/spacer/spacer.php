<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_spacer($params, $content) {
  extract( shortcode_atts( 
    array(
      'desktop_height'              =>'',
      'mobile_height'               =>'',
      'tablet_height'               =>'',
      'extra_class'                 =>'',

    ), $params ) );

   
    wp_enqueue_style( 'mt-spacer', plugins_url( '../../css/spacer.css' , __FILE__ ));


    ob_start(); ?>
    <div class="mt-addons-flexible-spacer <?php echo esc_attr($extra_class); ?>">
      <div class="mt-addons-empty-spacer-desktop" style="height: <?php echo esc_attr($desktop_height.'px'); ?>;"></div>
      <div class="mt-addons-empty-spacer-mobile" style="height: <?php echo esc_attr($mobile_height.'px'); ?>;"></div>
      <div class="mt-addons-empty-spacer-tablet" style="height: <?php echo esc_attr($tablet_height.'px'); ?>;"></div>
    </div>
   
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-spacer', 'modeltheme_addons_for_wpbakery_spacer');


if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Spacer", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-spacer",
      "category" => esc_attr__('MT Addons', "modeltheme-addons-for-wpbakery"),
      "icon" => "modeltheme_shortcode",
      "params" => array(
        array(
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Desktop Height", "modeltheme-addons-for-wpbakery"),
          "param_name" => "desktop_height",
          "description" => esc_attr__("Enter empty space height for desktop (px).", "modeltheme-addons-for-wpbakery")

        ),
        array(
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Mobile Height", "modeltheme-addons-for-wpbakery"),
          "param_name" => "mobile_height",
          "description" => esc_attr__("Enter empty space height for mobile (px).", "modeltheme-addons-for-wpbakery")
        ),
        array(
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Tablet Height", "modeltheme-addons-for-wpbakery"),
          "param_name" => "tablet_height",
          "description" => esc_attr__("Enter empty space height for tablet (px).", "modeltheme-addons-for-wpbakery")

        ),
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "modeltheme-addons-for-wpbakery"),
          "param_name" => "extra_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme-addons-for-wpbakery")
        )
      )
  ));
}