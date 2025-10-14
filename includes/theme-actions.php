<?php
/**
 * HeightWind actions
 * Functions hooked into actions
 * @package heightwind
 * @since 2.0.0
 */


/**
 * Setup / Init
 */
add_action( 'wp_enqueue_scripts',       		'heightwind_add_scripts' );							// HeightWind scripts
add_action( 'after_setup_theme',            	'heightwind_setup' );									// Set up the theme
add_action( 'widgets_init',                 	'heightwind_widgets_init' );							// Widgets
add_action( 'heightwind_body_top',            	'heightwind_skip_to_content', 1 );					// Skip to content link


/**
 * Header
 */
add_action( 'heightwind_header',                	'heightwind_navigation_toggle', 10 );     			// Site title
add_action( 'heightwind_header',                	'heightwind_site_title', 20 );          				// Site title
add_action( 'heightwind_header',                	'heightwind_main_navigation', 30 );     				// Navigation


/**
 * Content
 */
add_action( 'heightwind_content_bottom',   		'heightwind_content_nav', 10 );         				// Post navigation
add_action( 'heightwind_content_bottom',   		'heightwind_comments_template', 20 );     			// Comments
add_action( 'heightwind_content_header_top',		'heightwind_post_date', 10 );							// Post date
add_action( 'heightwind_entry_bottom', 			'heightwind_post_meta', 10 );			 				// Post meta
add_action( 'heightwind_content_entry_top',		'heightwind_featured_image', 20 );					// Adds the featured image to the_content
add_action( 'heightwind_content_after', 			'heightwind_sidebar' );                 				// The sidebar


/**
 * Footer
 */
add_action( 'heightwind_footer', 					'heightwind_footer_widgets', 10 );					// Footer widgets
#add_action( 'heightwind_footer',                	'heightwind_credit', 20 );         					// Credit link
add_action( 'heightwind_footer',                	'heightwind_back_to_top', 30 );         				// Back to top link


/**
 * Comments
 */
add_action( 'comment_form_defaults',        	'heightwind_move_textarea' );           				// Re-arrange comment form (text area first)
add_action( 'comment_form_top',             	'heightwind_move_textarea' );			 				// Re-arrange comment form (text area first)


/**
 * Options
 */
add_action( 'customize_register',   			array( 'HeightWindOptions' , 'heightwind_register' ) );	// Register the options
add_action( 'wp_head',              			array( 'HeightWindOptions' , 'heightwind_render' ) );	// Output the CSS
add_action( 'after_setup_theme',    			'heightwind_custom_background' );						// Custom Background
add_filter( 'body_class',           			'heightwind_layout_classes' );						// Layout classes based on options
