var gulp = require('gulp');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var browserSync = require('browser-sync');

var bsport = 8080;
var dir = "./public_html/";


gulp.task('sass', function() {
  gulp.src(dir+'res/scss/*.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(gulp.dest(dir+'res/css'));
});

gulp.task('browser-sync', function() {
  browserSync({
      port : bsport,
      server: {
        baseDir: dir,
        index  : "index.html"
      },
      files: [
        dir+"*.html",
        dir+"res/css/*.css",
        dir+"res/js/*.js"
      ]
  });
});

gulp.task('default', ['browser-sync', 'sass'], function () {
    gulp.watch(dir+"res/scss/*.scss", ['sass']);
});
