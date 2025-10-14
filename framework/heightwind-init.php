<?php
/**
 * Framework init
 * Loads options, template, functions, hooks
 * @package heightwind
 * @since 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


require_once( get_template_directory() . '/framework/heightwind-functions.php' );
require_once( get_template_directory() . '/framework/heightwind-template.php' );
require_once( get_template_directory() . '/framework/heightwind-hooks.php' );
require_once( get_template_directory() . '/framework/heightwind-options.php' );
require_once( get_template_directory() . '/framework/tha-theme-hooks.php' );