<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_stacking_cards($params, $content) {
  extract( shortcode_atts( 
    array(
      'title'               => '',
      'subtitle'            => '',
      'card_image'          => '',
      'button_url'          => '',
      'title_color'         => '',
      'title_size'          => '',
      'subtitle_color'      => '',
      'subtitle_size'       => '',
      'btn_size'            => '',
      'btn_style'           => '',
      'btn_text_color'      => '',
      'btn_bg_text_color'   => '',
      'box_bg'              => '',
      'featured_image_size' => '',
      'title_tag'           => '',
      'subtitle_tag'        => '',

    ), $params ) );
   
    wp_enqueue_style( 'stacking-cards-css', plugins_url( '../../css/stacking-cards.css' , __FILE__ ));
    wp_enqueue_script( 'stacking-cards', plugins_url( '../../js/plugins/stacking-cards/scripts.js' , __FILE__));

    ob_start(); ?>
    <section class="mt-addons-card-wrapper">
      <?php if (array_key_exists('cards', $params)) { ?>
        <?php  if (function_exists('vc_param_group_parse_atts')) {
          $cards = vc_param_group_parse_atts($params['cards']); ?>
          <?php if ($cards) { ?>
            <?php foreach($cards as $card){

              if (!array_key_exists('title', $card)) {
                $title = '';
              }else{
                $title = $card['title'];
              }
              if (!array_key_exists('subtitle', $card)) {
                $subtitle = '';
              }else{
                $subtitle = $card['subtitle'];
              }
              if (!array_key_exists('card_image', $card)) {
                $card_image = '';
              }else{
                $card_image = $card['card_image'];
              }
              if (!array_key_exists('title_color', $card)) {
                $title_color = '';
              }else{
                $title_color = $card['title_color'];
              }
              if (!array_key_exists('title_size', $card)) {
                $title_size = '';
              }else{
                $title_size = $card['title_size'];
              }
              if (!array_key_exists('subtitle_color', $card)) {
                $subtitle_color = '';
              }else{
                $subtitle_color = $card['subtitle_color'];
              }
              if (!array_key_exists('subtitle_size', $card)) {
                $subtitle_size = '';
              }else{
                $subtitle_size = $card['subtitle_size'];
              }
              if (!array_key_exists('button_url', $card)) {
                $card_link = '';
              }else{
                $link = vc_build_link($card['button_url']);
                $card_link = $link['url'];
              }
              if (!array_key_exists('btn_size', $card)) {
                $btn_size = '';
              }else{
                $btn_size = $card['btn_size'];
              }
              if (!array_key_exists('btn_style', $card)) {
                $btn_style = '';
              }else{
                $btn_style = $card['btn_style'];
              }
              if (!array_key_exists('btn_text_color', $card)) {
                $btn_text_color = '';
              }else{
                $btn_text_color = $card['btn_text_color'];
              }
              if (!array_key_exists('btn_bg_text_color', $card)) {
                $btn_bg_text_color = '';
              }else{
                $btn_bg_text_color = $card['btn_bg_text_color'];
              }
              if (!array_key_exists('title_tag', $card)) {
                $title_tag = 'h2';
              }else{
                $title_tag = $card['title_tag'];
              }
              if (!array_key_exists('subtitle_tag', $card)) {
                $subtitle_tag = 'p';
              }else{
                $subtitle_tag = $card['subtitle_tag'];
              }

              $image_size = 'full';
              if ($featured_image_size) {
                $image_size = $featured_image_size;
              }

              $image_attributes = wp_get_attachment_image_src( $card_image, $image_size ); ?>
                <div class="mt-addons-items-card card" style="background:<?php echo esc_attr($box_bg); ?>">
                  <div class="mt-addons-flex-card items-center height-100%">
                    <div class="mt-addons-text-holder">
                      <?php if(!empty($card['title'])){ ?>
                        <<?php echo esc_attr( $title_tag ); ?> class="mt-addons-title-card" style="color:<?php echo esc_attr($title_color); ?>;font-size:<?php echo esc_attr($title_size); ?>px"> <?php echo esc_html__($card['title']);?> </<?php echo esc_attr($title_tag);?>> 
                      <?php } ?>
                      <?php if(!empty($card['subtitle'])){ ?>
                        <<?php echo esc_attr( $subtitle_tag ); ?> class="mt-addons-card-subtitle" style="color:<?php echo esc_attr($subtitle_color); ?>;font-size:<?php echo esc_attr($subtitle_size); ?>px"> <?php echo esc_html__($card['subtitle']);?> </<?php echo esc_attr( $subtitle_tag ); ?>>   
                      <?php } ?>
                      <?php if($card_link != ''){ ?>
                        <div class="mt-addons-button-card-holder <?php echo esc_attr($btn_size.' '.$btn_style); ?>"> 
                          <a class="mt-addons-button-card" style="color:<?php echo esc_attr($btn_text_color); ?>;background:<?php echo esc_attr($btn_bg_text_color); ?>" href="<?php echo esc_url($card_link); ?>" target="<?php echo esc_attr($link['target']); ?>" rel="<?php echo esc_attr($link['rel']); ?>"><?php echo esc_html($link['title']); ?>
                          </a>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php if($image_attributes) { ?>
                    <div class="mt-addons-card-image">
                      <img src="<?php echo esc_url($image_attributes[0]); ?>" alt="<?php echo esc_html__($title); ?>"  />
                    </div>
                  <?php } ?>
                </div>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-stacking-cards', 'modeltheme_addons_for_wpbakery_stacking_cards');

  if (function_exists('vc_map')) {
  
  $params = array(
    array(
      "group" => "Options",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__( "Box Background Color", "modeltheme-addons-for-wpbakery" ),
      "param_name" => "box_bg",
      "description" => esc_attr__( "Choose Box Background Color", "modeltheme-addons-for-wpbakery" )
    ),
    array(
      "type" => "dropdown",
      "group" => "Options",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Featured Image size", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "featured_image_size",
      "std" => 'full',
      "value" => modeltheme_addons_image_sizes_array()
    ),
    array(
      'type' => 'param_group',
      "group" => "Cards",
      'value' => '',
      'param_name' => 'cards',
      'params' => array(
        array(  
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Title", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "title",
          "value" => "My Title",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element tag", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "title_tag",
          "value" => array(
              'Select Option' => '',
              'h1'      => 'h1',
              'h2'      => 'h2',
              'h3'      => 'h3',
              'h4'      => 'h4',
              'h5'      => 'h5',
              'h6'      => 'h6',
              'p'       => 'p',
          )
        ),
        array(
          "type" => "colorpicker", 
          "class" => "",
          "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "title_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Title Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "title_size"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Subtitle", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "subtitle", 
          "value" => "My Subtitle",
        ),
        array(
          "type" => "dropdown",
          "group" => "Subtitle",
          "class" => "",
          "heading" => esc_attr__( "Element tag", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "subtitle_tag",
          "value" => array(
              'Select Option' => '',
              'h1'      => 'h1',
              'h2'      => 'h2',
              'h3'      => 'h3',
              'h4'      => 'h4',
              'h5'      => 'h5',
              'h6'      => 'h6',
              'p'       => 'p',
          )
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Subtitle Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "subtitle_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Subtitle Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "subtitle_size"
        ),
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Card Image", "modeltheme_addons_for_wpbakery"),
          "param_name" => "card_image",
        ),
        array(
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Link Button", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "button_url",
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Button Size", "modeltheme-addons-for-wpbakery"),
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
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Button Shape", "modeltheme-addons-for-wpbakery"),
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
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button Text color", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "btn_text_color",
          "description" => esc_attr__( "Choose text color", "modeltheme-addons-for-wpbakery" )
        ),
        array(
          "group" => "Options",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button Background Color", "modeltheme-addons-for-wpbakery" ),
          "param_name" => "btn_bg_text_color",
          "description" => esc_attr__( "Choose Background Color", "modeltheme-addons-for-wpbakery" )
        ),
      ),
    ),
  );
  vc_map(
    array(
      "name" => esc_attr__("MT: Stacking Cards", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-stacking-cards",
      "category" => esc_attr__('MT Addons', "modeltheme-addons-for-wpbakery"),
      "icon" => plugins_url( 'images/product-grid.svg', __FILE__ ),
      "params" => $params,
  ));
}