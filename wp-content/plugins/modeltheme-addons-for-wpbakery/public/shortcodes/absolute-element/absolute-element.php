<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Andreea
 */

function modeltheme_addons_for_wpbakery_absolute_element( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'page_builder'              => '',
            'elements'                       => '',
            'element_photo_height'             => '',
            'left_percent'                       => '',
            'top_percent'                       => '',
            'enable_animation'                 => '',
            'animation_type'                 => '',
            'image'                 => '',

        ), $params ) );
    
    wp_enqueue_style( 'mt-absolute-element', plugins_url( '../../css/absolute-element.css' , __FILE__ ));
    
    ob_start(); 
    ?>
    <?php if (array_key_exists('elements', $params)) { ?>
        <?php  if ($page_builder == 'elementor') { ?>
            <?php $elements = unserialize(base64_decode($elements));?>
        <?php } else { ?>
            <?php 
            if (function_exists('vc_param_group_parse_atts')) {
                $elements = vc_param_group_parse_atts($params['elements']);
            }
            ?>
       <?php } ?>
        <?php if ($elements) { ?>
            <?php foreach($elements as $element){ 
               if ($page_builder == 'elementor') {
                  $image = $element['image']['id'];
                }else{
                  $image = $element['image'];
                }
                if (!array_key_exists('left_percent', $element)) {
                  $left_percent = '';
                }else{
                  $left_percent = $element['left_percent'];
                }
                if (!array_key_exists('top_percent', $element)) {
                  $top_percent = '';
                }else{
                  $top_percent = $element['top_percent'];
                }
                if (!array_key_exists('absolute_element', $element)) {
                    $absolute_element = 'absolute element';
                }else{
                    $absolute_element = $element['absolute_element'];
                }
                if (!array_key_exists('animation_type', $element)) {
                    $animation_type = '';
                }else{
                    $animation_type = $element['animation_type'];
                }
               if (!array_key_exists('element_photo_height', $element)) {
                    $element_photo_height = '';
                }else{
                    $element_photo_height = $element['element_photo_height'];
                }
                // $image_attributes = wp_get_attachment_image_src( $element['image'], 'full' );
                $image_attributes = wp_get_attachment_image_src( $image, 'full'  ); ?>
                
                <?php  if ($image_attributes) { ?>
                    <img class="mt-addons-absolute-element-absolute <?php echo $animation_type;?>"  style="left:<?php echo esc_attr($left_percent);?>%;top:<?php echo esc_attr($top_percent);?>px; <?php if($element_photo_height){echo 'height: '.$element_photo_height.'px;';} ?>" src="<?php echo esc_url($image_attributes[0]); ?>" alt="<?php echo esc_html__($absolute_element); ?>" />
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
  <?php
  return ob_get_clean();
}
add_shortcode('mt-addons-absolute-element', 'modeltheme_addons_for_wpbakery_absolute_element');


if ( function_exists('vc_map') ) {
    vc_map( 
        array(
            "name" => esc_attr__("MT: Absolute Element", 'modeltheme_addons_for_wpbakery'),
            "base" => "mt-addons-absolute-element",
            "icon" => "modeltheme_shortcode",
            "category" => esc_attr__('MT Addons', 'modeltheme_addons_for_wpbakery'),
            "params" => array(
                array(
                    'type' => 'param_group',
                    'value' => '',
                    'param_name' => 'elements',
                    // Note params is mapped inside param-group:
                    'params' => array(
                        array(
                            "type" => "attach_image",
                            "holder" => "div",
                            "class" => "",
                            "heading" => esc_attr__("Element Image", "modeltheme_addons_for_wpbakery"),
                            "param_name" => "image",
                        ),
                        array(
                          "type" => "vc_number",
                          "class" => "",
                          'min' => 0,
                          'step' => 1,
                          'suffix' => 'px',
                          "heading" => __( 'Element Height', 'modeltheme-addons-for-wpbakery' ),
                          "param_name" => "element_photo_height",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => esc_attr__("Left (%) - Do not write the '%'", "modeltheme_addons_for_wpbakery"),
                            "param_name" => "left_percent",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => esc_attr__("Top (px) - Do not write the 'px'", "modeltheme_addons_for_wpbakery"),
                            "param_name" => "top_percent",
                        ),
                        array(
                            "type" => "checkbox",
                            "holder" => "div",
                            "class" => "",
                            "heading" => esc_attr__("Image Animation", "modeltheme_addons_for_wpbakery"),
                            "param_name" => "enable_animation",
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_attr__("Animation Type", "modeltheme-addons-for-wpbakery"),
                            "param_name" => "animation_type",
                            "value" => array(
                              'Select Option'     => '',
                              esc_attr__('Rotate', 'modeltheme-addons-for-wpbakery')   => 'rotate',
                              esc_attr__('Float', 'modeltheme-addons-for-wpbakery')   => 'float',
                            ),
                            "dependency" => array(
                              'element' => 'enable_animation',
                              'value' => 'true',
                            ),
                        ),
                    )
                ),
            )
        )
    );  
}