<?php
/**
 * The sidebar containing the main widget area
 *
 * @package kreators
 */

if (!is_active_sidebar('sidebar-1') && !is_active_sidebar('sidebar-shop')) {
    return;
}

// Use shop sidebar on WooCommerce pages
if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
    $sidebar = 'sidebar-shop';
} else {
    $sidebar = 'sidebar-1';
}

if (!is_active_sidebar($sidebar)) {
    $sidebar = 'sidebar-1';
}

if (is_active_sidebar($sidebar)) :
    dynamic_sidebar($sidebar);
endif;
