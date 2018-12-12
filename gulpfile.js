"use strict";

const gulpfile       = require ( 'gulp' ),
      inject         = require ( 'gulp-inject' ),
      concat         = require ( 'gulp-concat' ),
      concatCss      = require ( 'gulp-concat-css' ),
      rename         = require ( 'gulp-rename' ),
      uglify         = require ( 'gulp-uglify' ),
      minify         = require ( 'gulp-minify' ),
      cleanCSS       = require ( 'gulp-clean-css' ),
      pump           = require ( 'pump' ),
      autoprefixer   = require ( 'gulp-autoprefixer' ),
      libraries      = './node_modules/',
      assets         = './assets/',
      build          = './assets/build/',

      css_src_vendor = [
	      libraries + "bootstrap/dist/css/bootstrap.min.css",
	      assets + 'css/style.css',
      ],

      css_src_app    = [
	      // ignore, too small
      ],

      js_src_vendor  = [
	      libraries + "jquery/dist/jquery.min.js",
	      libraries + "bootstrap/dist/js/bootstrap.bundle.min.js",
	      assets + 'js/api.js',
	      assets + 'js/app.js'
      ],

      js_src_app     = [
	      // ignore, too small
      ],

      js_build       = [
	      build + 'build.app.js',
      ],

      css_build      = [
	      build + 'build.app.css'
      ];

gulpfile.task ( 'build-css', function ( done ) {
	pump ( [
			gulpfile.src ( css_src_vendor, { allowEmpty : true, relative: true } ),
			concatCss ( 'build.app.css' ),
			cleanCSS ( { compatibility : 'ie8' } ),
			autoprefixer (),
			gulpfile.dest ( build )
		],
		done ()
	);
} );

gulpfile.task ( 'build-js', function ( done ) {
	pump ( [
			gulpfile.src ( js_src_vendor, { allowEmpty : true, relative: true } ),
			concat ( 'build.app.js' ),
			uglify (),
			gulpfile.dest ( build )
		],
		done ()
	);
} );

gulpfile.task ( 'inject', function ( done ) {
	pump ( [
			gulpfile.src ( 'assets/src.php' ),
			inject ( gulpfile.src ( css_build, {
				read : false,
				allowEmpty : true,
			} ), { ignorePath : '/', addRootSlash: false } ),
			inject ( gulpfile.src ( js_build, {
				read : false,
				allowEmpty : true,
				relative: true
			} ), { ignorePath : '/', addRootSlash: false } ),
			rename ( 'index-production.php' ),
			gulpfile.dest ( './' )
		],
		done ()
	);
} );

gulpfile.task ( 'inject-dev', function ( done ) {
	pump ( [
			gulpfile.src ( 'assets/src.php' ),
			inject ( gulpfile.src ( css_src_vendor, {
				read : false,
				allowEmpty : true,
			} ), { ignorePath : '/', addRootSlash: false } ),
			inject ( gulpfile.src ( js_src_vendor, {
				read : false,
				allowEmpty : true,
				relative: true
			} ), { ignorePath : '/', addRootSlash: false } ),
			rename ( 'index.php' ),
			gulpfile.dest ( './' )
		],
		done ()
	);
} );

gulpfile.task ( 'default', gulpfile.series (
	'build-css',
	'build-js',
	'inject',
	'inject-dev',
	function ( done ) {
		console.log ( 'done building account app . . . ' );
		done ();
	} ) );