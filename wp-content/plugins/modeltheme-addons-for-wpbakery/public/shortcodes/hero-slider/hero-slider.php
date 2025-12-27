<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Andreea
 */
function modeltheme_addons_for_wpbakery_hero_slider($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'               => '',
      'slider_groups'              =>'',
      'background_image'           => '',
      'slider_image_height'        => '',
      // before title text
      'before_title'       => '', 
      'before_tag'           => '',
      'slider_beftitle_color'     => '',
      'slider_beftitle_size'      => '', 
      'slider_beftitle_line'      => '',  
      'slider_beftitle_weight'    => '',
      // title
      'title'               => '',
      'title_tag'           => 'h2',
      'slider_title_color'     => '#fff',
      'slider_title_size'      => '24',
      'slider_title_line'      => '18',
      'slider_title_weight'    => '300',
      // subtitle
      'subtitle'                  => '',
      'subtitle_tag'           => '',
      'slider_subtitle_color'     => '',
      'slider_subtitle_size'      => '',
      'slider_subtitle_line'      => '',
      'slider_subtitle_weight'    => '',
      // discount
      'discount'                  => '',
      'discount_tag'           => '',
      'slider_discount_color'     => '',
      'slider_discount_bg_color'     => '',
      'slider_discount_size'      => '',
      'slider_discount_line'      => '',
      'slider_discount_weight'    => '',
      // after subtitle
      'after_subtitle'         => '',
      'after_tag'           => '',
      'slider_aftersubtitle_color'     => '',
      'slider_aftersubtitle_size'      => '',
      'slider_aftersubtitle_line'      => '',
      'slider_aftersubtitle_weight'    => '',
      'slider_columns'          => '',
      'url'                     => '',
      // carousel
      'autoplay'              => '', 
      'delay'                 => '',
      'items_desktop'         => '',
      'items_mobile'          => '',
      'items_tablet'          => '',
      'space_items'           => '',
      'touch_move'            => '',
      'effect'                => '',
      'grab_cursor'           => '',
      'infinite_loop'         => '',
      'carousel'                 => '',
      'columns'                  => '',
      'layout'                   => '',
      'centered_slides'          => '',
      'select_navigation'          => '',
      'navigation_position'        => '',
      'nav_style'                  => '',
      'navigation_color'           => '',
      'navigation_bg_color'        => '',
      'navigation_bg_color_hover'  => '',
      'navigation_color_hover'     => '',
      'pagination_color'           => '',
      'navigation'                 => '',
      'pagination'                 => '',
      'scrollbar'                  => '',

      'pagination_color_next'      => '',
      'pagination_type'            => '',

      // end carousel
      'section_align'              => '',
      'slider_button_url'          => '',
      'slider_button_color'        => '',
      'slider_button_background'   => '',
      'button_status'              => '',
      'slider_button_text'         => '',
      'button_style'               =>'',
      'gradient_color_1'           =>'',
      'slider_button_hover_bg'     => '',
      'slider_button_color_hover'  => '',
      'gradient_color_2'           =>'',
      'background_gradient'        =>'',
      'sliders_groups'             => ''
      

    ), $params ) );
    

    wp_enqueue_style( 'mt-hero-slider', plugins_url( '../../css/hero-slider.css' , __FILE__ ));
    if ($page_builder == 'elementor') {
      $sliders_groups = unserialize(base64_decode($sliders_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $sliders_groups = vc_param_group_parse_atts($params['sliders_groups']);
      }
    }
    $uniqid = 'mt-addons-uniqid-'.uniqid();
    $uniqidpag = 'mt-addons-uniqid-pagination'.uniqid();

    $id = 'mt-addons-swipper-'.uniqid();

    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $swiper_container_start = '';
    $swiper_container_end = '';
    $html_post_swiper_wrapper = '';


    $bg_color_active_style = '';
    if ($pagination_color_next) {
      $bg_color_active_style = 'background:'.$pagination_color_next.'!important;';
    }
    $bg_color_pagination_style = '';
    if ($pagination_color) {
      $bg_color_pagination_style = 'background:'.$pagination_color.';';
    }
    $slider_button_background_style = '';
    if ($slider_button_background) {
      $slider_button_background_style = 'background:'.$slider_button_background.';';
    }

    
    if ($layout == "carousel") {
      $carousel_holder_class = 'mt-addons-swipper swiper'; 
      $carousel_item_class = 'swiper-slide elementor-repeater-item-';


      $swiper_wrapped_start = '<div class="swiper-wrapper">';
      $swiper_wrapped_end = '</div>';
    
      $swiper_container_start = '<div class="mt-addons-swiper-container">';
      $swiper_container_end = '</div>';
    
      if($page_builder == 'elementor' && $navigation == "yes") { 
        // next/prev
        $html_post_swiper_wrapper .= '
        <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
        <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
      }else {
        if($navigation == "true") { 
          $html_post_swiper_wrapper .= '
          <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
          <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
        }
      }
      if($page_builder == 'elementor' && $pagination == "yes") { 
          // next/prev
        $html_post_swiper_wrapper .= '<div class="swiper-pagination '.$pagination_type.'"></div>';
      }else {
        if($pagination == "true") { 
          // next/prev
          $html_post_swiper_wrapper .= '<div class="swiper-pagination '.$pagination_type.'"></div>';
        }
      }
      if($page_builder == 'elementor' && $scrollbar == "yes") { 
          // scrollbar
        $html_post_swiper_wrapper .= '<div class="swiper-scrollbar"></div>';
      }else {
        if($scrollbar == "true") { 
          // scrollbar
          $html_post_swiper_wrapper .= '<div class="swiper-scrollbar"></div>';
        }
      }
      // SWIPER SLIDER
      if($page_builder != 'elementor') { 
      wp_enqueue_style( 'swiper-bundle', plugins_url( '../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
      // if($page_builder != 'elementor') { 
        wp_enqueue_script( 'swipper', plugins_url( '../../js/swiper.js' , __FILE__), ['jquery', 'elementor-frontend'], time(), true);
        wp_enqueue_script( 'swipper-bundle-min', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
      }
    }

    ob_start(); 
    ?>

    <?php //swiper container start ?>
    <?php echo wp_kses_post($swiper_container_start); ?>
      <div class="mt-swipper-carusel-position" style="position:relative;">
        <div id="<?php echo esc_attr($id); ?>" 
          <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides, $navigation, $pagination, $scrollbar); ?> 
          class="mt-addons-hero-slider <?php echo esc_attr($carousel_holder_class); ?>">

            <?php //swiper wrapped start ?>
            <?php echo wp_kses_post($swiper_wrapped_start); ?>
              <?php //items ?>
              <?php if ($sliders_groups) { ?>
                <?php foreach ($sliders_groups as $slider) {
                  // if (!array_key_exists('background_image', $slider)) {
                  //   $background_image = 'John Doe';
                  // }else{
                  //   $background_image = $slider['background_image'];
                  // }
                  
                  if ($page_builder == 'elementor') {
                    $background_image = $slider['background_image']['id'];
                  }else{
                    $background_image = $slider['background_image'];
                  }
                  if (!array_key_exists('slider_image_height', $slider)) {
                    $slider_image_height = '';
                  }else{
                    $slider_image_height = $slider['slider_image_height'];
                  }
                  // beftitle
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_beftitle_color', $slider)) {
                      $slider_beftitle_color_style = '';
                    }else{
                      $slider_beftitle_color_style = 'color:'.$slider['slider_beftitle_color'].';';

                    }
                  }
                  if (!array_key_exists('slider_beftitle_size', $slider)) {
                    $slider_beftitle_size = '';
                  }else{
                    $slider_beftitle_size = $slider['slider_beftitle_size'];
                  }
                  if (!array_key_exists('slider_beftitle_line', $slider)) {
                    $slider_beftitle_line = '';
                  }else{
                    $slider_beftitle_line = $slider['slider_beftitle_line'];
                  }
                  if (!array_key_exists('slider_beftitle_weight', $slider)) {
                    $slider_beftitle_weight = '';
                  }else{
                    $slider_beftitle_weight = $slider['slider_beftitle_weight'];
                  }
                  if (!array_key_exists('before_tag', $slider)) {
                    $before_tag = 'h2';
                  }else{
                    $before_tag = $slider['before_tag'];
                  }
                  // title
                  if (!array_key_exists('title_tag', $slider)) {
                    $title_tag = 'h2';
                  }else{
                    $title_tag = $slider['title_tag'];
                  }
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_title_color', $slider)) {
                      $slider_title_color_style = '';
                    }else{
                      $slider_title_color_style = 'color:'.$slider['slider_title_color'].';';
                    }
                  }
                  if (!array_key_exists('slider_title_size', $slider)) {
                    $slider_title_size = '';
                  }else{
                    $slider_title_size = $slider['slider_title_size'];
                  }
                  if (!array_key_exists('slider_title_line', $slider)) {
                    $slider_title_line = '';
                  }else{
                    $slider_title_line = $slider['slider_title_line'];
                  }
                  if (!array_key_exists('slider_title_weight', $slider)) {
                    $slider_title_weight = '';
                  }else{
                    $slider_title_weight = $slider['slider_title_weight'];
                  }
                  // subtitle
                  if (!array_key_exists('subtitle_tag', $slider)) {
                    $subtitle_tag = 'h2';
                  }else{
                    $subtitle_tag = $slider['subtitle_tag'];
                  }
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_subtitle_color', $slider)) {
                      $slider_subtitle_color_style = '';
                    }else{
                      $slider_subtitle_color_style = 'color:'.$slider['slider_subtitle_color'].';';
                    }
                  }
                  if (!array_key_exists('slider_subtitle_size', $slider)) {
                    $slider_subtitle_size = '';
                  }else{
                    $slider_subtitle_size = $slider['slider_subtitle_size'];
                  }
                  if (!array_key_exists('slider_subtitle_line', $slider)) {
                    $slider_subtitle_line = '';
                  }else{
                    $slider_subtitle_line = $slider['slider_subtitle_line'];
                  }
                  if (!array_key_exists('slider_subtitle_weight', $slider)) {
                    $slider_subtitle_weight = '';
                  }else{
                    $slider_subtitle_weight = $slider['slider_subtitle_weight'];
                  }
                  // discount
                  if (!array_key_exists('discount_tag', $slider)) {
                    $discount_tag = 'h2';
                  }else{
                    $discount_tag = $slider['discount_tag'];
                  }
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_discount_color', $slider)) {
                      $slider_discount_color_style = '';
                    }else{
                      $slider_discount_color_style = 'color:'.$slider['slider_discount_color'].';';

                    }
                  }
                  if (!array_key_exists('slider_discount_bg_color', $slider)) {
                    $slider_discount_bg_color = '';
                  }else{
                    $slider_discount_bg_color = $slider['slider_discount_bg_color'];
                  }
                  if (!array_key_exists('slider_discount_size', $slider)) {
                    $slider_discount_size = '';
                  }else{
                    $slider_discount_size = $slider['slider_discount_size'];
                  }
                  if (!array_key_exists('slider_discount_line', $slider)) {
                    $slider_discount_line = '';
                  }else{
                    $slider_discount_line = $slider['slider_discount_line'];
                  }
                  if (!array_key_exists('slider_discount_weight', $slider)) {
                    $slider_discount_weight = '';
                  }else{
                    $slider_discount_weight = $slider['slider_discount_weight'];
                  }
                  // after_subtitle
                  if (!array_key_exists('after_tag', $slider)) {
                    $after_tag = 'h2';
                  }else{
                    $after_tag = $slider['after_tag'];
                  }
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_aftersubtitle_color', $slider)) {
                      $slider_aftersubtitle_color_style = '';
                    }else{
                      $slider_aftersubtitle_color_style = 'color:'.$slider['slider_aftersubtitle_color'].';';
                    }
                  }
                  if (!array_key_exists('slider_aftersubtitle_size', $slider)) {
                    $slider_aftersubtitle_size = '';
                  }else{
                    $slider_aftersubtitle_size = $slider['slider_aftersubtitle_size'];
                  }
                  if (!array_key_exists('slider_aftersubtitle_line', $slider)) {
                    $slider_aftersubtitle_line = '';
                  }else{
                    $slider_aftersubtitle_line = $slider['slider_aftersubtitle_line'];
                  }
                  if (!array_key_exists('slider_aftersubtitle_weight', $slider)) {
                    $slider_aftersubtitle_weight = '';
                  }else{
                    $slider_aftersubtitle_weight = $slider['slider_aftersubtitle_weight'];
                  }
                  // button
                  if (!array_key_exists('button_status', $slider)) {
                    $button_status = '';
                  }else{
                    $button_status = $slider['button_status'];
                  }
                  if (!array_key_exists('slider_button_color', $slider)) {
                    $slider_button_color = '';
                  }else{
                    $slider_button_color = $slider['slider_button_color'];
                  }
                  if($page_builder != 'elementor') { 
                    if (!array_key_exists('slider_button_background', $slider)) {
                      $slider_button_background_style= '';
                    }else{
                      $slider_button_background_style = 'background:'.$slider['slider_button_background'].';';
                    }
                  }
                  if (!array_key_exists('slider_button_text', $slider)) {
                    $slider_button_text = '';
                  }else{
                    $slider_button_text = $slider['slider_button_text'];
                  }
                  if (!array_key_exists('slider_button_text', $slider)) {
                    $slider_button_text = '';
                  }else{
                    $slider_button_text = $slider['slider_button_text'];
                  }
                  if (!array_key_exists('button_style', $slider)) {
                    $button_style = '';
                  }else{
                    $button_style = $slider['button_style'];
                  }
                  // gradient
                  if (!array_key_exists('gradient_color_1', $slider)) {
                    $gradient_color_1 = '';
                  }else{
                    $gradient_color_1 = $slider['gradient_color_1'];
                  }
                  if (!array_key_exists('gradient_color_2', $slider)) {
                    $gradient_color_2 = '';
                  }else{
                    $gradient_color_2 = $slider['gradient_color_2'];
                  }
                  // alignment
                  if (!array_key_exists('section_align', $slider)) {
                    $section_align = '';
                  }else{
                    $section_align = $slider['section_align'];
                  }
                  if (!array_key_exists('background_gradient', $slider)) {
                    $background_gradient = '';
                  }else{
                    $background_gradient = $slider['background_gradient'];
                  }
                  if ($page_builder == 'elementor') {
                    $slider_button_url = $slider['slider_button_url'];
                  }
                  if (!array_key_exists('slider_button_hover_bg', $slider)) {
                    $slider_button_hover_bg = '';
                  }else{
                    $slider_button_hover_bg = $slider['slider_button_hover_bg'];
                  }
                  if (!array_key_exists('slider_button_color_hover', $slider)) {
                    $slider_button_color_hover = '';
                  }else{
                    $slider_button_color_hover = $slider['slider_button_color_hover'];
                  }
                  if ($page_builder == 'elementor') {
                    $slider_button_url = $slider['slider_button_url'];
                  }
                  

                  if (!array_key_exists('pagination_color', $slider)) {
                    $pagination_color = '';
                  }else{
                    $pagination_color = $slider['pagination_color'];
                  }
                  if (!array_key_exists('pagination_color_next', $slider)) {
                    $pagination_color_next = '';
                  }else{
                    $pagination_color_next = $slider['pagination_color_next'];
                  }
                  $slider_style_bg = '';
                  // if (isset($background_image) && !empty($background_image)) {
                    $background_image = wp_get_attachment_image_src($background_image, "full");
                  // }
                  $slider_style_bg_color = '';
                  if ($background_gradient == "true"){ 
                    $slider_style_bg_color .= '';
                  }else {
                    $slider_style_bg_color .= ' background-color: ' . $gradient_color_1 . '';
                  }
                  if ($background_gradient == "true") {
                    $slider_style_bg = 'background-image: linear-gradient(90deg, ' . $gradient_color_1 . ' 0%, ' . $gradient_color_2 .' 100%),url('.$background_image[0].')';
                  }else{
                    if ($background_image) {
                      $slider_style_bg .= 'background-image: url('.$background_image[0].'); ';
                    }
                  }
                  $discount_bg_color_style = '';
                  if ($slider_discount_bg_color) {
                    $discount_bg_color_style .= 'background: linear-gradient(to top left, transparent 51%, rgba(255, 0, 0, 0) 30%, '.$slider_discount_bg_color.' 48%, '.$slider_discount_bg_color.'  58.5%) no-repeat, linear-gradient(to top left, transparent 0.1%, '.$slider_discount_bg_color.' 0.1%) no-repeat;';
                  }
                  ?>
                  <?php if ($layout == "carousel") {  ?>

                    <div class="<?php echo esc_attr($carousel_item_class)?><?php echo esc_attr($slider['_id'])?>">
                  <?php }else { ?>
                    <div class="<?php echo esc_attr($carousel_item_class)?>">
                  <?php } ?>
                      <div style="<?php echo esc_attr($slider_style_bg); ?>;height:<?php echo esc_attr($slider_image_height);?>px;" class="mt-addons-hero-slider-background">
                      <div class="mt-addons-hero-slider-bg" style="<?php echo esc_attr($slider_style_bg_color); ?>">
                        <div class="container">
                          <div class="mt-addons-hero-slider-holder <?php echo esc_attr($section_align);?>">
                            <?php if(!empty($slider['before_title'])){ ?> 
                              <<?php echo esc_attr( $before_tag ); ?> class="mt-addons-hero-slider-beftitle" style="<?php echo esc_attr($slider_beftitle_color_style);?>;font-size:<?php echo esc_attr($slider_beftitle_size);?>px;line-height:<?php echo esc_attr($slider_beftitle_line);?>px;font-weight:<?php echo esc_attr($slider_beftitle_weight);?>;"> <?php echo esc_html($slider['before_title']);?> </<?php echo esc_attr( $before_tag ); ?>>
                            <?php } ?>
                              <?php if(!empty($slider['title'])){ ?>
                              <<?php echo esc_attr( $title_tag ); ?> class="mt-addons-hero-slider-title" style="<?php echo esc_attr($slider_title_color_style);?>;font-size:<?php echo esc_attr($slider_title_size);?>px;line-height:<?php echo esc_attr($slider_title_line);?>px;font-weight:<?php echo esc_attr($slider_title_weight);?>;"> <?php echo esc_html($slider['title']);?> </<?php echo esc_attr( $title_tag ); ?>>
                              <?php } ?>
                            <?php if(!empty($slider['discount'])){ ?>
                              <div class="mt-addons-hero-discount-background"style="<?php echo esc_attr($discount_bg_color_style); ?>;">
                                <<?php echo esc_attr( $discount_tag ); ?> class="mt-addons-hero-slider-discount" style="<?php echo esc_attr($slider_discount_color_style);?>;font-size:<?php echo esc_attr($slider_discount_size);?>px;line-height:<?php echo esc_attr($slider_discount_line);?>px;font-weight:<?php echo esc_attr($slider_discount_weight);?>;"> <?php echo esc_html($slider['discount']);?> </<?php echo esc_attr( $discount_tag ); ?>>
                                </div>
                            <?php } ?>
                            <?php if(!empty($slider['subtitle'])){ ?>
                              <<?php echo esc_attr( $subtitle_tag ); ?> class="mt-addons-hero-slider-subtitle" style="<?php echo esc_attr($slider_subtitle_color_style);?>;font-size:<?php echo esc_attr($slider_subtitle_size);?>px;line-height:<?php echo esc_attr($slider_subtitle_line);?>px;font-weight:<?php echo esc_attr($slider_subtitle_weight);?>;"> <?php echo esc_html($slider['subtitle']);?> </<?php echo esc_attr( $subtitle_tag ); ?>>
                            <?php } ?>
                            <?php if(!empty($slider['after_subtitle'])){ ?>
                              <<?php echo esc_attr( $after_tag ); ?> class="mt-addons-hero-slider-aftersubtitle" style="<?php echo esc_attr($slider_aftersubtitle_color_style);?>;font-size:<?php echo esc_attr($slider_aftersubtitle_size);?>px;line-height:<?php echo esc_attr($slider_aftersubtitle_line);?>px;font-weight:<?php echo esc_attr($slider_aftersubtitle_weight);?>;"> <?php echo esc_html($slider['after_subtitle']);?> </<?php echo esc_attr( $after_tag ); ?>>
                            <?php } ?>
                            <?php if($page_builder == 'elementor' && $button_status == "yes") { ?>
                                <a href="<?php echo esc_url($slider_button_url);?>" class="relative">
                                  <span class="mt-addons-hero-slider-button <?php echo esc_attr($button_style);?>" style="color:<?php echo esc_attr($slider_button_color);?>;<?php echo esc_attr($slider_button_background_style);?>;"><?php echo esc_html($slider_button_text);?></span>
                                </a>
                            <?php }else { ?>
                              <?php if(($button_status) == "true") { ?>
                                <a href="<?php echo esc_url($slider_button_url);?>" class="relative">
                                  <span class="mt-addons-hero-slider-button <?php echo esc_attr($button_style);?>" style="color:<?php echo esc_attr($slider_button_color);?>;background:<?php echo esc_attr($slider_button_background);?>;"><?php echo esc_html($slider_button_text);?></span>
                                </a>
                              <?php } ?>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            <?php //swiper wrapped end ?>
            <?php echo wp_kses_post($swiper_wrapped_end); ?>
            <?php //pagination/navigation ?>
            <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
        </div>
      </div>
    <?php //swiper container end ?>
    <?php echo wp_kses_post($swiper_container_end); ?>
    <?php if (function_exists('vc_map')) { ?>
      <style >
        span.mt-addons-hero-slider-button:hover{
          background: <?php echo esc_attr($slider_button_hover_bg);?> !important;
          color: <?php echo esc_attr($slider_button_color_hover); ?>!important;
        }
        <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-prev,
        <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-next {
          background: <?php echo esc_attr($navigation_bg_color);?>!important;
          color: <?php echo esc_attr($navigation_color); ?>!important;
        }
      
      </style>
    <?php } ?>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-hero-slider', 'modeltheme_addons_for_wpbakery_hero_slider');

//VC Map
if (function_exists('vc_map')) {
  $params = array(

    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'sliders_groups',
      'params' => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "background_image"
        ),
        array(
          "type" => "colorpicker", 
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "gradient_color_1"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Image Height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_image_height"
        ),
        array(
          "type" => "checkbox",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Background Gradient', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "background_gradient",
          "value"       => "false", 
        ),
        array(
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Gradient Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "gradient_color_2",
          "dependency" => array(
            'element' => 'background_gradient',
            'value' => 'false',
          ),
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => esc_attr__( "Alignment", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "section_align",
          "value" => array(
              'Select Option' => '',
              'Left'          => 'text-left',
              'Center'        => 'text-center',
              'Right'         => 'text-right',
          ),
          "default" => 'text-left'
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "title",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element Title Tag", 'modeltheme-addons-for-wpbakery' ),
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
          ),
          "std" => 'h2',
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_title_color",
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__("Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_title_size",
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__("Line height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_title_line",
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__("Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_title_weight"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Subtitle", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "subtitle",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element Subtitle Tag", 'modeltheme-addons-for-wpbakery' ),
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
          ),
          "std" => 'h2',
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Subtitle Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_subtitle_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Subtitle Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_subtitle_size"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Subtitle Line height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_subtitle_line"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Subtitle Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_subtitle_weight"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Before Title Text", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "before_title",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element Before Tag", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "before_tag",   
          "value" => array(
            'Select Option' => '',
            'h1'      => 'h1',
            'h2'      => 'h2',
            'h3'      => 'h3',
            'h4'      => 'h4',
            'h5'      => 'h5',
            'h6'      => 'h6',
            'p'       => 'p',
          ),
          "std" => 'h2',
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Before Title Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_beftitle_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Before Title Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_beftitle_size"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Before Title Line height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_beftitle_line"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Before Title Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_beftitle_weight"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Discount Text", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "discount",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element Discount Tag", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "discount_tag",    
          "value" => array(
            'Select Option' => '',
            'h1'      => 'h1',
            'h2'      => 'h2',
            'h3'      => 'h3',
            'h4'      => 'h4',
            'h5'      => 'h5',
            'h6'      => 'h6',
            'p'       => 'p',
          ),
          "std" => 'h2',
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Discount Title Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_discount_color"
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Discount Title Background Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_discount_bg_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Discount Title Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_discount_size"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Discount Title Line height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_discount_line"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "Discount Title Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_discount_weight"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("After Subtitle Text", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "after_subtitle",
        ),
        array(
          "type" => "dropdown",
          "group" => "Title",
          "class" => "",
          "heading" => esc_attr__( "Element After Tag", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "after_tag",    
          "value" => array(
            'Select Option' => '',
            'h1'      => 'h1',
            'h2'      => 'h2',
            'h3'      => 'h3',
            'h4'      => 'h4',
            'h5'      => 'h5',
            'h6'      => 'h6',
            'p'       => 'p',
          ),
          "std" => 'h2',
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("After Subtitle Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_aftersubtitle_color"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "After Subtitle Font size", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_aftersubtitle_size"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "After Subtitle Line height", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_aftersubtitle_line"
        ),
        array(
          "type" => "vc_number",
          "class" => "",
          "heading" => esc_attr__( "After Subtitle Font weight", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_aftersubtitle_weight"
        ),
        array(
          "type" => "checkbox",
          "class" => "",
          "heading" => esc_attr__("Button", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "button_status",
          "value"       => array(
            "Enabled" => "true",
          ),
        ),
        array(
          "type" => "textfield",
          "class" => "",
          "heading" => esc_attr__( "Text", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "slider_button_text",
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Style", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "button_style",
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
          "std" => 'round',
          "value" => array(
            'Rounded'           => 'round',
            'Rectangle'         => 'boxed'
          ),
        ),
        array(
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Link", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_button_url",
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
          "param_name" => "slider_button_color"
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_button_color_hover",
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
        ),
        array(
          "type" => "colorpicker", 
          "class" => "",
          "heading" => esc_attr__("Background", 'modeltheme-addons-for-wpbakery'),
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
          "param_name" => "slider_button_background"
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__("Background hover", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "slider_button_hover_bg",
          "dependency" => array(
            'element' => 'button_status',
            'value' => "true",
          ),
        ),  
      ),
    ),
  );

    $swiper_fields_array = modeltheme_addons_swiper_vc_fields();
    if ($swiper_fields_array) {
      foreach ($swiper_fields_array as $swiper_fields) {
        $params[] = $swiper_fields;
      }
    }
  vc_map(
    array(
      "name" => esc_attr__("MT: Hero slider", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-hero-slider",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => "modeltheme_shortcode",
      "params" => $params,
  ));
}