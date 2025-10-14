# HeightWind

**Version 2.0.0**

HeightWind is a lightweight, free WordPress theme designed to showcase content. It features a clean, responsive design with a strong focus on typography, plus a bunch of presentational options and widgetised regions allowing you to give your site a unique touch.

**Modernized and maintained by [Matt Simpson](https://mattsimpson.ca)**
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

## Theme Hook Alliance
HeightWind fully supports the [Theme Hook Alliance](https://github.com/zamoose/themehookalliance).

## Theme Options
Just enough options to make your site unique. There are options to change colors, layout and header / background images.

## Typography
All aspects of typography are set up in accordance to a Modular Scale ensuring consistent typographical hierarchy.

## Documentation
Ever evolving documentation available in the [wiki](https://github.com/jameskoster/highwind/wiki).

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

# Misc

* [Modular Scale](http://modularscale.com/scale/?px1=16&px2=18&ra1=1.333&ra2=0)