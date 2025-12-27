<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_highlighted_text($params, $content) {
  extract( shortcode_atts( 
    array(
      'texts_groups'      => '',
      'page_builder'      => '',
      'title_size'        => '',
      'title_weight'      => '',
      'title_line'        => '',

      'text_normal'       => '',
      'text_type'         => 'simple',
      'aligment'          => '',
      'color'             => '',

      'text_highlighted'  => '',
      'highlight_color'   => '#444',
      'highlight_text_color'   => '',

    ), $params ) );
    
    $color_style = '';
    if ($color) {
      $color_style = 'color:'.$color.';';
    }
    $title_size_style = '';
    if ($title_size) {
      $title_size_style = 'font-size:'.$title_size.'px;';
    }
    $title_weight_style = '';
    if ($title_weight) {
      $title_weight_style = 'font-weight:'.$title_weight.';';
    }
    $title_line_style = '';
    if ($title_line) {
      $title_line_style = 'line-height:'.$title_line.';';
    }

    if ($highlight_color) {
      $highlight_color_bg = 'background:'.$highlight_color.';';
    }
    $highlight_color_style = '';
    if ($highlight_text_color) {
      $highlight_color_style = 'color:'.$highlight_text_color.';';
    }

    wp_enqueue_style( 'highlighted-text', plugins_url( '../../css/highlighted-text.css' , __FILE__ ));
    wp_enqueue_script( 'highlighted-text-js', plugins_url( '../../js/highlighted-text.js' , __FILE__));

        if ($page_builder == 'elementor') {
      $texts_groups = unserialize(base64_decode($texts_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $texts_groups = vc_param_group_parse_atts($params['texts_groups']);
      }
    }
    ob_start(); ?>
    <div class="mt-addons-highlighted-text <?php echo esc_attr($aligment);?>">
      <?php if ($texts_groups) { ?>
        <?php foreach ($texts_groups as $text) {?>
          <?php if($text['text_type'] == "simple"){ ?>
              <?php if(!empty($text['text_normal'])){ ?>
                <span class="mt-addons-text-simple" style="<?php echo esc_attr($color_style.' '.$title_size_style.' '.$title_weight_style. ' '.$title_line_style); ?>">
                    <?php echo esc_attr__($text['text_normal']); ?>
                </span>
              <?php } ?>
          <?php } else if($text['text_type'] == "highlighted") { ?>
              <?php if(!empty($text['text_highlighted'])){ ?>
                <span class="mt-addons-text-highlighted" style="<?php echo esc_attr($highlight_color_bg.' '.$highlight_color_style.' '.$title_size_style.' '.$title_weight_style. ' '.$title_line_style); ?>">
                    <?php echo esc_attr__($text['text_highlighted']); ?>
                </span>
              <?php } ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-highlighted-text', 'modeltheme_addons_for_wpbakery_highlighted_text');

//VC Map
if (function_exists('vc_map')) {

  $params = array(
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'texts_groups',
      'params' => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Text Type", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "text_type",
          "value" => array(
            'Select Option' => '',
            'Simple'        => 'simple',
            'Highlighted'   => 'highlighted'
          )
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Text", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "text_normal",
          "dependency" => array(
            'element' => 'text_type',
            'value' => "simple",
          )
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Text", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "text_highlighted",
          "dependency" => array(
            'element' => 'text_type',
            'value' => "highlighted",
          ),
        ),
      ),
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Highligh Background Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "highlight_color",
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Highligh Text Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "highlight_text_color",
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Text Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "color",
      "value" => "",
      "description" => ""
    ),
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Aligment", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "aligment",
      "value" => array(
        'Select Option' => '',
        'Left'          => 'text-left',
        'Center'        => 'text-center',
        'Right'         => 'text-right'
      )
    ),
    array(
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( "Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_size"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 1.5 (Min: 0.1 - Max 3)",
      'min' => 0.1,
      'max' => 3,
      'step' => 0.1,
      "class" => "",
      "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_line"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 500",
      "class" => "",
      "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_weight"
    ),
  );
  vc_map(
    array(
      "name" => esc_attr__("MT: Highlighted Text", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-highlighted-text",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/highlight.svg', __FILE__ ),
      "params" => $params,
  ));
}