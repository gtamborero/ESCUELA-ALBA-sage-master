var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');
var sourcemaps  = require('gulp-sourcemaps');

// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: "http://src.wordpress-develop.dev/"
    });

    gulp.watch("scss/*.scss", ['sass']);
    gulp.watch("*.php").on('change', browserSync.reload);
	gulp.watch("pages/*.php").on('change', browserSync.reload);
	gulp.watch("templates/*.php").on('change', browserSync.reload);
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp
		.src("scss/*.scss")
        .pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest("dist/styles"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);