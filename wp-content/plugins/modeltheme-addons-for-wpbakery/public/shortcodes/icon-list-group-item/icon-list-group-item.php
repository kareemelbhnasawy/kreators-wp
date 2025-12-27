<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_icon_list($params, $content) {
    extract( shortcode_atts( 
      array(
          'page_builder'       => '',
          'icon_type'               => '',
          'icon_dropdown'           => 'fontawesome',
          'icon_fontawesome'        => 'fas fa-adjust',
          'icon_typicons'           => '',
          'icon_openiconic'         => '',
          'icon_entypo'             => '',
          'icon_material'           => '',
          'icon_linecons'           => '',
          'icon_url'                => '#',
          'icon_position'           => '',
          'image'                   => '',
          'image_max_width'         => '50',
          'image_margin'            => '20',
          'icon_size'               => '30',
          'icon_color'              => '#222',
          'style_block'             => '',
          'section_aligment'        => 'text-center',
          'title_tag'               => 'h3',
          'subtitle_tag'            => 'p',
          'subtitle_weight'         => '',
          'title'                   => '',
          'title_size'              => '',
          'title_height'            => '',
          'title_weight'            => '',
          'title_color'             => '',
          'title_color_hover'       => '',
          'subtitle'                => '',
          'subtitle_size'           => '',
          'subtitle_color'          => '',
          'style_bg'                => 'style_bg_color',
          'bg_color'                => '',
          'style_bg_color'          => '',
          'margin_right'            => '',
          'style_margin_top'        => '',
          'elementor_icon_fontawesome'          => '#3d404f',
          'background_box_color'    => '',
          'box_border_radius'       =>'',
          'el_class'                => '',
          'bg_box_color'             => '',

      ), $params ) );

  wp_enqueue_style( 'icon-css', plugins_url( '../../css/icon-list-group-item.css' , __FILE__ ));
  $thumb_src = '';
  if($image) {
    $thumb      = wp_get_attachment_image_src($image, "full");
    if ($thumb) {
      $thumb_src  = $thumb[0];
    }
  }
  if($page_builder == 'elementor') { 
    //condition
   }else{ 
      if (function_exists('vc_icon_element_fonts_enqueue')) {
        vc_icon_element_fonts_enqueue( $icon_dropdown );
      }
   }

  ob_start(); 

  if ($page_builder == 'elementor') {
    $url_link = modeltheme_addons_for_wpbakery_build_box_icon_link($icon_url);
  }else{
      if (function_exists('vc_build_link')) {
        $url_link = vc_build_link($icon_url);
      } 
  }

  $icon_position_style = 'layout_before';
  if($icon_position == "layout_before") {
    $icon_position_style = 'mt-addons-before_content';
  } else if ($icon_position == "layout_top") {
    $icon_position_style = 'mt-addons-top_content';
  }
  $style_block_style = '';
  if($style_block == "box_shadow") {
    $style_block_style = 'mt-addons-box-shadow';
  }
   $bg_box_color_style = '';
  if($style_block == "bg_box_color") {
    $bg_box_color_style = 'mt-addons-bg-color';
  }
  $uniqid = 'mt-addons-icon'.uniqid();
  
  $title_color_style = '';
  if ($title_color) {
    $title_color_style = 'color:'.$title_color.';';
  }
  $title_size_style = '';
  if ($title_size) {
    $title_size_style = 'font-size:'.$title_size.'px;';
  }
  $title_line_style = '';
  if ($title_height) {
    $title_line_style = 'line-height:'.$title_height.';';
  }
  $title_weight_style = '';
  if ($title_weight) {
    $title_weight_style = 'font-weight:'.$title_weight.';';
  }
    
  $subtitle_size_style = '';
  if ($subtitle_size) {
    $subtitle_size_style = 'font-size:'.$subtitle_size.'px;';
  }
  $subtitle_weight_style = '';
  if ($subtitle_weight) {
    $subtitle_weight_style = 'font-weight:'.$subtitle_weight.';';
  }
  $subtitle_color_style = '';
  if ($subtitle_color) {
    $subtitle_color_style = 'color:'.$subtitle_color.';';
  }
  ?>
  <div style="<?php if($background_box_color){?>background-color:<?php echo esc_attr($background_box_color);}?>;<?php if($box_border_radius){?>border-radius:<?php echo esc_attr($box_border_radius.'px');}?>;" class="mt-icon-listgroup-item wow <?php   echo esc_attr($el_class); echo esc_attr($style_block_style.' '.$bg_box_color_style);?> <?php echo esc_attr($section_aligment.' '.$bg_box_color);?>">
      <div class="mt-icon-listgroup-holder <?php echo esc_attr($icon_position_style); ?>" <?php if($style_margin_top){ ?>style="margin-bottom:<?php echo esc_attr($style_margin_top); ?>px;" <?php } ?>>

        <div class="mt-icon-listgroup-icon-holder-inner <?php echo esc_attr($style_bg); ?>" <?php if($margin_right){ ?>style="margin-right:<?php echo esc_attr($margin_right); ?>px;"<?php } ?>>
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
          </a>
          <?php }?>
        </div>
        <div class="mt-icon-listgroup-content-holder-inner" >
          <<?php echo esc_attr( $title_tag ); ?> class="mt-icon-listgroup-title"><a href="<?php echo esc_url($url_link['url']); ?>" target="<?php echo esc_attr($url_link['target']); ?>" rel="<?php echo esc_attr($url_link['rel']); ?>" style="<?php echo esc_attr($title_size_style);?><?php echo esc_attr($title_line_style);?><?php echo esc_attr($title_weight_style);?><?php echo esc_attr($title_color_style);?>"><?php echo esc_attr($title);?></a>
          </<?php echo esc_attr( $title_tag ); ?>>
          <?php if(!empty($subtitle)){ ?>
            <<?php echo esc_attr( $subtitle_tag ); ?> class="mt-icon-listgroup-text" style="<?php echo esc_attr($subtitle_size_style);?><?php echo esc_attr($subtitle_weight_style);?><?php echo esc_attr($subtitle_color_style);?>"> <?php echo esc_attr($subtitle);?> </<?php echo esc_attr( $subtitle_tag ); ?>>      
           <?php } ?>
        </div>
      </div>
   </div>
   <?php if (function_exists('vc_map')) { ?>
    <style id="<?php  echo esc_attr($uniqid); ?>" type="text/css" media="screen">
      /*.mt-icon-listgroup-title a:hover{ */
      .mt-icon-listgroup-item:hover .mt-icon-listgroup-content-holder-inner .mt-icon-listgroup-title a{
        color: <?php echo esc_attr($title_color_hover); ?>!important;
      }
    </style>
  <?php } ?>
  <?php
  return ob_get_clean();
}
add_shortcode('mt-addons-icon-list', 'modeltheme_addons_for_wpbakery_icon_list');

//VC Map
if (function_exists('vc_map')) {

  $params = array();

  $params_shortcode = array(
    array(
      "group" => "Icon",
      "type" => "dropdown",
      "heading" => esc_attr__("Section Aligment", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "section_aligment",
      "holder" => "div",
      "value" => array(
        'Select'          => '',
        'Left'            => 'text-left',
        'Center'          => 'text-center',
        'Right'           => 'text-right'
      ),
      "class" => ""
    ),
    array(
      "group" => "Icon",
      "type" => "dropdown",
      "heading" => esc_attr__("Icon Position", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "icon_position",
      "holder" => "div",
      "std" => 'round',
      "value" => array(
        'Select'          => '',
        'Before Content'  => 'layout_before',
        'Top'             => 'layout_top'
      ),
      "class" => ""
    ),
    array(
      "group" => "Icon",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Margin Right", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "margin_right",
      "std" => '',
      "holder" => "div",
      "class" => "",
      "dependency" => array(
        'element' => 'icon_position', 
        'value' => "layout_before",
      ),
    ),
    array(
      "group" => "Icon",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Set space between items (Margin Top)", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "style_margin_top",
      "std" => '',
      "holder" => "div",
      "class" => "",
      "dependency" => array(
        'element' => 'icon_position', 
        'value' => "layout_before",
      ),
    ),
    array(
      "group" => "Icon",
      "type" => "dropdown",
      "heading" => esc_attr__("Style", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "style_block",
      "holder" => "div",
      "value" => array(
        'Select'          => '',
        'Box Shadow'      => 'box_shadow',
        'Backgroud Color'      => 'bg_box_color'
      ),
      "class" => ""
    ),
    array(
      "group" => "Icon",
      "type" => "colorpicker",
      "heading" => esc_attr__("Box Background Color", 'modeltheme-addons-for-wpbakery'),
      "description" => __( 'Select Box Background Color.', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "background_box_color",
      "std" => '',
      "holder" => "div",
      "class" => "",
      "dependency" => array(
        'element' => 'style_block', 
        'value' => "bg_box_color",
      ),
    ),
    array(
      "group" => "Icon",
      "type" => "dropdown",
      "heading" => esc_attr__("Style background", 'modeltheme-addons-for-wpbakery'),
      "description" => __( 'Select background style for icon.', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "style_bg",
      "holder" => "div",
      "value" => array(
        'Select'          => '',
        'Background Color'      => 'style_bg_color',
        'No Background Color'      => ''
      ),
      "class" => ""
    ),
    array(
      "group" => "Icon",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Border Radius", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "box_border_radius",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Icon",
      "type" => "colorpicker",
      "heading" => esc_attr__("Image Background Color", 'modeltheme-addons-for-wpbakery'),
      "description" => __( 'Select background color for icon.', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "bg_color",
      "std" => '',
      "holder" => "div",
      "class" => "",
      "dependency" => array(
        'element' => 'style_bg', 
        'value' => "style_bg_color",
      ),
    ),
    array(
      "group" => "Title",
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "type" => "dropdown",
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Element tag", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_tag",
      "value" => array(
          'Select Option' => '',
          'h1'      => 'h1',
          'h2'      => 'h2',
          'h3'      => 'h3',
          'h4'      => 'h4',
          'h5'      => 'h5',
          'h6'      => 'h6',
          'p'       => 'p',
      )
    ),
    array(
      "group" => "Title",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Font Size", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_size",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Title",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Font Weight", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_weight",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Title",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("Line Height", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_height",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Title",
      "type" => "colorpicker",
      "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Title",
      "type" => "colorpicker",
      "heading" => esc_attr__("Color Hover", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color_hover",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Subtitle",
      "type" => "textfield",
      "heading" => esc_attr__("Label/SubTitle", 'modeltheme'),
      "param_name" => "subtitle",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "type" => "dropdown",
      "group" => "Subtitle",
      "class" => "",
      "heading" => esc_attr__( "Element tag", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_tag",
      "value" => array(
          'Select Option' => '',
          'h1'      => 'h1',
          'h2'      => 'h2',
          'h3'      => 'h3',
          'h4'      => 'h4',
          'h5'      => 'h5',
          'h6'      => 'h6',
          'p'       => 'p',
      )
    ),
    array(
      "group" => "Subtitle",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("SubTitle Font Size", 'modeltheme'),
      "param_name" => "subtitle_size",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Subtitle",
      "type" => "vc_number",
      "suffix" => "px",
      "heading" => esc_attr__("SubTitle Weight", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "subtitle_weight",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ),
    array(
      "group" => "Subtitle",
      "type" => "colorpicker",
      "heading" => esc_attr__("SubTitle Color", 'modeltheme'),
      "param_name" => "subtitle_color",
      "std" => '',
      "holder" => "div",
      "class" => ""
    ) 
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
      "name" => esc_attr__("MT: Icon with Text", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-icon-list",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/icon-with-text.svg', __FILE__ ),
      "params" => $params,
  ));
}