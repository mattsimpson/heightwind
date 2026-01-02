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


}


/**
 * Custom background support
 *
 * @since 2.0.0
 * @deprecated 2.1.0 Background colors now managed by Color Scheme system
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
 * Enqueue Customizer controls script
 *
 * @since 2.1.0
 */
function heightwind_customize_controls_js() {
    wp_enqueue_script(
        'heightwind-customizer-controls',
        get_template_directory_uri() . '/framework/js/customizer-controls.js',
        array( 'customize-controls', 'jquery' ),
        '2.1.0',
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'heightwind_customize_controls_js' );


/**
 * Output color scheme CSS custom properties
 *
 * @since 2.1.0
 */
function heightwind_color_scheme_css() {
    // Get light scheme colors
    // Get light scheme colors with sanitization
    $light_bg      = sanitize_hex_color( get_theme_mod( 'heightwind_light_bg', '#f8f8f9' ) );
    $light_surface = sanitize_hex_color( get_theme_mod( 'heightwind_light_surface', '#ffffff' ) );
    $light_text    = sanitize_hex_color( get_theme_mod( 'heightwind_light_text', '#666A76' ) );
    $light_heading = sanitize_hex_color( get_theme_mod( 'heightwind_light_heading', '#444854' ) );
    $light_accent  = sanitize_hex_color( get_theme_mod( 'heightwind_light_accent', '#53a1b8' ) );

    // Get dark scheme colors with sanitization
    $dark_bg      = sanitize_hex_color( get_theme_mod( 'heightwind_dark_bg', '#1a1a2e' ) );
    $dark_surface = sanitize_hex_color( get_theme_mod( 'heightwind_dark_surface', '#16213e' ) );
    $dark_text    = sanitize_hex_color( get_theme_mod( 'heightwind_dark_text', '#e0e0e0' ) );
    $dark_heading = sanitize_hex_color( get_theme_mod( 'heightwind_dark_heading', '#ffffff' ) );
    $dark_accent  = sanitize_hex_color( get_theme_mod( 'heightwind_dark_accent', '#6bc5db' ) );

    // Calculate accent hover colors (slightly lighter/darker)
    $light_accent_hover = heightwind_adjust_brightness( $light_accent, -15 );
    $dark_accent_hover  = heightwind_adjust_brightness( $dark_accent, 15 );
    ?>
    <style id="heightwind-color-scheme-css">
        /* Light Scheme - Customizer values override compiled defaults via cascade */
        :root,
        [data-color-scheme="light"] {
            --hw-color-bg: <?php echo esc_attr( sanitize_hex_color( $light_bg ) ); ?>;
            --hw-color-surface: <?php echo esc_attr( sanitize_hex_color( $light_surface ) ); ?>;
            --hw-color-text: <?php echo esc_attr( sanitize_hex_color( $light_text ) ); ?>;
            --hw-color-heading: <?php echo esc_attr( sanitize_hex_color( $light_heading ) ); ?>;
            --hw-color-accent: <?php echo esc_attr( sanitize_hex_color( $light_accent ) ); ?>;
            --hw-color-accent-hover: <?php echo esc_attr( sanitize_hex_color( $light_accent_hover ) ); ?>;
        }

        /* Dark Scheme */
        [data-color-scheme="dark"] {
            --hw-color-bg: <?php echo esc_attr( sanitize_hex_color( $dark_bg ) ); ?>;
            --hw-color-surface: <?php echo esc_attr( sanitize_hex_color( $dark_surface ) ); ?>;
            --hw-color-text: <?php echo esc_attr( sanitize_hex_color( $dark_text ) ); ?>;
            --hw-color-heading: <?php echo esc_attr( sanitize_hex_color( $dark_heading ) ); ?>;
            --hw-color-accent: <?php echo esc_attr( sanitize_hex_color( $dark_accent ) ); ?>;
            --hw-color-accent-hover: <?php echo esc_attr( sanitize_hex_color( $dark_accent_hover ) ); ?>;
        }

        /* Auto Scheme - Dark Mode */
        @media (prefers-color-scheme: dark) {
            [data-color-scheme="auto"] {
                --hw-color-bg: <?php echo esc_attr( sanitize_hex_color( $dark_bg ) ); ?>;
                --hw-color-surface: <?php echo esc_attr( sanitize_hex_color( $dark_surface ) ); ?>;
                --hw-color-text: <?php echo esc_attr( sanitize_hex_color( $dark_text ) ); ?>;
                --hw-color-heading: <?php echo esc_attr( sanitize_hex_color( $dark_heading ) ); ?>;
                --hw-color-accent: <?php echo esc_attr( sanitize_hex_color( $dark_accent ) ); ?>;
                --hw-color-accent-hover: <?php echo esc_attr( sanitize_hex_color( $dark_accent_hover ) ); ?>;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'heightwind_color_scheme_css', 100 );


/**
 * Adjust color brightness using HSL color space
 *
 * @since 2.1.0
 * @param string $hex Hex color code
 * @param int $steps Steps to adjust (-255 to 255)
 * @return string Adjusted hex color
 */
function heightwind_adjust_brightness( $hex, $steps ) {
    // Remove # if present
    $hex = ltrim( $hex, '#' );

    // Expand shorthand form (#abc) to full form (#aabbcc)
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    if ( strlen( $hex ) !== 6 ) {
        return '#000000';
    }

    // Convert to RGB
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );

    // Convert RGB to HSL
    $hsl = heightwind_rgb_to_hsl( $r, $g, $b );

    // Map steps (-255..255) to lightness adjustment (-1..1)
    $delta_l = $steps / 255;
    $hsl['l'] = max( 0, min( 1, $hsl['l'] + $delta_l ) );

    // Convert back to RGB
    $rgb = heightwind_hsl_to_rgb( $hsl['h'], $hsl['s'], $hsl['l'] );

    return sprintf( '#%02x%02x%02x', $rgb['r'], $rgb['g'], $rgb['b'] );
}

/**
 * Convert RGB to HSL
 *
 * @since 2.1.0
 * @param int $r Red (0-255)
 * @param int $g Green (0-255)
 * @param int $b Blue (0-255)
 * @return array Array with h (0-360), s (0-1), l (0-1)
 */
function heightwind_rgb_to_hsl( $r, $g, $b ) {
    $r /= 255;
    $g /= 255;
    $b /= 255;

    $max = max( $r, $g, $b );
    $min = min( $r, $g, $b );
    $l = ( $max + $min ) / 2;

    if ( $max === $min ) {
        $h = 0;
        $s = 0;
    } else {
        $d = $max - $min;
        $s = $l > 0.5 ? $d / ( 2 - $max - $min ) : $d / ( $max + $min );

        if ( $max === $r ) {
            $h = ( $g - $b ) / $d + ( $g < $b ? 6 : 0 );
        } elseif ( $max === $g ) {
            $h = ( $b - $r ) / $d + 2;
        } else {
            $h = ( $r - $g ) / $d + 4;
        }

        $h *= 60;
    }

    return array(
        'h' => $h,
        's' => $s,
        'l' => $l,
    );
}

/**
 * Convert HSL to RGB
 *
 * @since 2.1.0
 * @param float $h Hue in degrees (0-360)
 * @param float $s Saturation (0-1)
 * @param float $l Lightness (0-1)
 * @return array Array with r, g, b (0-255)
 */
function heightwind_hsl_to_rgb( $h, $s, $l ) {
    if ( $s === 0 ) {
        $r = $g = $b = $l; // achromatic
    } else {
        $c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
        $hh = fmod( $h, 360 ) / 60;
        $x = $c * ( 1 - abs( fmod( $hh, 2 ) - 1 ) );
        $m = $l - $c / 2;

        if ( $hh >= 0 && $hh < 1 ) {
            $r = $c;
            $g = $x;
            $b = 0;
        } elseif ( $hh >= 1 && $hh < 2 ) {
            $r = $x;
            $g = $c;
            $b = 0;
        } elseif ( $hh >= 2 && $hh < 3 ) {
            $r = 0;
            $g = $c;
            $b = $x;
        } elseif ( $hh >= 3 && $hh < 4 ) {
            $r = 0;
            $g = $x;
            $b = $c;
        } elseif ( $hh >= 4 && $hh < 5 ) {
            $r = $x;
            $g = 0;
            $b = $c;
        } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }

        $r = $r + $m;
        $g = $g + $m;
        $b = $b + $m;
    }

    return array(
        'r' => round( max( 0, min( 1, $r ) ) * 255 ),
        'g' => round( max( 0, min( 1, $g ) ) * 255 ),
        'b' => round( max( 0, min( 1, $b ) ) * 255 ),
    );
}
