<?php
/**
 * The loop template.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php heightwind_entry_before(); ?>

<div id="post-wrap" class="post-wrap">

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php heightwind_entry_top(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php heightwind_entry_bottom(); ?>

	</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; ?>

</div><!--/.post-wrap-->

<?php heightwind_entry_after(); ?>