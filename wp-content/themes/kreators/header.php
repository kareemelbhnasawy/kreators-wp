<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="kr-site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'kreators'); ?></a>

    <!-- Header -->
    <header class="kr-header" role="banner">
        <!-- Top Bar -->
        <div class="kr-header-top">
            <div class="kr-container">
                <div class="kr-flex-between">
                    <div class="kr-header-top-left">
                        <span><?php esc_html_e('Welcome to Kreators Marketplace!', 'kreators'); ?></span>
                    </div>
                    <div class="kr-header-top-right">
                        <?php if (class_exists('WooCommerce') && !is_user_logged_in()) : ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Sign In', 'kreators'); ?></a>
                            <span class="separator">|</span>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Register', 'kreators'); ?></a>
                        <?php elseif (is_user_logged_in()) : ?>
                            <span><?php printf(esc_html__('Hello, %s', 'kreators'), wp_get_current_user()->display_name); ?></span>
                            <span class="separator">|</span>
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Logout', 'kreators'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="kr-header-main">
            <div class="kr-container">
                <div class="kr-header-inner">
                    <!-- Logo -->
                    <div class="kr-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Search Bar -->
                    <div class="kr-search-container">
                        <form role="search" method="get" class="kr-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <?php if (class_exists('WooCommerce')) : ?>
                                <?php
                                $args = array(
                                    'show_option_all' => esc_html__('All Categories', 'kreators'),
                                    'hierarchical'    => 1,
                                    'class'           => 'kr-search-category',
                                    'echo'            => 1,
                                    'value_field'     => 'slug',
                                    'selected'        => isset($_GET['product_cat']) ? esc_attr($_GET['product_cat']) : '',
                                    'name'            => 'product_cat',
                                    'id'              => 'product-cat',
                                    'taxonomy'        => 'product_cat',
                                    'hide_if_empty'   => true,
                                );
                                wp_dropdown_categories($args);
                                ?>
                                <input type="hidden" name="post_type" value="product">
                            <?php endif; ?>
                            <input type="search" class="kr-search-input" placeholder="<?php esc_attr_e('Search products, creators, services...', 'kreators'); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
                            <button type="submit" class="kr-search-btn" aria-label="<?php esc_attr_e('Search', 'kreators'); ?>">
                                <?php kreators_icon('search'); ?>
                                <span class="btn-text"><?php esc_html_e('Search', 'kreators'); ?></span>
                            </button>
                        </form>
                    </div>

                    <!-- Header Actions -->
                    <div class="kr-header-actions">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <!-- Account -->
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="kr-header-action">
                                <?php kreators_icon('user'); ?>
                                <span><?php esc_html_e('Account', 'kreators'); ?></span>
                            </a>

                            <!-- Wishlist -->
                            <?php if (function_exists('YITH_WCWL')) : ?>
                                <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="kr-header-action">
                                    <?php kreators_icon('heart'); ?>
                                    <span><?php esc_html_e('Wishlist', 'kreators'); ?></span>
                                    <?php $wishlist_count = YITH_WCWL()->count_products(); ?>
                                    <?php if ($wishlist_count > 0) : ?>
                                        <span class="kr-header-action-badge"><?php echo esc_html($wishlist_count); ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <!-- Cart -->
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="kr-header-action">
                                <?php kreators_icon('cart'); ?>
                                <span><?php esc_html_e('Cart', 'kreators'); ?></span>
                                <?php $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                                <?php if ($cart_count > 0) : ?>
                                    <span class="kr-header-action-badge"><?php echo esc_html($cart_count); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php else : ?>
                            <!-- Account for non-WooCommerce -->
                            <?php if (is_user_logged_in()) : ?>
                                <a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="kr-header-action">
                                    <?php kreators_icon('user'); ?>
                                    <span><?php esc_html_e('Profile', 'kreators'); ?></span>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url(wp_login_url()); ?>" class="kr-header-action">
                                    <?php kreators_icon('user'); ?>
                                    <span><?php esc_html_e('Login', 'kreators'); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Mobile Menu Toggle -->
                        <button class="kr-mobile-toggle" aria-label="<?php esc_attr_e('Toggle Menu', 'kreators'); ?>" aria-expanded="false">
                            <?php kreators_icon('menu'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="kr-nav" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'kreators'); ?>">
            <div class="kr-container">
                <div class="kr-nav-inner">
                    <!-- Categories Dropdown -->
                    <div class="kr-nav-categories">
                        <button class="kr-nav-categories-btn" aria-expanded="false">
                            <?php kreators_icon('grid'); ?>
                            <span><?php esc_html_e('Shop by Category', 'kreators'); ?></span>
                        </button>
                    </div>

                    <!-- Main Menu -->
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'kr-nav-menu',
                            'container'      => false,
                            'depth'          => 2,
                            'fallback_cb'    => false,
                        ));
                    } else {
                        echo '<ul class="kr-nav-menu">';
                        echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'kreators') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/shop/')) . '">' . esc_html__('Shop', 'kreators') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/blog/')) . '">' . esc_html__('Blog', 'kreators') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html__('About', 'kreators') . '</a></li>';
                        echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('Contact', 'kreators') . '</a></li>';
                        echo '</ul>';
                    }
                    ?>

                    <!-- Secondary Menu -->
                    <?php
                    if (has_nav_menu('secondary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'secondary',
                            'menu_class'     => 'kr-nav-menu kr-nav-menu-right',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <div id="content" class="kr-site-content">
