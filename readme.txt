=== HeightWind ===
Contributors: mattsimpson
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: two-columns, left-sidebar, right-sidebar, sticky-post, threaded-comments, translation-ready, custom-background, custom-colors, custom-header, custom-menu, featured-images, full-width-template, theme-options

HeightWind is a lightweight, free WordPress theme designed to showcase content. It features a clean, responsive design with a strong focus on typography.

== Description ==

HeightWind is a lightweight, free WordPress theme designed to showcase content. It features a clean, responsive design with a strong focus on typography, plus a bunch of presentational options and widgetised regions allowing you to give your site a unique touch.

**Key Features:**

* **Responsive Design** - Fully optimized for small screen display. Your content will look beautiful on desktops, tablets, and smartphones.
* **Typography** - All aspects of typography are set up in accordance to a Modular Scale ensuring consistent typographical hierarchy.
* **Theme Options** - Just enough options to make your site unique. Options to change colors, layout, header and background images.
* **Footer Widgets** - In addition to your sidebar, you can add widgets to three defined regions in the footer arranged in columns.
* **WooCommerce Integration** - Create an online store using WooCommerce.
* **Accessibility Features** - Skip to content links, WCAG compliant back-to-top button, and semantic HTML structure.
* **Customizable** - Loads of options to customize colors, layout, and appearance without touching code.

HeightWind is based on the original Highwind theme by James Koster and has been modernized for current WordPress standards.

== Installation ==

1. In your WordPress admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= How do I customize the theme colors? =

Go to Appearance > Customize in your WordPress admin panel. Under the Colors section, you can modify the background, text, and link colors.

= How do I add a custom header image? =

Go to Appearance > Customize > Header Image. You can upload your own custom header image.

= How do I enable the sidebar on the left? =

Go to Appearance > Customize > Layout and select the sidebar position option.

= How do I add widgets to the footer? =

Go to Appearance > Widgets. You'll find three footer widget areas: Footer Sidebar 1, Footer Sidebar 2, and Footer Sidebar 3. The footer layout will automatically adjust based on which areas you use.

== Copyright ==

HeightWind WordPress Theme, Copyright 2025 Matt Simpson
HeightWind is distributed under the terms of the GNU GPL

Based on Highwind by James Koster, Copyright 2013

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

**Third-Party Resources:**

* Font Awesome Free 7.0.0 by @fontawesome
  License: Font Awesome Free License
  - Icons: CC BY 4.0 License (https://creativecommons.org/licenses/by/4.0/)
  - Fonts: SIL OFL 1.1 License (https://scripts.sil.org/OFL)
  - Code: MIT License (https://opensource.org/licenses/MIT)
  Source: https://fontawesome.com/

* Normalize.css v2.1.1
  License: MIT License
  Source: https://necolas.github.io/normalize.css/

* Open Sans Font
  License: Apache License, Version 2.0
  Source: https://fonts.google.com/specimen/Open+Sans

* Semantic Grid System
  License: GPL/MIT
  Source: http://semantic.gs/

== Changelog ==

= 2.0.0 - 2025-10-13 =
* Major - Modernized and rebranded Highwind as HeightWind
* Update - Upgraded FontAwesome from 4.0.3 to 7.0.0 Free
* Update - Migrated from LESS to SCSS/Sass
* Update - Migrated from @import to @use syntax (Sass modules)
* Update - Added modern npm-based build system
* Update - Improved list styling for better readability
* Update - Added Text Domain and WordPress version requirements to stylesheet header (WordPress.org best practices)
* Update - Updated all @since tags to 2.0.0 (rebrand from HighWind to HeightWind)
* Fix - Fixed menu item height inconsistency
* Fix - Fixed third-level submenu positioning to appear to the right of parent items
* Fix - Improved submenu contrast by darkening background color for better visibility
* Fix - Removed navigation bottom border and list item padding for cleaner, more compact layout
* Fix - Fixed WordPress block search widget styles and button visibility
* Fix - Fixed WordPress block quote styling (removed border, adjusted spacing)
* Fix - Replaced scroll event listener with Intersection Observer API for better performance
* Fix - Updated back-to-top button to be square (44x44px) for WCAG compliance
* Fix - Fixed Sass slash-div deprecation warnings by migrating to math.div()
* Fix - Added translator comments to all strings with placeholders for better i18n support
* Fix - Fixed 8 output escaping issues for improved security (esc_url, esc_html, esc_attr, wp_kses_post, absint)
* Fix - Fixed WooCommerce array offset errors when options don't exist in database
* Fix - Fixed incorrect text domain in WooCommerce cart fragment
* Fix - Fixed WooCommerce star rating icons not displaying
* Fix - Fixed missing text domain in translation function
* Fix - Changed print to echo in heightwind-functions.php (WordPress coding standards)
* Cleanup - Modernized WooCommerce CSS by removing obsolete legacy code
* Cleanup - Removed unused FitVids and Modernizr plugin files and references
* Cleanup - Removed legacy translation files
* Dev - Added build scripts for CSS and JavaScript
* Dev - Added watch mode for development
* Dev - Added production distribution build script
* License - Updated to properly credit original HighWind by James Koster

= 1.2.7 - 2014-12-27 =
* Fix - Background color setting
* Fix - ul/ol padding
* Tweak - View cart button styling on product archives

= 1.2.6 - 2014-11-17 =
* Tweak - Remove codekit config file

= 1.2.5 - 2014-11-11 =
* Fix - Search template uses the correct loop
* Tweak - Removed id arg from heightwind_content_nav()
* Tweak - Several small style tweaks
* Tweak - Sanitize Customizer settings

= 1.0 - 2013-07-12 =
* Initial release by James Koster

== Resources ==

* HeightWind Theme Website: https://github.com/mattsimpson/heightwind
* Original Highwind: https://github.com/jameskoster/highwind
