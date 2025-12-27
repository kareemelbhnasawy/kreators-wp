<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_featured_product($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                    =>'',
      'select_product'                  =>'',
      'subtitle_product'                =>'',
      'category_text_color'             =>'',
      'product_name_text_color'         =>'',
      'background_color'                =>'',
      'price_text_color'                =>'',
      'button_background_color1'        =>'',
      'button_background_color2'        =>'',
      'button_text_color'               =>'',
      'button_text'                     =>'',
    ), $params ) );
   
    wp_enqueue_style( 'featured-product-css', plugins_url( '../../css/featured-product.css' , __FILE__ ));

    ob_start(); ?>

    <?php 
      global $woocommerce;
      $product = wc_get_product($select_product);
      $content_post = get_post($product->get_id());
      $content = $content_post->post_content;
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
    ?>
    <div class="mt-addons-featured-product col-md-12"style="animation-name: fadeIn;background-image: -webkit-linear-gradient(134.3deg, <?php echo $background_color; ?> 35%, #ffffff 27%);min-height: 400px;">
      <div class="mt-addons-featured-product-details-holder col-md-6">
        <h3 class="mt-addons-featured-product-categories" style="color:<?php echo $category_text_color; ?>"><?php echo $subtitle_product;?> 
        </h3>
        <h2 class="mt-addons-featured-product-name">
          <a href="<?php echo get_permalink($product->get_id())?>"style="color: <?php echo $product_name_text_color; ?>"><?php echo get_the_title($select_product); ?>
          </a>
        </h2>
        <h4 class="mt-addons-featured-product-price" style="color:<?php echo $price_text_color; ?>">
          <?php echo $product->get_price_html(); ?>
        </h4>
        <div class="mt-addons-featured-product-description">
          <?php echo $content; ?>
        </div>
        <a class="mt-addons-featured-product-button" href="<?php echo get_permalink($product->get_id())?>" style="color:<?php echo $button_text_color; ?>; background:<?php echo $button_background_color1; ?>"><?php echo esc_html__($button_text); ?>
        </a>
      </div>
      <div class="mt-addons-image-holder col-md-6">
        <?php if ( has_post_thumbnail( $select_product ) ) {
          $attachment_ids[0] = get_post_thumbnail_id( $select_product );
          $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' ); ?> 
          <img class="mt-addons-ifeatured-product-image" src="<?php echo $attachment[0]; ?>" alt="<?php echo get_the_title($select_product);?>" />
        <?php } ?>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-featured-product', 'modeltheme_addons_for_wpbakery_featured_product');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Featured Product", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-featured-product",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
       "icon" => plugins_url( 'images/featured-product.svg', __FILE__ ),
      "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Product ID", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "select_product",
          "value" => "",
          "description" => esc_attr__( "Enter product ID", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Subtitle Product", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "subtitle_product",
          "value" => "",
          "description" => esc_attr__( "Enter Subtitle Product", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Featured product background color", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "background_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the background color", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product category color", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "category_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for categories", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product name color", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "product_name_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for product name", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product price color", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "price_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for price", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button text", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "button_text",
          "value" => "",
          "description" => esc_attr__( "Enter button text", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 1", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "button_background_color1",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -1 for the button", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 2", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "button_background_color2",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -2 for the button", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button text color ", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "button_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the text color for the button", 'modeltheme-addons-for-wpbakery' )
        ),
      )
  ));
}