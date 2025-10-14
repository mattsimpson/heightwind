<?php
/**
 * The search template.
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

	<header class="page-header">

		<?php /* translators: %s: Search query */ ?>
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'heightwind' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	</header><!-- .page-header -->

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>

		<?php get_template_part( 'loop' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">

			<header class="entry-header">

				<h1 class="entry-title"><?php _e( 'Nothing Found', 'heightwind' ); ?></h1>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'heightwind' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .entry-content -->

		</article><!-- #post-0 -->

	<?php endif; ?>

	<?php heightwind_content_bottom(); ?>

</section>

<?php heightwind_content_after(); ?>

<?php get_footer(); ?>