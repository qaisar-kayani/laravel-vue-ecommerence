const mix = require('laravel-mix');
require('dotenv').config();
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


mix //for admin
	.js('resources/js/Modules/admin/admin.js', 'public/js/admin.js') //admin
	.js('resources/js/Modules/vendor/vendor.js', 'public/js/vendor.js') //vendor
.js('resources/js/Modules/frontend/frontend.js', 'public/js/app.js')//front end

	.scripts(
		[
			'public/assets/vendor/jquery/jquery.min.js',
			'public/assets/vendor/feather-icons/feather.min.js',
			'public/assets/vendor/simplebar/simplebar.min.js',
			'public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
			'public/assets/vendor/highlight.js/highlight.pack.js',
			'public/assets/vendor/quill/quill.min.js',
			'public/assets/vendor/air-datepicker/js/datepicker.min.js',
			'public/assets/vendor/air-datepicker/js/i18n/datepicker.en.js',
			'public/assets/vendor/select2/js/select2.min.js',
			'public/assets/vendor/fontawesome/js/all.min.js',
			'public/assets/vendor/chart.js/chart.min.js',
			'public/assets/vendor/datatables/js/jquery.dataTables.min.js',
			'public/assets/vendor/datatables/js/dataTables.bootstrap5.min.js',
			'public/assets/vendor/nouislider/nouislider.min.js',
			// 'public/assets/js/stroyka.js',
			// 'public/assets/js/custom.js',
			'public/assets/js/demo.js',
			// 'public/assets/js/demo-chart-js.js'
		],
		'public/js/theme.js'
	)
	.vue()
	.postCss(
		'resources/css/app.css',
		'public/css/app.css',
		[
			//
		]
	);
