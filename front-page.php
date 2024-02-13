<?php

get_header();
?>
<div class="hero-header">
    <div class="hero-header__image"> <?php

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'photos', 
        'post_status' => 'publish',
        'order' => 'ASC', // par ordre croissant
    );

  $posts = get_posts($args);

  // sélectionne post aléatoire
  $random_post = $posts[array_rand($posts)];

  // récupére l'image aléatoire
  echo get_the_post_thumbnail($random_post->ID, 'full' );
?></div>    
    <h1 class="hero-header__title">PHOTOGRAPHE EVENT</h1>
</div>
<div class="photo-list">
    <div id="image-container" class="photo-list__container">
        <!-- images chargées via AJAX ici -->
    </div>
    <button class="photo-list__button">Charger plus</button>
</div>


<?php
get_footer();
