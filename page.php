<?php
/**
 * The page template.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header();
?>

<?php heightwind_content_before(); ?>

<section class="content" role="main" id="main-content">

	<?php heightwind_content_top(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php heightwind_entry_top(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php heightwind_entry_bottom(); ?>

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; // end of the loop. ?>

	<?php heightwind_content_bottom(); ?>

</section><!-- /.content -->

<?php heightwind_content_after(); ?>

<?php get_footer(); ?>