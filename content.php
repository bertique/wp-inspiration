<?php
/**
 * @package Gridster
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class("poste"); ?>>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb', array('class' => 'postimg')); ?></a>
<div class="portfoliooverlay"><a href="<?php the_permalink(); ?>"><span>+</span></a></div>
<h2 class="posttitle"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<p class="postmeta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'themefurnace' ) );
				if ( $categories_list && themefurnace_categorized_blog() ) :
			?>
				<?php printf( __( '%1$s', 'themefurnace' ), $categories_list ); ?>
			<?php endif; // End if categories ?>


		<?php endif; // End if 'post' == get_post_type() ?>
</p>
</div><!-- post -->
