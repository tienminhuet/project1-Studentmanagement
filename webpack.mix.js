const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/teacher.js', 'public/js/teacher.js')
    .js('resources/js/admin/admin.js', 'public/js/admin.js')
    .js('resources/js/admin/theory.js', 'public/js/theory.js')
    .js('resources/js/admin/exercise.js', 'public/js/exercise.js')
    .js('resources/js/admin/classes.js', 'public/js/classes.js')
    .js('resources/js/admin/classesDetail.js', 'public/js/classesDetail.js')
    .js('resources/js/admin/lesson.js', 'public/js/lesson.js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles('resources/sass/admin.css', 'public/css/admin.css')
    .styles('resources/sass/editLesson.css', 'public/css/editLesson.css');
