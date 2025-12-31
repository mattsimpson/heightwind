<?php
/**
 * Contains the HeightWind Options class and other options functions
 * @package heightwind
 * @since 2.0.0
 * @link http://codex.wordpress.org/Theme_Customization_API
 */


/**
 * Options Class
 */
class HeightWindOptions {

    /**
     * Registers the settings with WordPress.
     *
     * Used by hook: 'customize_register'
     *
     * @see add_action('customize_register',$func)
     * @param WP_Customize_Manager $wp_customize
     */
    public static function heightwind_register( $wp_customize ) {
        /**
         * Theme Option Settings
         * @since 2.1.0 - Legacy color settings removed, replaced with Color Scheme system
         */

        // Layout Setting
        $wp_customize->add_setting( 'heightwind_theme_options[theme_layout]', array(
            'type'              => 'option',
            'default'           => apply_filters( 'heightwind_layout_default', 'sidebar-content' ),
            'sanitize_callback' => 'sanitize_key',
        ) );

        // Enable Dark Mode Setting
        $wp_customize->add_setting( 'heightwind_dark_mode_enabled', array(
            'default'           => true,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport'         => 'refresh',
        ) );

        // Color Scheme Mode Setting
        $wp_customize->add_setting( 'heightwind_color_scheme', array(
            'default'           => 'auto',
            'sanitize_callback' => 'heightwind_sanitize_color_scheme',
            'transport'         => 'postMessage',
        ) );

        // Light Scheme Colors
        $wp_customize->add_setting( 'heightwind_light_bg', array(
            'default'           => '#f8f8f9',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_light_surface', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_light_text', array(
            'default'           => '#666A76',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_light_heading', array(
            'default'           => '#444854',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_light_accent', array(
            'default'           => '#53a1b8',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        // Dark Scheme Colors
        $wp_customize->add_setting( 'heightwind_dark_bg', array(
            'default'           => '#1a1a2e',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_dark_surface', array(
            'default'           => '#16213e',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_dark_text', array(
            'default'           => '#e0e0e0',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_dark_heading', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $wp_customize->add_setting( 'heightwind_dark_accent', array(
            'default'           => '#6bc5db',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );


        /**
         * Theme Option Sections
         */

        // Color Scheme Section
        $wp_customize->add_section( 'heightwind_color_scheme', array(
            'title'       => __( 'Color Scheme', 'heightwind' ),
            'description' => __( 'Choose between light, dark, or automatic color scheme. Customize colors for each scheme below.', 'heightwind' ),
            'priority'    => 25,
        ) );

        // Navigation Section
        $wp_customize->add_section( 'nav', array(
             'title'          => __( 'Navigation', 'heightwind' ),
             'theme_supports' => 'menus',
             'priority'       => 100,
        ) );

        // Layout Section
        $wp_customize->add_section( 'heightwind_layout', array(
            'title'    => __( 'Layout', 'heightwind' ),
            'priority' => 50,
        ) );


        /**
         * Theme Option Controls
         */

        // Enable Dark Mode Control
        $wp_customize->add_control( 'heightwind_dark_mode_enabled', array(
            'label'       => __( 'Enable Dark Mode', 'heightwind' ),
            'description' => __( 'Allow visitors to switch between light and dark color schemes.', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
            'type'        => 'checkbox',
            'priority'    => 5,
        ) );

        // Color Scheme Mode Control (only shown when dark mode is enabled)
        $wp_customize->add_control( 'heightwind_color_scheme', array(
            'label'           => __( 'Color Scheme Mode', 'heightwind' ),
            'description'     => __( 'Select how the color scheme is determined.', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'type'            => 'radio',
            'choices'         => array(
                'auto'  => __( 'Auto (Browser Preference)', 'heightwind' ),
                'light' => __( 'Light', 'heightwind' ),
                'dark'  => __( 'Dark', 'heightwind' ),
            ),
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) );

        // Light Scheme Color Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_light_bg', array(
            'label'       => __( 'Light: Background', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_light_surface', array(
            'label'       => __( 'Light: Surface', 'heightwind' ),
            'description' => __( 'Content areas and cards', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_light_text', array(
            'label'       => __( 'Light: Text', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_light_heading', array(
            'label'       => __( 'Light: Headings', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_light_accent', array(
            'label'       => __( 'Light: Accent', 'heightwind' ),
            'description' => __( 'Links, buttons, and header', 'heightwind' ),
            'section'     => 'heightwind_color_scheme',
        ) ) );

        // Dark Scheme Color Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_dark_bg', array(
            'label'           => __( 'Dark: Background', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_dark_surface', array(
            'label'           => __( 'Dark: Surface', 'heightwind' ),
            'description'     => __( 'Content areas and cards', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_dark_text', array(
            'label'           => __( 'Dark: Text', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_dark_heading', array(
            'label'           => __( 'Dark: Headings', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heightwind_dark_accent', array(
            'label'           => __( 'Dark: Accent', 'heightwind' ),
            'description'     => __( 'Links, buttons, and header', 'heightwind' ),
            'section'         => 'heightwind_color_scheme',
            'active_callback' => 'heightwind_dark_mode_enabled_callback',
        ) ) );

        // Legacy color controls removed in 2.1.0
        // Colors are now managed via the Color Scheme section which supports light/dark modes
        // The 'colors' section is hidden by removing all its controls

        // Layout Control
        $layouts = heightwind_layouts();
        $choices = array();
        foreach ( $layouts as $layout ) {
            $choices[$layout['value']] = $layout['label'];
        }
        $wp_customize->add_control( 'heightwind_theme_options[theme_layout]', array(
            'section'    => 'heightwind_layout',
            'type'       => 'radio',
            'choices'    => $choices,
        ) );
    }


    /**
     * Legacy render method - no longer outputs CSS
     *
     * @since 2.0.0
     * @since 2.1.0 - Removed legacy color output, now handled by Color Scheme system
     */
    public static function heightwind_render() {
        // Colors are now managed via heightwind_color_scheme_css()
        return;
    }

}


/**
 * Custom background support
 *
 * @since 2.0.0
 * @since 2.1.0 - Background colors now managed by Color Scheme system
 */
function heightwind_custom_background() {
    // Background colors are now handled by the Color Scheme system
    // This function is kept for backwards compatibility but no longer adds theme support
    return;
}


/**
 * Returns the options array for HeightWind.
 *
 * @since 2.0.0
 */
function heightwind_get_theme_options() {
    return get_option( 'heightwind_theme_options', heightwind_get_default_theme_options() );
}


/**
 * Returns the default options for HeightWind layout.
 *
 * @since 2.0.0
 */
function heightwind_get_default_theme_options() {
    $default_theme_options = array(
        'theme_layout'      => apply_filters( 'heightwind_layout_default', $layout = 'content-sidebar' ),
    );

    if ( is_rtl() )
        $default_theme_options['theme_layout'] = apply_filters( 'heightwind_layout_default', 'sidebar-content' );

    return apply_filters( 'heightwind_default_theme_options', $default_theme_options );
}


/**
 * Returns an array of layout options registered for HeightWind.
 *
 * @since 2.0.0
 */
function heightwind_layouts() {
    $layout_options = array(
        'content-sidebar' => array(
            'value' => 'content-sidebar',
            'label' => __( 'Content on left', 'heightwind' ),
        ),
        'sidebar-content' => array(
            'value' => 'sidebar-content',
            'label' => __( 'Content on right', 'heightwind' ),
        ),
    );

    return apply_filters( 'heightwind_layouts', $layout_options );
}


/**
 * Adds HeightWind layout classes to the array of body classes.
 *
 * @since 2.0.0
 * @since 2.1.0 - Removed legacy background color contrast check
 */
function heightwind_layout_classes( $existing_classes ) {
    $options        = heightwind_get_theme_options();
    $current_layout = $options['theme_layout'];

    if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
        $classes = array( 'two-column' );
    else
        $classes = array( 'one-column' );

    if ( 'content-sidebar' == $current_layout )
        $classes[] = 'content-sidebar';
    elseif ( 'sidebar-content' == $current_layout )
        $classes[] = 'sidebar-content';
    else
        $classes[] = $current_layout;

    $classes = apply_filters( 'heightwind_layout_classes', $classes, $current_layout );

    return array_merge( $existing_classes, $classes );
}

/**
 * Sanitize Checkboxes
 *
 * @since  2.0.0
 */
function heightwind_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}


/**
 * Sanitize Color Scheme
 *
 * @since 2.1.0
 */
function heightwind_sanitize_color_scheme( $input ) {
    $valid = array( 'light', 'dark', 'auto' );
    return in_array( $input, $valid, true ) ? $input : 'auto';
}


/**
 * Active callback for dark mode controls
 * Returns true if dark mode is enabled
 *
 * @since 2.1.0
 */
function heightwind_dark_mode_enabled_callback() {
    return get_theme_mod( 'heightwind_dark_mode_enabled', true );
}


/**
 * Enqueue Customizer preview script
 *
 * @since 2.1.0
 */
function heightwind_customize_preview_js() {
    wp_enqueue_script(
        'heightwind-customizer-preview',
        get_template_directory_uri() . '/framework/js/customizer-preview.js',
        array( 'customize-preview', 'jquery' ),
        '2.1.0',
        true
    );
}
add_action( 'customize_preview_init', 'heightwind_customize_preview_js' );


/**
 * Output color scheme CSS custom properties
 *
 * @since 2.1.0
 */
function heightwind_color_scheme_css() {
    // Get light scheme colors
    $light_bg      = get_theme_mod( 'heightwind_light_bg', '#f8f8f9' );
    $light_surface = get_theme_mod( 'heightwind_light_surface', '#ffffff' );
    $light_text    = get_theme_mod( 'heightwind_light_text', '#666A76' );
    $light_heading = get_theme_mod( 'heightwind_light_heading', '#444854' );
    $light_accent  = get_theme_mod( 'heightwind_light_accent', '#53a1b8' );

    // Get dark scheme colors
    $dark_bg      = get_theme_mod( 'heightwind_dark_bg', '#1a1a2e' );
    $dark_surface = get_theme_mod( 'heightwind_dark_surface', '#16213e' );
    $dark_text    = get_theme_mod( 'heightwind_dark_text', '#e0e0e0' );
    $dark_heading = get_theme_mod( 'heightwind_dark_heading', '#ffffff' );
    $dark_accent  = get_theme_mod( 'heightwind_dark_accent', '#6bc5db' );

    // Calculate accent hover colors (slightly lighter/darker)
    $light_accent_hover = heightwind_adjust_brightness( $light_accent, -15 );
    $dark_accent_hover  = heightwind_adjust_brightness( $dark_accent, 15 );
    ?>
    <style id="heightwind-color-scheme-css">
        /* Light Scheme - uses !important to override compiled defaults */
        :root,
        [data-color-scheme="light"] {
            --hw-color-bg: <?php echo esc_attr( $light_bg ); ?> !important;
            --hw-color-surface: <?php echo esc_attr( $light_surface ); ?> !important;
            --hw-color-text: <?php echo esc_attr( $light_text ); ?> !important;
            --hw-color-heading: <?php echo esc_attr( $light_heading ); ?> !important;
            --hw-color-accent: <?php echo esc_attr( $light_accent ); ?> !important;
            --hw-color-accent-hover: <?php echo esc_attr( $light_accent_hover ); ?> !important;
        }

        /* Dark Scheme */
        [data-color-scheme="dark"] {
            --hw-color-bg: <?php echo esc_attr( $dark_bg ); ?> !important;
            --hw-color-surface: <?php echo esc_attr( $dark_surface ); ?> !important;
            --hw-color-text: <?php echo esc_attr( $dark_text ); ?> !important;
            --hw-color-heading: <?php echo esc_attr( $dark_heading ); ?> !important;
            --hw-color-accent: <?php echo esc_attr( $dark_accent ); ?> !important;
            --hw-color-accent-hover: <?php echo esc_attr( $dark_accent_hover ); ?> !important;
        }

        /* Auto Scheme - Dark Mode */
        @media (prefers-color-scheme: dark) {
            [data-color-scheme="auto"] {
                --hw-color-bg: <?php echo esc_attr( $dark_bg ); ?> !important;
                --hw-color-surface: <?php echo esc_attr( $dark_surface ); ?> !important;
                --hw-color-text: <?php echo esc_attr( $dark_text ); ?> !important;
                --hw-color-heading: <?php echo esc_attr( $dark_heading ); ?> !important;
                --hw-color-accent: <?php echo esc_attr( $dark_accent ); ?> !important;
                --hw-color-accent-hover: <?php echo esc_attr( $dark_accent_hover ); ?> !important;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'heightwind_color_scheme_css', 100 );


/**
 * Adjust color brightness
 *
 * @since 2.1.0
 * @param string $hex Hex color code
 * @param int $steps Steps to adjust (-255 to 255)
 * @return string Adjusted hex color
 */
function heightwind_adjust_brightness( $hex, $steps ) {
    // Remove # if present
    $hex = ltrim( $hex, '#' );

    // Convert to RGB
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );

    // Adjust
    $r = max( 0, min( 255, $r + $steps ) );
    $g = max( 0, min( 255, $g + $steps ) );
    $b = max( 0, min( 255, $b + $steps ) );

    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}
