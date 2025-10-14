<?php
/**
 * The template for displaying pages.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<header class="page-header">

	<?php heightwind_content_header_top(); ?>

	<h1 class="page-title" data-text="<?php the_title_attribute(); ?>"><?php the_title(); ?></h1>

	<?php heightwind_content_header_bottom(); ?>

</header><!-- /.page-header -->

<section class="article-content">

	<?php

		heightwind_content_entry_top();

		the_content();

		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'heightwind' ) . '</span>', 'after' => '</div>' ) );

		heightwind_content_entry_bottom();

	?>

</section><!-- /.article-content -->