module.exports = function(grunt) {
    grunt.initConfig({
		sass: {			
            dist: {
				options: {
					outputStyle: 'compressed'
				},
                files: [{
                    'assets/css/main.css':              'assets/scss/main.scss', 	                        /* 'All main SCSS' */

                    'light/assets/css/default.css':     'assets/scss/skins/default.scss',                   /* 'Theme SCSS to css path' */
                    'dark/assets/css/dark.css':         'assets/scss/skins/dark.scss',                      /* 'Theme SCSS to css path' */

                    'theme1/assets/css/theme1.css':     'assets/scss/skins/theme1.scss',                    /* 'Theme SCSS to css path' */                    
                    'theme2/assets/css/theme2.css':     'assets/scss/skins/theme2.scss',                    /* 'Theme SCSS to css path' */                    
                    'rtl/assets/css/theme3.css':        'assets/scss/skins/theme3.scss',                    /* 'Theme SCSS to css path' */
                    'horizontal/assets/css/theme4.css': 'assets/scss/skins/theme4.scss',                    /* 'Theme SCSS to css path' */
				}]
            }
        },  
        uglify: {
            my_target: {
              files: {
                    'assets/bundles/lib.vendor.bundle.js':   ['assets/plugins/jquery/jquery-3.4.1.min.js','assets/plugins/bootstrap/js/bootstrap.bundle.min.js','assets/plugins/metisMenu/metisMenu.js','assets/plugins/sparkline/sparkline.js','assets/js/vendors/circle-progress.min.js','assets/plugins/listjs/list.js'], /* main js*/
                    
                    /* 'assets/bundles/mainscripts.bundle.js':  ['assets/js/core.js'], /*coman js*/

                    'assets/bundles/counterup.bundle.js':           ['assets/plugins/counterjs/jquery.waypoints.js', 'assets/plugins/counterjs/jquery.counterup.min.js'],

                    'assets/bundles/c3.bundle.js':           ['assets/plugins/charts-c3/c3.min.js', 'assets/plugins/charts-c3/d3.v3.min.js'],
                    'assets/bundles/fullcalendar.bundle.js': ['assets/plugins/fullcalendar/moment.min.js', 'assets/plugins/fullcalendar/fullcalendar.min.js'],
                    'assets/bundles/summernote.bundle.js':   ['assets/plugins/summernote/dist/summernote.js'],
                    'assets/bundles/sweetalert.bundle.js':   ['assets/plugins/sweetalert/sweetalert.min.js'],
                    'assets/bundles/nestable.bundle.js':     ['assets/plugins/nestable/jquery.nestable.js'],
                    'assets/bundles/markdown.bundle.js':     ['assets/plugins/markdown/markdown.js','assets/plugins/markdown/to-markdown.js','assets/plugins/markdown/bootstrap-markdown.js'],
                    
                    'assets/bundles/flot.bundle.js':         ['assets/plugins/flot-charts/flot.js','assets/plugins/flot-charts/flot.resize.js','assets/plugins/flot-charts/flot.pie.js','assets/plugins/flot-charts/flot.categories.js','assets/plugins/flot-charts/flot.time.js'],
                    'assets/bundles/knobjs.bundle.js':       ['assets/plugins/knobjs/knob.min.js'],
                    'assets/bundles/echarts.bundle.js':      ['assets/plugins/echart/echarts.min.js'],
                    'assets/bundles/apexcharts.bundle.js':   ['assets/plugins/apexcharts/apexcharts.min.js'],
                    
                    
                    'assets/bundles/jvectormap1.bundle.js':  ['assets/plugins/jvectormap/jvectormap-2.0.3.min.js','assets/plugins/jvectormap/jvectormap-world.js','assets/plugins/jvectormap/jvectormap-in.js','assets/plugins/jvectormap/jvectormap-us.js','assets/plugins/jvectormap/jvectormap-au.js','assets/plugins/jvectormap/jvectormap-uk.js'],
                    'assets/bundles/jvectormap2.bundle.js':  ['light/assets/js/map/jquery-jvectormap-2.0.3.min.js', 'light/assets/js/map/jquery-jvectormap-de-merc.js', 'light/assets/js/map/jquery-jvectormap-world-mill.js'],
                    
                    'assets/bundles/selectize.bundle.js':    ['light/assets/js/vendors/selectize.min.js'],                    
                    
                    'assets/bundles/dataTables.bundle.js':[
                        'assets/plugins/datatable/jquery.dataTables.min.js',
                        'assets/plugins/datatable/dataTables.bootstrap4.min.js',
                        'assets/plugins/datatable/buttons/dataTables.buttons.min.js',
                        'assets/plugins/datatable/buttons/buttons.bootstrap4.min.js',
                        'assets/plugins/datatable/buttons/buttons.colVis.min.js',
                        'assets/plugins/datatable/buttons/buttons.html5.min.js',
                        'assets/plugins/datatable/buttons/buttons.print.min.js'], /*chartist js*/
                  }
              }
          }                      
    });
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    grunt.registerTask("buildcss", ["sass"]);
    grunt.registerTask("buildjs", ["uglify"]);
};
