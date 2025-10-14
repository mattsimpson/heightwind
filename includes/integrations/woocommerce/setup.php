<?php
/**
 * Contains code which makes HeightWind compatible with WooThemes' WooCommerce eCommerce plugin.
 * http://www.woothemes.com/woocommerce/
 * @since  2.0.0
 */

// Declare WooCommerce support
add_action( 'after_setup_theme', 'heightwind_supports_woocommerce' );


// Add options to the customizer
add_action( 'customize_register', 'heightwind_woocommerce_customize_register' );


// Prepare WooCommerce, fix the layout etc
add_action( 'wp', 'heightwind_woocommerce_prep' );


// Add the fullwidth class to the body tag if specified in the options
add_filter( 'body_class', 'heightwind_woocommerce_layout_classes' );


// Header cart functions
add_filter( 'wp_nav_menu_items', 'heightwind_woocommerce_header_cart', 10, 2 );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'heightwind_woocommerce_cart_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'heightwind_woocommerce_cart_fragment' );
}


// Product search functions
add_action( 'heightwind_content_before', 'heightwind_woocommerce_product_search' );


// Add style
add_action( 'wp_enqueue_scripts', 'heightwind_woocommerce_setup_styles', 999 );