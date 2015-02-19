module.exports = function(grunt) {

 var config = {
    author: 'PixelMEDIA',
    webRoot: '',
    deploy: ''
  }; //config

  grunt.initConfig({

    sass: {
      dev: {
          files: {
            'includes/front/css/style.css': 'scss/style.scss'
          }, //files
          options: {
            outputStyle: 'nested'
          } //options
      }, //dev
      dist: {
          files: {
            'includes/front/css/style.css': 'scss/style.scss'
          }, //files
          options: {
            outputStyle: 'compressed'
          } //options
      } //dist
    }, //sass

    jshint: {
        options: {
          browser: true,
          boss: true
        }, //options
        src: ['js/main.js']
    }, //jshint

    notify_hooks: {
      options: {
        enabled: true,
        max_jshint_notifications: 5, // maximum number of notifications from jshint output
        success: true, // whether successful grunt executions should be notified automatically
        duration: 3 // the duration of notification in seconds, for `notify-send only
      } //options
    }, //notify_hooks

    uglify: {
      options: {
        // This creates a note within common.min.js saying who created the file
        banner: '/* ' + config.author + ' - <%= grunt.template.today("yyyy-mm-dd") %>\n' +
          '* Copyright (c) <%= grunt.template.today("yyyy") %> ' + config.author + ';*/ \n',
        mangle: true
      }, //options
      plugins: {
        src: config.webRoot + 'includes/front/js/plugins/*',
        dest: config.deploy + 'includes/front/js/plugins.min.js'
      }, //plugins
      build: {
        src: config.webRoot + 'includes/front/js/main.js',
        dest: config.deploy + 'includes/front/js/main.min.js'
      } //build
    }, //uglify

    watch: {
      options: { 
        livereload: true 
      }, //options
      scss: {
        files: ['scss/**'],
        tasks: ['sass:dev']
      }, //sass
    } //watch

  }); //grunt.initConfig

  // Load the plugins
  grunt.loadNpmTasks('grunt-notify');
  require('time-grunt')(grunt);
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Default task(s).
  grunt.registerTask('init', ['bowercopy', 'uglify:plugins']);
  grunt.registerTask('dev', ['watch']);
  grunt.registerTask('dist', ['sass:dist, uglify:build, uglify:lib, uglify:plugins']);

  grunt.task.run('notify_hooks');

};