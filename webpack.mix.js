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

mix.copyDirectory('resources/assets/manifest', 'public/');
mix.copyDirectory('resources/assets/core', 'public/'); 

/* VERTIKAL TRIP & JOGJAFOODTOUR */
mix.js('resources/js/vertikaltrip.js', 'public/js/vertikaltrip-tmp.js');
mix.sass('resources/sass/vertikaltrip.scss', 'public/css/vertikaltrip-tmp.css');

mix.scripts([
	'resources/assets/vertikaltrip/assets/javascripts/apps/build/0.64cdccc40b9065595318.js',
	],'public/assets/javascripts/apps/build/0.64cdccc40b9065595318.js');


mix.scripts([
	'resources/assets/vertikaltrip/assets/javascripts/apps/build/100.7a31e40fbb31ca0a64f6.js',
	],'public/assets/javascripts/apps/build/100.7a31e40fbb31ca0a64f6.js');


mix.scripts([
	'resources/assets/vertikaltrip/assets/javascripts/widgets/687035c46b475965b2131d0e804b858e-widget-utils.js',
	],'public/assets/javascripts/widgets/687035c46b475965b2131d0e804b858e-widget-utils.js');

mix.scripts([
	'resources/assets/vertikaltrip/assets/javascripts/apps/build/ActivityBookingWidget.js',
	],'public/assets/javascripts/apps/build/ActivityBookingWidget.3.1.0.js');

mix.scripts([
	'resources/assets/vertikaltrip/assets/javascripts/apps/build/App.js',
	],'public/assets/javascripts/apps/build/App-3.1.0.js');
	
mix.scripts([
	'public/js/vertikaltrip-tmp.js',
	'public/assets/javascripts/widgets/687035c46b475965b2131d0e804b858e-widget-utils.js',
	],'public/js/vertikaltrip-3.1.1.js');

mix.styles([
	'resources/assets/vertikaltrip/assets/stylesheets/32c9c6fd0c7902a484471023a898dec1-activity-time-selector.css',
	],'public/assets/stylesheets/32c9c6fd0c7902a484471023a898dec1-activity-time-selector.css');

mix.styles([
	'public/css/vertikaltrip-tmp.css',
	'public/assets/stylesheets/32c9c6fd0c7902a484471023a898dec1-activity-time-selector.css',
	],'public/css/vertikaltrip-3.1.3.css');



mix.copyDirectory('resources/assets/vertikaltrip/img/core', 'public/img');

mix.copyDirectory('resources/assets/jogjafoodtour/img/core', 'public/img'); 
mix.copyDirectory('resources/assets/jogjafoodtour/img/gallery', 'public/img');
mix.copyDirectory('resources/assets/jogjafoodtour/img/tourguide', 'public/img'); 

 
/* ADMIN
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
	],'public/css/admin-3.0.3.css');
	

mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce/themes', 'public/js/themes');
 */
 


/* RATNAWAHYU
mix.js('resources/js/ratnawahyu.js', 'public/js/ratnawahyu_tmp1.js');
mix.sass('resources/sass/ratnawahyu.scss', 'public/css/ratnawahyu_tmp1.css');


mix.scripts([
	'resources/assets/ratnawahyu/jquery-easing/jquery.easing.min.js',
	'resources/assets/ratnawahyu/jquery-infinite-scroll/jquery.infinitescroll.min.js',
	'resources/assets/ratnawahyu/photoset-grid/jquery.photoset-grid.min.js',
	'resources/assets/ratnawahyu/imagesloaded/imagesloaded.pkgd.min.js',
	'resources/assets/ratnawahyu/back-to-top/js/main.js',
	],'public/js/ratnawahyu_tmp2.js');

mix.styles([
	'resources/assets/ratnawahyu/jquery-infinite-scroll/main.css',
	'resources/assets/ratnawahyu/photoset-grid/css/main.css',
	'resources/assets/ratnawahyu/back-to-top/css/style.css'
	],'public/css/ratnawahyu_tmp2.css');

mix.scripts([
	'public/js/ratnawahyu_tmp1.js',
	'public/js/ratnawahyu_tmp2.js'
	],'public/js/ratnawahyu-3.0.3.js');


mix.styles([
	'public/css/ratnawahyu_tmp1.css',
	'public/css/ratnawahyu_tmp2.css'
	],'public/css/ratnawahyu-3.0.3.css');

mix.copyDirectory('resources/assets/ratnawahyu/back-to-top/img', 'public/img');
mix.copyDirectory('resources/assets/ratnawahyu/img/core', 'public/img');
mix.copy('resources/assets/ratnawahyu/jquery-infinite-scroll/output_DTGK2a.gif', 'public/img/output_DTGK2a.gif');
 */
 
 /* MAIL
 mix.copyDirectory('resources/assets/mail/img/avatars', 'public/img');
 mix.copyDirectory('resources/assets/mail/js', 'public/js');
 mix.copyDirectory('resources/assets/mail/css', 'public/css');
 mix.copyDirectory('resources/assets/mail/font-awesome', 'public/fonts/vendor/font-awesome');
 mix.copyDirectory('resources/assets/mail/icheck', 'public/images/vendor/icheck');
 mix.copyDirectory('resources/assets/mail/bootstrap', 'public/fonts/vendor/bootstrap');
  */