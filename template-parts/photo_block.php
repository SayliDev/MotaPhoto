<?php
// Récupérer la photo transmise
$photo = get_query_var('related_photo');
?>
<div class="related-photo">
    <a href="<?php echo esc_url(get_permalink($photo)); ?>">
        <?php echo get_the_post_thumbnail($photo->ID, array(564, 495)); // moyenne largeur ?>
    </a>
</div>
