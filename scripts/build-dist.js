#!/usr/bin/env node

/**
 * HeightWind Production Build Script
 *
 * Creates a production-ready distribution of the theme by:
 * - Copying only necessary files (no dev dependencies)
 * - Creating a ZIP file for easy deployment
 *
 * Usage: node scripts/build-dist.js
 */

const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

// Configuration
const THEME_NAME = 'heightwind';
const THEME_VERSION = '2.0.0';
const ROOT_DIR = path.resolve(__dirname, '..');
const DIST_DIR = path.join(ROOT_DIR, 'dist');
const THEME_DIR = path.join(DIST_DIR, THEME_NAME);
const ZIP_NAME = `${THEME_NAME}-${THEME_VERSION}.zip`;

// Files and directories to include in distribution
const INCLUDE_PATTERNS = [
  // Root level files
  '*.php',
  'style.css',
  'accessibility.css',
  'block-editor-style.css',
  'screenshot.png',
  'license.txt',
  'theme.json',

  // Directories to include entirely
  'templates/',
  'includes/',
  'languages/',

  // Framework files (selective)
  'framework/*.php',
  'framework/css/',
  'framework/js/*.min.js',
  'framework/typefaces/',
];

// Patterns to explicitly exclude
const EXCLUDE_PATTERNS = [
  'node_modules',
  '.git',
  '.idea',
  '.claude',
  'dist',
  '*.scss',
  'package.json',
  'package-lock.json',
  '.gitignore',
  '.gitattributes',
  'README.md',
  'changelog.md',
  'scss',
  'scripts',
];

/**
 * Recursively copy directory with filtering
 */
function copyDir(src, dest, excludePatterns = []) {
  if (!fs.existsSync(dest)) {
    fs.mkdirSync(dest, { recursive: true });
  }

  const entries = fs.readdirSync(src, { withFileTypes: true });

  for (const entry of entries) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);

    // Check if this path should be excluded
    const shouldExclude = excludePatterns.some(pattern => {
      if (pattern.endsWith('/')) {
        return entry.name === pattern.slice(0, -1) && entry.isDirectory();
      }
      if (pattern.includes('*')) {
        const regex = new RegExp('^' + pattern.replace('*', '.*') + '$');
        return regex.test(entry.name);
      }
      return entry.name === pattern;
    });

    if (shouldExclude) {
      continue;
    }

    // Special case: exclude unminified JS files in framework/js
    if (srcPath.includes('framework/js/') &&
        (entry.name === 'script.js' || entry.name === 'plugins.js')) {
      continue;
    }

    if (entry.isDirectory()) {
      copyDir(srcPath, destPath, excludePatterns);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

/**
 * Clean distribution directory
 */
function cleanDist() {
  console.log('🧹 Cleaning distribution directory...');
  if (fs.existsSync(DIST_DIR)) {
    fs.rmSync(DIST_DIR, { recursive: true, force: true });
  }
  fs.mkdirSync(THEME_DIR, { recursive: true });
}

/**
 * Copy theme files to distribution
 */
function copyThemeFiles() {
  console.log('📦 Copying theme files...');

  // Copy all files except excluded patterns
  copyDir(ROOT_DIR, THEME_DIR, EXCLUDE_PATTERNS);

  console.log('✅ Theme files copied successfully');
}

/**
 * Create ZIP archive
 */
function createZip() {
  console.log('🗜️  Creating ZIP archive...');

  const zipPath = path.join(ROOT_DIR, ZIP_NAME);

  // Remove old zip if exists
  if (fs.existsSync(zipPath)) {
    fs.unlinkSync(zipPath);
  }

  try {
    // Use native zip command (works on macOS and Linux)
    process.chdir(DIST_DIR);
    execSync(`zip -r "${zipPath}" ${THEME_NAME} -q`, { stdio: 'inherit' });

    // Get file size
    const stats = fs.statSync(zipPath);
    const sizeInMB = (stats.size / (1024 * 1024)).toFixed(2);

    console.log(`✅ ZIP archive created: ${ZIP_NAME} (${sizeInMB} MB)`);
  } catch (error) {
    console.error('❌ Failed to create ZIP archive:', error.message);
    console.log('💡 Tip: Make sure the "zip" command is available on your system');
    process.exit(1);
  }
}

/**
 * Display summary
 */
function displaySummary() {
  console.log('\n' + '='.repeat(50));
  console.log('🎉 Production build complete!');
  console.log('='.repeat(50));
  console.log(`📁 Distribution folder: ${THEME_DIR}`);
  console.log(`📦 ZIP file: ${ZIP_NAME}`);
  console.log('\n💡 Next steps:');
  console.log('   - Upload the ZIP file to WordPress via Appearance > Themes > Add New');
  console.log('   - Or extract the theme folder to wp-content/themes/');
  console.log('='.repeat(50) + '\n');
}

/**
 * Main build process
 */
function main() {
  console.log('\n🚀 Building HeightWind production distribution...\n');

  try {
    cleanDist();
    copyThemeFiles();
    createZip();
    displaySummary();
  } catch (error) {
    console.error('\n❌ Build failed:', error.message);
    process.exit(1);
  }
}

// Run the build
main();
