<?php

/**
 * Declare Jetpack Infinite Scroll support
 * @since  2.0.0
 */
function heightwind_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
		'container'			=> 'post-wrap',
		'footer_widgets'	=> array( 'primary-sidebar', 'footer-sidebar-1', 'footer-sidebar-2', 'footer-sidebar-3' ),
		'footer'			=> 'inner-wrapper',
	) );
}
add_action( 'after_setup_theme', 'heightwind_infinite_scroll_init' );
function heightwind_infinite_scroll_archive_support() {
	$supported = current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() );

	return $supported;
}
add_filter( 'infinite_scroll_archive_supported', 'heightwind_infinite_scroll_archive_support' );