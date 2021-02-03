const mix = require('laravel-mix');

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

if(mix.inProduction()){
    mix.setPublicPath('public/dist');
    mix.setResourceRoot('/dist');
    mix.version();
}else{
    mix.setPublicPath('public/build');
    mix.setResourceRoot('/build');
}


mix.js('resources/js/admin.js', 'js').extract(['axios','jquery','jquery-pjax','nprogress']);
mix.sass('resources/css/admin/app.scss', 'css/admin').sass('resources/css/admin/vendor.scss', 'css/admin');
