const mix = require('laravel-mix');

/*
mix.js('resources/js/admin-lte.js', 'public/js/admin-lte.js')
	.sass('resources/sass/admin-lte.scss', 'public/css/admin-lte.css');
	
mix.scripts(['public/js/admin-lte.js','resources/assets/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js'],'public/js/admin-lte.js')
	.styles(['public/css/admin-lte.css','resources/assets/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css'], 'public/css/admin-lte.css');
*/

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

/* VERTIKAL TRIP */
mix.js('resources/js/vertikaltrip.js', 'public/js/vertikaltrip-1.2.6.js');
mix.sass('resources/sass/vertikaltrip.scss', 'public/css/vertikaltrip-1.2.6.css');

 
/* ADMIN */
mix.js('resources/js/app.js', 'public/js/app_tmp1.js');
mix.sass('resources/sass/app.scss', 'public/css/app_tmp1.css');

mix.scripts([
	'resources/assets/admin/jquery-uploadfile/js/jquery.uploadfile.js',
	'resources/assets/admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
	],'public/js/app_tmp2.js');

mix.scripts([
	'public/js/app_tmp1.js',
	'public/js/app_tmp2.js'
	],'public/js/app.js');


mix.styles([
	'public/css/app_tmp1.css',
	'resources/assets/admin/jquery-uploadfile/css/uploadfile.css',
	'resources/assets/admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
	],'public/css/app.css');
	
mix.copyDirectory('resources/assets/admin/avatars', 'public/img');
mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce/themes', 'public/js/themes');


/* RATNAWAHYU */
mix.js('resources/js/ratnawahyu.js', 'public/js/ratnawahyu_tmp1.js');
mix.sass('resources/sass/ratnawahyu.scss', 'public/css/ratnawahyu_tmp1.css');


mix.scripts([
	'resources/assets/ratnawahyu/jquery-easing/jquery.easing.min.js',
	'resources/assets/ratnawahyu/jquery-infinite-scroll/jquery.infinitescroll.min.js',
	'resources/assets/ratnawahyu/photoset-grid/jquery.photoset-grid.min.js',
	'resources/assets/ratnawahyu/imagesloaded/imagesloaded.pkgd.min.js',
	'resources/assets/ratnawahyu/back-to-top/js/main.js',
	'resources/assets/ratnawahyu/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
	],'public/js/ratnawahyu_tmp2.js');

mix.styles([
	'resources/assets/ratnawahyu/jquery-infinite-scroll/main.css',
	'resources/assets/ratnawahyu/photoset-grid/css/main.css',
	'resources/assets/ratnawahyu/back-to-top/css/style.css',
	'resources/assets/ratnawahyu/@fancyapps/fancybox/dist/jquery.fancybox.min.css'
	],'public/css/ratnawahyu_tmp2.css');

mix.scripts([
	'public/js/ratnawahyu_tmp1.js',
	'public/js/ratnawahyu_tmp2.js'
	],'public/js/ratnawahyu-1.1.9.js');


mix.styles([
	'public/css/ratnawahyu_tmp1.css',
	'public/css/ratnawahyu_tmp2.css'
	],'public/css/ratnawahyu-1.1.9.css');

mix.copyDirectory('resources/assets/ratnawahyu/back-to-top/img', 'public/img');
mix.copy('resources/assets/ratnawahyu/jquery-infinite-scroll/output_DTGK2a.gif', 'public/img/output_DTGK2a.gif');
