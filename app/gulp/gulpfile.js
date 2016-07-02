var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var plumber = require('gulp-plumber');
var strip = require('gulp-strip-comments');
var uglify = require('gulp-uglify');
var browserify = require('gulp-browserify');

var sourceBower = 'web/bower/';
var sourceDir = 'app/gulp/';
var sourceJsDir = sourceDir + 'js/';

var targetPublicAssets = 'web/dist/';

var config = {
  sources: {
    scss: {
      external: [
        sourceBower + 'foundation-sites/dist/foundation.min.css',
        sourceBower + 'fontawesome/css/font-awesome.min.css',
        sourceBower + 'sweetalert/dist/sweetalert.css'
      ],
      internal: [
        sourceDir + 'scss/index.scss'
      ]
    },
    js: {
      external: [
        sourceBower + 'jquery/dist/jquery.min.js',
        sourceBower + 'foundation-sites/dist/foundation.min.js',
        sourceBower + 'sweetalert/dist/sweetalert.min.js'
      ],
      internal: [
        sourceJsDir + 'index.js'
      ]
    }
  }
};

gulp.task('css-external', function(){
  return gulp.src(config.sources.scss.external)
    .pipe(plumber())
    .pipe(concat('external.css'))
    .pipe(gulp.dest(targetPublicAssets + 'css'))
    ;
});

gulp.task('css', function(){
  return gulp.src(config.sources.scss.internal)
    .pipe(plumber())
    .pipe(sass())
    .pipe(concat('bundle.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(targetPublicAssets + 'css'))
    ;
});

gulp.task('copy-fonts', function(){
  gulp.src([
    sourceBower + 'fontawesome/fonts/*.*'
  ], [{ base: 'bower/' }])
    .pipe(gulp.dest('web/fonts'))
  ;
});

gulp.task('copy-files', ['copy-fonts'], function(){
  //return gulp.src(sourceScssDir + 'responsive/**/*.css')
  //    .pipe(gulp.dest('web/css/responsive'));
});

gulp.task('js-external', function(){
  return gulp.src(config.sources.js.external)
    .pipe(strip())
    .pipe(uglify())
    .pipe(concat('external.js'))
    .pipe(gulp.dest(targetPublicAssets + 'js/'))
    ;
});

gulp.task('js', function(){
  return gulp.src(config.sources.js.internal)
    .pipe(strip())
    .pipe(browserify({
      insertGlobals: true,
      debug: false
    }))
    .pipe(uglify())
    .pipe(concat('bundle.js'))
    .pipe(gulp.dest(targetPublicAssets + 'js/'))
    ;
});

gulp.task('watch', ['css'], function(){
  gulp.watch([
    sourceDir + 'scss/**/*.scss'
  ], ['css'])
});

gulp.task('default', ['css', 'css-external', 'copy-files', 'js', 'js-external']);
