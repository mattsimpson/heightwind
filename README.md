# HeightWind

**Version 2.0.0**

HeightWind is a lightweight, free WordPress theme designed to showcase content. It features a clean, responsive design with a strong focus on typography, plus a bunch of presentational options and widgetised regions allowing you to give your site a unique touch.

**[HeightWind](https://github.com/mattsimpson/heightwind/) is maintained and modernized by [Matt Simpson](https://mattsimpson.ca)**
**Based on [Highwind](https://github.com/jameskoster/highwind) by [James Koster](http://jameskoster.co.uk)**

# License

* License: [GNU General Public License v2.0](http://www.gnu.org/licenses/gpl-2.0.html)
* FontAwesome 7 Free License: [SIL OFL 1.1 for fonts, MIT for CSS, CC BY 4.0 for icons](https://fontawesome.com/license/free)

# Features

## Developer Friendly
Loads of hooks and filters to extend and customise HeightWind via plugin and/or child theme.

## Footer Widgets
In addition to your sidebar you can add widgets the three defined regions in the footer. These will be arranged in columns according to which regions you use.

## Responsive
HeightWind has been fully optimised for small screen display. Your content will look beautiful whether it's viewed on a desktop, a tablet or a smartphone.

## Theme Options
Just enough options to make your site unique. There are options to change colors, layout and header / background images.

## WooCommerce Integration
Use HeightWind to create an online store using [WooCommerce](http://woothemes.com/woocommerce).

# Usage

## Theme options

To customise HeightWind log in to your dashboard and navigate to Appearance > Themes and click 'Customize'. From the front-end you can access theme customization from the admin bar.

* Site Title & Tagline - Change your site title & tagline.
* Colors - Change theme colors such as background, text, link etc
* Layout - Position the sidebar on the left or the right
* Header Image - Change the header image
* Background Image - Change the background image
* Navigation - Specify which menu to use in the menu location
* Static Front Page - Optionally specify a static front page

## Further customisation
If you want to customise HeightWind beyond the included options, I strongly recommend that you do so via a [child theme](http://codex.wordpress.org/Child_Themes).

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

## File Structure

### SCSS Files
- `style.scss` - Main stylesheet
- `framework/scss/_mixins.scss` - Reusable mixins and animations
- `framework/scss/_normalize.scss` - CSS normalization
- `framework/scss/_grid.scss` - Grid system
- `framework/scss/_core.scss` - Core styles

### JavaScript Files
- `framework/js/script.js` - Main theme JavaScript
- `framework/js/plugins.js` - jQuery plugins

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
