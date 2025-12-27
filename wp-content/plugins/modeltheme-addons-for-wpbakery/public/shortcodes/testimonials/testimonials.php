<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_testimonials($params, $content) {
  extract( shortcode_atts( 
    array(
      'section_align'             => '',
      'page_builder'              => '',
      'image_shape'               => '',
      'list_image'                => '',
      'testimonials_groups'       => '',
      'member_name'               => '',
      'member_position'           => '',
      'member_description'        => '',
      'title_color'               => '',
      'position_color'            => '',
      'description_color'         => '',
      'description_size'          => '',
      'quote_testimonial'         => '',
      'aligment'                  => '',
      'quote_color'               => '',
      'quote_position'            => '',
      'quote_size'                => '',
      'quote_image'               => '',
      // carousel
      'autoplay'              => '', 
      'delay'                 => '',
      'items_desktop'         => '2',
      'items_mobile'          => '',
      'items_tablet'          => '',
      'space_items'           => '',
      'touch_move'            => '',
      'effect'                => '',
      'grab_cursor'           => '',
      'infinite_loop'         => '',
      'carousel'                 => '',
      'columns'                  => '',
      'layout'                   => 'carousel',
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
      'section_align_image'        => '',
      'holder_image_position'      => '',
      'testimonial_date'           => '',
      'testimonial_date_color'     => '',
      'short_description_color'    => '',
      'testimonial_block_bg'       => ''
      
      // end carousel

    ), $params ) );
    
    $title_color_style = '';
    if ($title_color) {
      $title_color_style = 'color:'.$title_color.';';
    }
    $position_color_style = '';
    if ($position_color) {
      $position_color_style = 'color:'.$position_color.';';
    }
    $description_color_style = '';
    if ($description_color) {
      $description_color_style = 'color:'.$description_color.';';
    }
    $short_description_color_style = '';
    if ($short_description_color) {
      $short_description_color_style = 'color:'.$short_description_color.';';
    }
    $testimonial_block_bg_style = '';
    if ($testimonial_block_bg) {
      $testimonial_block_bg_style = 'background:'.$testimonial_block_bg.';';
    }

    wp_enqueue_style( 'testimonials-css', plugins_url( '../../css/testimonials.css' , __FILE__ ));
    if ($page_builder == 'elementor') {
      $testimonials_groups = unserialize(base64_decode($testimonials_groups));
    }else{
      $testimonials_groups = vc_param_group_parse_atts($params['testimonials_groups']);
    }
    $quote_position_style = 'before_content';
    if($quote_position == "before_content") {
      $quote_position_style = 'before_content';
    } elseif ($quote_position == "background_content") {
      $quote_position_style = 'background_content';
    }

    $uniqid = 'mt-addons-uniqid-'.uniqid();
    $id = 'mt-addons-carousel-'.uniqid();

    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $swiper_container_start = '';
    $swiper_container_end = '';
    $html_post_swiper_wrapper = '';

    if ($layout == "carousel") {
      $carousel_holder_class = 'mt-addons-swipper swiper';
      $carousel_item_class = 'swiper-slide';

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
        $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
      }else {
        if($pagination == "true") { 
          // next/prev
          $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
        }
      }

      // SWIPER SLIDER
      wp_enqueue_style( 'swiper-bundle', plugins_url( '../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
      wp_enqueue_script( 'swipper-bundle', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
      wp_enqueue_script( 'swipper', plugins_url( '../../js/swiper.js' , __FILE__));
    }

 
    ob_start(); ?>
    <?php //swiper container start ?>
    <?php echo wp_kses_post($swiper_container_start); ?>
      <div class="mt-swipper-carusel-position" style="position:relative;">
        <div id="<?php echo esc_attr($id); ?>" 
          <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>   
          class="mt-addons-testimonials-carusel <?php echo esc_attr($carousel_holder_class); ?>">

            <?php //swiper wrapped start ?>
            <?php echo wp_kses_post($swiper_wrapped_start); ?>

              <?php //items ?>
              <?php if ($testimonials_groups) { ?>
                <?php foreach ($testimonials_groups as $testimonial) {

                  if (!array_key_exists('testimonial_name', $testimonial)) {
                    $testimonial_name = 'John Doe';
                  }else{
                    $testimonial_name = $testimonial['testimonial_name'];
                  }

                  if ($page_builder == 'elementor') {
                    $image_id = $testimonial['list_image']['id'];
                  }else{
                    if (!array_key_exists('list_image', $testimonial)) {
                      $image_id = '';
                    }else{
                      $image_id = $testimonial['list_image'];
                    }
                  }

                  $image_testimonial = wp_get_attachment_image_src( $image_id, 'full' ); 
                  ;?>
                    <div class="mt-addons-testimonial-item relative <?php echo esc_attr($carousel_item_class.' '.$holder_image_position); ?>" style="<?php echo esc_attr($testimonial_block_bg_style); ?>">
                      <?php if ($quote_testimonial == "true") { ?>
                        <div class="mt-addons-quote-image <?php echo esc_attr($aligment.' '.$quote_position);?>" style="color:<?php echo esc_attr($quote_color); ?>;font-size:<?php echo esc_attr($quote_size); ?>px">
                          <i class="fas fa-quote-right"></i>
                        </div>
                      <?php } ?>

                      <div class="mt-addons-testimonial-holder <?php echo esc_attr($section_align);?>">
                      <?php if(!empty($testimonial['testimonial_description'])){ ?>
                        <div class="mt-addons-testimonial-description" style="<?php echo esc_attr($description_color_style); ?> <?php if($description_size){ ?>font-size:<?php echo esc_attr($description_size); ?>px<?php } ?>"><?php echo esc_html__($testimonial['testimonial_description']);?>
                        <?php if(!empty($testimonial['testimonial_date'])){ ?>
                          <p class="mt-addons-testimonial-date"style="color:<?php echo esc_attr($testimonial_date_color); ?>">
                            <?php echo esc_html__($testimonial['testimonial_date']); ?>
                          </p>
                        <?php } ?>
                        </div>
                        <?php if(!empty($testimonial['testimonial_short_description'])){ ?>
                        <p class="mt-addons-testimonial-short-description " style="<?php echo esc_attr($short_description_color_style); ?>;"><?php echo esc_html__($testimonial['testimonial_short_description']);?>
                        </p>
                      <?php } ?>
                      <?php } ?>
                    </div>

                    <div class="mt-addons-testimonial-image-holder">
                        <?php if($image_testimonial) { ?>
                          <div class="mt-addons-testimonial-image  <?php echo esc_attr($section_align_image);?>">
                            <img src="<?php echo esc_url($image_testimonial[0]); ?>" alt="<?php echo esc_html__($testimonial_name); ?>" class="<?php echo esc_attr($image_shape); ?>" />
                          </div>
                        <?php } ?>
                      <div class="mt-addons-testimonial-title-position "> 
                        <?php if(!empty($testimonial['testimonial_name'])){ ?>
                          <h4 class="mt-addons-testimonial-name" style="<?php echo esc_attr($title_color_style); ?>">
                              <?php echo esc_html__($testimonial['testimonial_name']); ?>
                          </h4>
                          <?php if(!empty($testimonial['testimonial_position'])){ ?>
                            <div class="mt-addons-testimonial-position" style="<?php echo esc_attr($position_color_style); ?>"><?php echo esc_html__($testimonial['testimonial_position']);?></div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            <?php //swiper wrapped end ?>
            <?php echo wp_kses_post($swiper_wrapped_end); ?>
   

          <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
        </div>
      </div>
     
    <?php //swiper container end ?>
    <?php echo wp_kses_post($swiper_container_end); ?>
    <style type="text/css" media="screen">
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-prev:hover,
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-next:hover {
        background: <?php echo esc_attr($navigation_bg_color_hover);?>!important;
        color: <?php echo esc_attr($navigation_color_hover); ?>!important;
        opacity: 1;
      }
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-pagination-bullet {
        background: <?php echo esc_attr($pagination_color);?>!important;
      }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-testimonials', 'modeltheme_addons_for_wpbakery_testimonials');

//VC Map
if (function_exists('vc_map')) {

  $params = array(
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => esc_attr__( "Text Description Aligment", 'modeltheme-addons-for-wpbakery' ),
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
      "type" => "dropdown",
      "class" => "",
      "heading" => esc_attr__( "Image/Position Aligment", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "section_align_image",
      "value" => array(
        'Select Option' => '',
        'Left'          => 'text-and-img-left',
        'Center'        => 'text-and-img-center',
        'Right'         => 'text-and-img-right',
      ),
      "default" => 'text-center'
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_attr__("Holder image Position", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "holder_image_position",
      "holder" => "div",
      "std" => 'round',
      "value" => array(
        'Select'          => '',
        'Down'            => 'mt-addons-holder_down',
        'Top'             => 'mt-addons-holder_top'
      ),
      "class" => ""
    ),
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'testimonials_groups',
      'params' => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Image', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "list_image",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Description', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "testimonial_description",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Name', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "testimonial_name",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Position', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "testimonial_position",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Date', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "testimonial_date",
        ),
      ),
    ),
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Image Shape', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "image_shape",
      "value" => array(
        'Select Option'     => '',
        'Rounded'     => 'img-rounded',
        'Circle'     => 'img-circle',
        'Square'     => 'img-square',
      )
    ),
    array(
      "group" => "Quotes",
      "type" => "checkbox",
      "class" => "",
      "heading" => esc_attr__('Status', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "quote_testimonial",
      "value"       => array(
        "Enabled" => "true",
      ),
    ),
    array(
      "group" => "Quotes",
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Quote Aligment', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "aligment",
      "value" => array(
        'Select '    => '',
        'Left'       => 'text-left',
        'Center'     => 'text-center',
        'Right'      => 'text-right'
      ),
      "dependency" => array(
        'element' => 'quote_testimonial',
        'value' => "true",
      )
    ),
    array(
      "group" => "Quotes",
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Quotes Position", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "quote_position",
      "value" => array(
        'Select Option'     => '',
        esc_attr__('Top Content', 'modeltheme-addons-for-wpbakery')    => 'top-content',
        esc_attr__('Background Content', 'modeltheme-addons-for-wpbakery')    => 'background-content',
      ),
      "dependency" => array(
        'element' => 'quote_testimonial',
        'value' => "true",
      )
    ),
    array(
      "group" => "Quotes",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( 'Quote Font size', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "quote_size",
      "dependency" => array(
        'element' => 'quote_testimonial',
        'value' => "true",
      ),
    ),
    array(
      "group" => "Quotes",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Quote Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "quote_color",
      "dependency" => array(
        'element' => 'quote_testimonial',
        'value' => "true",
      ),
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Title Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Date Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "testimonial_date_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Position Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "position_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Description Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "description_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__('Short Description Color', 'modeltheme-addons-for-wpbakery'),
      "param_name" => "short_description_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "vc_number",
      "suffix" => "px",
      "class" => "",
      "heading" => esc_attr__( 'Description Font size', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "description_size"
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
      "name" => esc_attr__('MT: Testimonials', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-testimonials",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/testimonials.svg', __FILE__ ),
      "params" => $params,
  ));
}