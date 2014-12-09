module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      build: {
        src: 'js/scripts.js',
        dest: 'js/scripts.min.js'
      }
    },
    cssmin: {
 	  options: {
		 banner: '/*\nTheme Name: FAU\nTheme URI: www.fau.de\nAuthor: RRZE und Medienreaktor GmbH\nAuthor URI: http://www.rrze.fau.de und http://www.medienreaktor.de\nDescription: Wordpress-Theme der Startseite der Friedrich-Alexander-Universität Erlangen-Nürnberg (FAU).\nVersion: 1.1.8\nLicense: GNU General Public License v2 or later\nLicense URI: http://www.gnu.org/licenses/gpl-2.0.html\nTags: blue\nText Domain: fau\n*/\n'
	  },
	  build: {
	    src: ['css/fonts.css', 'css/basis.css', 'css/mediaqueries.css', 'css/print.css'],
	    dest: 'style.css'
	  }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'cssmin']);

};