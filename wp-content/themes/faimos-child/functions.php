<?php
function faimos_child_scripts() {
    wp_enqueue_style( 'faimos-parent-style', get_template_directory_uri(). '/style.css' );
    wp_enqueue_style( 'faimos-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700;800&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'faimos_child_scripts' );

// Your php code goes here
?>