<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_stylized_numbers($params, $content) {
  extract( shortcode_atts( 
    array(
      'section_align'      => '',
      'custom_number'      => '',
      'text_color'         => '',
      'background'         => '',
      'gradient_color_1'   => '',
      'gradient_color_2'   => '',
      'gradient_color_3'   => '',
      'gradient_bg'        => '',
      'number_size'        =>''

    ), $params ) );

    wp_enqueue_style( 'mt-stylized-numbers', plugins_url( '../../css/stylized-numbers.css' , __FILE__ ));

    $numbers = $custom_number;
    $bg_style = '';
    if ($gradient_bg == "true") {
      $bg_style = 'background: conic-gradient(from 90deg at 0 47%, ' . $gradient_color_1 . ' 0%,' . $gradient_color_2 .' 0%,' . $gradient_color_3 .' 100%)';
    }else{
      $bg_style ='background:'.$background.';';
    }
    ob_start(); ?>
    <?php if ($numbers) { ?>
    <?php $split_numbers = str_split($numbers);?>
    <div class="mt-addons-numbers-group <?php echo esc_attr($section_align);?>" style="color: <?php echo esc_attr($text_color); ?>">
      <div class="mt-addons-numbers-digit"> 
         <?php  foreach ($split_numbers as $number) { ?>
        <div class="mt-addons-numbers-item" style="<?php echo esc_attr($bg_style); ?>">
          <span style="font-size:<?php echo esc_attr($number_size); ?>px; "><?php echo esc_attr($number); ?></span>
        </div>
      <?php } ?>
      </div>
    </div>
    <?php } ?>

    <?php 
    return ob_get_clean();
}
add_shortcode('mt-addons-stylized-numbers', 'modeltheme_addons_for_wpbakery_stylized_numbers');



//VC Map
if (function_exists('vc_map')) {

  $params = array(
    array(
      "type" => "vc_number",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Number", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "custom_number",
      "value" => "",
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => esc_attr__( "Aligment", 'modeltheme-addons-for-wpbakery' ),
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
      "type" => "vc_number",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Number Size", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "number_size",
      "value" => "",
    ),
    array(
      'type' => 'colorpicker',
      'heading' => esc_html__( "Text Color", "modeltheme-addons-for-wpbakery" ),
      'param_name' => 'text_color',
      'description' => esc_html__( "Select Text Color.", "modeltheme-addons-for-wpbakery" ),
    ),
    array(
      'type' => 'colorpicker',
      'heading' => esc_html__( "Background Color", "modeltheme-addons-for-wpbakery" ),
      'param_name' => 'background',
      'description' => esc_html__( "Select Background Color.", "modeltheme-addons-for-wpbakery" ),
    ),
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => esc_attr__('Gradient', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "gradient_bg",
      "value"       => array(
        "Enabled" => "true",
      ),
    ),
    array(
      'type' => 'colorpicker',
      'heading' => esc_html__( "Background Gradient 1", "modeltheme-addons-for-wpbakery" ),
      'param_name' => 'gradient_color_1',
      'description' => esc_html__( "Select Gradient 1.", "modeltheme-addons-for-wpbakery" ),
      "dependency" => array(
        'element' => 'gradient_bg',
        'value' => "true",
      )
    ),
    array(
      'type' => 'colorpicker',
      'heading' => esc_html__( "Background Background Gradient 2", "modeltheme-addons-for-wpbakery" ),
      'param_name' => 'gradient_color_2',
      'description' => esc_html__( "Select Background Gradient 2.", "modeltheme-addons-for-wpbakery" ),
      "dependency" => array(
        'element' => 'gradient_bg',
        'value' => "true",
      )
    ),
    array(
      'type' => 'colorpicker',
      'heading' => esc_html__( "Background Gradient 3", "modeltheme-addons-for-wpbakery" ),
      'param_name' => 'gradient_color_3',
      'description' => esc_html__( "Select Background Gradient 3.", "modeltheme-addons-for-wpbakery" ),
      "dependency" => array(
        'element' => 'gradient_bg',
        'value' => "true",
      )
    ),
  );
  

  vc_map(
    array(
      "name" => esc_attr__("MT: Stylized Numbers", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-stylized-numbers",
      "category" => esc_attr__("MT Addons", "modeltheme-addons-for-wpbakery"),
      "icon" => plugins_url( 'images/progress-bar.svg', __FILE__ ),
      "params" => $params,
  ));
}
