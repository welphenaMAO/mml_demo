'use strict';
//php开发用，只有页面自动刷新
var gulp = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('reload', function() {
    browserSync.init({
        port: 3000,
        proxy: 'http://study.mml.local/',
    });
    gulp.watch('./wp-content/themes/**/*.php', browserSync.reload);
    gulp.watch('./wp-common/*.php', browserSync.reload);
});
