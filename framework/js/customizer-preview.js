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

        // Check if user has explicitly selected a scheme via the frontend toggle
        var userScheme = document.documentElement.getAttribute('data-user-scheme');

        // Use user's selection if available, otherwise use admin setting
        var activeScheme = userScheme || currentScheme;

        // Update data-color-scheme attribute on html element
        document.documentElement.setAttribute('data-color-scheme', activeScheme);

        // Note: Don't remove data-user-scheme or localStorage here
        // Those should only be cleared when the admin explicitly changes the scheme setting
    }

    // Color Scheme Mode binding
    wp.customize('heightwind_color_scheme', function(value) {
        value.bind(function(newval) {
            currentScheme = newval;

            // Admin is explicitly changing the scheme, clear user override
            document.documentElement.removeAttribute('data-user-scheme');
            localStorage.removeItem('heightwind-user-scheme');

            document.documentElement.setAttribute('data-color-scheme', newval);

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
     * Adjust color brightness using HSL color space
     *
     * @param {string} hex Hex color code
     * @param {number} steps Steps to adjust (-255 to 255)
     * @returns {string} Adjusted hex color
     */
    function adjustBrightness(hex, steps) {
        if (!hex) {
            return '#000000';
        }

        // Normalize and remove leading '#'
        hex = String(hex).trim();
        if (hex.charAt(0) === '#') {
            hex = hex.slice(1);
        }

        // Expand shorthand form (#abc) to full form (#aabbcc)
        if (hex.length === 3) {
            hex = hex.charAt(0) + hex.charAt(0) +
                hex.charAt(1) + hex.charAt(1) +
                hex.charAt(2) + hex.charAt(2);
        }

        if (hex.length !== 6) {
            // Invalid hex format, fallback
            return '#000000';
        }

        var rgb = hexToRgb(hex);
        if (!rgb) {
            return '#000000';
        }

        var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b);

        // Map steps (-255..255) to lightness adjustment (-1..1)
        var deltaL = steps / 255;
        hsl.l = Math.max(0, Math.min(1, hsl.l + deltaL));

        var adjustedRgb = hslToRgb(hsl.h, hsl.s, hsl.l);

        // Convert back to hex
        var rHex = ('0' + adjustedRgb.r.toString(16)).slice(-2);
        var gHex = ('0' + adjustedRgb.g.toString(16)).slice(-2);
        var bHex = ('0' + adjustedRgb.b.toString(16)).slice(-2);

        return '#' + rHex + gHex + bHex;
    }

    /**
     * Convert hex color (without #) to RGB object.
     *
     * @param {string} hex Hex color string (e.g. 'aabbcc')
     * @returns {{r:number,g:number,b:number}|null}
     */
    function hexToRgb(hex) {
        if (!hex || hex.length !== 6) {
            return null;
        }
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);

        if (isNaN(r) || isNaN(g) || isNaN(b)) {
            return null;
        }

        return {
            r: r,
            g: g,
            b: b
        };
    }

    /**
     * Convert RGB to HSL.
     *
     * @param {number} r Red (0-255)
     * @param {number} g Green (0-255)
     * @param {number} b Blue (0-255)
     * @returns {{h:number,s:number,l:number}} h in [0,360), s,l in [0,1]
     */
    function rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;

        var max = Math.max(r, g, b);
        var min = Math.min(r, g, b);
        var h, s;
        var l = (max + min) / 2;

        if (max === min) {
            h = 0;
            s = 0;
        } else {
            var d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

            switch (max) {
                case r:
                    h = (g - b) / d + (g < b ? 6 : 0);
                    break;
                case g:
                    h = (b - r) / d + 2;
                    break;
                default:
                    h = (r - g) / d + 4;
                    break;
            }

            h *= 60;
        }

        return {
            h: h,
            s: s,
            l: l
        };
    }

    /**
     * Convert HSL to RGB.
     *
     * @param {number} h Hue in degrees [0,360)
     * @param {number} s Saturation [0,1]
     * @param {number} l Lightness [0,1]
     * @returns {{r:number,g:number,b:number}} RGB values (0-255)
     */
    function hslToRgb(h, s, l) {
        var r, g, b;

        if (s === 0) {
            r = g = b = l; // achromatic
        } else {
            var c = (1 - Math.abs(2 * l - 1)) * s;
            var hh = (h % 360) / 60;
            var x = c * (1 - Math.abs(hh % 2 - 1));
            var m = l - c / 2;

            if (hh >= 0 && hh < 1) {
                r = c;
                g = x;
                b = 0;
            } else if (hh >= 1 && hh < 2) {
                r = x;
                g = c;
                b = 0;
            } else if (hh >= 2 && hh < 3) {
                r = 0;
                g = c;
                b = x;
            } else if (hh >= 3 && hh < 4) {
                r = 0;
                g = x;
                b = c;
            } else if (hh >= 4 && hh < 5) {
                r = x;
                g = 0;
                b = c;
            } else {
                r = c;
                g = 0;
                b = x;
            }

            r = r + m;
            g = g + m;
            b = b + m;
        }

        return {
            r: Math.round(Math.max(0, Math.min(1, r)) * 255),
            g: Math.round(Math.max(0, Math.min(1, g)) * 255),
            b: Math.round(Math.max(0, Math.min(1, b)) * 255)
        };
    }

})(jQuery);
