<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}


/**
 * @author Cristi
 */
function modeltheme_addons_for_wpbakery_button($params, $content) {
  extract( shortcode_atts( 
    array(
    'page_builder'       => '',
    'btn_url'       => '',
    'btn_theme_default'      => '',
    'btn_size'      => '',
    'btn_style'      => '',
    'display_type'      => '',
    'font_size'      => '',
    'font_weight'    => '',
    'align'      => '',
    'color'      => '',
    'bg_color_hover'      => '',
    'text_color'      => '',
    'text_color_hover'      => '',
    'border_status'      => '',
    'border_width'      => '',
    'border_color'      => '',
    'border_color_hover'      => '',
    'box_shadow_status'      => '',
    'box_shadow_offset_x'      => '',
    'box_shadow_offset_y'      => '',
    'box_shadow_blur'      => '',
    'box_shadow_color'      => '',
    'box_shadow_color'      => '',
    'margin'             => '',
    'btn_margin'        => '',
    'padding'        => '',
    'btn_padding'        => '',





  ), $params ) ); 

  wp_enqueue_style( 'mt-button', plugins_url( '../../css/button.css' , __FILE__ ));

  ob_start(); 

  if ($display_type) {
    $display_type = 'inline-block';
  }
  $style_margin = '';
  if (!empty($btn_margin)) {
    $style_margin = $btn_margin;
  }
  $style_padding = '';
  if (!empty($btn_padding)) {
    $style_padding = $btn_padding;
  }

  $border_atts = $border_styling = '';
  if ($border_status) {
    $border_atts .= 'data-border="'.esc_attr($border_width).'px solid '.esc_attr($border_color).'" ';
    $border_atts .= 'data-border-hover="'.esc_attr($border_width).'px solid '.esc_attr($border_color_hover).'"';
    $border_styling = esc_attr($border_width).'px solid '.esc_attr($border_color).';';
  }
  $box_shadow_style = '';
  if ($box_shadow_status) {
    $box_shadow_style = $box_shadow_offset_x.'px '.$box_shadow_offset_y.'px '.$box_shadow_blur.'px '.$box_shadow_color;
  }

  $btn_theme_default_class = '';
  if($btn_theme_default){
    $btn_theme_default_class = 'mt-addons_button--theme_default';
  }

  if ($page_builder == 'elementor') {
   $url_link = modeltheme_addons_for_wpbakery_build_link($btn_url);
  }else{
    if (function_exists('vc_build_link')) {
      $url_link = vc_build_link($btn_url);
    }
  }
  ?>

  <div class="mt-addons_button_holder <?php echo esc_attr($align.' '.$btn_style.' '.$display_type. ' '.$btn_theme_default_class); ?>">
    <a 
      data-text-color="<?php echo esc_attr($text_color); ?>" 
      data-text-color-hover="<?php echo esc_attr($text_color_hover); ?>" 
      data-bg="<?php echo esc_attr($color); ?>" 
      data-bg-hover="<?php echo esc_attr($bg_color_hover); ?>" 
      target="<?php echo esc_attr($url_link['target']); ?>" 
      rel="<?php echo esc_attr($url_link['rel']); ?>"
      href="<?php echo esc_url($url_link['url']); ?>" 
      class="mt-addons_button <?php echo esc_attr($btn_size); ?>" 
      <?php echo $border_atts; ?> 
      style="
        font-size: <?php echo esc_attr($font_size.'px'); ?>;
        font-weight: <?php echo esc_attr($font_weight); ?>;
        background-color: <?php echo esc_attr($color); ?>;
        color: <?php echo esc_attr($text_color); ?>;
        border: <?php echo esc_attr($border_styling); ?>;
        box-shadow: <?php echo esc_attr($box_shadow_style); ?>; -webkit-box-shadow: <?php echo esc_attr($box_shadow_style); ?>; 
        margin: <?php echo esc_attr($style_margin); ?>;
        padding: <?php echo esc_attr($style_padding); ?>;

      ">
      <?php echo esc_html($url_link['title']); ?>
    </a>
  </div>

  <?php
  return ob_get_clean();
}
add_shortcode('mt-addons-button', 'modeltheme_addons_for_wpbakery_button');


if (function_exists('vc_map')) {
  vc_map( array(
     "name" => esc_attr__("MT: Button", "modeltheme-addons-for-wpbakery"),
     "base" => "mt-addons-button",
     "category" => esc_attr__('MT Addons', "modeltheme-addons-for-wpbakery"),
     "icon" => plugins_url( 'images/button.svg', __FILE__ ),
     "params" => array(
        array(
          "heading" => __( "Link & Text", "modeltheme-addons-for-wpbakery" ),
          "group" => "Options",
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "param_name" => "btn_url",
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Size", "modeltheme-addons-for-wpbakery"),
          "param_name" => "btn_size",
          "value" => array(
            esc_attr__('Small', "modeltheme-addons-for-wpbakery")   => 'mt-addons-btn-sm',
            esc_attr__('Medium', "modeltheme-addons-for-wpbakery")   => 'mt-addons-btn-medium',
            esc_attr__('Large', "modeltheme-addons-for-wpbakery")   => 'mt-addons-btn-lg',
            esc_attr__('Extra-Large', "modeltheme-addons-for-wpbakery")   => 'mt-addons-btn-extra-large'
          ),
          "std" => 'normal',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "type"      =>  "vc_number",
          "heading"     =>  esc_html__( 'Font Size', 'modeltheme-addons-for-wpbakery' ),
          "param_name"  =>  "font_size",
          "description"   =>  esc_html__( 'in pixels', 'modeltheme-addons-for-wpbakery' ),
          "value"     =>  "",
          "group"     =>  'Options',
        ),
        array(
          "type" => "vc_number",
          "suffix" => "E.g.: 500",
          "group" => "Options",
          "class" => "",
          "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "font_weight"
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Shape", "modeltheme-addons-for-wpbakery"),
          "param_name" => "btn_style",
          "value" => array(
            esc_attr__('Square (Default)', "modeltheme-addons-for-wpbakery")   => 'btn-square',
            esc_attr__('Rounded (5px Radius)', "modeltheme-addons-for-wpbakery")   => 'btn-rounded',
            esc_attr__('Round (30px Radius)', "modeltheme-addons-for-wpbakery")   => 'btn-round',
          ),
          "std" => 'normal',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Alignment", "modeltheme-addons-for-wpbakery"),
          "param_name" => "align",
          "value" => array(
            esc_attr__('Left', "modeltheme-addons-for-wpbakery")   => 'text-left',
            esc_attr__('Center', "modeltheme-addons-for-wpbakery")   => 'text-center',
            esc_attr__('Right', "modeltheme-addons-for-wpbakery")   => 'text-right'
          ),
          "std" => 'normal',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "checkbox",
          "class" => "",
          "heading" => __( "Inline Block", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "display_type",
          "value" => __( "inline-block", "modeltheme-addons-for-wpbakery" ),
          "description" => __( "If checked, the button will allow other content next to it", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Options",
          "type" => "checkbox",
          "class" => "",
          "heading" => __( "Margin", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "margin",
          "value" => __( "margin", "modeltheme-addons-for-wpbakery" ),
          "description" => __("If checked, the button will allow to set custom margin", "modeltheme-addons-for-wpbakery")
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button Margin", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "btn_margin",
          "value" => "",
          "dependency" => array(
            'element' => 'margin',
            'value' => "true",
          ),
          "description" => esc_attr__("Example: 25px 50px 75px 100px (top margin is 25px; right margin is 50px;
          bottom margin is 75px;left margin is 100px).", "modeltheme-addons-for-wpbakery" ),
        ),
        array(
          "group" => "Options",
          "type" => "checkbox",
          "class" => "",
          "heading" => __( "Padding", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "padding",
          "value" => __( "padding", "modeltheme-addons-for-wpbakery" ),
          "description" => __("If checked, the button will allow to set custom padding", "modeltheme-addons-for-wpbakery")
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button Padding", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "btn_padding",
          "value" => "",
          "dependency" => array(
            'element' => 'padding',
            'value' => "true",
          ),
          "description" => esc_attr__("Example: 50px 30px 50px 80px (top margin is 50px; right margin is 30px;
          bottom margin is 50px;left margin is 80px).", "modeltheme-addons-for-wpbakery" ),
        ),
        array(
          "heading" => __( "Theme Default Button?", "modeltheme-addons-for-wpbakery" ),
          "group" => "Styling",
          "type" => "checkbox",
          "class" => "",
          "param_name" => "btn_theme_default",
          "description" => __( "If checked, the button will inherit styling from the theme (colors/border/box shadow). By filling the options below the default options will be overridden.", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Background color", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "color",
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Background color - hover", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "bg_color_hover",
         ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Text color", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "text_color",
          "description" => esc_attr__( "Choose text color", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Text color - hover", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "text_color_hover",
          "description" => esc_attr__( "Choose text color", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "checkbox",
          "class" => "",
          "heading" => __( "Border", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "border_status",
          "description" => __( "If checked, the button have border", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "vc_number",
          "class" => "",
          "heading" => __( "Border Width", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "border_width",
          "dependency" => array(
            'element' => 'border_status',
            'value' => "true",
          ),
          "description" => __( "Ex: 5", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Border Color", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "border_color",
          "dependency" => array(
            'element' => 'border_status',
            'value' => "true",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Border Color - Hover", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "border_color_hover",
          "dependency" => array(
            'element' => 'border_status',
            'value' => "true",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "checkbox",
          "class" => "",
          "heading" => __( "Box Shadow", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "box_shadow_status",
          "description" => __( "If checked, the button have box shadow", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Styling",
          "type" => "vc_number",
          "class" => "",
          "heading" => __( "Box Shadow Offset X (px)", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "box_shadow_offset_x",
          "dependency" => array(
            'element' => 'box_shadow_status',
            'value' => "true",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "vc_number",
          "class" => "",
          "heading" => __( "Box Shadow Offset Y (px)", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "box_shadow_offset_y",
          "dependency" => array(
            'element' => 'box_shadow_status',
            'value' => "true",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "vc_number",
          "class" => "",
          "heading" => __( "Box Shadow Blur (px)", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "box_shadow_blur",
          "dependency" => array(
            'element' => 'box_shadow_status',
            'value' => "true",
          ),
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Box Shadow Color (It can be RGBA)", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "box_shadow_color",
          "dependency" => array(
            'element' => 'box_shadow_status',
            'value' => "true",
          ),
        ),

     )
  ));
}