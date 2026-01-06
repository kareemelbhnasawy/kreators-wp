<?php
/**
 * WooCommerce Compatibility File
 *
 * @package kreators
 */

/**
 * WooCommerce setup function.
 */
function kreators_woocommerce_setup() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'kreators_woocommerce_setup');

/**
 * Disable WooCommerce default styles.
 */
function kreators_woocommerce_dequeue_styles($enqueue_styles) {
    // Keep the general WooCommerce styles but disable smallscreen
    unset($enqueue_styles['woocommerce-smallscreen']);
    return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'kreators_woocommerce_dequeue_styles');

/**
 * Add custom WooCommerce styles.
 */
function kreators_woocommerce_scripts() {
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('kreators-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array('kreators-style'), KREATORS_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'kreators_woocommerce_scripts');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom wrapper before WooCommerce content.
 */
function kreators_woocommerce_wrapper_before() {
    ?>
    <main id="primary" class="kr-main kr-woo-main" role="main">
        <div class="kr-container">
            <div class="kr-content-wrapper">
                <div class="kr-content">
    <?php
}
add_action('woocommerce_before_main_content', 'kreators_woocommerce_wrapper_before');

/**
 * Add custom wrapper after WooCommerce content.
 */
function kreators_woocommerce_wrapper_after() {
    ?>
                </div>
                <?php if (is_active_sidebar('sidebar-shop')) : ?>
                    <aside class="kr-sidebar" role="complementary">
                        <?php dynamic_sidebar('sidebar-shop'); ?>
                    </aside>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php
}
add_action('woocommerce_after_main_content', 'kreators_woocommerce_wrapper_after');

/**
 * Modify WooCommerce products per row.
 */
function kreators_woocommerce_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'kreators_woocommerce_loop_columns');

/**
 * Modify related products display.
 */
function kreators_woocommerce_related_products_args($args) {
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'kreators_woocommerce_related_products_args');

/**
 * Add custom product card classes.
 */
function kreators_woocommerce_product_class($classes, $product) {
    $classes[] = 'kr-product-card';
    return $classes;
}
add_filter('woocommerce_post_class', 'kreators_woocommerce_product_class', 10, 2);

/**
 * Get cart item count.
 */
function kreators_get_cart_count() {
    if (!function_exists('WC') || !WC()->cart) {
        return 0;
    }
    return WC()->cart->get_cart_contents_count();
}

/**
 * Get cart total.
 */
function kreators_get_cart_total() {
    if (!function_exists('WC') || !WC()->cart) {
        return '';
    }
    return WC()->cart->get_cart_total();
}

/**
 * AJAX cart fragments.
 */
function kreators_woocommerce_header_cart_fragment($fragments) {
    ob_start();
    ?>
    <span class="kr-cart-count"><?php echo kreators_get_cart_count(); ?></span>
    <?php
    $fragments['span.kr-cart-count'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'kreators_woocommerce_header_cart_fragment');

/**
 * Modify add to cart button.
 */
function kreators_woocommerce_loop_add_to_cart_link($button, $product) {
    // Add custom classes to the button
    $button = str_replace('button', 'button kr-btn kr-btn-secondary', $button);
    return $button;
}
add_filter('woocommerce_loop_add_to_cart_link', 'kreators_woocommerce_loop_add_to_cart_link', 10, 2);

/**
 * Customize breadcrumb.
 */
function kreators_woocommerce_breadcrumb_defaults($defaults) {
    return array(
        'delimiter'   => '<span class="kr-breadcrumb-sep">/</span>',
        'wrap_before' => '<nav class="kr-breadcrumbs-nav woo-breadcrumbs" itemprop="breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '<span>',
        'after'       => '</span>',
        'home'        => _x('Home', 'breadcrumb', 'kreators'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'kreators_woocommerce_breadcrumb_defaults');

/**
 * Single product - Move price after title.
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 6);

/**
 * Custom sale flash.
 */
function kreators_woocommerce_sale_flash($html, $post, $product) {
    return '<span class="kr-badge kr-badge-sale">' . esc_html__('Sale', 'kreators') . '</span>';
}
add_filter('woocommerce_sale_flash', 'kreators_woocommerce_sale_flash', 10, 3);

/**
 * Add wishlist button placeholder.
 */
function kreators_product_wishlist_button() {
    global $product;
    
    // Check if YITH WooCommerce Wishlist is active
    if (shortcode_exists('yith_wcwl_add_to_wishlist')) {
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    } else {
        // Custom wishlist button (requires custom implementation)
        ?>
        <button type="button" class="kr-btn kr-btn-icon kr-product-wishlist" data-product-id="<?php echo esc_attr($product->get_id()); ?>" title="<?php esc_attr_e('Add to Wishlist', 'kreators'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        </button>
        <?php
    }
}
add_action('woocommerce_after_add_to_cart_button', 'kreators_product_wishlist_button');

/**
 * Products per page.
 */
function kreators_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'kreators_woocommerce_products_per_page');

/**
 * Wrap product thumbnails in custom container.
 */
function kreators_before_shop_loop_item() {
    echo '<div class="kr-product-image-wrapper">';
}
add_action('woocommerce_before_shop_loop_item_title', 'kreators_before_shop_loop_item', 5);

function kreators_after_product_thumbnail() {
    echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'kreators_after_product_thumbnail', 12);

/**
 * Add quick view button.
 */
function kreators_product_quick_view() {
    global $product;
    ?>
    <button type="button" class="kr-btn kr-btn-icon kr-product-quickview" data-product-id="<?php echo esc_attr($product->get_id()); ?>" title="<?php esc_attr_e('Quick View', 'kreators'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
    </button>
    <?php
}
add_action('woocommerce_before_shop_loop_item_title', 'kreators_product_quick_view', 11);

/**
 * Remove sidebar from specific pages.
 */
function kreators_woocommerce_remove_sidebar() {
    if (is_product() || is_cart() || is_checkout() || is_account_page()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
add_action('wp', 'kreators_woocommerce_remove_sidebar');

/**
 * Modify checkout fields.
 */
function kreators_woocommerce_checkout_fields($fields) {
    // Add placeholder text to fields
    $fields['billing']['billing_first_name']['placeholder'] = __('First Name', 'kreators');
    $fields['billing']['billing_last_name']['placeholder'] = __('Last Name', 'kreators');
    $fields['billing']['billing_email']['placeholder'] = __('Email Address', 'kreators');
    $fields['billing']['billing_phone']['placeholder'] = __('Phone Number', 'kreators');

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'kreators_woocommerce_checkout_fields');

/**
 * Custom checkout button text.
 */
function kreators_woocommerce_order_button_text() {
    return __('Complete Order', 'kreators');
}
add_filter('woocommerce_order_button_text', 'kreators_woocommerce_order_button_text');

/**
 * Empty cart message.
 */
function kreators_woocommerce_empty_cart_message() {
    ?>
    <div class="kr-empty-cart">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <h2><?php esc_html_e('Your cart is empty', 'kreators'); ?></h2>
        <p><?php esc_html_e("Looks like you haven't added anything to your cart yet.", 'kreators'); ?></p>
        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="kr-btn kr-btn-primary">
            <?php esc_html_e('Start Shopping', 'kreators'); ?>
        </a>
    </div>
    <?php
}
add_action('woocommerce_cart_is_empty', 'kreators_woocommerce_empty_cart_message', 10);

/**
 * Custom rating HTML.
 */
function kreators_woocommerce_rating_html($html, $rating, $count) {
    if ($rating > 0) {
        $label = sprintf(__('Rated %s out of 5', 'kreators'), $rating);
        $html  = '<div class="kr-star-rating" role="img" aria-label="' . esc_attr($label) . '">';
        $html .= '<span class="kr-stars-filled" style="width: ' . (($rating / 5) * 100) . '%"></span>';
        $html .= '</div>';
        
        if ($count) {
            $html .= '<span class="kr-rating-count">(' . $count . ')</span>';
        }
    }
    
    return $html;
}
add_filter('woocommerce_product_get_rating_html', 'kreators_woocommerce_rating_html', 10, 3);
