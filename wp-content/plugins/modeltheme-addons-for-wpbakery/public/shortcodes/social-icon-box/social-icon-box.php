<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_social_icons_box($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'       => '',
      'elementor_icon_fontawesome'          => '#3d404f',
      'icon_type'               => '',
      'icon_dropdown'           => 'fontawesome',
      'icon_fontawesome'        => 'fas fa-adjust',
      'icon_typicons'           => '',
      'icon_openiconic'         => '',
      'icon_entypo'             => '',
      'icon_material'           => '',
      'icon_linecons'           => '',
      'image'                   => '',
      'image_max_width'         => '50',
      'image_margin'            => '20',


      'icon_size'                      => '',
      'icon_color'                     => '',
      'icon_url'                       => '',

      'title_text'          => '',
      'title_size'    => '',

      'color_content'         => '',
      'background_box'        => '',
      'box_shape'           => '',


      'el_class'              => '',
      'el_custom_id'          => '',
 


    ), $params ) );
    
    
   
    wp_enqueue_style( 'social-icon-box-css', plugins_url( '../../css/social-icon-box.css' , __FILE__ ));
    if ($page_builder == 'elementor') {
      // nothing
    }else{
      vc_icon_element_fonts_enqueue( $icon_dropdown );
    }

    if($image) {
      $thumb      = wp_get_attachment_image_src($image, "full");
      $thumb_src  = $thumb[0];
    }
    ob_start(); 

    if ($page_builder == 'elementor') {
      $url_link = modeltheme_addons_for_wpbakery_build_link($icon_url);
    }else{
      $url_link = vc_build_link($icon_url);
    }
    // echo '<pre>' . var_export($url_link, true) . '</pre>';
    
    ?>

    <div class="mt-addons-social-icon-box vc_row <?php echo esc_attr($el_class); ?>">
      <div class="mt-addons-social-icon-box-holder <?php echo esc_attr($box_shape); ?>" style="color:<?php echo esc_attr($color_content); ?>;background-color:<?php echo esc_attr($background_box); ?>">
        <?php if(empty($image)) { ?>
          <?php if($page_builder == 'elementor') { ?>
              <?php $font_icon_class = $elementor_icon_fontawesome; ?>
            <?php }else{ ?>
              <?php $font_icon_class = 'vc_icon_element-icon ' .esc_attr('icon_').$icon_dropdown.' '.esc_attr( ${'icon_' . $icon_dropdown} ); ?>
            <?php } ?>
          <a href="<?php echo esc_url($url_link['url']); ?>" target="<?php echo esc_attr($url_link['target']); ?>" rel="<?php echo esc_attr($url_link['rel']); ?>">
              <span style="font-size:<?php echo esc_attr($icon_size); ?>px;color:<?php echo esc_attr($icon_color); ?>;background:<?php echo esc_attr($bg_color); ?>" 
                class="<?php echo esc_attr($font_icon_class); ?>">
              </span>
            </a>
        <?php } else { ?>
          <a href="<?php echo esc_url($url_link['url']); ?>" target="<?php echo esc_attr($url_link['target']); ?>" rel="<?php echo esc_attr($url_link['rel']); ?>">
            <img alt="list-image" style="max-width:<?php echo esc_attr($image_max_width);?>px;margin-right: <?php echo esc_attr($image_margin);?>px;" class="mt-image-list" src="<?php echo esc_attr($thumb_src); ?>">
          <?php } ?>
          </a>
        <h3 class="mt-addons-social-icon-box-title-text" style="color:<?php echo esc_attr($color_content); ?>; font-size:<?php echo esc_attr($title_size);?>px;"><?php echo esc_html($title_text); ?></h3>
        <a href="<?php echo esc_url($url_link['url']); ?>" target="<?php echo esc_attr($url_link['target']); ?>" rel="<?php echo esc_attr($url_link['rel']); ?>">
          <span class="mt-addons-social-icon-box-button" style="color:<?php echo esc_attr($color_content); ?>;"><?php echo esc_html($url_link['title']); ?> <i class="fas fa-arrow-right"></i></span>
        </a>
      </div>
    </div>
    <?php 

    return ob_get_clean();
}
add_shortcode('mt-addons-social-icons-box', 'modeltheme_addons_for_wpbakery_social_icons_box');
//VC Map
if (function_exists('vc_map')) {


  $params = array();

  $params_shortcode = array(
    array(
      "group" => "Social box setup",
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Box Shape', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "box_shape",
      "value" => array(
        'Select Option'     => '',
        'Rounded'     => 'img-rounded',
        'Circle'     => 'img-circle',
        'Square'     => 'img-square',
      )
    ),
    array(
      "type" => "textfield",
      "group" => "Social box setup",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Social/Title', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_text",
    ),
    array(
      "type" => "vc_number",
      "group" => "Social box setup",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Title Font Size', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_size",
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('"Color of content', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "color_content",
      "value" => "",
      "group" => "Style"
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( 'Background of the box', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "background_box",
      "value" => "",
      "group" => "Style"
    ),
  );

  $icons_vc_fields = modeltheme_addons_icons_vc_fields('Icon');

  if ($icons_vc_fields) {
    foreach ($icons_vc_fields as $icon_field) {
      $params[] = $icon_field;
    }
  }

  if ($params_shortcode) {
    foreach ($params_shortcode as $param) {
      $params[] = $param;
    }
  }

  $extras_vc_fields = modeltheme_addons_extras_vc_fields();
  if ($extras_vc_fields) {
    foreach ($extras_vc_fields as $extra_param) {
      $params[] = $extra_param;
    }
  }

  vc_map(
    array(
      "name" => esc_attr__('MT: Social Icon Box', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-social-icons-box",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/social-icons.svg', __FILE__ ),
      "params" => $params,
  ));
}