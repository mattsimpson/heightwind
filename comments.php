<?php
/**
 * The template for comments.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php heightwind_comments_before(); ?>

<div id="comments" class="comments<?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && is_page() ) { echo ' page-nocomments'; } ?>">

	<?php if ( post_password_required() ) : ?>

		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'heightwind' ); ?></p>

	</div><!-- #comments -->

	<?php
			return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php
				/* translators: 1: Number of comments, 2: Post title */
				printf( _n( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'heightwind' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( 'callback=heightwind_comment&avatar_size=' . apply_filters( 'heightwind_comment_avatar_size', $avatar_size = '96' ) ); ?>
		</ol>

		<?php heightwind_comment_navigation(); ?>

	<?php
		elseif ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && ! is_page() ) :
	?>

	<p class="nocomments"><?php _e( 'Comments are closed.', 'heightwind' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments -->

<?php heightwind_comments_after(); ?>
