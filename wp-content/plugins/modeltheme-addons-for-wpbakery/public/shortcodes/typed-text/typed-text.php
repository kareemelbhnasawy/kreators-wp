<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_typed_text($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'       => '',
      'texts'              => '',
      'cursor_font_size'   => '60',
      'font_size'          => '60',
      'weight'             => '600',
      'color'              => '',
      'section_align'      => '',
      'aftertext'          => '',
      'beforetext'         => '',

    ), $params ) );
   
    wp_enqueue_style( 'typed-text', plugins_url( '../../css/typed-text.css' , __FILE__ ));
    wp_enqueue_script( 'typed', plugins_url( '../../js/plugins/typed/typed.js' , __FILE__));
    $typed_unique_id = 'mt_addons_typed_text_'.uniqid();

    ob_start(); ?>
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".<?php echo esc_attr($typed_unique_id); ?>").typed({
          strings: [<?php echo strip_tags($texts);?>],
          loop: true
        });
      }); 
    </script>
    <div class="mt-addons-typed-text <?php echo esc_attr($section_align);?>">
      <span  style="font-size:<?php echo esc_attr($font_size); ?>px; color:<?php echo esc_attr($color); ?>;font-weight:<?php echo esc_attr($weight);?>;" class="mt_addons_typed_text-beforetext"><?php echo esc_html__($beforetext); ?></span>
      <span  style="font-size:<?php echo esc_attr($font_size); ?>px; color:<?php echo esc_attr($color); ?>;font-weight:<?php echo esc_attr($weight);?>;" class="mt_addons_typed_text <?php echo esc_attr($typed_unique_id); ?>"></span>
      <span  style="font-size:<?php echo esc_attr($font_size); ?>px; color:<?php echo esc_attr($color); ?>;font-weight:<?php echo esc_attr($weight);?>;" class="mt_addons_typed_text-aftertext"><?php echo esc_html__($aftertext); ?></span>
    </div>
    <style> span.typed-cursor { font-size:<?php echo esc_attr($cursor_font_size); ?>px;color:<?php echo esc_attr($color); ?>;font-weight:<?php echo esc_attr($weight);?>; } </style>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-typed-text', 'modeltheme_addons_for_wpbakery_typed_text');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__('MT: Typed Text', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-typed-text",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/typed.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( 'Aligment', 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "section_align",
          "value" => array(
            'Select Option' => '',
            'Left'          => 'text-left',
            'Center'        => 'text-center',
            'Right'         => 'text-right',
          ),
          "default" => 'text-center'
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Texts', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "texts",
          "value" => "",
          "description" => "Eg: 'String Text 1', 'String Text 2', 'String Text 3'"
        ),
        array(
          "group" => "Style",
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Font Size', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "font_size",
          "value" => "",
          "description" => "Eg: 60"
        ),
        array(
          "group" => "Style",
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Cursor Font Size', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "cursor_font_size",
          "value" => "",
          "description" => "Eg: 60"
        ),
        array(
          "group" => "Style",
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Font Weight', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "weight",
          "value" => ""
        ),
        array(
          "type" => "colorpicker",
          "group" => "Style",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Text Color', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "color",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Before text', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "beforetext",
          "value" => "",
          "description" => ""
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('After text', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "aftertext",
          "value" => "",
          "description" => ""
        ),
      )
  ));
}