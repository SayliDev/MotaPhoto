<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-photo-main">

	<?php
        // Boucle WordPress standard pour afficher le contenu du CPT "photo"
        while (have_posts()) :
            the_post();

           

            // Affichage du contenu principal
            // the_content();

            // Utilisation de la fonction ACF pour afficher un champ personnalisé
            $type = get_field('Type');
            $reference = get_field('Référence');
            ?>

            <!-- Structure HTML pour la zone de contenu spécifique -->
            <div class="photo-details">
                <div class="photo-description">
           <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                <p>Référence : <?php echo $reference; ?></p>
                <p>Catégorie : </p>
                <p>Format : </p>
                <p>Type : <?php echo $type; ?></p>
                <p>Année : </p>
                </div>

                <!-- Ajoutez ici d'autres éléments HTML pour afficher d'autres champs ACF ou du contenu spécifique -->
            </div>

            <!-- Ajout de la photo -->
            <div class="photo-container">
            <?php the_post_thumbnail(); ?>
        </div>

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php
get_footer();
