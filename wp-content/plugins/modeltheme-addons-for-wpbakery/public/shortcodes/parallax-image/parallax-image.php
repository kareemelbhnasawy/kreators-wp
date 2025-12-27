<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_parallax_image($params, $content) {
  extract( shortcode_atts( 
    array(
      'banner_img'                => '',
      'image_size'                => '',
      'page_builder'              => '',
    ), $params ) );
   
    wp_enqueue_style( 'parallax-image', plugins_url( '../../css/parallax-image.css' , __FILE__ ));
    wp_enqueue_script( 'parallax-image-js', plugins_url( '../../js/parallax-image.js' , __FILE__));
    $image_size_opt = '';
    if($image_size) {
      $image_size_opt = $image_size;
    } else {
      $image_size_opt = 'full';
    }
    $banner_bg = wp_get_attachment_image_src($banner_img, "$image_size_opt");

    ob_start(); ?>
    <style> html { height: 1500px; font-size: 0; }</style>

    <div class="mt-addons-parallax-image">
      <?php if($banner_img) { ?>
          <img class="mt-addons-image-position" src="<?php echo esc_attr($banner_bg[0]);?>" alt="parallax-image" />
      <?php } else { ?>
          <img src="https://source.unsplash.com/category/nature/600x600" class="mt-addons-image-position">
      <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-parallax-image', 'modeltheme_addons_for_wpbakery_parallax_image');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Parallax Image", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-parallax-image",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/countdown.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "banner_img"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image Size", 'modeltheme-addons-for-wpbakery'),
          "description" => esc_attr__("Enter image size (Example: thumbnail, medium, large, full or other sizes defined by theme)", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "image_size"
        ),
      )
  ));
}