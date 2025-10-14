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
         * Theme Option Defaults
         */

        $wp_customize->get_setting( 'background_color' )->default = '#f8f8f9';

        // Layout Default
        $wp_customize->add_setting( 'heightwind_theme_options[theme_layout]', array(
            'type'              => 'option',
            'default'           => apply_filters( 'heightwind_layout_default', 'sidebar-content' ),
            'sanitize_callback' => 'sanitize_key',
        ) );

        // Link Color Default
        $wp_customize->add_setting( 'link_textcolor', array(
                'default'           => apply_filters( 'heightwind_link_textcolor_default', $color = '#53a1b8' ),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Heading Color Default
        $wp_customize->add_setting( 'headercolor', array(
                'default'           => apply_filters( 'heightwind_headercolor_default', $color = '#444854' ),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Text Color Default
        $wp_customize->add_setting( 'textcolor', array(
                'default'           => apply_filters( 'heightwind_textcolor_default', $color = '#666A76' ),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Background Color Default
        $wp_customize->add_setting( 'content_background_color', array(
                'default'           => apply_filters( 'heightwind_content_background_color_default', $color = '#f8f8f9' ),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );


        /**
         * Theme Option Sections
         */

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

        // Link Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
                'label'      => __( 'Link Color', 'heightwind' ),
                'section'    => 'colors',
                'settings'   => 'link_textcolor',
        ) ) );

        // Heading Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headercolor', array(
                'label'      => __( 'Header Color', 'heightwind' ),
                'section'    => 'colors',
                'settings'   => 'headercolor',
        ) ) );

        // Text Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'textcolor', array(
                'label'      => __( 'Text Color', 'heightwind' ),
                'section'    => 'colors',
                'settings'   => 'textcolor',
        ) ) );

        // Background Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
                'label'      => __( 'Background Color', 'heightwind' ),
                'section'    => 'colors',
                'settings'   => 'background_color',
        ) ) );

        // Content Background Color Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_background_color', array(
                'label'      => __( 'Content Background Color', 'heightwind' ),
                'section'    => 'colors',
                'settings'   => 'content_background_color',
        ) ) );

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
     * This will output the custom WordPress settings to the theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     */
    public static function heightwind_render() {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
                <?php
                    // Link color applied to color
                    self::generate_css( apply_filters( 'heightwind_link_color_color_selectors', $selectors = 'a' ), 'color', 'link_textcolor' );

                    // Link color applied to background
                    self::generate_css( apply_filters( 'heightwind_link_color_background_selectors', $selectors = 'input[type="submit"], .button, input[type="button"], .navigation-post a, .navigation-paging a, .header, .comments .bypostauthor > .comment-body .comment-content' ), 'background-color', 'link_textcolor' );

                    // Text color applied to color
                    self::generate_css( apply_filters( 'heightwind_text_color_color_selectors', $selectors = 'body, input[type="text"], input[type="password"], input[type="email"], input[type="search"], input.input-text, textarea' ), 'color', 'textcolor' );

                    // Link color applied to border-color
                    self::generate_css( apply_filters( 'heightwind_link_color_border_color_selectors', $selectors = '.comments .bypostauthor > .comment-body .comment-content:after' ), 'border-bottom-color', 'link_textcolor' );

                    // Text color applied to background
                    self::generate_css( apply_filters( 'heightwind_text_color_background_selectors', $selectors = 'hr, input[type="checkbox"], input[type="radio"]' ), 'background', 'textcolor' );

                    // Text color applied to border color
                    self::generate_css( apply_filters( 'heightwind_text_color_border_color_selectors', $selectors = 'input[type="radio"]' ), 'border-color', 'textcolor' );

                    // Header color applied to color
                    self::generate_css( apply_filters( 'heightwind_header_color_color_selectors', $selectors = 'h1, h2, h3, h4, h5, h6, .alpha, .beta, .gamma, .delta, .page-title, .post-title' ), 'color', 'headercolor' );

                    // Content Background color applied to color
                    self::generate_css( apply_filters( 'heightwind_background_color_color_selectors', $selectors = 'input[type="submit"], .button, input[type="button"], .navigation-post a, .navigation-paging a, input[type="checkbox"]:before, input[type="checkbox"]:checked:before, .comments .bypostauthor > .comment-body .comment-content, .comments .bypostauthor > .comment-body .comment-content a' ), 'color', 'content_background_color' );

                    // Content Background color applied to border-color
                    self::generate_css( apply_filters( 'heightwind_background_color_border_color_selectors', $selectors = '.comments .comment-content:after' ), 'border-bottom-color', 'content_background_color' );

                    // Content Background color applied to background
                    self::generate_css( apply_filters( 'heightwind_content_background_color_background_selectors', $selectors = '.inner-wrap, .main-nav' ), 'background-color', 'content_background_color' );
                ?>
                @media only screen and (min-width: 769px) {
                    /* Styles only applied to desktop */
                    <?php
                        // Link color applied to background
                        self::generate_css( apply_filters( 'heightwind_desktop_link_color_background_selectors',  $selectors = '.main-nav ul.menu ul, .main-nav ul.menu > li:hover > a, .main-nav ul.menu > li > a:hover' ), 'background', 'link_textcolor' );

                        // Link color applied to color
                        self::generate_css( apply_filters( 'heightwind_desktop_link_color_background_selectors',  $selectors = '.main-nav ul.menu li.current-menu-item > a' ), 'color', 'link_textcolor', '#' );

                        // Link color applied to border-color
                        self::generate_css( apply_filters( 'heightwind_desktop_link_color_border_color_selectors',  $selectors = '.main-nav' ), 'border-color', 'link_textcolor' );

                        // Link color applied to border-bottom-color
                        self::generate_css( apply_filters( 'heightwind_desktop_link_color_border_color_selectors',  $selectors = '.main-nav ul.menu li.current-menu-item > a:before' ), 'border-bottom-color', 'link_textcolor' );

                        // Content Background color applied to color
                        self::generate_css( apply_filters( 'heightwind_desktop_background_color_color_selectors', $selectors = '.main-nav ul.menu ul a, .main-nav ul.menu > li:hover > a' ), 'color', 'content_background_color', '#' );

                        // Background color applied to background
                        self::generate_css( apply_filters( 'heightwind_desktop_background_color_background_selectors', $selectors = 'body' ), 'background-color', 'background_color', '#' );
                    ?>
                }
        </style>
        <!--/Customizer CSS-->
        <?php
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * A custom helper function used within this class to keep code clean.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS property to modify
     * @param string $mod_name The name of the theme_mod option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since 2.0.0
     */
    public static function generate_css($selector,$style,$mod_name,$prefix='',$postfix='',$echo=true) {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if ( ! empty( $mod ) )
        {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
            if ( $echo )
            {
                echo $return;
            }
        }
        return $return;
    }

}


/**
 * Custom background
 * @var default background color
 */
function heightwind_custom_background() {
    $args = array(
        'default-color' => apply_filters( 'heightwind_background_color_default', $color = '#f8f8f9' )
    );
    add_theme_support( 'custom-background', $args );
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
 */
function heightwind_layout_classes( $existing_classes ) {
    $options                    = heightwind_get_theme_options();
    $current_layout             = $options['theme_layout'];
    $background_color           = str_replace( '#', '', get_theme_mod( 'background_color' ) );
    $content_background_color   = str_replace( '#', '', get_theme_mod( 'content_background_color' ) );

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

    if ( $background_color == $content_background_color ) {
        $classes[] = 'no-background-contrast';
    } else {
        $classes[] = 'background-contrast';
    }

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