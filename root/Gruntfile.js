module.exports = function( grunt ) {

	'use strict';

	var banner = '/**\n * {%= title %}\n * {%= homepage %}\n *\n * Copyright (c) {%= grunt.template.today('yyyy') %} {%= author_name %}\n */\n';

	// Load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Project configuration
	grunt.initConfig( {

		pkg:    grunt.file.readJSON( 'package.json' ),

		// JS Minification & Concatenation
		uglify: {

			dev: {
				options: {
					preserveComments: true,
					sourceMap: function( dest ) { return dest + '.map' },
					sourceMappingURL: function( dest ) { return dest.replace(/^.*[\\\/]/, '') + '.map' },
					sourceMapRoot: '/',
					beautify: true
				},
				files: {
					'assets/js/theme.js': ['assets/js/src/theme.js']
				}
			},

			prod: {
				options: {
					preserveComments: false,
					banner: banner,
					mangle: { except: ['jQuery'] }
				},
				files: {
					'assets/js/theme.min.js': ['assets/js/src/theme.js']
				}
			}

		},

		{% if ('sass' === css_type) { %}
		// Compile SASS
		sass: {

			compile: {
				files: {
					'assets/css/theme.css' : 'assets/css/sass/theme.scss'
				}
			}

		},

		// Minify CSS
		cssmin: {

			theme: {

				options: {
					banner: banner
				},

				files: {
					'assets/css/theme.min.css': ['assets/css/theme.css']
				}

			}

		},
		{% } else if ('less' === css_type) { %}
		less: {

			dev: {
				options: {
					dumpLineNumbers: 'comments',
					banner: banner
				},
				files: {
					"assets/css/theme.css": "assets/css/less/theme.less"
				}
			},

			prod: {
				options: {
					yuicompress: true,
					banner: banner
				},
				files: {
					"assets/css/theme.min.css": "assets/css/less/theme.less"
				}
			}

		},
		{% } else { %}
		// Minify CSS
		cssmin: {

			theme: {

				options: {
					banner: '/**\n * {%= title %}\n * {%= homepage %}\n *\n * Copyright (c) {%= grunt.template.today('yyyy') %} {%= author_name %}\n */\n'
				},

				files: {
					'assets/css/theme.min.css': ['assets/css/theme.css']
				}

			}

		},
		{% } %}

		// Watch for changes
		watch:  {

			sass: {
				files: ['assets/css/*/**/*.scss'],
				tasks: ['sass', 'cssmin'],
				options: {
					debounceDelay: 500,
					livereload: true
				}
			},

			scripts: {
				files: ['assets/js/*/**/*.js'],
				tasks: ['uglify'],
				options: {
					debounceDelay: 500
				}
			}

		}
	} );

	// Default task.
	{% if ('sass' === css_type) { %}
	grunt.registerTask( 'default', ['uglify', 'sass', 'cssmin'] );
	{% } else if ('less' === css_type) { %}
	grunt.registerTask( 'default', ['uglify', 'less', 'cssmin'] );
	{% } else { %}
	grunt.registerTask( 'default', ['uglify', 'cssmin'] );
	{% } %}

	grunt.util.linefeed = '\n';

};