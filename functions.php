<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}

function theme_enqueue_styles() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);
    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    // Enqueue navigation script
    wp_enqueue_script('navigation-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), null, true);

    // Other optional stylesheets or scripts
    // wp_enqueue_style('another-style', get_template_directory_uri() . '/path/to/another-style.css', array(), '1.0', 'all');
    // wp_enqueue_script('custom-script', get_template_directory_uri() . '/path/to/your-script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => esc_html__( 'Primary Menu', 'mota-photo' ),
        )
    );
}
add_action( 'after_setup_theme', 'theme_register_menus' );
