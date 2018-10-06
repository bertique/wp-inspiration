<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Gridster
 */
?>

<div id="container">
    <div id="sidebar">
        <?php if ( get_theme_mod( 'themefurnace_logo' ) ) : ?>
            <p><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img class="logo" src='<?php echo esc_url( get_theme_mod( 'themefurnace_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' /></a></p>
        <?php else : ?>
            <h1 id="logo_text"><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
        <?php endif; ?>

        <p class="tagline"><?php echo get_theme_mod('intro_text'); ?></p>

        <div class="sidebarwidget">
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </div>

        <?php do_action('before_sidebar'); ?>
        <?php if (!dynamic_sidebar('sidebar-1')) : ?>


        <?php get_search_form(); ?>

        <h3 class="sidetitle"><?php _e('Archives', 'themefurnace'); ?></h3>
            <ul>
                <?php wp_get_archives(array('type' => 'monthly')); ?>
            </ul>

            <h3 class="sidetitle"><?php _e('Meta', 'themefurnace'); ?></h3>

                <?php endif; // end sidebar widget area ?>

    </div>
    <!-- End Sidebar -->
