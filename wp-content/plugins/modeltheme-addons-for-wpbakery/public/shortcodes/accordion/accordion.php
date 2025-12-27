<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_accordion($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'title'                     => '',
      'description'               => '',
      'image_shape'               => '',
      'accordion_groups'          => '',
      'styles'                    => '',
      'background_color'          => '',
      'text_color'                => '#222'
    ), $params ) );
    
   
    wp_enqueue_style( 'accordion', plugins_url( '../../css/accordion.css' , __FILE__ ));
    wp_enqueue_script( 'accordion-js', plugins_url( '../../js/accordion.js' , __FILE__));
    if ($page_builder == 'elementor') {
      $accordion_groups = unserialize(base64_decode($accordion_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $accordion_groups = vc_param_group_parse_atts($params['accordion_groups']);
      }
    }
    $style_code = '';
    $bg_code = '';
    $text_code = '';
    if($styles == 'border'){
      $style_code = 'mt-addons-border_bottom';
      $bg_code = 'transparent';
      $text_code = $text_color;
    } else if ($styles == 'background') {
      $style_code = 'mt-addons-bg';
      $bg_code = $background_color;
      $text_code = $text_color;
    } else if ($styles == 'boxed') { 
      $style_code = 'mt-addons-boxed';
      $bg_code = 'transparent';
      $text_code = $text_color;
    }
    ob_start(); ?>
    <div class="mt-addons-accordion relative">
        <?php if ($accordion_groups) { ?>
          <?php foreach ($accordion_groups as $accordion) {
            if (!array_key_exists('title', $accordion)) {
              $title = '';
            }else{
              $title = $accordion['title'];
            }
            ?>
          
            <div class="mt-addons-accordion-holder <?php echo esc_attr($style_code);?>" style ="background:<?php echo esc_attr($bg_code);?>;">
              <div class="mt-addons-accordion-header" style="color:<?php echo esc_attr($text_code); ?>">
                <?php echo esc_attr($title); ?>
                <div class="mt-addons-accordion-arrow">
                  <i class="fa fa-angle-down"></i>
                </div>
              </div>
              <div class="mt-addons-accordion-content">
                <div class="mt-addons-accordion-item">
                  <p style="color:<?php echo esc_attr($text_code); ?>"><?php echo $accordion['description']; ?></p>
                </div>
              </div>           
            </div>
          <?php } ?>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-accordion', 'modeltheme_addons_for_wpbakery_accordion');

//VC Map
if (function_exists('vc_map')) {
      
  $params = array(
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __( "Styles", "modeltheme-addons-for-wpbakery" ),
      "param_name" => "styles",
      "value" => array(
        'Select Option' => '',
        'Border'        => 'border',
        'Background'    => 'background',
        'Boxed'         => 'boxed',
      )
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Background", 'modeltheme-addons-for-wpbakery'),
      'dependency' => array(
        'element' => 'styles',
        'value' => 'background',
      ),
      "param_name" => "background_color"
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Text Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "text_color"
    ),
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'accordion_groups',
      'params' => array(
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "title",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Description", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "description",
        ),
      ),
    ),
  );
  vc_map(
    array(
      "name" => esc_attr__("MT: Accordion", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-accordion",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/accordion.svg', __FILE__ ),
      "params" => $params,
  ));
}