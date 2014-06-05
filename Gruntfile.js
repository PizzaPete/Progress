module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		uglify: {
	    	build: {
				files: {
					'assets/js/build/plugins.js': ['assets/js/vendor/*.js','assets/js/plugins/*.js']
				}
			}
	  	},
	  	compass: {
			dist: {
				options: {
					sassDir: 'assets/css/sass',
					cssDir: 'assets/css'
				}
			}
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['compass']
			}
		}
	});
	
	// Load the plugin that provides the "uglify" task.
	  grunt.loadNpmTasks('grunt-contrib-uglify');
	  grunt.loadNpmTasks('grunt-contrib-compass');
	  grunt.loadNpmTasks('grunt-contrib-watch');
	
	  // Default task(s).
	  grunt.registerTask('default', ['uglify', 'watch']);
};
