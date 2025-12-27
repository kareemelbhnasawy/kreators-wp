<?php
function iffiliate_shop_categories_with_banners_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'title'                                => '',
            'category'                             => '',
            'banner_image'                         => '',
            'banner_url'                           => '',
            'banner_pos'                           => '',
            'banner_text'                          => '',
            'hide_empty'                           => ''
        ), $params ) );

    $cat = get_term_by( 'slug', $category, 'product_cat' );

    if ($cat) {
        $prod_categories = get_terms( 'product_cat', array(
            'number'        => $number,
            'child_of'      => $cat->term_id,
            'hide_empty'    => $hide_empty,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category
                )
            )
        ));
    }else{
        $prod_categories = get_terms( 'product_cat', array(
            'number'        => $number,
            'hide_empty'    => $hide_empty,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category
                )
            )
        )); 
    }
    $banner_image = wp_get_attachment_image_src($banner_image, '');
    $class = 'banners_'.uniqid();
    $shortcode_content = '';
 
    //Begin: Main div holder
    $shortcode_content .= '<div id="'.$class.'" class="woocommerce_categories banners '.$class.'">';

      // Section Header
      $shortcode_content .= '<div class="header_banners col-md-12">';
        $shortcode_content .= '<h2 class="col-md-7">'.$title.'</h2>';
        $shortcode_content .= '<div class="col-md-5 categories-list categories_shortcode categories_shortcode_'.$number_of_columns.' ">';
        if ($prod_categories) {
          foreach( $prod_categories as $prod_cat ) {
            if ( class_exists( 'WooCommerce' ) ) {
              $cat_thumb_id   = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            } else {
              $cat_thumb_id = '';
            }
            $cat_thumb_url  = wp_get_attachment_image_src( $cat_thumb_id, 'pic100x75' );
            $term_link      = get_term_link( $prod_cat, 'product_cat' );

            $shortcode_content .= '<div class="category item ">';
              $shortcode_content .= '<a class="#categoryid_'.$prod_cat->term_id.'">';
                $shortcode_content .= '<span class="cat-name">'.$prod_cat->name.'</span>';                    
              $shortcode_content .= '</a>';    
            $shortcode_content .= '</div>';
          }
        }
        $shortcode_content .= '</div>';
      $shortcode_content .= '</div>';

      // Section Body
      $shortcode_content .= '<div class="products_category">';
        if ($prod_categories) {
          foreach( $prod_categories as $prod_cat ) {

            wp_reset_postdata();
            $args_prods = array(
              'posts_per_page'   => $number_of_products_by_category,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'tax_query' => array(
                array(
                  'taxonomy' => 'product_cat',
                  'field' => 'slug',
                  'terms' => $prod_cat
                )
              ),
              'post_status'      => 'publish' 
            ); 
            // $prods = get_posts($args_prods);
            $prods = new WP_Query( $args_prods );
            $count = 0;

            $shortcode_content .= '<div id="categoryid_'.$prod_cat->term_id.'" class=" products_by_category '.$prod_cat->name.'">';
              if ( $prods->have_posts() ) {
                while ( $prods->have_posts() ) {
                  $prods->the_post(); 
                  // foreach ($prods as $prod) {
                  #thumbnail
                  $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'iffiliate_product_simple_285x38' );                        

                  if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_the_title().'" />';
                    $post_col = 'col-md-12';
                  }else{
                    $post_col = 'col-md-12 no-featured-image';
                    $post_img = '';
                  }

                  if($count == 2 && $banner_pos == 2) {
                    $shortcode_content.='<div class="product-banner">';
                    $shortcode_content .= '<a class="col-md-2" href="'.$banner_url.'" target="_blank">
                                            <img src="'.esc_attr($banner_image[0]).'" alt="banner">
                                            <p>'.$banner_text.'</p>
                                          </a>';
                    $shortcode_content .= '</div>';
                  }elseif($count == 3 && $banner_pos == 3) {
                    $shortcode_content.='<div class="product-banner">';
                    $shortcode_content .= '<a class="col-md-2" href="'.$banner_url.'" target="_blank">
                                            <img src="'.esc_url($banner_image[0]).'" alt="banner">
                                            <p>'.$banner_text.'</p>
                                          </a>';
                    $shortcode_content .= '</div>';
                  }elseif($count == 4 && $banner_pos == 4) {
                    $shortcode_content.='<div class="product-banner">';
                    $shortcode_content .= '<a class="col-md-2" href="'.$banner_url.'" target="_blank">
                                            <img src="'.esc_url($banner_image[0]).'" alt="banner">
                                            <p>'.$banner_text.'</p>
                                          </a>
                                          ';
                    $shortcode_content .= '</div>';
                  }elseif($count == 1 && $banner_pos == 1) {
                    $shortcode_content.='<div class="product-banner">';
                    $shortcode_content .= '<a class="col-md-2" href="'.$banner_url.'" target="_blank">
                                            <img src="'.esc_url($banner_image[0]).'" alt="banner">
                                            <p>'.$banner_text.'</p>
                                          </a>';
                    $shortcode_content .= '</div>';
                  }

                  $shortcode_content .= '<div class="prods product-id-'.esc_attr(get_the_ID()).'">
                                          <div class="prods_'.$number_of_products_by_category.' modeltheme-product ">
                                              <div class="modeltheme-product-wrapper">
                                                  
                                                  <div class="modeltheme-thumbnail-and-details">
                                                      <a class="modeltheme_media_image" title="'.esc_attr(get_the_title()).'" href="'.esc_url(get_permalink(get_the_ID())).'"> '.$post_img.'</a>
                                                  </div>

                                                  <div class="modeltheme-title-metas">

                                                    <div class="woocommerce_product__category">
                                                      <span class="posted_in">';
                                                        $cat_name = get_the_term_list(get_the_ID(), 'product_cat', '', ' | ');          
                                                        $shortcode_content .= ''.wp_kses_post($cat_name).'</span>
                                                    </div>

                                                    <h3 class="modeltheme-archive-product-title">
                                                        <a href="'.esc_url(get_permalink(get_the_ID())).'" title="'. esc_attr(get_the_title()) .'">'. get_the_title() .'</a>
                                                    </h3>';
                                                      
                                                    global $product;
                                                    $product = wc_get_product( get_the_ID() );

                                                    $shortcode_content .= '<p>'.$product->get_price_html().'</p>';
                                                    $shortcode_content .= ' <a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a>';

                                                    if (  class_exists( 'YITH_WOOCOMPARE' ) ) {
                                                      $shortcode_content .= '<a href="'.esc_url(get_permalink()).'?action=yith-woocompare-add-product&amp;id='.esc_attr(get_the_ID()).'" class="compare button" data-product_id="'.esc_attr(get_the_ID()).'" rel="nofollow">'.esc_html__('Compare', 'modeltheme').'</a>';

                                                    }
                            $shortcode_content .= '</div>
                                              </div>
                                          </div>                     
                                      </div>';
                  $count++;
                }
              }else{
                $shortcode_content .= '<div class="clearfix"></div>';
                $shortcode_content .= '<div class="alert alert-info">'.__('<strong>This category doesn\'t exist or it has no products!</strong> Edit the page and set an existing category from the builder.', 'modeltheme').'</div>';
              }
            $shortcode_content .= '</div>';
          }
        }
      $shortcode_content .= '</div>';

    //End: Main div holder
    $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-categories-with-banners', 'iffiliate_shop_categories_with_banners_shortcode');
