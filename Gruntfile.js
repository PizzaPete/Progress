module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
	  uglify: {
	    build: {
			files: {
				'assets/js/build/plugins.js': ['assets/js/plugins/*.js']
			}
		}
	  }
	});
	
	// Load the plugin that provides the "uglify" task.
	  grunt.loadNpmTasks('grunt-contrib-uglify');
	
	  // Default task(s).
	  grunt.registerTask('default', ['uglify']);
};