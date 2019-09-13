const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');

const purgecss = require('@fullhuman/postcss-purgecss')({

	// Specify the paths to all of the template files in your project
	content: [
		'./resources/js/**/*.js',
		'./resources/js/**/*.vue',
		// './resources/views/**/*.blade.php',
		// etc.
	],

	// Include any special characters you're using in this regular expression
	defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
})


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
    .postCss('resources/css/app.css', 'public/css', [
	    require('postcss-import'),
	    require('tailwindcss'),
	    require('postcss-nested'),
	    require('postcss-custom-properties'),
	    require('postcss-custom-properties'),
	    require('autoprefixer'),
	    ...process.env.NODE_ENV === 'production'
		    ? [purgecss]
		    : []
    ])
	.options({
		processCssUrls: false,
		postCss: [ tailwindcss('./tailwind.config.js') ],
	})
	.version()
	.webpackConfig({
		output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
		resolve: {
			alias: {
				vue$: 'vue/dist/vue.runtime.esm.js',
				'@': path.resolve('resources/js'),
			},
		},
	})
	.babelConfig({
		plugins: ['@babel/plugin-syntax-dynamic-import'],
	});
