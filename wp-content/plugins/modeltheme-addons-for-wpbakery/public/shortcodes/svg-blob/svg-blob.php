<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_svg_blob($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'   => '',
      'color_or_image' => '', 
      'animation'      => '', 
      'back_color'     => '', 
      'clip_path'      => '',
      'skillvalue'     => '',
      'blob_width'     => '100%',
      'image'          => '',
      'extra_class'    => ''
    ), $params ) );
   
    wp_enqueue_style( 'svg-blob-css', plugins_url( '../../css/svg-blob.css' , __FILE__ ));
    if($image) {
      $image      = wp_get_attachment_image_src($image, "full");
      $image_src  = $image[0];
    }
    $id = uniqid();
    ob_start(); ?>

    <div class="svg-block <?php echo esc_attr($extra_class);?>" >
      <svg viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width:<?php echo esc_attr($blob_width)?>;">
        <?php if($color_or_image == 'choosed_color'){ ?>
          <path fill="<?php echo esc_attr($back_color);?>" d="<?php echo esc_attr($clip_path);?>" />
        <?php } else if ($color_or_image == 'choosed_image') { ?>
        <defs>
          <clipPath id="blob-<?php echo $id;?>">
              <path fill="#474bff" d="<?php echo esc_attr($clip_path);?>"/>
          </clipPath>
        </defs>
        <image x="0" y="0" width="100%" height="100%" alt="svg-blob" clip-path="url(#blob-<?php echo $id;?>)" xlink:href="<?php echo esc_attr($image_src);?>" preserveAspectRatio="xMidYMid slice"></image>
        <?php } ?>
      </svg>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-svg-blob', 'modeltheme_addons_for_wpbakery_svg_blob');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: SVG Blob", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-svg-blob",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/thumbnail.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Type", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "color_or_image",
          "std" => '',
          "description" => esc_attr__("Choose what you want to use: image/color", 'modeltheme-addons-for-wpbakery'),
          "value" => array(
            'Select'  => '',
            'Use an image'     => 'choosed_image',
            'Use a color'      => 'choosed_color'
          )
        ),
        array(
          "dependency" => array(
            'element' => 'color_or_image',
            'value' => array( 'choosed_color' ),
          ),
          "heading" => esc_attr__("Background color", 'modeltheme-addons-for-wpbakery'),
          "type" => "colorpicker",
          "param_name" => "back_color",
          "holder" => "div",
          "class" => "",
          "value" => ''
        ),
        array(
          "dependency" => array(
            'element' => 'color_or_image',
            'value' => array( 'choosed_image' ),
          ),
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Image", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "image",
          "value" => "",
          "description" => esc_attr__( "Choose background image", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "type" => "textfield",
          "class" => "",
          "heading" => esc_attr__("Clip Path", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "clip_path",
          "description" => esc_attr__("Create the blob shape at https://10015.io/tools/svg-blob-generator",'modeltheme-addons-for-wpbakery')
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Blob Width", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "blob_width",
          "description" => esc_attr__("Set with by px or %.",'modeltheme-addons-for-wpbakery')
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Extra Class", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "extra_class"
        )
      )
  ));
}