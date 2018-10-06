<?php
/**
 * Gridster functions and definitions
 *
 * @package Gridster
 */

// themefurnace functions and definitions
if ( ! function_exists( 'themefurnace_setup' ) ) :
    function themefurnace_setup() {
        load_theme_textdomain( 'themefurnace', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
    }
endif;
add_action( 'after_setup_theme', 'themefurnace_setup' );

// Emable The custom Menu
register_nav_menu( 'primary', __( 'Primary Menu', 'themefurnace' ) );

// Style the Tag Cloud
function custom_tag_cloud_widget($args) {
    $args['largest'] = 12; //largest tag
    $args['smallest'] = 12; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    $args['number'] = '8'; //number of tags
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
    $links = str_replace('</a> (', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis) and sets character length to 35
 */
function wp_new_excerpt($text)
{
    if ($text == '')
    {
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text);
        $text = nl2br($text);
        $excerpt_length = apply_filters('excerpt_length', 25);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');


/**
 * Register widgetized area and update sidebar with default widgets
 */
function gridster_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'themefurnace' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="sidetitle">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'gridster_widgets_init' );

/**
 * Profile page: function to convert date to "readable" time (XX days ago etc)
 * @param int $timestamp
 * @param int $num_times
 * @return string
 */
if(!function_exists('readable_time')):
    function readable_time($timestamp, $num_times = 2) {

        //this returns human readable time when it was uploaded (array in seconds)
        $times = array(31536000 => 'year', 2592000 => 'month',  604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');
        $now = time();
        $secs = $now - $timestamp;
        $count = 0;
        $time = '';

        foreach ($times AS $key => $value)
        {
            if ($secs >= $key)
            {
                //time found
                $s = '';
                $time .= floor($secs / $key);

                if ((floor($secs / $key) != 1))
                    $s = 's';

                $time .= ' ' . $value . $s;
                $count++;
                $secs = $secs % $key;

                if ($count > $num_times - 1 || $secs == 0)
                    break;
                else
                    $time .= ', ';
            }
        }

        return $time;
    }
endif;

// Pagination

function themefurnace_pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
        echo "</div>\n";
    }
}


//Enqueue scripts and styles
function themefurnace_scripts() {
    wp_enqueue_style( 'themefurnace-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'themefurnace-selectbox', get_template_directory_uri() . '/js/selectbox.js', array(), '20130115', true );
    wp_enqueue_script( 'themefurnace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
//	wp_enqueue_script( 'gridster-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'themefurnace-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

}
add_action( 'wp_enqueue_scripts', 'themefurnace_scripts' );


function load_fonts() {
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700', array(), false, 'all');
    wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'load_fonts');

// post thumbnail support
if ( function_exists( 'add_image_size' ) ) {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-full');
    add_image_size( 'post-page', 990, 525, true );
    add_image_size( 'post-thumb', 225, 158, true );
}

// Load Extra Functions
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/themesetup.php';