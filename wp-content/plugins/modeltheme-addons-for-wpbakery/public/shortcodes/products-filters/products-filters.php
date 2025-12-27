<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_product_filters($params, $content) {
  extract( shortcode_atts( 
    array(
      'number'              =>'',
      'searchfilter'        =>'',
      'categoriesfilter'    =>'',
      'tagsfilter'          =>'',
      'search_placeholder'  =>'',
      'attribute'           =>'',
      'page_builder'        =>''
    ), $params ) );

    $args_blogposts = array(
      'posts_per_page'   => $number,
      'order'            => 'DESC',
      'post_type'        => 'product',
      'post_status'      => 'publish' 
    ); 
    $blogposts = get_posts($args_blogposts);
   
    $prod_categories = get_terms( 'product_cat', array(
      'number'        => 10,
      'hide_empty'    => true,
      'parent' => 0
    ));

    $product_categories = get_terms( 'product_cat', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
    $product_tags = get_terms( 'product_tag', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
   
    wp_enqueue_style( 'product-filters', plugins_url( '../../css/product-filters.css' , __FILE__ ));
    wp_enqueue_script( 'filters-main-js', plugins_url( '../../js/filters-main.js' , __FILE__));
    wp_enqueue_script( 'filters-mixitup-js', plugins_url( '../../js/filters-mixitup.min.js' , __FILE__));

    ob_start(); ?>
    <div class="mt-addons-product-filters">
      <div class="row">
        <main class="mt-addons-product-filters-content">
          <div class="mt-addons-product-filters-header">
            <div class="mt-addons-filter filter-is-visible">
              <ul class="mt-addons-filters">
                <li class="placeholder"><a data-type="all"><?php echo esc_html__('All','modeltheme-addons-for-wpbakery');?></a></li>
                <li class="filter"><a class="selected" data-type="all"><?php echo esc_html__('All ','modeltheme-addons-for-wpbakery');?></a></li>     
                  <?php foreach( $prod_categories as $prod_cat ) { ?>
                    <li class="filter" data-filter=".<?php echo esc_attr($prod_cat->slug);?>">
                      <a href="#0" data-type="<?php echo esc_attr($prod_cat->slug); ?>"><?php echo esc_attr($prod_cat->name);?><span></span></a>
                    </li>
                  <?php } ?>
              </ul>
            </div>
          </div>

          <section class="mt-addons-content-wrapper filter-is-visible">
            <ul>
              <?php 
              // ALL WOOCOMMERCE AVAILABLE ATTRIBUTES
              $all_available_attributes = array();
              $taxonomy_terms = array();
              $attribute_taxonomies = wc_get_attribute_taxonomies();
              if ( $attribute_taxonomies ){
                foreach ( $attribute_taxonomies as $tax ){
                  array_push($all_available_attributes, $tax->attribute_name);
                }
              }

              $attributes_to_list = array();
              if ($attribute) {
                $attributes_to_list = explode(",", $attribute);
              }

              foreach ($blogposts as $blogpost) { 

                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'mt_addons_400x400' );

                $categories_list = wp_get_post_terms($blogpost->ID, 'product_cat');
                $cat_slugs = implode(' ',wp_list_pluck($categories_list,'slug'));
                
                $tags_list = wp_get_post_terms($blogpost->ID, 'product_tag');
                $tags_slugs = implode(' ',wp_list_pluck($tags_list,'slug'));

                if ($thumbnail_src) {
                  $post_img = '<img class="mt_addons_filters_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                  $post_col = 'col-md-12';
                }else{
                  $post_col = 'col-md-12 no-featured-image';
                  $post_img = '';
                }

                global $product;
                $product = wc_get_product( $blogpost->ID );
                $attributes_final = '';
                $all_product_attr = get_post_meta($blogpost->ID, '_product_attributes', true);
                if ($all_product_attr) {
                  foreach ($all_product_attr as $attr) {
                    $attributes = wc_get_product_terms( $blogpost->ID, $attr['name'], array( 'fields' => 'all' ) );
                    if ($attributes) {
                      foreach ($attributes as $single_attr_value) {
                        $attributes_final .=  $single_attr_value->slug.' ';
                      }
                    }
                  }
                } ?>

                <li id="product-id-<?php echo esc_attr($blogpost->ID);?>" class="mix <?php echo esc_attr($attributes_final); ?> <?php echo esc_attr($cat_slugs);?> <?php echo esc_attr($blogpost->post_title); ?> <?php echo esc_attr($tags_slugs);?>"> 
                  <div class="col-md-12 post">
                    <div class="mt-addons-product-wrapper">
                      <div class="mt-addons-thumbnail">
                        <a class="woo_catalog_media_images" title="<?php echo esc_attr($blogpost->post_title); ?>" href="<?php echo esc_url(get_permalink($blogpost->ID));?>"> <?php echo $post_img; ?></a>
                      </div>
                      <div class="mt-addons-title-metas">
                        <h3 class="mt-addons-product-title">
                          <a href="<?php echo esc_url(get_permalink($blogpost->ID));?>" title="<?php echo esc_attr($blogpost->post_title);?>"><?php echo esc_attr($blogpost->post_title);?></a>
                        </h3>
                        <?php if($product->get_price_html()) { ?>
                          <p>
                          <?php echo esc_attr__('Price','modeltheme-addons-for-wpbakery');?><?php echo $product->get_price_html();?></p>
                          <?php } ?>
                      </div>  
                    </div>
                  </div>                     
                </li>       
              <?php } ?>
              </ul>
              <div class="mt-addons-fail-message"><?php echo esc_attr__('No results found','modeltheme-addons-for-wpbakery');?></div>
            </section>

            <div class="mt-addons-sidebar filter-is-visible">
              <form>
                <?php
                // SIDEBAR: SEARCH FORM
                if($searchfilter == 'search_on') { ?>
                  <div class="mt-addons-filter-block">
                    <h4><?php echo esc_html__('Search','modeltheme-addons-for-wpbakery');?></h4>
                    <div class="mt-addons-filter-content">
                      <?php if($search_placeholder) { ?>
                        <input type="search" placeholder="<?php echo esc_attr($search_placeholder);?>...">
                      <?php } else { ?>
                        <input type="search" placeholder="<?php echo esc_attr__('Search...','modeltheme-addons-for-wpbakery');?>">
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
                <?php 
                // SIDEBAR: ATTRIBUTES
                if($attribute) { ?>
                  <div class="mt-addons-filter-block">
                    <?php $attributes_taxonomies = wc_get_attribute_taxonomies();
                    foreach ( $attributes_taxonomies as $tax ) {
                      if (in_array($tax->attribute_name, $attributes_to_list)) { ?>
                        <h4><?php echo $tax->attribute_label; ?></h4>
                        <ul class="mt-addons-filter-content mt-addons-filters list">
                        <?php $attributes_array = array();
                        $taxonomies_terms = array();
                        if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ){
                          $attributes_array[ $tax->attribute_name ] = $tax->attribute_name;                                    
                          $taxonomies_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name));
                        }

                        foreach ($attributes_array as $key ) {
                          foreach ($taxonomies_terms[$key] as $term) { ?>
                            <li>
                              <input class="filter" data-filter=".<?php echo esc_attr($term->slug);?>" type="checkbox" id="<?php echo esc_attr($term->slug); ?>">
                              <label class="checkbox-label" for="<?php echo esc_attr($term->slug); ?>"><?php echo esc_attr($term->name);?></label>
                            </li>
                          <?php }
                        }
                      } ?>
                      </ul>
                    <?php } ?>
                  </div>  
                <?php } ?>

                <?php
                // SIDEBAR: CATEGORIES
                if($categoriesfilter == 'categories_on') { ?>
                  <div class="mt-addons-filter-block">
                    <h4><?php echo esc_html__('Categories','modeltheme-addons-for-wpbakery');?></h4>
                    <ul class="mt-addons-filter-content mt-addons-filters list">               
                      <?php foreach($product_categories as $category){ ?>
                        <li>
                          <input class="filter" data-filter=".<?php echo esc_attr($category->slug);?>" type="checkbox" id="<?php echo esc_attr($category->slug);?>">
                          <label class="checkbox-label" for="<?php echo esc_attr($category->slug);?>"><?php echo esc_attr($category->name);?></label>
                        </li>                
                      <?php } ?>    
                    </ul>
                  </div>
                <?php }

                // SIDEBAR: TAGS
                if($tagsfilter == 'tags_on') { ?>
                  <div class="mt-addons-filter-block">
                    <h4><?php echo esc_html__('Most used Tags','modeltheme-addons-for-wpbakery');?></h4>
                    <ul class="mt-addons-filter-content mt-addons-filters list">             
                      <?php foreach($product_tags as $tag){ ?>
                        <li>
                          <input class="filter" data-filter=".<?php echo esc_attr($tag->slug);?>" type="checkbox" id="<?php echo esc_attr($tag->slug);?>">
                          <label class="checkbox-label" for="<?php echo esc_attr($tag->slug);?>"><?php echo esc_attr($tag->name);?></label>
                        </li>                 
                      <?php } ?>    
                    </ul> 
                  </div>  
                <?php } ?>

              </form>
              <a class="mt-addons-sidebar-close"><?php echo esc_html__('Close','modeltheme-addons-for-wpbakery');?></a>
            </div>

          <a class="mt-addons-sidebar-trigger filter-is-visible"><?php echo esc_html__('Filters','modeltheme-addons-for-wpbakery'); ?></a>
        </main>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-product-filters', 'modeltheme_addons_for_wpbakery_product_filters');

//VC Map
// Products Filter Main
$all_attributes = array();
if (function_exists('wc_get_attribute_taxonomies')) {
  $attribute_taxonomies = wc_get_attribute_taxonomies();
  if ( $attribute_taxonomies ) {
    foreach ( $attribute_taxonomies as $tax ) {
      $all_attributes[$tax->attribute_name ] = $tax->attribute_name;
    }
  }
}

$search_filter = array('Choose' => 'Null','Search Enabled ' => 'search_on', 'Search Disabled' => 'search_off');
$categories_filter = array('Choose' => 'Null','Categories Enabled ' => 'categories_on', 'Categories Disabled' => 'categories_off');
$tags_filter = array('Choose' => 'Null','Tags Enabled ' => 'tags_on', 'Tags Disabled' => 'tags_off');

if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Product Filters", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-product-filters",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => "modeltheme_shortcode",
      "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Number of products", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "number",
          "value" => ""
        ),
        array(
          "group" => "Filters",
          "type" => "checkbox",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Select Products Attributes", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "attribute",
          "description" => esc_attr__("The selected attributes will be used to filter the products from the left side", 'modeltheme-addons-for-wpbakery'),
          "std" => 'Default value',
          "value" => $all_attributes,
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Search placeholder", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "search_placeholder",
          "value" => "",
          "description" => esc_attr__( "Set the search placeholder.(e.g 'Search Products')", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Filters",
          "type" => "dropdown",
          "holder" => "div",
          "heading" => esc_attr__( "Enable or disable search on filter sidebar", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "searchfilter",
          "value" => $search_filter,
        ),
        array(
          "group" => "Filters",
          "type" => "dropdown",
          "holder" => "div",
          "heading" => esc_attr__( "Enable or disable categories on filter sidebar", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "categoriesfilter",
          "value" => $categories_filter,
        ),
        array(
          "group" => "Filters",
          "type" => "dropdown",
          "holder" => "div",
          "heading" => esc_attr__( "Enable or disable tags on filter sidebar", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "tagsfilter",
          "value" => $tags_filter,
        )
      )
  ));
}