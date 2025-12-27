<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_product_category($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                    => '',
      'featured_image_size'       => '',
      'image_shape'               => '',
      'list_image'                => '',
      'collectors_groups'       => '',
      'member_name'               => '',
      'member_position'           => '',
      'member_description'        => '', 
      'title_color'               => '',
      'position_color'            => '',
      'description_color'         => '',
      'description_size'          => '',
      'quote_testimonial'         => '',
      'quote_color'               => '',
      'quote_size'                => '',
      'quote_image'               => '',
      // carousel
      'autoplay'              => '', 
      'delay'                 => '',
      'items_desktop'         => '4',
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
      'navigation'                 => 'true',
      'pagination'                 => '',
      'image_status'              => '',
      'bg_color'                  => '',
      'btn_style'                 => '',
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
    $bg_color_style = '';
    if ($bg_color) {
      $bg_color_style = 'background:'.$bg_color.';';
    }

    wp_enqueue_style( 'product-category', plugins_url( '../../css/product-category.css' , __FILE__ ));
    
  
    if ($page_builder == 'elementor') {
      // $member_groups = modeltheme_addons_for_wpbakery_param_group_img_parse_atts($member_groups);
      $collectors_groups = unserialize(base64_decode($collectors_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $collectors_groups = vc_param_group_parse_atts($params['collectors_groups']);
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

    if ($layout == "carousel" or $layout == ""){
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
        class="mt-addons-collectors-carusel <?php echo esc_attr($carousel_holder_class); ?> <?php echo esc_attr($style_var_value); ?>">

          <?php //swiper wrapped start ?>
          <?php echo wp_kses_post($swiper_wrapped_start); ?>
 
            <?php if ($collectors_groups) { ?>
              <?php foreach ($collectors_groups as $collector) {
                if (!array_key_exists('category', $collector)) {
                  $category = 'Uncategorized';
                }else{
                  $category = $collector['category'];
                }
                if (!array_key_exists('bg_color', $collector)) {
                    $bg_color = '';
                  }else{
                    $bg_color = $collector['bg_color'];
                  }
                $cat   = get_term_by('slug', $category, 'product_cat');
                if($cat) {
                $cat_link  = get_term_link( $category, 'product_cat' );
                $cat_img_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );  
                $args_prods = array(
                    'posts_per_page'   => 1,
                    'order'            => 'ASC',
                    'post_type'        => 'product',
                    'tax_query' => array(
                      array(
                          'taxonomy' => 'product_cat',
                          'field' => 'slug',
                          'terms' => $category
                      )),
                    'post_status'      => 'publish' 
                ); 

                $prods = get_posts($args_prods); 
                $image_size = 'enefti_collections149x100';
                if ($featured_image_size) {
                  $image_size = $featured_image_size;
                }
                ?>

                <div class="<?php echo esc_attr($carousel_item_class); ?>">
                  <?php if ($image_status) { ?>

                  <div class="mt-addons-product-category-wrapper">
                    <?php 
                      $category_src = wp_get_attachment_image_src( $cat_img_id, $image_size );

                      if ($category_src) {
                          $post_img = '<img class="mt_addons_post_image" src="'. esc_url($category_src[0]) . '" alt="mt_addons_post_image" />';
                      }else{
                          $post_img = '<img class="mt_addons_post_image" src="http://via.placeholder.com/144x100" alt="'.$cat->post_title.'" />';
                      } ?>  
                      <a class="mt-addons-product-category" title="<?php echo esc_attr($cat->post_title);?>" href="<?php echo esc_url($cat_link);?>"><?php echo $post_img; ?></a>
                    <?php ?>
                  </div>
                  <?php } ?>
                  <div class="mt-addons-product-category-info-wrapper <?php echo esc_attr($btn_style);?>" <?php if($bg_color){?>style="background:<?php echo esc_attr($bg_color); ?>;" <?php } ?>>
                    <a class="#categoryid_<?php echo esc_attr($cat->term_id);?>" href="<?php echo esc_url($cat_link);?>"><span class="mt-addons-product-category-title"><?php echo esc_attr($cat->name);?></span></a>
                  </div> 
                </div>
              <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>
        <?php //pagination/navigation ?>
        <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
      </div>
      <?php //swiper container end ?>
      <?php echo wp_kses_post($swiper_container_end); ?>

    <?php if (function_exists('vc_map')) { ?>
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
    <?php } ?>
  </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-product-category', 'modeltheme_addons_for_wpbakery_product_category');

add_action('init','mt_addons_product_category');
function mt_addons_product_category(){

  if (function_exists('vc_map')) {
    $product_category = array();
    if ( class_exists( 'WooCommerce' ) ) {
      $product_category_tax = get_terms( 'product_cat', array(
        'parent'      => 0,
        'hide_empty'      => 1,
      ));
      if ($product_category_tax) {
        foreach ( $product_category_tax as $term ) {
          if ($term) {
             $product_category[$term->name.' ('.$term->count.')'] = $term->slug;
          }
        }
      }
    }
  
  $params = array(
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Featured Image size", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "featured_image_size",
      "std" => 'full',
      "value" => modeltheme_addons_image_sizes_array()
    ),
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => esc_attr__("Enable/Disable Category Image", "modeltheme-addons-for-wpbakery"),
      "param_name" => "image_status",
    ),
    array(
      "group" => "Options",
      "type" => "dropdown",
      "heading" => esc_attr__("Shape", "modeltheme-addons-for-wpbakery"),
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
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'collectors_groups',
      // Note params is mapped inside param-group:
      'params' => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Category", "modeltheme-addons-for-wpbakery"),
            "param_name" => "category",
            "description" => esc_attr__("Select Category", "modeltheme-addons-for-wpbakery"),
            "std" => 'Select',
            "value" => $product_category
          ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Background color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "bg_color"
          )
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
      "name" => esc_attr__("MT: Product Categories", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-product-category",
      "category" => esc_attr__('MT Addons', "modeltheme-addons-for-wpbakery"),
      "icon" => plugins_url( 'images/product-grid.svg', __FILE__ ),
      "params" => $params,
  ));
}}