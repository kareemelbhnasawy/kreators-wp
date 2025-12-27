<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_pricing_table($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                 => '',
      'package_currency'             => '',
      'package_price'                => '',
      'price_size'                   => '',
      'package_name'                 => '',
      'title_size'                   => '',
      'package_description'          => '',
      'description_size'             => '',
      'editor_content'               => '',
      'button_url'                   => '',
      'package_name_color'           => '',
      'price_color'                  => '',
      'package_description_color'    => '',
      'btn_size'                     => '',
      'btn_style'                    => '',
      'font_size'                    => '',
      'button_bg_color'              => '',
      'button_color'                 => '',
      'package_background_color'     => '',
      'border_color'                 => '',
      'package_feature'              => '',
      'package_feature_icon'         => '',
      'section_align'                => '',
      'title_align'                  =>'',
      'style_var'                    => '',
      'feature_icon_color'           => '',
      'package_background_title'     => '',
      'inline_row'                   => '',
      'package_bg_color_hover'       => '',
      'feature_list'                 => '',
      'no_container_row'             => '',
      'pricing_groups'               => '',
      'description_align'            => '',

    ), $params ) );
   
    $params['editor_content'] = $content;

    wp_enqueue_style( 'mt-pricing-table', plugins_url( '../../css/pricing-table.css' , __FILE__ ));
    $colors_ID = 'mt-addons-pricing-'.uniqid();


    ob_start(); 
    $container_row_start = '';
    $container_row_end = '';
    $in_container_row_start = '';
    $in_container_row_end = '';


    if ($inline_row == "true") {
      $container_row_start = '<div class="mt-addons-pricing-row row ">';
      $container_row_end = '</div>';
    }
    if ($page_builder == 'elementor') {
      $url_link = modeltheme_addons_for_wpbakery_build_pricing_link($button_url);
    }else{
      $url_link = vc_build_link($button_url);
    }
    ?>

    <?php if( $style_var == 'style_1' or $style_var == '') { ?>
      <div class="mt-addons-pricing-table-section" id="<?php echo esc_attr($colors_ID); ?>" style="background:<?php echo esc_attr($package_background_color); ?>; ">
        <h2 class="mt-addons-pricing-table-title <?php echo $title_align;?>" style="color:<?php echo esc_attr($package_name_color); ?>; font-size:<?php echo esc_attr($title_size); ?>px;"><?php echo esc_html($package_name); ?></h2>
          <p class="mt-addons-pricing-table-price <?php echo $section_align;?>" style="color:<?php echo esc_attr($price_color); ?>; font-size:<?php echo esc_attr($price_size); ?>px;">
            <span><?php echo esc_attr($package_currency); ?></span><?php echo esc_attr($package_price); ?>
          </p>
          <p class="mt-addons-pricing-table-sub text-center" style="color:<?php echo esc_attr($package_description_color); ?>;font-size:<?php echo esc_attr($description_size); ?>px;"><?php echo esc_html($package_description); ?>
          </p>
          <div class="mt-addons-pricing-table-feature">
           
          <?php if ($page_builder == 'elementor') { ?>
            <?php  echo $params['content']; ?>
          <?php } else{ ?>
            <?php if(!empty($content)){ ?>
              <?php echo html_entity_decode($content); ?>
            <?php } ?>
          <?php } ?>

          </div>
        <div class="mt-addons-pricing-table-button-holder text-center">
          <a class="mt-addons-pricing-table-button <?php echo esc_attr($btn_size.' '.$btn_style); ?>"
            style="font-size: <?php echo esc_attr($font_size.'px'); ?>;        
            background-color: <?php echo esc_attr($button_bg_color); ?>;
            color: <?php echo esc_attr($button_color); ?>;"
            target="<?php echo esc_attr($url_link['target']); ?>" 
            rel="<?php echo esc_attr($url_link['rel']); ?>" 
            href="<?php echo esc_url($url_link['url']); ?>">
            <?php echo esc_html($url_link['title']); ?>
          </a>
        </div>
        <style type="text/css" media="screen">
        <?php echo esc_attr('#'.$colors_ID); ?>.mt-addons-pricing-table-section:hover {
          border-top:3px solid <?php echo $border_color; ?>;
          transition: border-color 0.5s;
        }
        </style>
      </div>
    <?php } else { ?>
      <?php //container row start ?>
      <?php echo wp_kses_post($container_row_start); ?> 
        <div class="mt-addons-pricing-table-section-v2 " id="<?php echo esc_attr($colors_ID); ?>" style="background:<?php echo esc_attr($package_background_color); ?>;">
         <?php if (isset($package_name) && !empty($package_name)) { ?>
          <div class="mt-addons-pricing-table-title-v2 <?php echo $title_align;?>" style="color:<?php echo esc_attr($package_name_color); ?>; background:<?php echo esc_attr($package_background_title); ?>; font-size:<?php echo esc_attr($title_size); ?>px;"><?php echo esc_html($package_name); ?>
          </div>
         <?php }?>
         <?php if (isset($package_price) && !empty($package_price)) { ?>
          <div class="mt-addons-pricing-table-price-v2 <?php echo $section_align;?>" style="color:<?php echo esc_attr($price_color); ?>; font-size:<?php echo esc_attr($price_size); ?>px;">
            <span><?php echo esc_attr($package_currency); ?></span><?php echo esc_attr($package_price); ?>
          </div>
         <?php }?>

          <p class="mt-addons-pricing-table-sub-v2 <?php echo $description_align;?>" style="color:<?php echo esc_attr($package_description_color); ?>;font-size:<?php echo esc_attr($description_size); ?>px;"><?php echo esc_html($package_description); ?>
          </p>
          <ul class="mt-addons-pricing-table-feature-v2 <?php echo esc_attr($no_container_row); ?>">
            <?php if ($page_builder == 'elementor') { ?>
             <?php $pricing_groups_content = unserialize(base64_decode($pricing_groups));?>
            <?php }else{?>
             <?php 
               if (function_exists('vc_param_group_parse_atts')) {
                $pricing_groups_content = vc_param_group_parse_atts($params['pricing_groups']);
               }
             ?>
            <?php  } ?>
            <?php echo mt_addons_get_pricing_param_group_li($pricing_groups_content);?>
          </ul>
          <div class="mt-addons-pricing-table-button-holder-v2">
          <a class="mt-addons-pricing-table-button <?php echo esc_attr($btn_size.' '.$btn_style); ?>"
            style="font-size: <?php echo esc_attr($font_size.'px'); ?>;        
            background-color: <?php echo esc_attr($button_bg_color); ?>;
            color: <?php echo esc_attr($button_color); ?>;"
            target="<?php echo esc_attr($url_link['target']); ?>" 
            rel="<?php echo esc_attr($url_link['rel']); ?>" 
            href="<?php echo esc_url($url_link['url']); ?>">
            <?php echo esc_html($url_link['title']); ?>
          </a>
          </div>
          <style type="text/css" media="screen">
            <?php echo esc_attr('#'.$colors_ID); ?>.mt-addons-pricing-table-section-v2:hover {
              background: <?php echo esc_attr($package_bg_color_hover);?>!important;
            }
          </style>
        </div>
        <?php //container row start ?>
      <?php echo wp_kses_post($container_row_end); ?> 
  <?php } ?>
 


    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-pricing-table', 'modeltheme_addons_for_wpbakery_pricing_table');

function mt_addons_get_pricing_param_group_li($param_group){
    $html = '';
    if ($param_group) {
      foreach($param_group as $param){
        if (!array_key_exists('feature_icon_color', $param)) {
          $feature_icon_color = '';
        }else{
          $feature_icon_color = $param['feature_icon_color'];
        }
        if (!array_key_exists('feature_list', $param)) {
          $feature_list = '';
        }else{
          $feature_list = $param['feature_list'];
        }
      
        $title = $icon = ''; 
          #title
          if (isset($param['package_feature']) && !empty($param['package_feature'])) {
            $title = $param['package_feature'];
          }
          if (!array_key_exists('package_feature_icon', $param)) {
            $package_feature_icon = '';
          }else{
            $package_feature_icon = $param['package_feature_icon'];
          }
          #icon
          if (isset($param['package_feature_icon']) && !empty($param['package_feature_icon'])) {
            $icon = $param['package_feature_icon'];
          }
        if(!empty($package_feature_icon)){ 
          $icon = $package_feature_icon['value'];
        }
          $html .= '<li class="mt-addons-pricing-feature '.$feature_list.'"> '.$title.'<i class=" '.$icon.'" style="color:'.$feature_icon_color.'"></i></li>';
      }
    }
    return $html;
}

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Pricing Table", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-pricing-table",
      "category" => esc_attr__('MT Addons', "modeltheme-addons-for-wpbakery"),
      "icon" => plugins_url( 'images/pricing-table.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "dropdown",
          "heading" => esc_attr__("Style", "modeltheme-addons-for-wpbakery"),
          "param_name" => "style_var",
          "value" => array(
            esc_attr__('Select', "modeltheme-addons-for-wpbakery")   => '',
            esc_attr__('Style 1', "modeltheme-addons-for-wpbakery")  => 'style_1',
            esc_attr__('Style 2', "modeltheme-addons-for-wpbakery")  => 'style_2',
          ),
          "holder" => "div",
          "class" => "",
          "std" => "style_1"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package name", "modeltheme-addons-for-wpbakery"),
          "param_name" => "package_name",
          "value" => ""
        ),
         array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( "Package Name Aligment", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "title_align",
          "value" => array(
              esc_attr__('Select Option' , "modeltheme-addons-for-wpbakery")=> '',
              esc_attr__('Left', "modeltheme-addons-for-wpbakery")          => 'text-left',
              esc_attr__('Center', "modeltheme-addons-for-wpbakery")        => 'text-center',
              esc_attr__('Right' , "modeltheme-addons-for-wpbakery")        => 'text-right',
          ),
          "default" => 'text-left'
        ),
        array(
          "type" => "vc_number",
          "suffix" => "px",
          "class" => "",
          "heading" => esc_attr__( "Font size", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "title_size"
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( "Price Aligment", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "section_align",
          "value" => array(
              esc_attr__('Select Option' , "modeltheme-addons-for-wpbakery")=> '',
              esc_attr__('Left', "modeltheme-addons-for-wpbakery")          => 'text-left',
              esc_attr__('Center', "modeltheme-addons-for-wpbakery")        => 'text-center',
              esc_attr__('Right' , "modeltheme-addons-for-wpbakery")        => 'text-right',
          ),
          "default" => 'text-center'
        ),
        array(
          "type" => "vc_number", 
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package price", "modeltheme-addons-for-wpbakery"),
          "param_name" => "package_price",
          "value" => ""
        ),
        array(
          "type" => "vc_number",
          "suffix" => "px",
          "class" => "",
          "heading" => esc_attr__( "Price size", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "price_size"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package currency", "modeltheme-addons-for-wpbakery"),
          "param_name" => "package_currency",
          "value" => ""
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package Description", "modeltheme-addons-for-wpbakery"),
          "param_name" => "package_description",
          "value" => "",
        ),
        array(
          "type" => "vc_number",
          "suffix" => "px",
          "class" => "",
          "heading" => esc_attr__( "Description size", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "description_size",
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( "Description Aligment", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "description_align",
          "value" => array(
            esc_attr__('Select Option' , "modeltheme-addons-for-wpbakery")=> '',
            esc_attr__('Left', "modeltheme-addons-for-wpbakery")          => 'text-left',
            esc_attr__('Center', "modeltheme-addons-for-wpbakery")        => 'text-center',
            esc_attr__('Right' , "modeltheme-addons-for-wpbakery")        => 'text-right',
          ),
        ),
        array(
          'type' => 'textarea_html',
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package's feature", "modeltheme-addons-for-wpbakery"),
          "param_name" => "content",
          "value" => "",
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_1",
          ),
        ),
        array(
          "group" => "Pricing Button",
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package Button Text and URL", "modeltheme-addons-for-wpbakery"),
          "param_name" => "button_url",
          "value" => esc_attr__("#", "modeltheme-addons-for-wpbakery")
        ),
        array(
          "group" => "Pricing Button",
          "type" => "dropdown",
          "heading" => esc_attr__("Size", "modeltheme-addons-for-wpbakery"),
          "param_name" => "btn_size",
          "value" => array(
            'Select Option'     => '',
            esc_attr__('Small', "modeltheme-addons-for-wpbakery")   => 'btn btn-sm',
            esc_attr__('Medium', "modeltheme-addons-for-wpbakery")   => 'btn btn-medium',
            esc_attr__('Large', "modeltheme-addons-for-wpbakery")   => 'btn btn-lg',
            esc_attr__('Extra-Large', "modeltheme-addons-for-wpbakery")   => 'extra-large'
          ),
          "std" => 'normal',
          "holder" => "div",
          "class" => "",
        ),
        array(
          "group"     =>  'Pricing Button',
          "type"      =>  "vc_number",
          "heading"     =>  esc_html__( 'Font Size', 'accordion' ),
          "param_name"  =>  "font_size",
          "description"   =>  esc_html__( 'in pixels', 'accordion' ),
          "value"     =>  ""
        ),
        array(
          "group" => "Pricing Button",
          "type" => "dropdown",
          "heading" => esc_attr__("Shape", "modeltheme-addons-for-wpbakery"),
          "param_name" => "btn_style",
          "value" => array(
            'Select Option'     => '',
            esc_attr__('Square (Default)', "modeltheme-addons-for-wpbakery")   => 'btn-square',
            esc_attr__('Rounded (5px Radius)', "modeltheme-addons-for-wpbakery")   => 'btn-rounded',
            esc_attr__('Round (30px Radius)', "modeltheme-addons-for-wpbakery")   => 'btn-round',
          )
        ),
        array(
          "group" => "Pricing Button",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Button Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Button Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "button_color"
        ),
        array(
          "group" => "Pricing Button",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Background Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "button_bg_color"
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Title Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Background Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "package_background_title",
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_1",
          ),
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_2",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package Background Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Package Background Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "package_background_color"
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Package Background Color - Hover", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Package Background Color - Hover.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "package_bg_color_hover",
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_2",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Title Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Title Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "package_name_color"
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Price Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Price Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "price_color"
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Description Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Description Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "package_description_color",
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_1",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Border Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Border Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "border_color",
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_1",
          ),
        ),
        array(
          "type" => "checkbox",
          "class" => "",
          "heading" => esc_attr__("Inline", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "inline_row",
          "value"       => array(
            "Enabled" => "true",
          ),
          "dependency" => array(
            'element' => 'style_var',
            'value' => "style_2",
          ),
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( "Container", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "no_container_row",
          "value" => array(
              esc_attr__('Select Option' , "modeltheme-addons-for-wpbakery")=> '',
              esc_attr__('Margin', "modeltheme-addons-for-wpbakery")          => 'padding',
              esc_attr__('No Margin', "modeltheme-addons-for-wpbakery")        => 'nomargin',
          ),
        ),
        array(
          'type' => 'param_group',
          'value' => '',
          'param_name' => 'pricing_groups',
           "dependency" => array(
            'element' => 'style_var',
            'value' => "style_2",
          ),
          'params' => array(
            array(
              "group" => "Options",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Package's feature List", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "package_feature",
              "description" => ""
            ),
            array(
              "type" => "dropdown",
              "class" => "",
              "heading" => esc_attr__( "Package's feature List Position", 'modeltheme-addons-for-wpbakery' ),
              "param_name" => "feature_list",
              "value" => array(
                  esc_attr__('Select Option' , "modeltheme-addons-for-wpbakery")=> '',
                  esc_attr__('Left', "modeltheme-addons-for-wpbakery")          => 'text-left',
                  esc_attr__('Center', "modeltheme-addons-for-wpbakery")        => 'text-center',
                  esc_attr__('Right' , "modeltheme-addons-for-wpbakery")        => 'text-right',
              ),
            ),
            array(
              'type' => 'iconpicker',
              'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
              'param_name' => 'package_feature_icon',
              'value' => '',
              'settings' => array(
                  'emptyIcon' => true,
                  'iconsPerPage' => 100,
              ),
              'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
            ),
            array(
              "group" => "Styling",
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Icon Color", "modeltheme-addons-for-wpbakery"),
              'description' => __( 'Select Icon Color.', "modeltheme-addons-for-wpbakery" ),
              "param_name" => "feature_icon_color",
            ),
          ),
        )
      )
  ));
}