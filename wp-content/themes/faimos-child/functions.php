<?php
function faimos_child_scripts() {
    // Load parent theme stylesheet
    wp_enqueue_style( 'faimos-parent-style', get_template_directory_uri(). '/style.css' );

    // Load Google Fonts
    wp_enqueue_style( 'faimos-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap', array(), null );

    // Load child theme stylesheet (with version for cache busting)
    wp_enqueue_style( 'faimos-child-style', get_stylesheet_directory_uri() . '/style.css', array('faimos-parent-style'), filemtime(get_stylesheet_directory() . '/style.css') );
}
add_action( 'wp_enqueue_scripts', 'faimos_child_scripts' );

// Your php code goes here
?>