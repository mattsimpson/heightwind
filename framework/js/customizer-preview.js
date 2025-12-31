/**
 * HeightWind Customizer Live Preview
 *
 * Handles live preview updates for color scheme settings in the WordPress Customizer.
 *
 * @package heightwind
 * @since 2.1.0
 */
(function($) {
    'use strict';

    // Color values storage
    var colors = {
        light: {
            bg: '#f8f8f9',
            surface: '#ffffff',
            text: '#666A76',
            heading: '#444854',
            accent: '#53a1b8'
        },
        dark: {
            bg: '#1a1a2e',
            surface: '#16213e',
            text: '#e0e0e0',
            heading: '#ffffff',
            accent: '#6bc5db'
        }
    };

    // Current scheme
    var currentScheme = 'auto';

    /**
     * Initialize on DOM ready
     */
    $(document).ready(function() {
        // Get initial values from customizer
        initializeColors();

        // Get initial scheme
        if (wp.customize && wp.customize('heightwind_color_scheme')) {
            currentScheme = wp.customize('heightwind_color_scheme').get() || 'auto';
        }

        // Apply initial styles immediately
        applyColorScheme();

        // Also set up a small delay to ensure proper rendering
        setTimeout(applyColorScheme, 100);
    });

    /**
     * Initialize colors from customizer settings
     */
    function initializeColors() {
        // Light scheme
        if (wp.customize && wp.customize('heightwind_light_bg')) {
            colors.light.bg = wp.customize('heightwind_light_bg').get() || colors.light.bg;
        }
        if (wp.customize && wp.customize('heightwind_light_surface')) {
            colors.light.surface = wp.customize('heightwind_light_surface').get() || colors.light.surface;
        }
        if (wp.customize && wp.customize('heightwind_light_text')) {
            colors.light.text = wp.customize('heightwind_light_text').get() || colors.light.text;
        }
        if (wp.customize && wp.customize('heightwind_light_heading')) {
            colors.light.heading = wp.customize('heightwind_light_heading').get() || colors.light.heading;
        }
        if (wp.customize && wp.customize('heightwind_light_accent')) {
            colors.light.accent = wp.customize('heightwind_light_accent').get() || colors.light.accent;
        }

        // Dark scheme
        if (wp.customize && wp.customize('heightwind_dark_bg')) {
            colors.dark.bg = wp.customize('heightwind_dark_bg').get() || colors.dark.bg;
        }
        if (wp.customize && wp.customize('heightwind_dark_surface')) {
            colors.dark.surface = wp.customize('heightwind_dark_surface').get() || colors.dark.surface;
        }
        if (wp.customize && wp.customize('heightwind_dark_text')) {
            colors.dark.text = wp.customize('heightwind_dark_text').get() || colors.dark.text;
        }
        if (wp.customize && wp.customize('heightwind_dark_heading')) {
            colors.dark.heading = wp.customize('heightwind_dark_heading').get() || colors.dark.heading;
        }
        if (wp.customize && wp.customize('heightwind_dark_accent')) {
            colors.dark.accent = wp.customize('heightwind_dark_accent').get() || colors.dark.accent;
        }
    }

    /**
     * Apply color scheme by injecting CSS
     */
    function applyColorScheme() {
        var styleId = 'heightwind-customizer-preview-css';
        var $style = $('#' + styleId);

        if (!$style.length) {
            $style = $('<style id="' + styleId + '"></style>');
            $('head').append($style);
        }

        var lightAccentHover = adjustBrightness(colors.light.accent, -15);
        var darkAccentHover = adjustBrightness(colors.dark.accent, 15);

        var css = '';

        // Light scheme - applied to :root and [data-color-scheme="light"]
        css += ':root, [data-color-scheme="light"] {\n';
        css += '  --hw-color-bg: ' + colors.light.bg + ' !important;\n';
        css += '  --hw-color-surface: ' + colors.light.surface + ' !important;\n';
        css += '  --hw-color-text: ' + colors.light.text + ' !important;\n';
        css += '  --hw-color-heading: ' + colors.light.heading + ' !important;\n';
        css += '  --hw-color-accent: ' + colors.light.accent + ' !important;\n';
        css += '  --hw-color-accent-hover: ' + lightAccentHover + ' !important;\n';
        // Derived colors for light scheme
        css += '  --hw-color-border: rgba(0, 0, 0, 0.1) !important;\n';
        css += '  --hw-color-shadow: rgba(0, 0, 0, 0.05) !important;\n';
        css += '  --hw-color-input-bg: rgba(0, 0, 0, 0.05) !important;\n';
        css += '  --hw-color-code-bg: rgba(0, 0, 0, 0.05) !important;\n';
        css += '  --hw-color-code-text: #dc5494 !important;\n';
        css += '  --hw-color-on-accent: #ffffff !important;\n';
        css += '}\n\n';

        // Dark scheme
        css += '[data-color-scheme="dark"] {\n';
        css += '  --hw-color-bg: ' + colors.dark.bg + ' !important;\n';
        css += '  --hw-color-surface: ' + colors.dark.surface + ' !important;\n';
        css += '  --hw-color-text: ' + colors.dark.text + ' !important;\n';
        css += '  --hw-color-heading: ' + colors.dark.heading + ' !important;\n';
        css += '  --hw-color-accent: ' + colors.dark.accent + ' !important;\n';
        css += '  --hw-color-accent-hover: ' + darkAccentHover + ' !important;\n';
        // Derived colors for dark scheme
        css += '  --hw-color-border: rgba(255, 255, 255, 0.1) !important;\n';
        css += '  --hw-color-shadow: rgba(0, 0, 0, 0.3) !important;\n';
        css += '  --hw-color-input-bg: rgba(255, 255, 255, 0.1) !important;\n';
        css += '  --hw-color-code-bg: rgba(255, 255, 255, 0.1) !important;\n';
        css += '  --hw-color-code-text: #f0a8c9 !important;\n';
        css += '  --hw-color-on-accent: ' + colors.dark.bg + ' !important;\n';
        css += '}\n\n';

        // Auto scheme with dark preference
        css += '@media (prefers-color-scheme: dark) {\n';
        css += '  [data-color-scheme="auto"] {\n';
        css += '    --hw-color-bg: ' + colors.dark.bg + ' !important;\n';
        css += '    --hw-color-surface: ' + colors.dark.surface + ' !important;\n';
        css += '    --hw-color-text: ' + colors.dark.text + ' !important;\n';
        css += '    --hw-color-heading: ' + colors.dark.heading + ' !important;\n';
        css += '    --hw-color-accent: ' + colors.dark.accent + ' !important;\n';
        css += '    --hw-color-accent-hover: ' + darkAccentHover + ' !important;\n';
        css += '    --hw-color-border: rgba(255, 255, 255, 0.1) !important;\n';
        css += '    --hw-color-shadow: rgba(0, 0, 0, 0.3) !important;\n';
        css += '    --hw-color-input-bg: rgba(255, 255, 255, 0.1) !important;\n';
        css += '    --hw-color-code-bg: rgba(255, 255, 255, 0.1) !important;\n';
        css += '    --hw-color-code-text: #f0a8c9 !important;\n';
        css += '    --hw-color-on-accent: ' + colors.dark.bg + ' !important;\n';
        css += '  }\n';
        css += '}\n';

        $style.text(css);

        // Update data-color-scheme attribute on html element
        document.documentElement.setAttribute('data-color-scheme', currentScheme);

        // Remove user scheme override for customizer preview
        document.documentElement.removeAttribute('data-user-scheme');

        // Remove localStorage override for preview
        localStorage.removeItem('heightwind-user-scheme');
    }

    // Color Scheme Mode binding
    wp.customize('heightwind_color_scheme', function(value) {
        value.bind(function(newval) {
            currentScheme = newval;
            document.documentElement.setAttribute('data-color-scheme', newval);
            document.documentElement.removeAttribute('data-user-scheme');

            // Trigger the HeightWindColorScheme if it exists
            if (window.HeightWindColorScheme) {
                window.HeightWindColorScheme.adminSetting = newval;
            }

            applyColorScheme();
        });
    });

    // Light Scheme Color bindings
    wp.customize('heightwind_light_bg', function(value) {
        value.bind(function(newval) {
            colors.light.bg = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_light_surface', function(value) {
        value.bind(function(newval) {
            colors.light.surface = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_light_text', function(value) {
        value.bind(function(newval) {
            colors.light.text = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_light_heading', function(value) {
        value.bind(function(newval) {
            colors.light.heading = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_light_accent', function(value) {
        value.bind(function(newval) {
            colors.light.accent = newval;
            applyColorScheme();
        });
    });

    // Dark Scheme Color bindings
    wp.customize('heightwind_dark_bg', function(value) {
        value.bind(function(newval) {
            colors.dark.bg = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_dark_surface', function(value) {
        value.bind(function(newval) {
            colors.dark.surface = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_dark_text', function(value) {
        value.bind(function(newval) {
            colors.dark.text = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_dark_heading', function(value) {
        value.bind(function(newval) {
            colors.dark.heading = newval;
            applyColorScheme();
        });
    });

    wp.customize('heightwind_dark_accent', function(value) {
        value.bind(function(newval) {
            colors.dark.accent = newval;
            applyColorScheme();
        });
    });

    /**
     * Adjust color brightness
     *
     * @param {string} hex Hex color code
     * @param {number} steps Steps to adjust (-255 to 255)
     * @returns {string} Adjusted hex color
     */
    function adjustBrightness(hex, steps) {
        if (!hex) return '#000000';

        // Remove # if present
        hex = hex.replace('#', '');

        // Convert to RGB
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);

        // Adjust
        r = Math.max(0, Math.min(255, r + steps));
        g = Math.max(0, Math.min(255, g + steps));
        b = Math.max(0, Math.min(255, b + steps));

        // Convert back to hex
        return '#' +
            ('0' + r.toString(16)).slice(-2) +
            ('0' + g.toString(16)).slice(-2) +
            ('0' + b.toString(16)).slice(-2);
    }

})(jQuery);
