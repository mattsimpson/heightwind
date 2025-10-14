# HeightWind

**Version 2.0.0** - A modern WordPress theme for developers

HeightWind is a lightweight WordPress theme with a clean, responsive design and strong focus on typography. Originally created by [James Koster](http://jameskoster.co.uk) as **Highwind**, this modernized version is maintained by [Matt Simpson](https://mattsimpson.ca).

## Quick Links

- **[Download Latest Release](../../releases)** - Production-ready ZIP file
- **[WordPress.org Theme Page](https://wordpress.org/themes/heightwind/)** - End-user documentation
- **[Original Highwind](https://github.com/jameskoster/highwind)** - Original theme repository

## License

- Theme: [GNU General Public License v2.0](http://www.gnu.org/licenses/gpl-2.0.html)
- Font Awesome 7 Free: [SIL OFL 1.1 (fonts), MIT (CSS), CC BY 4.0 (icons)](https://fontawesome.com/license/free)

## For Developers

### Technical Features

- **Modern Build System**: npm + Sass (SCSS) + Terser
- **Developer Friendly**: Extensive hooks and filters via Theme Hook Alliance
- **Typography**: Modular scale for consistent hierarchy
- **Responsive Grid**: Semantic grid system
- **Accessibility**: WCAG compliant, skip links, semantic HTML
- **WooCommerce Ready**: Full integration with customization options
- **Child Theme Ready**: Extensive customization via child themes

# Development

HeightWind uses a modern npm-based build system with SCSS for stylesheets and Terser for JavaScript minification.

## Prerequisites

- Node.js and npm installed on your system

## Setup

Install development dependencies:

```bash
npm install
```

## Build Commands

### Build everything (CSS and JavaScript)
```bash
npm run build
```

### Build CSS only
```bash
npm run build:css
```

Compiles:
- `style.scss` → `style.css`
- `framework/scss/editor-styles.scss` → `framework/css/editor-styles.css`

### Build JavaScript only
```bash
npm run build:js
```

Minifies:
- `framework/js/script.js` → `framework/js/script.min.js`
- `framework/js/plugins.js` → `framework/js/plugins.min.js`

### Watch for changes
```bash
npm run watch
```

Automatically rebuilds CSS and JavaScript when source files change.

## Project Architecture

### Directory Structure

```
heightwind/
├── framework/              # Core theme framework
│   ├── css/               # Compiled CSS
│   ├── js/                # JavaScript files
│   ├── scss/              # SCSS source files
│   ├── heightwind-functions.php
│   ├── heightwind-hooks.php
│   ├── heightwind-template.php
│   └── heightwind-customizer.php
├── includes/              # Feature integrations
│   └── integrations/
│       └── woocommerce/   # WooCommerce support
├── templates/             # Page templates
├── style.scss            # Main stylesheet source
├── style.css             # Compiled main stylesheet
├── functions.php         # Theme initialization
└── package.json          # Build configuration
```

### SCSS Files (Source)
- `style.scss` - Main stylesheet (imports all partials)
- `framework/scss/_mixins.scss` - Reusable mixins and animations
- `framework/scss/_normalize.scss` - CSS normalization
- `framework/scss/_grid.scss` - Semantic grid system
- `framework/scss/_core.scss` - Core theme styles

### JavaScript Files
- `framework/js/script.js` - Main theme JavaScript (navigation, back-to-top)
- `framework/js/plugins.js` - jQuery plugins

### Theme Hook System

HeightWind provides extensive action hooks for customization:

**Body Hooks:**
- `heightwind_body_top` - Top of `<body>` tag
- `heightwind_body_bottom` - Bottom of `<body>` tag

**Header Hooks:**
- `heightwind_header_before` - Before header
- `heightwind_header` - Main header area
- `heightwind_header_after` - After header

**Navigation Hooks:**
- `heightwind_navigation_before` - Before navigation
- `heightwind_navigation_top` - Top of navigation
- `heightwind_navigation_bottom` - Bottom of navigation
- `heightwind_navigation_after` - After navigation

**Content Hooks:**
- `heightwind_content_before` - Before content container
- `heightwind_content_top` - Top of content area
- `heightwind_content_header_top` - Top of entry header
- `heightwind_content_bottom` - Bottom of content area
- `heightwind_content_after` - After content container

**Entry Hooks:**
- `heightwind_entry_top` - Top of entry/post
- `heightwind_entry_bottom` - Bottom of entry/post

**Footer Hooks:**
- `heightwind_footer_before` - Before footer
- `heightwind_footer` - Main footer area
- `heightwind_footer_after` - After footer

See `framework/heightwind-hooks.php` for complete hook definitions.

## Production Deployment

### Creating a Production Build

To create a production-ready ZIP file for deployment:

```bash
npm run build:dist
```

This command will:
1. Compile all CSS and JavaScript files
2. Create a `dist/` folder with only production files (no node_modules, .git, development files)
3. Generate a `heightwind-2.0.0.zip` file ready for deployment

### Installing on WordPress

**Option 1: Upload ZIP via WordPress Admin**
1. Run `npm run build:dist`
2. Go to WordPress Admin > Appearance > Themes > Add New > Upload Theme
3. Upload the generated `heightwind-2.0.0.zip` file
4. Activate the theme

**Option 2: Manual Installation**
1. Run `npm run build:dist`
2. Extract `heightwind-2.0.0.zip`
3. Upload the `heightwind/` folder to your WordPress site's `wp-content/themes/` directory
4. Activate via WordPress Admin > Appearance > Themes

**Option 3: Direct Git Clone (Development Only)**

⚠️ **Not recommended for production sites** - includes 31MB of development dependencies.

For development/testing only, you can clone directly:
```bash
cd wp-content/themes/
git clone <repository-url> heightwind
cd heightwind
npm install
npm run build
```

Then activate the theme in WordPress. This approach is only suitable for development environments where you need access to the build tools.

## Customization via Child Theme

For site-specific customizations, use a child theme rather than modifying HeightWind directly. This preserves your changes when updating the parent theme.

### Creating a Child Theme

1. Create a new directory in `wp-content/themes/` (e.g., `heightwind-child/`)

2. Create `style.css` with the following header:
```css
/*
Theme Name: HeightWind Child
Template: heightwind
*/
```

3. Create `functions.php`:
```php
<?php
function heightwind_child_enqueue_styles() {
    wp_enqueue_style('heightwind-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('heightwind-child', get_stylesheet_uri(), array('heightwind-parent'));
}
add_action('wp_enqueue_scripts', 'heightwind_child_enqueue_styles');
```

### Using Hooks in Child Themes

Example - Add custom content before footer:
```php
function my_custom_footer_content() {
    echo '<div class="custom-footer">My custom content</div>';
}
add_action('heightwind_footer_before', 'my_custom_footer_content');
```

Example - Modify post meta display:
```php
// Remove default post meta
remove_action('heightwind_entry_bottom', 'heightwind_post_meta');

// Add custom post meta
function my_custom_post_meta() {
    // Your custom implementation
}
add_action('heightwind_entry_bottom', 'my_custom_post_meta');
```

### Using Filters in Child Themes

Example - Disable header gravatar:
```php
add_filter('heightwind_header_gravatar', '__return_false');
```

Example - Change featured image size:
```php
add_filter('heightwind_featured_image_size', function() {
    return 'full';
});
```

## Contributing

Contributions are welcome! Please follow these guidelines:

1. **Fork the repository** and create a feature branch
2. **Follow WordPress Coding Standards** for PHP, CSS, and JavaScript
3. **Test thoroughly** with WordPress 6.0+ and PHP 7.4+
4. **Document your changes** in comments and commit messages
5. **Update changelog** in readme.txt for user-facing changes
6. **Submit a pull request** with a clear description

### Development Workflow

```bash
# Fork and clone
git clone https://github.com/YOUR-USERNAME/heightwind.git
cd heightwind

# Create feature branch
git checkout -b feature/your-feature-name

# Install dependencies
npm install

# Make changes and test
npm run watch  # Auto-rebuild on changes

# Build for production
npm run build:dist

# Commit and push
git add .
git commit -m "Add feature: your feature description"
git push origin feature/your-feature-name
```

## Support

- **Issues**: [GitHub Issues](https://github.com/mattsimpson/heightwind/issues)
- **Documentation**: See readme.txt for end-user documentation
- **Original Theme**: [Highwind by James Koster](https://github.com/jameskoster/highwind)
