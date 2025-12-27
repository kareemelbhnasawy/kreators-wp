<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

if (!function_exists('modeltheme_addons_progressbar_vc_fields')) {
  function modeltheme_addons_progressbar_vc_fields(){
    $progressbar_vc_fields = array(

      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'progress_color',
        'description' => esc_html__( 'Select Progress Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Trail color', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'trail_color',
        'description' => esc_html__( 'Select Trail Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "heading" => esc_attr__('Progress Speed (in ms)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "duration",
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "heading" => esc_attr__('Progress Bar Value (0.0 to 1.0)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "number",
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "heading" => esc_attr__('Progress Bar Stroke Value', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "bar_stroke",
      ),      
      array(
        "type" => "vc_number",
        "holder" => "div",
        "heading" => esc_attr__('Progress Bar Height Value (%)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "bar_height",
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "heading" => esc_attr__('Progress Bar trail Value', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "trail_height",
      ),
      array(
      'type' => 'dropdown',
      'param_name'       => 'percentage_type',
      'heading'      => esc_html__( 'Percentage Type', 'modeltheme-addons-for-wpbakery' ),
      'value'    => array(
        'Select Option'     => '',
        esc_html__( 'Floating Above', 'modeltheme-addons-for-wpbakery' )     => 'mt-addons-progress-floating-above',
        esc_html__( 'Fixed Above', 'modeltheme-addons-for-wpbakery' )  => 'mt-addons-progress-fixed-above',
        esc_html__( 'Floating On', 'modeltheme-addons-for-wpbakery' )     => 'mt-addons-progress-floating-on',
        esc_html__( 'Fixed On', 'modeltheme-addons-for-wpbakery' )      => 'mt-addons-progress-fixed-on',
      ),
    ),
  
    );

    return $progressbar_vc_fields;
  }
}

if (!function_exists('modeltheme_addons_progressbar_attributes')) {
  function modeltheme_addons_progressbar_attributes($id = '', $progress_color = '', $trail_color= '', $duration= '',$number= '' ,$bar_stroke= '', $bar_height= '', $trail_height= '', $percentage_type= ''){
    ?>
        data-progressbar-id="<?php echo esc_attr($id); ?>"  
        data-progressbar-color="<?php echo esc_attr($progress_color); ?>"
        data-progressbar-trail-color="<?php echo esc_attr($trail_color); ?>"
        data-progressbar-duration="<?php echo esc_attr($duration); ?>"
        data-progressbar-data-number="<?php echo esc_attr($number); ?>"
        data-progressbar-data-bar-stroke="<?php echo esc_attr($bar_stroke); ?>"
        data-progressbar-data-bar-height="<?php echo esc_attr($bar_height); ?>"
        data-progressbar-data-trail-width="<?php echo esc_attr($trail_height); ?>"
        data-progressbar-percentage-type="<?php echo esc_attr($percentage_type); ?>"





        

    <?php 
  }
}