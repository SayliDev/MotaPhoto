<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-photo-main">

	<?php // Boucle WordPress standard pour afficher le contenu du CPT "photo"

while (have_posts()):

     the_post();

     // Contenu principal
     // the_content();

     // Utilisation de la fonction ACF pour afficher un champ personnalisé
     $type = get_field("Type");
     $reference = get_field("Référence");
     // Récupère la catégorie de la photo avec get_the_terms
     // $categories = get_the_terms(get_the_ID(), 'categorie');
     // if (!is_wp_error($categories) && $categories) {
     //     $category = $categories[0]->name;
     // } else {
     //     $category = 'Non renseigné';
     // }

     //      $categories = get_the_terms(get_the_ID(), 'categorie');
     // if (!is_wp_error($categories) && $categories) {
     //     $category_names = array();
     //     foreach ($categories as $category) {
     //         $category_names[] = $category->name;
     //     }
     //     $category = implode(', ', $category_names);
     // } else {
     //     $category = 'Non renseigné';
     // }

     // Récupérer les termes de la taxonomie "Categorie"
     $categories = get_the_terms(get_the_ID(), "categorie");
     $category =
         !is_wp_error($categories) && $categories
             ? $categories[0]->name
             : "Non renseigné";

     // Récupérer les termes de la taxonomie "Format"
     $formats = get_the_terms(get_the_ID(), "formats");
     if (!is_wp_error($formats) && $formats) {
         $format = $formats[0]->name;
     } else {
         $format = "Non renseigné";
     }
     ?>

            <!-- Structure HTML pour la zone de contenu spécifique -->
            <div class="photo-details">
                <div class="photo-description">
           <?php the_title('<h1 class="entry-title">', "</h1>"); ?>
                <p>Référence : <?php echo $reference; ?></p>
                <p>Catégorie : <?php echo $category; ?></p>
                <p>Format : <?php echo $format; ?> </p>
                <p>Type : <?php echo $type; ?></p>
                <p>Année : <?php echo get_the_date("Y"); ?> </p>
                </div>
            </div>

            <!-- Ajout de la photo -->
            <div class="photo-container">
            <?php the_post_thumbnail(); ?>
        </div>

        <?php
 endwhile; ?>

    </main><!-- #main -->
    <section class="photo-contact">
        <div class="photo-contact__container">
        <p>Cette photo vous interesse ?</p>
        <button class="contact-btn">Contact</button>
        </div>


        <div class="photo-contact__nav">
        <?php
$current_post_id = get_the_ID();
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'photos', 
    'post_status' => 'publish',
    'order' => 'ASC', // triés par ordre croissant
);

$all_posts = get_posts($args);
$current_post_index = array_search($current_post_id, array_column($all_posts, 'ID'));

$prev_post = $all_posts[$current_post_index - 1] ?? $all_posts[count($all_posts) - 1]; // on affiche le dernier si on est au premier
$next_post = $all_posts[$current_post_index + 1 ] ?? $all_posts[0]; // on affiche le premier si on est au dernier

// si arrive au dernier article, on affiche le premier
if ($current_post_index === count($all_posts) - 1) {
    $prev_post = $all_posts[0];
}

if ($prev_post || $next_post) :
?>
    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="prev-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev.svg">
    </a>
    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="next-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.svg">
    </a>

    <div> 
        <!-- Affiche l'image de l'article suivant -->
        <?php if ($next_post) : ?>
            <img src="<?php echo get_the_post_thumbnail_url($next_post, 'thumbnail'); ?>">
        <?php endif; ?>
    </div>
<?php endif; ?>


        
    </section>
</div><!-- #primary -->

<script>
jQuery(document).ready(function ($) {
  // Récupérez la référence de la photo depuis PHP
  let photoReference = "#<?php echo esc_js($reference); ?>";

  // Ajoutez la référence à votre champ dans la modale
  $("#reference").val(photoReference);
});
</script>

<?php get_footer();
