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


        <!-- photo suivante & precedente -->
        <div class="photo-contact__nav">
            <!-- affiche un apercu de la photo suivante -->

        <button class="prev-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev.svg">
        </button>
        <button class="next-btn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.svg"></button>

        

        </div>
       
        
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
