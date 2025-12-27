<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Cristi
 */
function modeltheme_addons_for_wpbakery_marquee_texts_hero( $params, $content = null ) {
  extract( 
    shortcode_atts(
      array(
        'page_builder'      => '',
        'text_border_color' => '',
        'mix_blend_mode'    => '',
        'items'             => '',
      ), 
      $params
    ) 
  );
 
  wp_enqueue_style( 'mt-marquee-texts-hero', plugins_url( '../../css/marquee-texts-hero.css' , __FILE__ ));

  if ($page_builder == 'elementor') {
    $all_items = unserialize(base64_decode($items));
  }else{
    if (function_exists('vc_param_group_parse_atts')) {
      $all_items = vc_param_group_parse_atts($params['items']);
    }
  }
  $id = uniqid('texts-hero-shortcode-');
  ?>
    
  <?php 
  ob_start(); ?>
  
    <div class="mt-addons-marquee-texts-hero-shortcode" data-unique-id="<?php echo esc_attr($id); ?>">
      <nav class="mt-addons-marquee-texts-hero-menu">
        <?php if ($all_items) { ?>
          <?php foreach ($all_items as $item) { ?>
                  <?php if ($page_builder == 'elementor') { ?>
                     <?php $image = $item['image']['id']; ?>
                  <?php }else{ ?>
                    <?php if (!array_key_exists('image', $item)) { ?>
                      <?php $image = ''; ?>
                    <?php }else{ ?>
                      <?php $image = $item['image']; ?>
                    <?php } ?>
                  <?php } ?>
            <?php 
                  $image = wp_get_attachment_image_src( $image, 'medium' );?>
            <div class="mt-addons-marquee-texts-hero-menu__item">
              <a class="mt-addons-marquee-texts-hero-menu__item-link" style="text-stroke: 1.5px <?php echo esc_attr($text_border_color); ?>;-webkit-text-stroke: 1.5px <?php echo esc_attr($text_border_color); ?>;"><?php echo esc_html($item['title']); ?></a>
              <img class="mt-addons-marquee-texts-hero-menu__item-img" src="<?php echo esc_url($image[0]); ?>"/>
              <div class="mt-addons-marquee-texts-hero-marquee" style="mix-blend-mode: <?php echo esc_attr($mix_blend_mode); ?>">
                <div class="mt-addons-marquee-texts-hero-marquee__inner" aria-hidden="true">
                  <span><?php echo esc_html($item['title']); ?></span>
                  <span><?php echo esc_html($item['title']); ?></span>
                  <span><?php echo esc_html($item['title']); ?></span>
                  <span><?php echo esc_html($item['title']); ?></span>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </nav>
    </div>

  <?php 
  return ob_get_clean();
}
add_shortcode('mt-addons-marquee-texts-hero', 'modeltheme_addons_for_wpbakery_marquee_texts_hero');


if ( function_exists('vc_map') ) {
  add_action( 'init', 'mt_addons_marquee_texts_hero_map');
  function mt_addons_marquee_texts_hero_map(){
    vc_map( array(
      "name" => esc_attr__("MT: Marquee Texts Hero", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-marquee-texts-hero",
      "icon" => plugins_url( 'images/marquee.svg', __FILE__ ),
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "params" => array(
        array(
          "heading" => __("Item Text Store Color", 'modeltheme-addons-for-wpbakery'),
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "param_name" => "text_border_color"
        ),
        array(
          "heading" => esc_attr__("Mix Blend Mode (Item Text Hover)", 'modeltheme-addons-for-wpbakery'),
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "param_name" => "mix_blend_mode",
          "description" => __( "This is a special CSS effect compatible with any major browser." ),
          "value" => array(
            'Select Option'     => '',
            'normal' => 'normal',
            'multiply' => 'multiply',
            'screen' => 'screen',
            'overlay' => 'overlay',
            'darken' => 'darken',
            'lighten' => 'lighten',
            'color-dodge' => 'color-dodge',
            'color-burn' => 'color-burn',
            'hard-light' => 'hard-light',
            'soft-light' => 'soft-light',
            'difference' => 'difference',
            'exclusion' => 'exclusion',
            'hue' => 'hue',
            'saturation' => 'saturation',
            'color' => 'color',
            'luminosity' => 'luminosity',
          )
        ),
        array(
          "group" => "Items",
          'type' => 'param_group',
          'value' => '',
          'param_name' => 'items',
          // Note params is mapped inside param-group:
          'params' => array(
            array(
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "title",
            ),
            array(
              "type" => "attach_image",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Image", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "image",
            ),
          ),
        ),
      )
    ));
  }
}