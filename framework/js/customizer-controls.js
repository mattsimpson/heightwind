/**
 * Customizer Controls - Dynamic Control Visibility
 *
 * Handles dynamic showing/hiding of controls in the WordPress Customizer
 * based on the dark mode enabled setting.
 *
 * @package HeightWind
 * @since 2.1.0
 */

(function($) {
    'use strict';

    wp.customize.bind('ready', function() {
        
        /**
         * Toggle visibility of dark theme controls based on dark mode enabled setting
         */
        function toggleDarkModeControls(enabled) {
            var darkModeControls = [
                'heightwind_color_scheme',
                'heightwind_dark_bg',
                'heightwind_dark_surface',
                'heightwind_dark_text',
                'heightwind_dark_heading',
                'heightwind_dark_accent'
            ];

            darkModeControls.forEach(function(controlId) {
                var control = wp.customize.control(controlId);
                if (control) {
                    if (enabled) {
                        control.container.slideDown(200);
                    } else {
                        control.container.slideUp(200);
                    }
                }
            });
        }

        // Initial state
        var darkModeEnabled = wp.customize('heightwind_dark_mode_enabled')();
        toggleDarkModeControls(darkModeEnabled);

        // Listen for changes
        wp.customize('heightwind_dark_mode_enabled', function(setting) {
            setting.bind(function(enabled) {
                toggleDarkModeControls(enabled);
            });
        });

    });

})(jQuery);
