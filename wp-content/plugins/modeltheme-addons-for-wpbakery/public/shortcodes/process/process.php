<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_process($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                  => '',
      'step_title'                    => '',
      'step_description'              => '',
      'process_groups'                => ''
    ), $params ) );
       
    wp_enqueue_style( 'process', plugins_url( '../../css/process.css' , __FILE__ ));

    
    if ($page_builder == 'elementor') {
      $process_groups = unserialize(base64_decode($process_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $process_groups = vc_param_group_parse_atts($params['process_groups']);
      }
    }
    ob_start(); ?>

    <div class="mt-addons-process">
    <?php $count = 1; ?>
    <?php if ($process_groups) { ?>
      <?php foreach ($process_groups as $step) { ?>
              
        <div class="mt-addons-process-wrapper mt-addons-step-<?php echo esc_attr($count); ?>">
          <div class="mt-addons-steps mt-addons-step-<?php echo esc_attr($count); ?>">
            <h3><?php echo esc_html($step['step_title']); ?></h3>
            <p><?php echo esc_html($step['step_description']); ?></p>
          </div>
          <div class="mt-addons-steps-count mt-addons-step-<?php echo esc_attr($count); ?>">
            <span><?php echo esc_attr($count); ?></span>
          </div>
        </div>
        <?php $count++; ?>
      <?php } ?>
    <?php } ?>

    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-process', 'modeltheme_addons_for_wpbakery_process');

//VC Map
if (function_exists('vc_map')) {
      
  $params = array(
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'process_groups',
      'params' => array(
         array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Title', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "step_title",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Description', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "step_description",
        ),
      ),
    ),
  );
  vc_map(
    array(
      "name" => esc_attr__('MT: Process', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-process",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/clients.svg', __FILE__ ),
      "params" => $params,
  ));
}