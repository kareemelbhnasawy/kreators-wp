<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_masonry_banners($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
          'page_builder'          => '',
          'extra_class'     => ''
        ), $params ) );
    wp_enqueue_style( 'masonry-banners-css', plugins_url( '../../css/masonry-banners.css' , __FILE__ ));
    wp_enqueue_script( 'masonry-banners-js', plugins_url( '../../js/masonry-banners.js' , __FILE__));
    ob_start(); ?>
      <div class="mt-addons-masonry-banners">  
        <?php echo do_shortcode($content); ?>
      </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt_addons_masonry_short', 'modeltheme_addons_for_wpbakery_masonry_banners');
/**
||-> Shortcode: Child Shortcode v1
*/
function modeltheme_addons_for_wpbakery_masonry_banners_items($params, $content = NULL) {

    extract( shortcode_atts( 
        array(
            'page_builder'                    => '',
            'default_skin_background_color'   => '',
            'dark_skin_background_color'      => '',
            'banner_img'                      => '',
            'banner_title'                    => 'Banner Title',
            'banner_subtitle'                 => 'This is the content',
            'banner_url'                      => '#', 
            'banner_title_color'              => '#fff',
            'banner_title_size'               => '30',
            'banner_title_line'               => '24',
            'banner_title_weight'             => '800',
            'banner_subtitle_color'           => '#fff',
            'banner_subtitle_size'            => '16',
            'banner_subtitle_line'            => '26',
            'banner_subtitle_weight'          => '300',
            'button_status'                   => '',
            'banner_button_text'              => 'VIEW MORE', 
            'button_style'                    => '',
            'button_color'                    => '#fff',
            'button_background'               => '',
            'layout'                          => '',
        ), $params ) );
    wp_enqueue_style( 'masonry-banners-css', plugins_url( '../../css/masonry-banners.css' , __FILE__ ));
    wp_enqueue_script( 'masonry-banners-js', plugins_url( '../../js/masonry-banners.js' , __FILE__));
    $banner_bg = wp_get_attachment_image_src($banner_img, "large");

    if ($page_builder == 'elementor') {
      $url_link = modeltheme_addons_for_wpbakery_build_banner_link($banner_url);
    }else{
        $url_link = vc_build_link($banner_url);
    }
    ob_start(); 
    $banner_possition_start = '';
    $banner_possition_end = '';
    if ($layout == "top_right" or $layout == "") {
      $banner_possition_start = '<div class="mt-addons-banner-offset col-sm-6 col-sm-offset-6">';
      $banner_possition_end = '</div>'; 
    }
    ?>
    <div class="mt-addons-grid col-md-6">
      <div class="mt-addons-banner relative">

        <a href=" <?php echo esc_url($url_link['url']); ?>" target="<?php echo esc_attr($url_link['target']); ?>" rel="<?php echo esc_attr($url_link['rel']); ?>">
        <?php if($banner_img) { ?>
          <img src="<?php echo esc_attr($banner_bg[0]);?>" alt="<?php echo esc_attr($banner_title);?>" />
        <?php } else { ?>
          <img src="//via.placeholder.com/650x300" alt="<?php echo esc_attr($banner_title);?>" />
        <?php } ?>
        <div class="mt-addons-banner-holder">
          <?php echo wp_kses_post($banner_possition_start); ?>
            <h3 class="mt-addons-banner-title" style="color:<?php echo esc_attr($banner_title_color);?>;font-size:<?php echo esc_attr($banner_title_size);?>px;line-height:<?php echo esc_attr($banner_title_line);?>px;font-weight:<?php echo esc_attr($banner_title_weight);?>;"><?php echo esc_attr($banner_title);?></h3>
            <p class="mt-addons-banner-subtitle" style="color:<?php echo esc_attr($banner_subtitle_color);?>;font-size:<?php echo esc_attr($banner_subtitle_size);?>px;line-height:<?php echo esc_attr($banner_subtitle_line);?>px;font-weight:<?php echo esc_attr($banner_subtitle_weight);?>;"><?php echo esc_attr($banner_subtitle);?></p>
            <?php if($page_builder == 'elementor' && $button_status == "yes") { ?>
              <span class="mt-addons-banner-button <?php echo esc_attr($button_style);?>" style="color:<?php echo esc_attr($button_color);?>;background:<?php echo esc_attr($button_background);?>;"><?php echo esc_html($banner_button_text);?></span>
            <?php } ?>
          <?php //banner possition end ?>
          <?php echo wp_kses_post($banner_possition_end); ?>
        </div>
        </a>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt_addons_masonry_short_item', 'modeltheme_addons_for_wpbakery_masonry_banners_items');

/**
||-> Map Shortcode in Visual Composer with: vc_map();
*/
if (function_exists('vc_map')) {
    vc_map( array(
        "name" => esc_attr__("MT: Masonry Banners", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt_addons_masonry_short",
        "as_parent" => array('only' => 'mt_addons_masonry_short_item'), 
        "content_element" => true,
        "show_settings_on_create" => true,
        "icon" => 'modeltheme_shortcode',
        "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
        "is_container" => true,
        "params" => array(
            array(
               "group" => "Options",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Extra Class",'modeltheme-addons-for-wpbakery'),
               "param_name" => "extra_class",
               "std" => '',
               "description" => esc_attr__("",'modeltheme-addons-for-wpbakery')
            ),  
        ),
        "js_view" => 'VcColumnView'
    ) );
    vc_map( array(
        "name" => esc_attr__("MT: Banner", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt_addons_masonry_short_item",
        "content_element" => true,
        "as_child" => array('only' => 'mt_addons_masonry_short'),
        "params" => array(
          array(
            "group" => "Settings",
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Image", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "banner_img"
          ),
          array(
            "group" => "Settings",
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "banner_title"
          ),
          array(
            "group" => "Settings",
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Subtitle", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "banner_subtitle"
          ),
          array(
            "group" => "Settings",
            "type" => "vc_link",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Link", 'modeltheme'),
            "param_name" => "banner_url",
            "value" => esc_attr__("#", 'modeltheme')
          ),
          array(
            "group" => "Settings",
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Text Layout", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "layout",
            "value" => array(
              esc_attr__('Select', "modeltheme-addons-for-wpbakery")          => '',
              esc_attr__('Top Left ', "modeltheme-addons-for-wpbakery")       => 'top_left',
              esc_attr__('Top Right', "modeltheme-addons-for-wpbakery")       => 'top_right'
            ),
          ),
          array(
            "group" => "Title Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "banner_title_color"
          ),
          array(
            "type" => "vc_number",
            "group" => "Title Styling",
            "class" => "",
            "heading" => esc_attr__( "Font size", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_title_size"
          ),
          array(
            "type" => "vc_number",
            "group" => "Title Styling",
            "class" => "",
            "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_title_line"
          ),
          array(
            "type" => "vc_number",
            "group" => "Title Styling",
            "class" => "",
            "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_title_weight"
          ),
          array(
            "group" => "Subtitle Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "banner_subtitle_color"
          ),
          array(
            "type" => "vc_number",
            "group" => "Subtitle Styling",
            "class" => "",
            "heading" => esc_attr__( "Font size", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_subtitle_size"
          ),
          array(
            "type" => "vc_number",
            "group" => "Subtitle Styling",
            "class" => "",
            "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_subtitle_line"
          ),
          array(
            "type" => "vc_number",
            "group" => "Subtitle Styling",
            "class" => "",
            "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_subtitle_weight"
          ),
          array(
            "group" => "Button",
            "type" => "checkbox",
            "class" => "",
            "heading" => esc_attr__("Status", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "button_status",
            "value"       => array(
              "Enabled" => "true",
            ),
          ),
          array(
            "type" => "textfield",
            "group" => "Button",
            "class" => "",
            "heading" => esc_attr__( "Text", 'modeltheme-addons-for-wpbakery' ),
            "param_name" => "banner_button_text",
            "dependency" => array(
              'element' => 'button_status', 
              'value' => "true",
            ),
          ),
          array(
            "group" => "Button",
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Style", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "button_style",
            "dependency" => array(
              'element' => 'button_status',
              'value' => "true",
            ),
            "value" => array(
              'Select'  => '',
              'Rounded'                 => 'round',
              'Boxed with Color'        => 'boxed'
            ),
          ),
          array(
            "group" => "Button",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
            "dependency" => array(
              'element' => 'button_status',
              'value' => "true",
            ),
            "param_name" => "button_color"
          ),
          array(
            "group" => "Button",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__("Background", 'modeltheme-addons-for-wpbakery'),
            "dependency" => array(
              'element' => 'button_status',
              'value' => "true",
            ),
            "param_name" => "button_background"
          ),      
        )
    ) );
    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_mt_addons_masonry_short extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_mt_addons_masonry_short_item extends WPBakeryShortCode {
        }
    }
}