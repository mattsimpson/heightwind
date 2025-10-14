<?php
/**
 * The template for displaying 404 pages (Not Found).
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

		<?php heightwind_content_header_top(); ?>

		<h1 class="page-title" data-text="<?php the_title(); ?>"><?php _e( '404 not found', 'heightwind' ); ?></h1>

		<?php heightwind_content_header_bottom(); ?>

	</header><!-- /.page-header -->

	<section class="article-content">

		<?php heightwind_content_entry_top(); ?>

		<p><?php _e( 'It seems the page you\'re looking for no longer (or indeed never did) exists at this location. Please try searching...', 'heightwind' ); ?>

		<?php

			// Display a search form and some helpful widgets

			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'heightwind' ) ) . '</p>';

			get_search_form();

			the_widget( 'WP_Widget_Recent_Posts' );

			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

			the_widget( 'WP_Widget_Tag_Cloud' );
		?>

		<?php heightwind_content_entry_bottom(); ?>

	</section>

	<?php heightwind_content_bottom(); ?>

</section>

<?php heightwind_content_after(); ?>

<?php get_footer(); ?>