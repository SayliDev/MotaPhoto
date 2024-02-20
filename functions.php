<?php

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.6.3');
}

function theme_enqueue_styles()
{
    // Enqueue Google Fonts
    wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);

// Enqueue Poppins font
    wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), null);

    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    // Enqueue navigation script
    wp_enqueue_script('navigation-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), null, true);
    // si c'est une page photo
    if (is_singular('photos')) {
        wp_enqueue_script('global-script', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true);
    }
    // Enqueue jQuery
    wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_register_menus()
{
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'mota-photo'),
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');

function register_footer_menu()
{
    register_nav_menu('footer_menu', __('Footer Menu', 'textdomain'));
}
add_action('after_setup_theme', 'register_footer_menu');

/* -------------------------------------------------------------------------- */
/*                                Requete Ajax                                */
/* -------------------------------------------------------------------------- */

add_action('wp_enqueue_scripts', 'enqueue_ajax_script');

function enqueue_ajax_script()
{
    wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/js/load-images.js', array('jquery'), '', true);
    wp_localize_script('ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_load_more_images', 'load_more_images');
add_action('wp_ajax_nopriv_load_more_images', 'load_more_images');

function load_more_images()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 8;

    // Récupérer les arguments de filtrage passés via AJAX
    $args = isset($_POST['args']) ? $_POST['args'] : array();

    // Fusionner les arguments de filtrage avec les arguments par défaut
    $args = array_merge(array(
        'post_type' => 'photos',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'offset' => $offset,
    ), $args);

    $posts = get_posts($args);

    ob_start(); // Commencer la mise en mémoire tampon de sortie
    foreach ($posts as $post) {
        setup_postdata($post);
        set_query_var('related_photo', $post);
        // Passer les arguments de filtrage au template photo-block.php
        get_template_part('template-parts/photo_block');
    }
    $output = ob_get_clean(); // Récupérer la sortie mise en mémoire tampon et vider le tampon

    echo $output; // Envoie les images chargées en réponse à la requête AJAX

    wp_die();
}

/* -------------------------------------------------------------------------- */
/*                                 Les select                                 */
/* -------------------------------------------------------------------------- */

// Défini les variables $argsCroissant et $argsDecroissant en dehors de toutes les fonctions
$argsCroissant = array(
    'posts_per_page' => 8, // Limite à 8 posts par requête
    'post_type' => 'photos',
    'post_status' => 'publish',
    'order' => 'DESC', // par ordre décroissant
);

$argsDecroissant = array(
    'posts_per_page' => 8, // Limite à 8 posts par requête
    'post_type' => 'photos',
    'post_status' => 'publish',
    'order' => 'ASC', // par ordre croissant
);

//* Pour les type Argentique et Numérique

$argsTypeArgentique = array(
    'meta_query' => array(
        array(
            'key' => 'type',
            'value' => 'Argentique',
            // 'compare' => '=',
        ),
    ),
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
);

$argsTypeNumerique = array(
    'meta_query' => array(
        array(
            'key' => 'type',
            'value' => 'Numérique',
            // 'compare' => '=',
        ),
    ),
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
);

//* Pour les categorie
// categorie "réception"

$argsReception = array(
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => 'reception',
        ),
    ),
);

// categorie "television"

$argsTelevision = array(
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => 'television',
        ),
    ),
);

// categorie "concert"

$argsConcert = array(
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => 'concert',
        ),
    ),
);

// categorie "mariage"

$argsMariage = array(
    'posts_per_page' => 8,
    'post_type' => 'photos',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => 'mariage',
        ),
    ),
);

// // ! Arguments de filtre pour les photos numériques par ordre décroissant
// $argsNumeriqueDecroissant = array(
//     'meta_query' => array(
//         array(
//             'order' => 'ASC',
//             'key' => 'type',
//             'value' => 'Numérique',
//             'posts_per_page' => 8,
//             'post_type' => 'photos',
//             'post_status' => 'publish',
//         ),
//     ),
// );

// // ! Arguments de filtre pour les photos numériques par ordre croissant
// $argsNumeriqueCroissant = array(
//     'meta_query' => array(
//         array(
//             'order' => 'DESC',
//             'key' => 'type',
//             'value' => 'Numérique',
//             'posts_per_page' => 8,
//             'post_type' => 'photos',
//             'post_status' => 'publish',
//         ),
//     ),
// );

// Hook pour enregistrer et charger les scripts et styles
function enqueue_my_scripts()
{
    // Enregistrement du script de navigation
    wp_enqueue_script('navigation-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), null, true);

    // Défini les données localisées pour la navigation
    global $argsCroissant, $argsDecroissant, $argsTypeArgentique, $argsTypeNumerique, $argsReception, $argsTelevision, $argsConcert, $argsMariage;
    $localized_data = array(
        'argsCroissant' => $argsCroissant,
        'argsDecroissant' => $argsDecroissant,
        'argsTypeArgentique' => $argsTypeArgentique,
        'argsTypeNumerique' => $argsTypeNumerique,
        'argsReception' => $argsReception,
        'argsTelevision' => $argsTelevision,
        'argsConcert' => $argsConcert,
        'argsMariage' => $argsMariage,
        // 'argsNumeriqueCroissant' => $argsNumeriqueCroissant,
        // 'argsNumeriqueDecroissant' => $argsNumeriqueDecroissant,
    );

    // todo: changer pour le nom du script (load images.js)
    // Passage des données localisées au script (ajax))
    wp_localize_script('navigation-script', 'localized_data', $localized_data);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');

/* -------------------------------------------------------------------------- */
/*                            Diagramme de séquence                           */
/* --------------------------------------------------------------------------

+--------------------------+
|   Frontend (Navigateur)  |
+--------------------------+
|
| Requêtes AJAX
|
+--------------------------+
|           load-images.js  |
+--------------------------+
|
| Envoie des données AJAX à l'URL admin-ajax.php
|
+--------------------------+
|        admin-ajax.php     |
+--------------------------+
|
| Traite les requêtes AJAX et appelle les fonctions correspondantes
|
+--------------------------+
|         function.php      |
+--------------------------+
|
| Enregistre les scripts et définit les données localisées
| Appelle les fonctions de traitement AJAX
|
+--------------------------+
|       load_more_images   |
+--------------------------+
|
| Récupère les paramètres de la requête AJAX
| Effectue la requête WP_Query avec les paramètres de filtrage
| Affiche les résultats en utilisant le modèle photo_block.php
|
+--------------------------+
|       photo-block.php    |
+--------------------------+
|
| Affiche chaque image avec les paramètres spécifiés
|
 */
