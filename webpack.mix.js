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

mix.js('resources/js/app.js', 'public/js').version();

// Para desactivar las notificaciones de webpack
// mix.js('resources/js/app.js', 'public/js').disableNotifications();

// Para desactivar las notificaciones exitosa de webpack
mix.disableSuccessNotifications();

// mix.webpackConfig({
//     module: {
//         rules: [{
//             test: /\.css$/,
//             use: ['style-loader', 'css-loader']
//         }]
//     }
// }); }
// });