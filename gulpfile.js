var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	var dirForBower ='resources/assets/bower';

	var bpath = dirForBower + '/bootstrap-sass/assets';
	var jqueryPath = dirForBower + '/jquery';

	mix.sass('app.scss')
		.copy(jqueryPath + '/dist/jquery.min.js', 'public/js')
		.copy(bpath + '/fonts', 'public/fonts')
		.copy(bpath + '/javascripts/bootstrap.min.js', 'public/js')
		.scripts([
			'../bower/jquery/dist/jquery.min.js',
			'../bower/bootstrap-sass/assets/javascripts/bootstrap.min.js'
		], '/public/js/merged/app.min.js'); //ovde stavi sve zajedno
});



// elixir(function(mix) {
//     mix.sass('app.scss').version('css/app.css');
// });
