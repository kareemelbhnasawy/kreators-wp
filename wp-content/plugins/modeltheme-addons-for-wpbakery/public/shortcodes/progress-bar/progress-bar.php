<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_progress_bar($params, $content) {
  extract( shortcode_atts( 
    array(
      'progress_color'      => '',
      'trail_color'         => '',
      'duration'            => '',
      'number'         => '',
      'bar_stroke'         => '',
      'bar_height'         => '',
      'trail_height'         => '',
      'percentage_type'   => '',
      'bar_label'     => '',
      'text_color'         => '',
    ), $params ) );

    // framework
    wp_enqueue_script( 'progressbar-min', plugins_url( '../../js/plugins/progressbar/progressbar.min.js' , __FILE__));
    // custom
    wp_enqueue_style( 'mt-progress-bar', plugins_url( '../../css/progress-bar.css' , __FILE__ ));
    wp_enqueue_script( 'progress-bar', plugins_url( '../../js/progress-bar.js' , __FILE__));

    $id = 'mt-addons-progress-bar-'.uniqid();

    ob_start(); ?>

    <div id="<?php echo esc_attr($id); ?>" 
      <?php modeltheme_addons_progressbar_attributes($id, $progress_color, $trail_color, $duration, $number, $bar_stroke , $bar_height, $trail_height, $percentage_type); ?> 
        class="mt-addons-progress-bar">
        <div class="mt-addons-progress-content">
          <h6 class="mt-addons-progress-title <?php echo esc_attr($percentage_type); ?>"style="color: <?php echo esc_attr($text_color); ?>"><?php echo esc_html($bar_label); ?> 
          </h6>
        </div>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('mt-addons-progress-bar', 'modeltheme_addons_for_wpbakery_progress_bar');



//VC Map
if (function_exists('vc_map')) {

  $params = array(
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Progress Bar Label", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "bar_label",
      "value" => " "
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'text_color',
        'description' => esc_html__( 'Select Text Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
  );
  
  $progressbar_fields_array = modeltheme_addons_progressbar_vc_fields();
  if ($progressbar_fields_array) {
    foreach ($progressbar_fields_array as $progressbar_fields) {
      $params[] = $progressbar_fields;
    }
  }

  vc_map(
    array(
      "name" => esc_attr__("MT: Progress Bar", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-progress-bar",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/progress-bar.svg', __FILE__ ),
      "params" => $params,
  ));
}
