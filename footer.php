<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 */

?>
<?php get_template_part("template-parts/modal"); ?>

	<footer class="site-footer">

        <?php
wp_nav_menu(array(
    'theme_location' => 'footer_menu', // Utilisez le nom de l'emplacement du menu que vous avez défini dans functions.php
    'menu_id'        => 'footer-menu',
    'container'      => 'nav',
    'container_class'=> 'site-footer__menu', // Ajoutez des classes supplémentaires au conteneur si nécessaire
));
?>


	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
