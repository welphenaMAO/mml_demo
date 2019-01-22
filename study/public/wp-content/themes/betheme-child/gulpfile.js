'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();
var ejs = require("gulp-ejs");
var sourcemaps = require('gulp-sourcemaps');

gulp.task('browser-sync', ['sass', 'ejs', 'copy-font'], function() {
        browserSync.init({
            port: 3000,
            proxy: 'http://reconproject1.mml.local/',
        });

    gulp.watch('./src/sass/**/*.scss', ['sass']);
    gulp.watch('./src/views/**/*.ejs', ['ejs']);
    gulp.watch('./src/images/**/*', ['copy-images']);
    gulp.watch('./src/fonts/**/*', ['copy-font']);
    gulp.watch('./**/*.php', browserSync.reload);
    gulp.watch('../../../wp-common/*.php', browserSync.reload);
});

gulp.task('sass', function () {
 return gulp.src('./src/sass/main.scss')
   .pipe(sourcemaps.init())
   .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
   .pipe(sourcemaps.write())
   .pipe(autoprefixer({
        browsers: ['last 10 versions']
   }))
   .pipe(gulp.dest('./dist/css'))
   .pipe(browserSync.stream());
});

gulp.task('ejs', function() {
    return gulp.src('./src/views/pages/index.ejs')
    .pipe(ejs({}, {}, {ext: '.html'}))
    .pipe(gulp.dest('./dist'))
    .pipe(browserSync.stream());
});

gulp.task('copy-images', function(){
    gulp.src(['./src/images/**/*']).pipe(gulp.dest('./dist/images'))
    .pipe(browserSync.stream());;
});

gulp.task('copy-font', function(){
    gulp.src(['./src/fonts/**/*']).pipe(gulp.dest('./dist/fonts'))
    .pipe(browserSync.stream());;
});

// This is the entry point
gulp.task('dev', function () {
    gulp.watch('./src/sass/**/*.scss', ['sass']);
    gulp.watch('./src/views/**/*.ejs', ['ejs']);
    gulp.watch('./src/images/**/*', ['copy-images']);
    gulp.watch('./src/fonts/**/*', ['copy-font']);
 //gulp.watch('./**/*.php', browserSync.reload);
});
