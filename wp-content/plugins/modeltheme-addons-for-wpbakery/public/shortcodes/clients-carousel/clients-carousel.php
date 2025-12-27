<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_clients_carusel($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'client_name_status'               => '',
      'client_photo_height'              => '',
      'image_shape'           => '',
      'clients_groups'        => '',

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
      'navigation'           => '',
      'pagination'           => '',
      'pagination'           => '',
      'grid_rows'           => '',
      // end carousel
      
    ), $params ) );
    
   
    wp_enqueue_style( 'mt-clients', plugins_url( '../../css/clients-carousel.css' , __FILE__ ));

    if ($page_builder == 'elementor') {
      $clients_groups = unserialize(base64_decode($clients_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $clients_groups = vc_param_group_parse_atts($params['clients_groups']);
      }
    }
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
      wp_enqueue_script( 'swipper-bundle-min', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.min.js.map' , __FILE__));
      wp_enqueue_script( 'swipper-bundle-min', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.esm.browser.min.js' , __FILE__));

      wp_enqueue_script( 'swipper', plugins_url( '../../js/swiper.js' , __FILE__));
    }

    ob_start(); ?>
    <?php //swiper container start ?>
    <?php echo wp_kses_post($swiper_container_start); ?>
      <div class="mt-swipper-carusel-position" style="position:relative;">

        <div id="<?php echo esc_attr($id); ?>" 
          <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?> 
          class="mt-addons-clients-carusel <?php echo esc_attr($carousel_holder_class); ?>">

            <?php //swiper wrapped start ?>
            <?php echo wp_kses_post($swiper_wrapped_start); ?>

              <?php //items ?>
              <?php if ($clients_groups) { ?>
            <?php $count = 1; ?>

                <?php foreach ($clients_groups as $client) {



                  if ($page_builder == 'elementor') {
                    $image_id = $client['clients_image']['id'];
                    $client_link = $client['client_url'];
                  }else{
                    if (!array_key_exists('clients_image', $client)) {
                      $image_id = '';
                    }else{
                      $image_id = $client['clients_image'];
                    }

                    if (!array_key_exists('client_url', $client)) {
                      $client_link = '';
                    }else{
                      $link = vc_build_link($client['client_url']);
                      $client_link = $link['url'];
                    }

                  }

                  $image_clients = wp_get_attachment_image_src($image_id, 'full' );

                  ?>
           

              
                  <div class="mt-addons-client-image-item relative <?php echo esc_attr($carousel_item_class); ?>">
                  <?php  if($page_builder == 'elementor' && $grid_rows == "yes") { ?>
                    <?php  if( $count % 2 == 1 ) {  ?>
                      <div class="mt-addons-client-grid-rows">
                    <?php } ?>
                  <?php } ?>

                    <?php if ($image_clients) { ?>
                      <div class="mt-addons-client-image-holder">
                        <div class="mt-addons-client-image">
                          <?php if($client_link != ''){ ?>
                            <a href="<?php echo esc_url($client_link); ?>" target="<?php echo esc_attr($link['target']); ?>" rel="<?php echo esc_attr($link['rel']); ?>">
                          <?php } ?>
                            <img style="<?php if($client_photo_height){echo 'height: '.$client_photo_height.'px;';} ?>" src="<?php echo esc_url($image_clients[0]); ?>" alt="<?php echo esc_attr__('Client', 'modeltheme-addons-for-wpbakery'); ?>" class="<?php echo $image_shape; ?>" />
                          <?php if($client_link != ''){ ?>
                            </a>
                          <?php } ?>

                          <?php if ($client_name_status) { ?>
                            <h6 class="mt-addons-heading">
                              <?php if($client_link != ''){ ?>
                                <a href="<?php echo esc_url($client_link); ?>" target="<?php echo esc_attr($link['target']); ?>" rel="<?php echo esc_attr($link['rel']); ?>">
                                  <?php echo esc_html($client['clients_name']); ?>
                                </a>
                              <?php }else{ ?>
                                  <?php echo esc_html($client['clients_name']); ?>
                              <?php } ?>
                            </h6>
                          <?php } ?>

                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <?php  if($page_builder == 'elementor' && $grid_rows == "yes") { ?>
                    <?php if($count % 2 == 0) { ?>
                      </div>
                    <?php } ?>
                    <?php $count++; ?>
                  <?php } ?>

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

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-clients-carusel', 'modeltheme_addons_for_wpbakery_clients_carusel');

//VC Map
if (function_exists('vc_map')) {
      
  $params = array(
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => __( 'Client Names', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "client_name_status",
      "description" => __( 'If checked, the name of the client will be shown as a label below client logo', 'modeltheme-addons-for-wpbakery' )
    ),
    array(
      "type" => "vc_number",
      "class" => "",
      'min' => 0,
      'step' => 1,
      'suffix' => 'px',
      "heading" => __( 'Photo Height', 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "client_photo_height",
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
      "group" => "Items",
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'clients_groups',
      'params' => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Image', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "clients_image",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__('Name', 'modeltheme-addons-for-wpbakery'),
          "param_name" => "clients_name",
        ),
        array(
          "group" => "Options",
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( 'Link', 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "client_url",
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
      "name" => esc_attr__('MT: Clients', 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-clients-carusel",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/clients.svg', __FILE__ ),
      "params" => $params,
  ));
}