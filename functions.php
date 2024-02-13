<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.6.0' );
}

function theme_enqueue_styles() {
    // Enqueue Google Fonts
wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);

// Enqueue Poppins font
wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), null);

    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    // Enqueue navigation script
    wp_enqueue_script('navigation-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), null, true);
    wp_enqueue_script('global-script', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true);
    // Enqueue jQuery
    wp_enqueue_script( 'jquery' );
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

function register_footer_menu() {
    register_nav_menu('footer_menu', __('Footer Menu', 'textdomain'));
}
add_action('after_setup_theme', 'register_footer_menu');

/* -------------------------------------------------------------------------- */
/*                                Requete Ajax                                */
/* -------------------------------------------------------------------------- */

add_action('wp_enqueue_scripts', 'enqueue_ajax_script');

function enqueue_ajax_script() {
    wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/js/load-images.js', array('jquery'), '', true);
    wp_localize_script('ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}


add_action('wp_ajax_load_more_images', 'load_more_images');
add_action('wp_ajax_nopriv_load_more_images', 'load_more_images');
function load_more_images() {
    $offset = isset($_POST['offset']) ? intval(sanitize_text_field($_POST['offset'])) : 0;
    $limit = isset($_POST['limit']) ? intval(sanitize_text_field($_POST['limit'])) : 8;
    // if (isset($_POST['limit'])) {
    //     $limit = intval(sanitize_text_field($_POST['limit']));
    // } else {
    //     $limit = 8;
    // } if limit

    $args = array(
        'post_type'      => 'photos', 
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'offset'         => $offset,
    );

    $posts = get_posts($args);

    foreach ($posts as $post) {
        setup_postdata($post);
        set_query_var('related_photo', $post);
        get_template_part('template-parts/photo_block'); // utilisation du même template que dans front-page.php
    }

    wp_die(); 
}