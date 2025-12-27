<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_products_list($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                         => '',
      'number'                               => '',
      'number_of_products_by_category'       => '',
      'hide_empty'                           => '',
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
      // end carousel
      'text_color'                           => '',
      'text_color_hover'                     => '',
      'border_color'                         => '',
      'color'                                => '',
      'active_tab_bg'                        => '',

    ), $params ) );

    $prod_categories = get_terms( 'product_cat', array(
      'number'        => $number,
      'hide_empty'    => $hide_empty,
      'parent' => 0
    ));

    wp_enqueue_style( 'products-list-css', plugins_url( '../../css/products-list.css' , __FILE__ ));
    $id = 'mt-addons-carousel-'.uniqid();
    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $html_post_swiper_wrapper = '';

    if ($layout == "carousel") {
      $carousel_holder_class = 'mt-addons-swipper swiper';
      $carousel_item_class = 'swiper-slide';

      $swiper_wrapped_start = '<div class="swiper-wrapper">';
      $swiper_wrapped_end = '</div>';

      if(($navigation) == "true") {
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
    ob_start(); 
    ?>

    <script type="text/javascript">
      jQuery(function(){
        jQuery(document).ready(function () {
          // Buttons
          jQuery( ".mt-addons-products-list .category" ).mouseover(function() {
              // bg
              var hover_color_bg = jQuery( this ).attr('data-bg-hover');
              // color
              var hover_color_text = jQuery( this ).attr('data-text-color-hover');

              jQuery( this ).css("background",hover_color_bg);
              jQuery( this ).css("color",hover_color_text);
          }).mouseout(function() {

              var color_text = jQuery( this ).attr('data-text-color');
              var color_bg = jQuery( this ).attr('data-bg');
              
              jQuery( this ).css("background",color_bg);
              jQuery( this ).css("color",color_text);
          });
        });
      });
    </script>
    <div class="woocommerce_categories mt-addons-products-list">
      <div class="mt-swipper-carusel-position" style="position:relative;">
        <div id="<?php echo esc_attr($id); ?>" 
        <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>  
        class="mt_addons_categories_shortcode <?php echo esc_attr($carousel_holder_class); ?>">
          <?php //swiper wrapped start ?>
          <?php echo wp_kses_post($swiper_wrapped_start); ?>


          <?php foreach( $prod_categories as $prod_cat ) { 
            if ( class_exists( 'WooCommerce' ) ) {
                $cat_thumb_id   = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            } else {
                $cat_thumb_id = '';
            }
            $cat_thumb_url  = wp_get_attachment_image_src( $cat_thumb_id, 'full' );
            $term_link      = get_term_link( $prod_cat, 'product_cat' );
            ?>
            <div 
              data-text-color="<?php echo esc_attr($text_color); ?>" 
              data-text-color-hover="<?php echo esc_attr($text_color_hover); ?>" 
              data-bg="<?php echo esc_attr($color); ?>" 
              class="category item <?php echo esc_attr($carousel_item_class); ?>"style="
              background-color: <?php echo esc_attr($color); ?>;
              color: <?php echo esc_attr($text_color); ?>;
              border: 1px solid <?php echo esc_attr($border_color); ?>">
              <a class="#categoryid_<?php echo esc_attr($prod_cat->term_id);?>">
                <span class="mt-addons-products-list-name" style="color: <?php echo esc_attr($text_color); ?>;">
                  <?php echo esc_attr($prod_cat->name);?>
                </span>
              </a>
            </div>
          <?php } ?>
          <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>

          <?php //pagination/navigation ?>
          <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
        </div>
      </div>
      <div class="mt-addons-products-list-category">
        <?php foreach( $prod_categories as $prod_cat ) { ?>
          <div id="categoryid_<?php echo esc_attr($prod_cat->term_id);?>" class="products_by_category <?php echo esc_attr($prod_cat->name);?>"><?php echo do_shortcode('[product_category columns="1" per_page="'.$number_of_products_by_category.'" category="'.$prod_cat->slug.'"]');?>
          </div>
        <?php } ?>
      </div>
    </div>
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
      body .mt-addons-products-list .category.item.active{
        background: <?php echo esc_attr($active_tab_bg);?>!important;
      }
    </style>
    <?php 
    return ob_get_clean();
}
add_shortcode('mt-addons-products-list', 'modeltheme_addons_for_wpbakery_products_list');

//VC Map
if (function_exists('vc_map')) {
  $params = array(
    array(
      "type" => "vc_number",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Number of categories to show", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "number"
    ),
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Number of products to show for each category", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "number_of_products_by_category"
    ),
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => esc_attr__("Show categories without products?", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "hide_empty",
      "value"       => array(
        "Enabled" => "true",
      ),
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Border Color", 'modeltheme-addons-for-wpbakery'),
      'description' =>"",
      "param_name" => "border_color"
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Text Color", 'modeltheme-addons-for-wpbakery'),
      'description' =>"",
      "param_name" => "text_color"
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Text Color - Hover", 'modeltheme-addons-for-wpbakery'),
      'description' =>"",
      "param_name" => "text_color_hover"
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Background Color", 'modeltheme-addons-for-wpbakery'),
      'description' =>"",
      "param_name" => "color"
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Background Active Tab", 'modeltheme-addons-for-wpbakery'),
      'description' =>"",
      "param_name" => "active_tab_bg"
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
      "name" => esc_attr__("MT: Products List", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-products-list",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/product-list.svg', __FILE__ ),
      "params" => $params,
  ));
}