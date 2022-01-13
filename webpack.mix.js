const mix = require('laravel-mix');
const cssImport = require('postcss-import');
const cssNesting = require('postcss-nesting');
const path = require('path');

/**
 * Browser sync and live reload.
 */

mix.browserSync({
    host: 'localhost',
    proxy: 'projekatc-app',
    port: 3000,
    open: false,
});

/**
 * Mapping ziggy location to 'ziggy' alias
 */
mix.alias({
    '@': path.resolve('./resources/js'),
    'ziggy': path.resolve('./vendor/tightenco/ziggy/dist'),
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.ts('resources/js/app.ts', 'public/js')
   .vue({ version: 3 })
   .postCss('resources/css/app.css', 'public/css', [
       cssImport(),
       cssNesting(),
       require('tailwindcss'),
   ]);
