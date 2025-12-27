<?php	



/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://modeltheme.com/
 * @since             1.0.0
 * @package           Modeltheme_Addons_For_Wpbakery
 *
 * @wordpress-plugin
 * Plugin Name:       ModelTheme Addons for WPBakery and Elementor
 * Plugin URI:        https://plugins.modeltheme.com/modeltheme-addons/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.5.3
 * Author:            ModelTheme
 * Author URI:        https://modeltheme.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       modeltheme-addons-for-wpbakery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MODELTHEME_ADDONS_FOR_WPBAKERY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-modeltheme-addons-for-wpbakery-activator.php
 */
function activate_modeltheme_addons_for_wpbakery() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-modeltheme-addons-for-wpbakery-activator.php';
  Modeltheme_Addons_For_Wpbakery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-modeltheme-addons-for-wpbakery-deactivator.php
 */
function deactivate_modeltheme_addons_for_wpbakery() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-modeltheme-addons-for-wpbakery-deactivator.php';
  Modeltheme_Addons_For_Wpbakery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_modeltheme_addons_for_wpbakery' );
register_deactivation_hook( __FILE__, 'deactivate_modeltheme_addons_for_wpbakery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-modeltheme-addons-for-wpbakery.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_modeltheme_addons_for_wpbakery() {

  $plugin = new Modeltheme_Addons_For_Wpbakery();
  $plugin->run();

}
run_modeltheme_addons_for_wpbakery();

/**
 * WP Bakery product categories
 */
function modeltheme_addons_for_wpbakery_get_categories($product_category) {
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
    return $product_category;
}
add_action('modeltheme_addons_for_wpbakery_get_categories', 'modeltheme_addons_for_wpbakery_get_categories', 10);
add_action('init','modeltheme_addons_for_wpbakery_get_categories');

// number parameter
include_once('includes/params/class-vc-number-param.php');
include_once('includes/params/class-vc-multi-select-param.php');
include_once('includes/params/class-vc-radio-param.php');
// include_once('includes/params/class-vc-border-param.php');
include_once('includes/helpers.php');
include_once('includes/helpers.elementor.php');
include_once('includes/ContentControlSlider.php');
include_once('includes/helpers.swiper.php');
include_once('includes/helpers.icons.php');
include_once('includes/ContentControlElementorIcon.php');
include_once('includes/helpers.progressbar.php');

// shortcodes
//A
include_once('public/shortcodes/absolute-element/absolute-element.php');
include_once('public/shortcodes/accordion/accordion.php');
// B
include_once('public/shortcodes/before-after-comparison/before-after-comparison.php');
include_once('public/shortcodes/button/button.php');
include_once('public/shortcodes/blog-posts/blog-posts.php');
include_once('public/shortcodes/buddypress-groups/buddypress-groups.php');
// C
include_once('public/shortcodes/category-tabs/category-tabs.php');
include_once('public/shortcodes/clients-carousel/clients-carousel.php');
include_once('public/shortcodes/countdown/countdown.php');
include_once('public/shortcodes/contact-form/contact-form.php');
include_once('public/shortcodes/circle-text/circle-text.php');
// F
include_once('public/shortcodes/featured-product/featured-product.php');
// H
include_once('public/shortcodes/highlighted-text/highlighted-text.php');
include_once('public/shortcodes/hero-slider/hero-slider.php');
// I
include_once('public/shortcodes/icon-list-group-item/icon-list-group-item.php');
// M
include_once('public/shortcodes/marquee-texts-hero/marquee-texts-hero.php');
include_once('public/shortcodes/masonry-banners/masonry-banners.php');
include_once('public/shortcodes/members/members.php');
include_once('public/shortcodes/map-pins/map-pins.php');
// P
include_once('public/shortcodes/parallax-image/parallax-image.php');
include_once('public/shortcodes/pricing-table/pricing-table.php');
include_once('public/shortcodes/posts-a-z/posts-a-z.php');
include_once('public/shortcodes/product-category/product-category.php');
include_once('public/shortcodes/products-category-list/products-category-list.php');
include_once('public/shortcodes/progress-bar/progress-bar.php');
include_once('public/shortcodes/products-category-group/products-category-group.php');
include_once('public/shortcodes/products-list/products-list.php');
include_once('public/shortcodes/products-carousel/products-carousel.php');
include_once('public/shortcodes/products-category-banner/products-category-banner.php');
include_once('public/shortcodes/products-filters/products-filters.php');
include_once('public/shortcodes/process/process.php');
// R
include_once('public/shortcodes/row-overlay/row-overlay.php');
include_once('public/shortcodes/row-separator/row-separator.php');
// S
include_once('public/shortcodes/skill-counter/skill-counter.php');
include_once('public/shortcodes/social-icon-box/social-icon-box.php');
include_once('public/shortcodes/svg-blob/svg-blob.php');
include_once('public/shortcodes/search-bar/search-bar.php');
include_once('public/shortcodes/stylized-numbers/stylized-numbers.php');
include_once('public/shortcodes/spacer/spacer.php');
include_once('public/shortcodes/stacking-cards/stacking-cards.php');
// T
include_once('public/shortcodes/typed-text/typed-text.php');
include_once('public/shortcodes/title-subtitle/title-subtitle.php');
include_once('public/shortcodes/testimonials/testimonials.php');
include_once('public/shortcodes/tabs/tabs.php');
include_once('public/shortcodes/timeline/timeline.php');
// V
include_once('public/shortcodes/video/video.php');
//Elementor Widgets
if ( class_exists('Elementor\Core\Admin\Admin') ) {
    require_once('public/shortcodes/elementor/functions-elementor.php');
}

function mt_addons_get_auction_price_status_for_grids($product_id, $buy_bid_btn_status = ''){
  $product = wc_get_product( $product_id );

  // metas
  // if ( class_exists( 'WooCommerce_simple_auction' ) || class_exists('Ultimate_WooCommerce_Auction_Free') || class_exists('Ultimate_WooCommerce_Auction_Pro')) {

  if ( class_exists( 'WooCommerce_simple_auction' )){
      $meta_auction_current_bid = get_post_meta( $product_id, '_auction_current_bid', true );
      $meta_auction_start_price = get_post_meta( $product_id, '_auction_start_price', true );
      $meta_auction_closed = get_post_meta( $product_id, '_auction_closed', true );
      $meta_auction_end_date = get_post_meta( $product_id, '_auction_dates_to', true );
  }elseif(class_exists('Ultimate_WooCommerce_Auction_Free') || class_exists('Ultimate_WooCommerce_Auction_Pro')){
      $meta_auction_current_bid = get_post_meta( $product_id, 'woo_ua_auction_current_bid', true );
      $meta_auction_start_price = get_post_meta( $product_id, 'woo_ua_opening_price', true );
      $meta_auction_closed = get_post_meta( $product_id, 'woo_ua_auction_closed', true );
      $meta_auction_end_date = get_post_meta( $product_id, 'woo_ua_auction_end_date', true );
      #sealed
      $meta_uwa_auction_silent = get_post_meta( $product_id, 'uwa_auction_silent', true );
  }
  // var_dump($buy_bid_btn_status);

  if( $product->is_type('auction') ){
      if ($meta_auction_closed == '') {
          if ($meta_auction_current_bid || $meta_auction_start_price) {
              if ( class_exists( 'WooCommerce_simple_auction' )){
                  if($product->get_auction_sealed() == 'yes'){ 
                      echo '<p>'.esc_html__('Sealed bid auction ','modeltheme').'</p>';
                  }else {
                      if ($meta_auction_current_bid) {
                          echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                      }elseif($meta_auction_start_price){
                          echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                      }
                  }
              }elseif(class_exists('Ultimate_WooCommerce_Auction_Pro')){
                  if($meta_uwa_auction_silent == 'yes'){ 
                      echo '<p>'.esc_html__('Sealed bid auction ','modeltheme').'</p>';
                  }else {
                      if ($meta_auction_current_bid) {
                          echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                      }elseif($meta_auction_start_price){
                          echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                      }
                  }
              }elseif(class_exists('Ultimate_WooCommerce_Auction_Free')){
                  if ($meta_auction_current_bid) {
                      echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                  }elseif($meta_auction_start_price){
                      echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                  }
              }
              echo '<p>'.esc_html__('Expires on: ','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime($meta_auction_end_date)).'</span></p>';

              
              if ($buy_bid_btn_status == 'button_on') {
                  echo '<div class="button-bid text-center">
                          <a href="'.esc_url(get_permalink($product_id)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                      </div>';
              }
          }
      }else {
          echo '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
      }
  }else{
      echo '<p>'.$product->get_price_html().'</p>';
              

      if ($buy_bid_btn_status == 'button_on') {
          echo '<div class="mt-addons-products button-other-type text-center"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></div>'; 
      }
  }
}
add_action('modeltheme_addons_for_wpbakery_mt_addons_products_carousel', 'mt_addons_get_auction_price_status_for_grids', 10, 2);

/* ========= RESIZE IMAGES ===================================== */
add_image_size( 'mt_addons_70x70',          70, 70, true );
add_image_size( 'mt_addons_100x100',        100, 100, true );
add_image_size( 'mt_addons_400x400',        400, 400, true );


/* ========= LIMIT POST CONTENT ===================================== */
function modeltheme_addons_excerpt_limit($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit) {
        array_pop($words);
    }
    return implode(' ', $words);
}