'use strict';
 
var gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano");
    // sourcemaps = require("gulp-sourcemaps"),
    // browserSync = require("browser-sync").create();

var paths = {
    styles: {
        // use any scss files in this location
        src: "assets/sass/*.scss",
        // Compiled files will end up here
        dest: "assets/css/"
    }
};

function style() {
    return gulp
        .src(paths.styles.src)
        // Initialize sourcemaps before compilation starts - disabled
        // .pipe(sourcemaps.init())
        .pipe(sass())
        .on("error", sass.logError)
        // Use postcss with autoprefixer and compress the compiled file using cssnano
        .pipe(postcss([autoprefixer(), cssnano()]))
        // Now add/write the sourcemaps
        // .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.styles.dest));
        // Add browsersync stream pipe after compilation
        // .pipe(browserSync.stream());
}

// Expose the task by exporting it
// This allows you to run it from the commandline using gulp style. this is what I use mainly
exports.style = style;

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
var build = gulp.parallel(style);
 
/*
 * You can still use `gulp.task` to expose tasks
 */
gulp.task('build', build);
 
/*
 * Define default task that can be called by just running `gulp` from cli
 */
gulp.task('default', build);