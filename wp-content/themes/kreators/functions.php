<?php
/**
 * Kreators Theme Functions and Definitions
 *
 * @package kreators
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme Constants
define('KREATORS_VERSION', '1.0.0');
define('KREATORS_DIR', get_template_directory());
define('KREATORS_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function kreators_setup() {
    // Add default posts and comments RSS feed links
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    add_image_size('kreators-card', 600, 400, true);
    add_image_size('kreators-card-large', 800, 500, true);
    add_image_size('kreators-single', 1200, 600, true);
    add_image_size('kreators-thumbnail', 100, 100, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'kreators'),
        'secondary' => esc_html__('Secondary Menu', 'kreators'),
        'footer'    => esc_html__('Footer Menu', 'kreators'),
    ));
    
    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Custom logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Custom header
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1920,
        'height'        => 400,
        'flex-width'    => true,
        'flex-height'   => true,
    ));
    
    // Custom background
    add_theme_support('custom-background', array(
        'default-color' => 'f9fafb',
    ));
    
    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Post formats
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));
    
    // Responsive embeds
    add_theme_support('responsive-embeds');
    
    // Wide alignment
    add_theme_support('align-wide');
    
    // Editor styles
    add_theme_support('editor-styles');
    add_editor_style('css/editor-style.css');
}
add_action('after_setup_theme', 'kreators_setup');

/**
 * Set content width
 */
function kreators_content_width() {
    $GLOBALS['content_width'] = apply_filters('kreators_content_width', 1200);
}
add_action('after_setup_theme', 'kreators_content_width', 0);

/**
 * Register widget areas
 */
function kreators_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'kreators'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here for the blog sidebar.', 'kreators'),
        'before_widget' => '<div id="%1$s" class="kr-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="kr-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'kreators'),
        'id'            => 'sidebar-shop',
        'description'   => esc_html__('Add widgets here for the shop sidebar.', 'kreators'),
        'before_widget' => '<div id="%1$s" class="kr-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="kr-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer widget areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Column %d', 'kreators'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Add widgets for footer column %d.', 'kreators'), $i),
            'before_widget' => '<div id="%1$s" class="kr-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="kr-footer-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'kreators_widgets_init');

/**
 * Enqueue scripts and styles
 */
function kreators_scripts() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'kreators-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
        array(),
        null
    );
    
    // Main stylesheet
    wp_enqueue_style(
        'kreators-style',
        get_stylesheet_uri(),
        array(),
        KREATORS_VERSION
    );
    
    // Responsive stylesheet
    wp_enqueue_style(
        'kreators-responsive',
        KREATORS_URI . '/css/responsive.css',
        array('kreators-style'),
        KREATORS_VERSION
    );
    
    // Main scripts
    wp_enqueue_script(
        'kreators-main',
        KREATORS_URI . '/js/main.js',
        array(),
        KREATORS_VERSION,
        true
    );
    
    // Comments reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Localize script
    wp_localize_script('kreators-main', 'kreatorsData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('kreators_nonce'),
        'siteUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'kreators_scripts');

/**
 * Custom excerpt length
 */
function kreators_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'kreators_excerpt_length');

/**
 * Custom excerpt more
 */
function kreators_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'kreators_excerpt_more');

/**
 * Breadcrumbs
 */
function kreators_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="kr-breadcrumbs-nav" aria-label="' . esc_attr__('Breadcrumb', 'kreators') . '">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'kreators') . '</a>';
    echo '<span>/</span>';
    
    if (is_category() || is_single()) {
        $categories = get_the_category();
        if ($categories) {
            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
            echo '<span>/</span>';
        }
    }
    
    if (is_single()) {
        echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_page()) {
        echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_category()) {
        echo '<span class="current">' . esc_html(single_cat_title('', false)) . '</span>';
    } elseif (is_tag()) {
        echo '<span class="current">' . esc_html(single_tag_title('', false)) . '</span>';
    } elseif (is_author()) {
        echo '<span class="current">' . esc_html(get_the_author()) . '</span>';
    } elseif (is_search()) {
        echo '<span class="current">' . esc_html__('Search Results', 'kreators') . '</span>';
    } elseif (is_archive()) {
        echo '<span class="current">' . esc_html(get_the_archive_title()) . '</span>';
    } elseif (is_404()) {
        echo '<span class="current">' . esc_html__('Page Not Found', 'kreators') . '</span>';
    }
    
    echo '</nav>';
}

/**
 * Pagination
 */
function kreators_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);
    
    echo '<nav class="kr-pagination" aria-label="' . esc_attr__('Posts navigation', 'kreators') . '">';
    
    // Previous
    if ($paged > 1) {
        echo '<a href="' . esc_url(get_pagenum_link($paged - 1)) . '" class="prev" aria-label="' . esc_attr__('Previous page', 'kreators') . '">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>';
        echo '</a>';
    }
    
    // Page numbers
    for ($i = 1; $i <= $max; $i++) {
        if ($i === $paged) {
            echo '<span class="current">' . $i . '</span>';
        } elseif ($i <= 2 || $i > $max - 2 || abs($paged - $i) <= 1) {
            echo '<a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
        } elseif (abs($paged - $i) === 2) {
            echo '<span class="dots">...</span>';
        }
    }
    
    // Next
    if ($paged < $max) {
        echo '<a href="' . esc_url(get_pagenum_link($paged + 1)) . '" class="next" aria-label="' . esc_attr__('Next page', 'kreators') . '">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
        echo '</a>';
    }
    
    echo '</nav>';
}

/**
 * Posted on
 */
function kreators_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );
    
    echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * Posted by
 */
function kreators_posted_by() {
    echo '<span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>';
}

/**
 * Comments count
 */
function kreators_comments_count() {
    if (!post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            esc_html__('0 Comments', 'kreators'),
            esc_html__('1 Comment', 'kreators'),
            esc_html__('% Comments', 'kreators')
        );
        echo '</span>';
    }
}

/**
 * Reading time
 */
function kreators_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return sprintf(
        esc_html(_n('%d min read', '%d min read', $reading_time, 'kreators')),
        $reading_time
    );
}

/**
 * Get SVG icon
 */
function kreators_get_icon($name, $class = '') {
    $icons = array(
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>',
        'user' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>',
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',
        'cart' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>',
        'close' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
        'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',
        'clock' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>',
        'arrow-up' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>',
        'grid' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="' . esc_attr($class) . '"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>',
        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="' . esc_attr($class) . '"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="' . esc_attr($class) . '"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="' . esc_attr($class) . '"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>',
        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="' . esc_attr($class) . '"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
    );
    
    return isset($icons[$name]) ? $icons[$name] : '';
}

/**
 * Print SVG icon
 */
function kreators_icon($name, $class = '') {
    echo kreators_get_icon($name, $class);
}

/**
 * Body classes
 */
function kreators_body_classes($classes) {
    // Add a class for the sidebar
    if (is_active_sidebar('sidebar-1') && !is_page()) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class if no featured image
    if (is_singular() && !has_post_thumbnail()) {
        $classes[] = 'no-featured-image';
    }
    
    return $classes;
}
add_filter('body_class', 'kreators_body_classes');

/**
 * Comment callback
 */
function kreators_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('kr-comment'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="kr-comment-body">
            <header class="kr-comment-header">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'kr-comment-avatar')); ?>
                <div class="kr-comment-meta">
                    <span class="kr-comment-author"><?php comment_author_link(); ?></span>
                    <span class="kr-comment-date"><?php comment_date(); ?> <?php esc_html_e('at', 'kreators'); ?> <?php comment_time(); ?></span>
                </div>
            </header>
            <div class="kr-comment-content">
                <?php comment_text(); ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <p class="kr-comment-awaiting"><?php esc_html_e('Your comment is awaiting moderation.', 'kreators'); ?></p>
            <?php endif; ?>
            <footer class="kr-comment-footer">
                <?php
                comment_reply_link(array_merge($args, array(
                    'reply_text' => esc_html__('Reply', 'kreators'),
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth'],
                )));
                
                edit_comment_link(esc_html__('Edit', 'kreators'), ' <span class="kr-comment-edit">');
                ?>
            </footer>
        </article>
    <?php
}

/**
 * AJAX Live Search
 */
function kreators_live_search() {
    check_ajax_referer('kreators_nonce', 'nonce');
    
    $search_query = sanitize_text_field($_POST['query']);
    
    $args = array(
        's'              => $search_query,
        'posts_per_page' => 5,
        'post_type'      => array('post', 'product'),
        'post_status'    => 'publish',
    );
    
    $query = new WP_Query($args);
    $results = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'title'     => get_the_title(),
                'url'       => get_permalink(),
                'image'     => get_the_post_thumbnail_url(get_the_ID(), 'kreators-thumbnail'),
                'post_type' => get_post_type(),
            );
        }
    }
    
    wp_reset_postdata();
    
    wp_send_json_success($results);
}
add_action('wp_ajax_kreators_live_search', 'kreators_live_search');
add_action('wp_ajax_nopriv_kreators_live_search', 'kreators_live_search');

/**
 * Disable widget block editor
 */
add_filter('use_widgets_block_editor', '__return_false');

/**
 * WooCommerce support
 */
if (class_exists('WooCommerce')) {
    // Remove default WooCommerce wrapper
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    // Add custom wrappers
    function kreators_wc_wrapper_start() {
        echo '<main class="kr-main"><div class="kr-container"><div class="kr-content-wrapper">';
    }
    add_action('woocommerce_before_main_content', 'kreators_wc_wrapper_start', 10);
    
    function kreators_wc_wrapper_end() {
        echo '</div></div></main>';
    }
    add_action('woocommerce_after_main_content', 'kreators_wc_wrapper_end', 10);
}

/**
 * Include additional files
 */
// Custom Walker for navigation
require_once KREATORS_DIR . '/inc/class-kreators-walker-nav-menu.php';

// WooCommerce integration
if (class_exists('WooCommerce')) {
    require_once KREATORS_DIR . '/inc/woocommerce.php';
}
