<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Cristi
 */
function modeltheme_addons_for_wpbakery_before_after_comparison( $params, $content = null ) {
  extract( 
    shortcode_atts(
      array(
        'image_before'           =>'',
        'image_after'           =>'',
        'orientation'           =>'',
      ), 
      $params
    ) 
  );
 
  // framework
  wp_enqueue_style( 'twentytwenty-no-compass', plugins_url( '../../css/plugins/twentytwenty/twentytwenty-no-compass.css' , __FILE__ ));
  wp_enqueue_script( 'jquery-event-move', plugins_url( '../../js/plugins/twentytwenty/jquery.event.move.js' , __FILE__));
  wp_enqueue_script( 'jquery-twentytwenty', plugins_url( '../../js/plugins/twentytwenty/jquery.twentytwenty.js' , __FILE__));
  // custom
  wp_enqueue_style( 'mt-before-after-comparison', plugins_url( '../../css/before-after-comparison.css' , __FILE__ ));

  $orientation_attr = '';
  if ($orientation == 'vertical') {
    $orientation_attr = 'data-orientation="vertical"';
  }
  $img1 = wp_get_attachment_image_src($image_before, "full");
  $img2 = wp_get_attachment_image_src($image_after, "full");

  ob_start(); ?>

  <script type="text/javascript">
    jQuery(window).load(function(){
      jQuery(".mt-addons-before-after-comparison-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      jQuery(".mt-addons-before-after-comparison-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
  </script>

  <div class="mt-addons-before-after-comparison-shortcode mt-addons-before-after-comparison-container" <?php echo $orientation_attr; ?>>
    <img src="<?php echo esc_url($img1[0]); ?>" alt="<?php _e("Before", "modeltheme-addons-for-wpbakery"); ?>" />
    <img src="<?php echo esc_url($img2[0]); ?>" alt="<?php _e("After", "modeltheme-addons-for-wpbakery"); ?>" />
  </div>

  <?php 
  return ob_get_clean();
}
add_shortcode('mt-addons-before-after-comparison', 'modeltheme_addons_for_wpbakery_before_after_comparison');


if ( function_exists('vc_map') ) {
  add_action( 'init', 'mt_addons_before_after_comparison_vc_map');
  function mt_addons_before_after_comparison_vc_map(){
    vc_map( array(
      "name" => __("MT: Before/After Comparison", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-before-after-comparison",
      "icon" => plugins_url( 'images/before-after.svg', __FILE__ ),
      "category" => __('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "params" => array(
        array(
          "heading" => __("Image (Before)", "modeltheme-addons-for-wpbakery"),
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "param_name" => "image_before",
        ),
        array(
          "heading" => __("Image (After)", "modeltheme-addons-for-wpbakery"),
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "param_name" => "image_after",
        ),
        array(
          "heading" => esc_attr__("Alignment", "modeltheme-addons-for-wpbakery"),
          "type" => "dropdown",
          "param_name" => "orientation",
          "value" => array(
            esc_attr__("Horizontal", "modeltheme-addons-for-wpbakery")   => 'horizontal',
            esc_attr__("Vertical", "modeltheme-addons-for-wpbakery")   => 'vertical',
          ),
          "std" => 'normal',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
      )
    ));
  }
}