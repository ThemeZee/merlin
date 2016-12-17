<?php
/**
 * The template for displaying the footer.
 *
 * Contains all content after the main content area and sidebar
 *
 * @package Merlin
 */

?>

	</div><!-- #content -->

	<?php do_action( 'merlin_before_footer' ); ?>

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">

    <?php // Check if there is a footer navigation menu.
    if ( has_nav_menu( 'footer' ) ) : ?>

        <nav id="footer-links" class="footer-navigation navigation clearfix" role="navigation">
            <?php
            // Display Footer Navigation
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'footer-navigation-menu',
                'echo' => true,
                'fallback_cb' => '',
                'depth' => 1)
            );
            ?>
        </nav><!-- #footer-links -->

    <?php endif; ?>

    <div id="footer-text" class="site-info">
        <?php do_action( 'merlin_footer_text' ); ?>
    </div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
