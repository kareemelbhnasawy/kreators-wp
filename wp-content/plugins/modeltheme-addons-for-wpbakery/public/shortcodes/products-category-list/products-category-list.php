<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_collectors_list($params, $content) {
    extract( shortcode_atts( 
        array(
            'number'                               => '8',
            'number_of_columns'                    => 'col-md-4',
            'order'                                => 'alpha',
            'title_color'                          => '',
            'subtitle_color'                       => '',
            'color_number'                         => '',
        ), $params ) );

    wp_enqueue_style( 'products-category-list', plugins_url( '../../css/collectors-list.css' , __FILE__ ));

    if($order == 'alpha' or $order == '') {
      $args = array(
          'number'     => $number,
          'orderby'    => 'title',
          'order'      => 'ASC'
      );
    } else if($order == 'recent') {
      $args = array(
          'number'     => $number,
          'orderby'    => 'id',
          'order'      => 'DESC'
      );
    } else if($order == 'oldest') {
      $args = array(
          'number'     => $number,
          'orderby'    => 'id',
          'order'      => 'ASC'
      );
    }

    $product_categories = get_terms( 'product_cat', $args );

    ob_start();
    $count_number = 01; ?>
    
    <div class="mt-categories-wrapper row">
    <?php foreach( $product_categories as $category ) { 
      $img_id = get_term_meta( $category->term_id, 'thumbnail_id', true );  
      $thumbnail_src = wp_get_attachment_image_src( $img_id, 'mt_addons_70x70' ); 
      global $post;
      $collectionData = get_post_meta(get_the_id($post), '_mtnft_collection', true); ?>

       <div class="mt-single-category <?php echo $number_of_columns;?>">
        <div class="mt-single-category-wrap">
          
            <a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>">
              <?php if($thumbnail_src) { ?>
                <img class="cat-image" alt="cat-image" src="<?php echo $thumbnail_src[0];?>">
              <?php } else { ?>
                <img class="cat-image" alt="cat-image" src="http://via.placeholder.com/70x70">
              <?php } ?>
            </a>
            <div class="mt-single-category-info">
              <a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>"style="color:<?php echo esc_attr($title_color);?>"><?php echo esc_attr($category->name);?></a>
              <span style="color:<?php echo esc_attr($subtitle_color);?>"><?php echo esc_attr($category->count);?> <?php  echo esc_html__('items','modeltheme-addons-for-wpbakery'); ?></span> 
            </div>
            <span class="mt-count-number" style="color:<?php echo esc_attr($color_number);?>"><?php echo $count_number;?></span>
          </div>
        </div> 

   <?php $count_number++; } ?>
   </div>     
   <?php return ob_get_clean();
}
add_shortcode('mt-addons-collectors-list', 'modeltheme_addons_for_wpbakery_collectors_list');

add_action('init','mt_addons_collectors_list');
function mt_addons_collectors_list(){
//VC Map
  if (function_exists('vc_map')) {
    vc_map(
      array(
        "name" => esc_attr__("MT: Products Category List", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt-addons-collectors-list",
        "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
        "icon" => plugins_url( 'images/product-list.svg', __FILE__ ),
        "params" => array(
          array(
            "type" => "vc_number",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Number", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "number"
          ),
          array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Columns", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "number_of_columns",
            "default" => 'col-md-4',
            "value" => array(
              'Select'    => '',
              'One'        => 'col-md-12',
              'Two'        => 'col-md-6',
              'Three'      => 'col-md-4',
              'Four'       => 'col-md-3'
            ),
          ),
          array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Order", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "order",
            "std" => '2',
            "value" => array(
              'Select'   => '',
              'Recent'        => 'recent',
              'Oldest'        => 'oldest',
              'Alphabetical'  => 'alpha'
            ),
          ),
          array(
            "group" => "Style",
            "type" => "colorpicker",
            "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "title_color",
            "std" => '',
            "holder" => "div",
            "class" => ""
          ),
          array(
            "group" => "Style",
            "type" => "colorpicker",
            "heading" => esc_attr__("Subtitle Color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "subtitle_color",
            "std" => '',
            "holder" => "div",
            "class" => ""
          ), 
          array(
            "group" => "Style",
            "type" => "colorpicker",
            "heading" => esc_attr__("Number Color", 'modeltheme-addons-for-wpbakery'),
            "param_name" => "color_number",
            "std" => '',
            "holder" => "div",
            "class" => ""
          ), 
        )
    ));
  }
}