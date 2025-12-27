<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_products_carousel($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'number'                   => '',
      'order'                    => '',
      'category'                 => '',

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
      'columns'                  => 'col-md-4',
      'layout'                   => 'grid',
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
      // end carousel

    ), $params ) );

    $args_products = array(
      'posts_per_page'   => $number,
      'order'            => 'DESC',
      'post_type'        => 'product',
      'post_status'      => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          'terms' => $category
        )
      ), 
    ); 
    $products = get_posts($args_products);
 
    wp_enqueue_style( 'products-carousel', plugins_url( '../../css/products-carousel.css' , __FILE__ ));
    
    $id = 'mt-addons-swiper-'.uniqid();
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
    if($navigation == "true") {
      // next/prev
      $html_post_swiper_wrapper .= '
      <i class="far fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
      <i class="far fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
    }

    if ($pagination == "true") {
      // next/prev
      $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
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
        class="mt_addons_products_carousel <?php echo esc_attr($carousel_holder_class); ?>">
        
          <?php //swiper wrapped start ?>
          <?php echo wp_kses_post($swiper_wrapped_start); ?>
            <?php foreach ($products as $prod) {
              global $product;
              $product = wc_get_product( $prod->ID );
              $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $prod->ID ), 'full' );
              $product_cause = get_post_meta( $prod->ID, 'product_cause', true );
              if ($thumbnail_src) {
                $post_img = '<img class="mt_addons_products_carousel_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$prod->post_title.'" />';
                $post_col = 'col-md-12';
              }else{
                $post_col = 'col-md-12 no-featured-image';
                $post_img = '';
              }
              ?>
              <div id="product-id-<?php echo esc_attr($prod->ID);?>" class="<?php echo esc_attr($carousel_item_class); ?>">
                  <div class="mt-addons-products-carousel-slider-wrapper">
                    <div class="mt-addons-products-carousel-thumbnail-and-details">
                      <a class="mt_addons_products_carousel_media_image" title="<?php echo esc_attr($prod->post_title);?>" href="<?php echo esc_attr(get_permalink($prod->ID))?>"><?php echo $post_img;?>
                        </a>
                    </div>
                    <div class="mt-addons-products-carousel-title-metas">
                      <h3 class="mt-addons-products-carousel-archive-product-title">
                        <a href="<?php echo get_permalink($prod->ID)?>" title="<?php echo esc_attr($prod->post_title);?>" ><?php echo esc_attr($prod->post_title);?></a>
                      </h3>
                      <div class="mt-addons-products-carousel-price">
                        <?php if($product->get_price_html()) { ?>
                          <p>
                            <?php echo $product->get_price_html();?>
                          </p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
              </div>
            <?php } ?>
          <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>
        <?php //pagination/navigation ?>
        <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
      </div>
    <?php //swiper container end ?>
   <?php echo wp_kses_post($swiper_container_end); ?>
    <style type="text/css" media="screen">
      .swiper-button-prev:hover,
      .swiper-button-next:hover {
        background: <?php echo esc_attr($navigation_bg_color_hover);?>!important;
        color: <?php echo esc_attr($navigation_color_hover); ?>!important;
        opacity: 1;
      }
      .swiper-pagination-bullet {
        background: <?php echo esc_attr($pagination_color);?>!important;
      }
    </style>
    </div>
      <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-products-carousel', 'modeltheme_addons_for_wpbakery_products_carousel');

add_action('init','mt_addons_products_carousel');
function mt_addons_products_carousel(){

  if (function_exists('vc_map')) {
    $product_category = array();
    if ( class_exists( 'WooCommerce' ) ) {
      $product_category_tax = get_terms( 'product_cat', array(
        'parent'      => '0'
      ));
      if ($product_category_tax) {
        foreach ( $product_category_tax as $term ) {
          if ($term) {
            $product_category[$term->name] = $term->slug;
          }
        }
      }
    }

    $params = array(
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Category", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "category",
        "std" => 'Default value',
        "value" => $product_category
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Number of products", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "number"
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
        "name" => esc_attr__("MT: Products Carousel", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt-addons-products-carousel",
        "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
        "icon" => plugins_url( 'images/products-carousel.svg', __FILE__ ),
        "params" => $params,
    ));
  }
}