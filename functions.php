<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function foce_add_google_fonts()
{
    wp_enqueue_style('foce-google-fonts-quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap', false);
    wp_enqueue_style('foce-google-fonts-roboto-mono', 'https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap', false);
}
add_action('wp_enqueue_scripts', 'foce_add_google_fonts');
