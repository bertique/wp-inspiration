<?php
/*
Plugin Name: Portfolio Post Type
Plugin URI: http://www.wptheming.com
Description: Enables a portfolio post type and taxonomies.
Version: 0.3
Author: Devin Price
Author URI: http://wptheming.com/portfolio-post-type/
License: GPLv2
*/

/**
 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404
 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
 */
 



function portfolioposttype_activation() {
	portfolioposttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'portfolioposttype_activation' );

function portfolioposttype() {

	/**
	 * Enable the Portfolio custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Portfolio', 'portfolioposttype' ),
		'singular_name' => __( 'Portfolio Item', 'portfolioposttype' ),
		'add_new' => __( 'Add New Item', 'portfolioposttype' ),
		'add_new_item' => __( 'Add New Portfolio Item', 'portfolioposttype' ),
		'edit_item' => __( 'Edit Portfolio Item', 'portfolioposttype' ),
		'new_item' => __( 'Add New Portfolio Item', 'portfolioposttype' ),
		'view_item' => __( 'View Item', 'portfolioposttype' ),
		'search_items' => __( 'Search Portfolio', 'portfolioposttype' ),
		'not_found' => __( 'No portfolio items found', 'portfolioposttype' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'portfolioposttype' )
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "portfolio"), // Permalinks format
		'menu_position' => 5,
		'has_archive' => true
	); 

	register_post_type( 'portfolio', $args );
	
	/**
	 * Register a taxonomy for Portfolio Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	 
	
	$taxonomy_portfolio_tag_labels = array(
		'name' => _x( 'Portfolio Tags', 'portfolioposttype' ,'themefurnace'),
		'singular_name' => _x( 'Portfolio Tag', 'portfolioposttype' ,'themefurnace'),
		'search_items' => _x( 'Search Portfolio Tags', 'portfolioposttype' ,'themefurnace'),
		'popular_items' => _x( 'Popular Portfolio Tags', 'portfolioposttype' ,'themefurnace'),
		'all_items' => _x( 'All Portfolio Tags', 'portfolioposttype' ,'themefurnace'),
		'parent_item' => _x( 'Parent Portfolio Tag', 'portfolioposttype' ,'themefurnace'),
		'parent_item_colon' => _x( 'Parent Portfolio Tag:', 'portfolioposttype' ,'themefurnace'),
		'edit_item' => _x( 'Edit Portfolio Tag', 'portfolioposttype' ,'themefurnace'),
		'update_item' => _x( 'Update Portfolio Tag', 'portfolioposttype' ,'themefurnace'),
		'add_new_item' => _x( 'Add New Portfolio Tag', 'portfolioposttype' ,'themefurnace'),
		'new_item_name' => _x( 'New Portfolio Tag Name', 'portfolioposttype' ,'themefurnace'),
		'separate_items_with_commas' => _x( 'Separate portfolio tags with commas', 'portfolioposttype' ,'themefurnace'),
		'add_or_remove_items' => _x( 'Add or remove portfolio tags', 'portfolioposttype' ,'themefurnace'),
		'choose_from_most_used' => _x( 'Choose from the most used portfolio tags', 'portfolioposttype' ,'themefurnace'),
		'menu_name' => _x( 'Portfolio Tags', 'portfolioposttype' ,'themefurnace')
	);
	
	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'query_var' => true
	);
	
	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );
	
	/**
	 * Register a taxonomy for Portfolio Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_portfolio_category_labels = array(
		'name' => _x( 'Portfolio Categories', 'portfolioposttype' ,'themefurnace'),
		'singular_name' => _x( 'Portfolio Category', 'portfolioposttype' ,'themefurnace'),
		'search_items' => _x( 'Search Portfolio Categories', 'portfolioposttype' ,'themefurnace'),
		'popular_items' => _x( 'Popular Portfolio Categories', 'portfolioposttype' ,'themefurnace'),
		'all_items' => _x( 'All Portfolio Categories', 'portfolioposttype' ,'themefurnace'),
		'parent_item' => _x( 'Parent Portfolio Category', 'portfolioposttype' ,'themefurnace'),
		'parent_item_colon' => _x( 'Parent Portfolio Category:', 'portfolioposttype' ,'themefurnace'),
		'edit_item' => _x( 'Edit Portfolio Category', 'portfolioposttype' ,'themefurnace'),
		'update_item' => _x( 'Update Portfolio Category', 'portfolioposttype' ,'themefurnace'),
		'add_new_item' => _x( 'Add New Portfolio Category', 'portfolioposttype' ,'themefurnace'),
		'new_item_name' => _x( 'New Portfolio Category Name', 'portfolioposttype' ,'themefurnace'),
		'separate_items_with_commas' => _x( 'Separate portfolio categories with commas', 'portfolioposttype' ,'themefurnace'),
		'add_or_remove_items' => _x( 'Add or remove portfolio categories', 'portfolioposttype' ,'themefurnace'),
		'choose_from_most_used' => _x( 'Choose from the most used portfolio categories', 'portfolioposttype' ,'themefurnace'),
		'menu_name' => _x( 'Portfolio Categories', 'portfolioposttype' ,'themefurnace'),
    );
	
    $taxonomy_portfolio_category_args = array(
		'labels' => $taxonomy_portfolio_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => true,
		'query_var' => true
    );
	
    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );
	
}

add_action( 'init', 'portfolioposttype' );

// Allow thumbnails to be used on portfolio post type

add_theme_support( 'post-thumbnails', array( 'portfolio' ) );
 
/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function portfolioposttype_edit_columns($portfolio_columns){
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name','themefurnace'),
		"thumbnail" => __('Thumbnail', 'portfolioposttype','themefurnace'),
		"portfolio_category" => __('Category', 'portfolioposttype','themefurnace'),
		"portfolio_tag" => __('Tags', 'portfolioposttype','themefurnace'),
		"author" => __('Author', 'portfolioposttype','themefurnace'),
		"comments" => __('Comments', 'portfolioposttype','themefurnace'),
		"date" => __('Date', 'portfolioposttype','themefurnace'),
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

add_filter( 'manage_edit-portfolio_columns', 'portfolioposttype_edit_columns' );
 
function portfolioposttype_columns_display($portfolio_columns, $post_id){

	switch ( $portfolio_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		case "thumbnail":
			$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_category":
			
			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;			
	}
}

add_action( 'manage_posts_custom_column',  'portfolioposttype_columns_display', 10, 2 );

/**
 * Add Portfolio count to "Right Now" Dashboard Widget
 */

function add_portfolio_counts() {
        if ( ! post_type_exists( 'portfolio' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'portfolio' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
        }
        echo '<td class="first b b-portfolio">' . $num . '</td>';
        echo '<td class="t portfolio">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
            }
            echo '<td class="first b b-portfolio">' . $num . '</td>';
            echo '<td class="t portfolio">' . $text . '</td>';

            echo '</tr>';
        }
}

add_action( 'right_now_content_table_end', 'add_portfolio_counts' );

/**
 * Add contextual help menu
 */
 
function portfolioposttype_add_help_text( $contextual_help, $screen_id, $screen ) { 
	if ( 'portfolio' == $screen->id ) {
		$contextual_help =
		'<p>' . __('The title field and the big Post Editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.','themefurnace') . '</p>' .
		'<p>' . __('<strong>Title</strong> - Enter a title for your post. After you enter a title, you&#8217;ll see the permalink below, which you can edit.','themefurnace') . '</p>' .
		'<p>' . __('<strong>Post editor</strong> - Enter the text for your post. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your post text. You can insert media files by clicking the icons above the post editor and following the directions. You can go the distraction-free writing screen, new in 3.2, via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular post editor.','themefurnace') . '</p>' .
		'<p>' . __('<strong>Publish</strong> - You can set the terms of publishing your post in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a post or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a post to be published in the future or backdate a post.','themefurnace') . '</p>' .
		( ( current_theme_supports( 'post-formats' ) && post_type_supports( 'post', 'post-formats' ) ) ? '<p>' . __( '<strong>Post Format</strong> - This designates how your theme will display a specific post. For example, you could have a <em>standard</em> blog post with a title and paragraphs, or a short <em>aside</em> that omits the title and contains a short text blurb. Please refer to the Codex for <a href="http://codex.wordpress.org/Post_Formats#Supported_Formats">descriptions of each post format</a>. Your theme could enable all or some of 10 possible formats.' ,'themefurnace') . '</p>' : '' ) .
		'<p>' . __('<strong>Featured Image</strong> - This allows you to associate an image with your post without inserting it. This is usually useful only if your theme makes use of the featured image as a post thumbnail on the home page, a custom header, etc.','themefurnace') . '</p>' .
		'<p>' . __('<strong>Send Trackbacks</strong> - Trackbacks are a way to notify legacy blog systems that you&#8217;ve linked to them. Enter the URL(s) you want to send trackbacks. If you link to other WordPress sites they&#8217;ll be notified automatically using pingbacks, and this field is unnecessary.','themefurnace') . '</p>' .
		'<p>' . __('<strong>Discussion</strong> - You can turn comments and pings on or off, and if there are comments on the post, you can see them here and moderate them.','themefurnace') . '</p>' .
		'<p><strong>' . __('For more information:','themefurnace') . '</strong></p>' .
		'<p>' . __('<a href="http://codex.wordpress.org/Posts_Add_New_Screen" target="_blank">Documentation on Writing and Editing Posts</a>','themefurnace') . '</p>' .
		'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>','themefurnace') . '</p>';
  } elseif ( 'edit-portfolio' == $screen->id ) {
    $contextual_help = 
	    '<p>' . __('You can customize the display of this screen in a number of ways:','themefurnace') . '</p>' .
		'<ul>' .
		'<li>' . __('You can hide/display columns based on your needs and decide how many posts to list per screen using the Screen Options tab.','themefurnace') . '</li>' .
		'<li>' . __('You can filter the list of posts by post status using the text links in the upper left to show All, Published, Draft, or Trashed posts. The default view is to show all posts.','themefurnace') . '</li>' .
		'<li>' . __('You can view posts in a simple title list or with an excerpt. Choose the view you prefer by clicking on the icons at the top of the list on the right.','themefurnace') . '</li>' .
		'<li>' . __('You can refine the list to show only posts in a specific category or from a specific month by using the dropdown menus above the posts list. Click the Filter button after making your selection. You also can refine the list by clicking on the post author, category or tag in the posts list.','themefurnace') . '</li>' .
		'</ul>' .
		'<p>' . __('Hovering over a row in the posts list will display action links that allow you to manage your post. You can perform the following actions:','themefurnace') . '</p>' .
		'<ul>' .
		'<li>' . __('Edit takes you to the editing screen for that post. You can also reach that screen by clicking on the post title.','themefurnace') . '</li>' .
		'<li>' . __('Quick Edit provides inline access to the metadata of your post, allowing you to update post details without leaving this screen.','themefurnace') . '</li>' .
		'<li>' . __('Trash removes your post from this list and places it in the trash, from which you can permanently delete it.','themefurnace') . '</li>' .
		'<li>' . __('Preview will show you what your draft post will look like if you publish it. View will take you to your live site to view the post. Which link is available depends on your post&#8217;s status.','themefurnace') . '</li>' .
		'</ul>' .
		'<p>' . __('You can also edit multiple posts at once. Select the posts you want to edit using the checkboxes, select Edit from the Bulk Actions menu and click Apply. You will be able to change the metadata (categories, author, etc.) for all selected posts at once. To remove a post from the grouping, just click the x next to its name in the Bulk Edit area that appears.','themefurnace') . '</p>' .
		'<p><strong>' . __('For more information:','themefurnace') . '</strong></p>' .
		'<p>' . __('<a href="http://codex.wordpress.org/Posts_Screen" target="_blank">Documentation on Managing Posts</a>','themefurnace') . '</p>' .
		'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>','themefurnace') . '</p>';

  }
  return $contextual_help;
}

add_action( 'contextual_help', 'portfolioposttype_add_help_text', 10, 3 );