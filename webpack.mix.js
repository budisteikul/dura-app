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


mix.js('resources/js/app.js', 'public/js/app_tmp1.js');
mix.sass('resources/sass/app.scss', 'public/css/app_tmp1.css');

mix.scripts([
	'resources/assets/backend/jquery-uploadfile/js/jquery.uploadfile.js',
	'resources/assets/backend/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
	],'public/js/app_tmp2.js');

mix.scripts([
	'public/js/app_tmp1.js',
	'public/js/app_tmp2.js'
	],'public/js/app.js');


mix.styles([
	'public/css/app_tmp1.css',
	'resources/assets/backend/jquery-uploadfile/css/uploadfile.css',
	'resources/assets/backend/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
	],'public/css/app.css');
	
mix.copyDirectory('resources/assets/backend/avatars', 'public/img');
mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce/themes', 'public/js/themes');



mix.scripts([
	'resources/assets/frontend/jquery/dist/jquery.min.js',
	'resources/assets/frontend/moment/moment.js',
	'resources/assets/frontend/bootstrap-4.3.1/dist/js/bootstrap.min.js',
	'resources/assets/frontend/jquery-easing/jquery.easing.min.js',
	'resources/assets/frontend/jquery-infinite-scroll/jquery.infinitescroll.min.js',
	'resources/assets/frontend/photoset-grid/jquery.photoset-grid.min.js',
	'resources/assets/frontend/imagesloaded/imagesloaded.pkgd.min.js',
	'resources/assets/frontend/back-to-top/js/main.js',
	'resources/assets/frontend/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
	'resources/assets/frontend/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'resources/assets/frontend/sweetalert/dist/sweetalert.min.js',
	'resources/assets/frontend/wowjs/dist/wow.min.js'
	],'public/js/vertikaltrip-1.0.0.js');

mix.styles([
	'resources/assets/frontend/bootstrap-4.3.1/dist/css/bootstrap.min.css',
	'resources/assets/frontend/fontawesome-free-5.9.0-web/css/all.css',
	'resources/assets/frontend/animate.css/animate.min.css',
	'resources/assets/frontend/jquery-infinite-scroll/main.css',
	'resources/assets/frontend/photoset-grid/css/main.css',
	'resources/assets/frontend/back-to-top/css/style.css',
	'resources/assets/frontend/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
	'resources/assets/frontend/timeline/timeline.css',
	'resources/assets/frontend/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
	],'public/css/vertikaltrip-1.0.0.css');

mix.copyDirectory('resources/assets/frontend/fontawesome-free-5.9.0-web/webfonts', 'public/webfonts');
mix.copyDirectory('resources/assets/frontend/back-to-top/img', 'public/img');
mix.copy('resources/assets/frontend/jquery-infinite-scroll/output_DTGK2a.gif', 'public/img/output_DTGK2a.gif');
