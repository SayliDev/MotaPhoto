<?php
// Récupére la photo transmise
$photo = get_query_var('related_photo');

// Récupére les arguments de filtrage (condition)
$args = isset($args) ? $args : array();

?>
<div class="related-photo">
    <a href="<?php echo esc_url(get_permalink($photo)); ?>">
        <?php echo get_the_post_thumbnail($photo, array(564, 495)); // moyenne largeur ?>
    </a>
</div>

<!-- On mettra $post = get_query_var('related_photo');

(related_photo) uniquemnt pour le template-->