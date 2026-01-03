/**
 * HeightWind Color Scheme Handler
 *
 * Manages light/dark color scheme switching with:
 * - Admin setting from WordPress Customizer
 * - User override via front-end toggle
 * - localStorage persistence for user preferences
 * - System preference detection for auto mode
 *
 * @package heightwind
 * @since 2.1.0
 */
(function() {
    'use strict';

    var HeightWindColorScheme = {
        // Storage key for user preference
        storageKey: 'heightwind-user-scheme',

        // Admin setting (passed via wp_localize_script or read from HTML attribute)
        adminSetting: null,

        // Current effective scheme
        currentScheme: null,

        /**
         * Initialize the color scheme handler
         */
        init: function() {
            // Get admin setting from HTML attribute or global variable
            this.adminSetting = document.documentElement.getAttribute('data-color-scheme') || 'auto';

            // Check for user override in localStorage
            var userScheme = this.getUserScheme();

            // Apply the appropriate scheme
            this.applyScheme(userScheme || this.adminSetting);

            // Listen for system preference changes (for auto mode)
            this.watchSystemPreference();

            // Set up toggle buttons if present
            this.setupToggleButtons();
        },

        /**
         * Get user's stored scheme preference
         * @returns {string|null} Stored scheme or null
         */
        getUserScheme: function() {
            try {
                return localStorage.getItem(this.storageKey);
            } catch (e) {
                return null;
            }
        },

        /**
         * Store user's scheme preference
         * @param {string|null} scheme Scheme to store, or null to clear
         */
        setUserScheme: function(scheme) {
            try {
                if (scheme === null) {
                    localStorage.removeItem(this.storageKey);
                    document.documentElement.removeAttribute('data-user-scheme');
                } else {
                    localStorage.setItem(this.storageKey, scheme);
                    document.documentElement.setAttribute('data-user-scheme', scheme);
                }
            } catch (e) {
                // localStorage not available
            }
        },

        /**
         * Apply color scheme to document
         * @param {string} scheme 'light', 'dark', or 'auto'
         */
        applyScheme: function(scheme) {
            var html = document.documentElement;

            // Set the data attribute
            html.setAttribute('data-color-scheme', scheme);

            // Store current scheme
            this.currentScheme = scheme;

            // Update toggle buttons state if present
            this.updateToggleButtons();

            // Dispatch custom event for other scripts
            this.dispatchChangeEvent();
        },

        /**
         * Get the effective scheme (resolving 'auto' to actual light/dark)
         * @returns {string} 'light' or 'dark'
         */
        getEffectiveScheme: function() {
            if (this.currentScheme === 'auto') {
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            return this.currentScheme;
        },

        /**
         * Set scheme directly to light or dark
         * @param {string} scheme 'light' or 'dark'
         */
        setScheme: function(scheme) {
            if (scheme !== 'light' && scheme !== 'dark') {
                return;
            }

            // Store user preference
            this.setUserScheme(scheme);

            // Apply the scheme
            this.applyScheme(scheme);
        },

        /**
         * Toggle between light and dark
         * If currently auto, resolves to opposite of effective scheme
         */
        toggleScheme: function() {
            var effective = this.getEffectiveScheme();
            var newScheme = effective === 'light' ? 'dark' : 'light';
            this.setScheme(newScheme);
        },

        /**
         * Watch for system preference changes
         */
        watchSystemPreference: function() {
            var self = this;
            var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            var handleChange = function() {
                // Only dispatch event if in auto mode
                if (self.currentScheme === 'auto') {
                    self.dispatchChangeEvent();
                    self.updateToggleButtons();
                }
            };

            // Modern API
            if (mediaQuery.addEventListener) {
                mediaQuery.addEventListener('change', handleChange);
            } else if (mediaQuery.addListener) {
                // Legacy API for older browsers
                mediaQuery.addListener(handleChange);
            }
        },

        /**
         * Dispatch custom event when scheme changes
         */
        dispatchChangeEvent: function() {
            var event;
            var detail = {
                scheme: this.currentScheme,
                effectiveScheme: this.getEffectiveScheme()
            };

            if (typeof CustomEvent === 'function') {
                event = new CustomEvent('heightwind-scheme-change', { detail: detail });
            } else {
                // IE11 fallback
                event = document.createEvent('CustomEvent');
                event.initCustomEvent('heightwind-scheme-change', true, true, detail);
            }

            document.dispatchEvent(event);
        },

        /**
         * Set up the toggle buttons
         */
        setupToggleButtons: function() {
            var self = this;
            var container = document.querySelector('.color-scheme-toggle');

            if (!container) return;

            var lightBtn = container.querySelector('.toggle-light');
            var darkBtn = container.querySelector('.toggle-dark');

            if (lightBtn) {
                lightBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    self.setScheme('light');
                });
            }

            if (darkBtn) {
                darkBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    self.setScheme('dark');
                });
            }

            // Set initial state
            this.updateToggleButtons();
        },

        /**
         * Update toggle buttons aria-pressed and styling
         */
        updateToggleButtons: function() {
            var container = document.querySelector('.color-scheme-toggle');
            if (!container) return;

            var lightBtn = container.querySelector('.toggle-light');
            var darkBtn = container.querySelector('.toggle-dark');
            var effective = this.getEffectiveScheme();

            if (lightBtn) {
                lightBtn.setAttribute('aria-pressed', effective === 'light' ? 'true' : 'false');
            }

            if (darkBtn) {
                darkBtn.setAttribute('aria-pressed', effective === 'dark' ? 'true' : 'false');
            }
        },

        /**
         * Reset to admin setting (clear user preference)
         */
        reset: function() {
            this.setUserScheme(null);
            this.applyScheme(this.adminSetting);
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            HeightWindColorScheme.init();
        });
    } else {
        HeightWindColorScheme.init();
    }

    // Expose globally for external use and Customizer preview
    window.HeightWindColorScheme = HeightWindColorScheme;

})();
