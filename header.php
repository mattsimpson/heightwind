<?php
/**
 * The header template.
 * @package heightwind
 * @since 2.0.0
 */
?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?><?php heightwind_html_before(); ?><!doctype html>
<html <?php language_attributes(); ?> class="no-js" data-color-scheme="<?php echo esc_attr( get_theme_mod( 'heightwind_color_scheme', 'auto' ) ); ?>">
<head>
	<?php heightwind_head_top(); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php // Color scheme early script to prevent flash of wrong colors ?>
	<script>
	(function() {
		// Skip localStorage override when in Customizer preview
		var isCustomizerPreview = window.parent && window.parent.wp && window.parent.wp.customize;
		var stored = isCustomizerPreview ? null : localStorage.getItem('heightwind-user-scheme');
		var admin = '<?php echo esc_js( get_theme_mod( 'heightwind_color_scheme', 'auto' ) ); ?>';
		var scheme = stored || admin;
		document.documentElement.setAttribute('data-color-scheme', scheme);
		if (stored) {
			document.documentElement.setAttribute('data-user-scheme', stored);
		}
	})();
	</script>

	<?php heightwind_head_bottom(); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php heightwind_body_top(); ?>

<div class="outer-wrap" id="top">

	<div class="inner-wrap">

	<?php heightwind_header_before(); ?>

	<header class="header content-wrapper" role="banner" style="background-image:url(<?php echo esc_url( header_image() ); ?>);">

		<?php heightwind_header(); ?>

	</header>

	<div class="content-wrapper">

	<?php heightwind_header_after(); ?>
