<?php
/**
 * The template for displaying posts.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<header class="post-header">

	<?php heightwind_content_header_top(); ?>

	<?php if ( is_single() ) : ?>
		<h1 class="post-title" data-text="<?php the_title_attribute(); ?>"><?php the_title(); ?></h1>
	<?php else : ?>
		<?php /* translators: %s: Post title */ ?>
		<h1 class="post-title" data-text="<?php the_title_attribute(); ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'heightwind' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php endif; ?>

	<?php heightwind_content_header_bottom(); ?>

</header><!-- /.post-header -->

<section class="article-content">

	<?php

		heightwind_content_entry_top();

		the_content( __( 'Continue Reading...', 'heightwind' ) );

		wp_link_pages();

		heightwind_content_entry_bottom();

	?>

</section><!-- /.article-content -->