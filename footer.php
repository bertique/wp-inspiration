<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Gridster
 */
?>

<div id="footer">
    <p class="copy"><?php echo get_theme_mod( 'themefurnacefooter_footer_text' ); ?><br />
        <?php _e('&copy; Copyright','themefurnace') ?> <?php the_time('Y') ?> <?php bloginfo('name'); ?> - <?php printf( __( 'Theme: %1$s by %2$s.', 'themefurnace' ), 'Gridster', '<a href="http://themefurnace.com" rel="designer">ThemeFurnace</a>' ); ?></a></p>
</div>
</div><!-- main -->
<?php echo get_theme_mod( 'footer_scripts' ); ?>
<?php wp_footer(); ?>
</body>
</html>