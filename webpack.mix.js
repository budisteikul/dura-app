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

 
/* ADMIN */
mix.js('resources/js/admin.js', 'public/js/admin_tmp1.js');
mix.sass('resources/sass/admin.scss', 'public/css/admin_tmp1.css');

mix.scripts([
	'resources/assets/admin/jquery-uploadfile/js/jquery.uploadfile.js',
	'resources/assets/admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
	],'public/js/admin_tmp2.js');

mix.scripts([
	'public/js/admin_tmp1.js',
	'public/js/admin_tmp2.js'
	],'public/js/admin-3.0.3.js');


mix.styles([
	'public/css/admin_tmp1.css',
	'resources/assets/admin/jquery-uploadfile/css/uploadfile.css',
	'resources/assets/admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
	],'public/css/admin-3.0.4.css');
	

mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce/themes', 'public/js/themes');
