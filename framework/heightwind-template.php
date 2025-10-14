<?php
/**
 * HeightWind template functions
 * @package heightwind
 * @since 2.0.0
 */

/**
 * Skip to Content Link
 * Accessibility feature to skip navigation
 * @since 2.0.0
 * Hooked into heightwind_body_top()
 */
if ( ! function_exists( 'heightwind_skip_to_content' ) ) {
	function heightwind_skip_to_content() {
		?>
		<a href="#main-content" class="skip-link screen-reader-text">
			<?php _e( 'Skip to content', 'heightwind' ); ?>
		</a>
		<?php
	}
}


/**
 * Navigation Toggle
 * This anchor is used to skip to the navigation if no CSS is loaded and
 * to toggle the display of the navigation on small screens
 * @since 2.0.0
 * Hooked into heightwind_header()
 */
if ( ! function_exists( 'heightwind_navigation_toggle' ) ) {
	function heightwind_navigation_toggle() {
		?>
		<p class="toggle-container">
			<a href="#navigation" class="nav-toggle button">
				<?php _e( 'Skip to navigation', 'heightwind' ); ?>
			</a>
		</p>
		<?php
	}
}


/**
 * Site title
 * Displays the gravatar, site title and description
 * Hooked into heightwind_header()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_site_title' ) ) {
	function heightwind_site_title() {
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="site-intro">
				<?php
					do_action( 'heightwind_site_title_link' );
					if ( apply_filters( 'heightwind_header_gravatar', true ) ) {
						echo get_avatar( apply_filters( 'heightwind_header_gravatar_email', $email = esc_attr( get_option( 'admin_email' ) ) ), 256, '', esc_attr( get_bloginfo( 'name' ) ) );
					}
				?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>
		<?php
	}
}


/**
 * Main Navigation
 * Displays the main navigation
 * Hooked into heightwind_header()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_main_navigation' ) ) {
	function heightwind_main_navigation() {
		?>

		<?php do_action( 'heightwind_navigation_before' ); ?>

		<nav class="main-nav" id="navigation" role="navigation">

			<?php do_action( 'heightwind_navigation_top' ); ?>

			<ul class="buttons">
				<li class="home"><a href="<?php echo esc_url( home_url() ); ?>" class="nav-home button"><span><?php _e( 'Home', 'heightwind' ); ?></span></a></li>
				<li class="close"><a href="#top" class="nav-close button"><span><?php _e( 'Return to Content', 'heightwind' ); ?></span></a></li>
			</ul>
			<hr />
			<h2><?php echo esc_html( heightwind_get_menu_name( 'main' ) ); ?></h2>
			<?php wp_nav_menu( array(
				'theme_location' => 'main',
				'menu_class' => 'menu',
				'container_class' => 'heightwind-navigation',
				'fallback_cb' => '' )
			); ?>

			<?php do_action( 'heightwind_navigation_bottom' ); ?>

		</nav><!-- /.main-nav -->

		<?php do_action( 'heightwind_navigation_after' ); ?>

		<?php
	}
}


/**
 * Sidebar
 * Displays the sidebar
 * Hooked into heightwind_content_after()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_sidebar' ) ) {
	function heightwind_sidebar() {
		if ( ! is_page_template( 'templates/template-fullwidth.php' ) ) {
			if ( is_page() ) {
				get_sidebar( 'page' );
			} else if ( is_single() ) {
				get_sidebar( 'post' );
			} else {
				get_sidebar();
			}
		}
	}
}


/**
 * Post Meta
 * Hooked into heightwind_entry_bottom()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_post_meta' ) ) {
	function heightwind_post_meta() {
		if ( ! is_page() ) {
		?>
		<aside class="post-meta">
			<ul>
				<li class="categories"><?php the_category( ', ' ); ?></li>
				<li class="comment"><?php comments_popup_link( __( '0 Comments', 'heightwind' ), __( '1 Comment', 'heightwind' ), __( '% Comments', 'heightwind' ) ); ?></li>
				<?php the_tags( '<li class="tags">', ', ','</li>' ); ?>
				<?php if ( apply_filters( 'heightwind_meta_author', true ) ) { ?>
					<li class="author"><?php if ( apply_filters( 'heightwind_meta_author_link', true ) ) { the_author_posts_link(); } else { the_author(); } ?></li>
				<?php } // endif ?>
			</ul>
		</aside><!-- /.post-meta -->
		<?php
		}
	}
}


/**
 * Post Time
 * Hooked in to heightwind_content_header_top()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_post_date' ) ) {
	function heightwind_post_date() {
		if ( ! is_page() && ! is_404() ) {
		?>
			<time class="post-date"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'heightwind' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a></time>
		<?php
		}
	}
}


/**
 * Comments Navigation
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_comment_navigation' ) ) {
	function heightwind_comment_navigation() {
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
			<nav class="navigation navigation-comments">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'heightwind' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'heightwind' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'heightwind' ) ); ?></div>
			</nav>
		<?php } // check for comment navigation
	}
}


/**
 * Content navigation
 * Hooked into heightwind_content_bottom
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_content_nav' ) ) {
	function heightwind_content_nav() {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

		?>
		<nav role="navigation" class="<?php echo esc_attr( $nav_class ); ?>">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'heightwind' ); ?></h1>

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '', 'Previous post link', 'heightwind' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'heightwind' ) . '</span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'heightwind' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'heightwind' ) ); ?></div>
			<?php endif; ?>

		<?php endif; ?>

		</nav>
		<?php
	}
}

/**
 * Comment Template
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_comment' ) ) {
	function heightwind_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php } ?>
			<div class="comment-author vcard">
				<?php if ( $args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>

				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="date-link"><?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'heightwind' ), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__( 'Edit', 'heightwind' ),'  ','' );
					?>
				</div>
				<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>
			</div>
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') { ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'heightwind' ) ?></em>
					<br />
				<?php } ?>

				<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</div><!-- /.reply -->
			<?php if ( 'div' != $args['style'] ) { ?>
		</div><!-- /.comment-body -->
		<?php } ?>
	<?php
	}
}


/**
 * Comments Template
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_comments_template' ) ) {
	function heightwind_comments_template() {
		comments_template( '', true );
	}
}


/**
 * Featured Image
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_featured_image' ) ) {
	function heightwind_featured_image() {
		global $post;
		if ( ! is_404() ) {
			$post_image_size 	= apply_filters( 'heightwind_featured_image_size', 'large' );
			$post_image 		= get_the_post_thumbnail( $post->ID, $post_image_size );
			echo wp_kses_post( $post_image );
		}
	}
}


/**
 * Footer Widgets
 * Hooked into heightwind_footer
 * @since 2.0.0
 */
function heightwind_footer_widgets() {
	if ( is_active_sidebar( 'footer-sidebar-3' ) ) {
		$columns = 3;
	} elseif ( is_active_sidebar( 'footer-sidebar-2' ) ) {
		$columns = 2;
	} elseif ( is_active_sidebar( 'footer-sidebar-1' ) ) {
		$columns = 1;
	} else {
		$columns = 0;
	}
	?>
	<section class="footer-widgets columns-<?php echo absint( $columns ); ?>">

		<div class="footer-sidebar first">
			<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
		</div>

		<div class="footer-sidebar second">
			<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
		</div>

		<div class="footer-sidebar third">
			<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
		</div>

	</section>
	<?php
}


/**
 * Credit
 * Hooked into heightwind_footer
 * @since 2.0.0
 */
function heightwind_credit() {
	?>
	<p>
		<?php _e( 'Powered by', 'heightwind' ); ?> <a href="http://wordpress.org" title="WordPress.org">WordPress</a> &amp; <a href="http://jameskoster.co.uk/highwind/" title="<?php _e( 'HeightWind - Customisable and extendable WordPress theme', 'heightwind' ); ?>">HeightWind</a>.
	</p>
	<?php
}


/**
 * Back to top link
 * Hooked into heightwind_footer
 * @since 2.0.0
 */
function heightwind_back_to_top() {
	?>
		<a href="#top" class="back-to-top button">
			<?php apply_filters( 'heightwind_back_to_top_text', _e( 'Back to top', 'heightwind' ) ); ?>
		</a>
	<?php
}
