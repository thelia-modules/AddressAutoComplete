var gulp = require('gulp');
var babel = require('gulp-babel');
var uglifyEs = require('gulp-uglify-es').default;
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');

function minifyJs(cb) {
    return gulp.src("assets/src/auto-complete.js")
        .pipe(babel())
        .pipe(uglifyEs())
        .pipe(rename({extname: '.min.js'}))
        .pipe(gulp.dest("assets/dist/"));
    cb();
}

function minifyCss(cb) {
    return gulp.src("assets/src/auto-complete.css")
        .pipe(cleanCSS({debug: true}, (details) => {
            console.log(`${details.name}: ${details.stats.originalSize} => ${details.stats.minifiedSize}`);
        }))
        .pipe(rename({extname: '.min.css'}))
        .pipe(gulp.dest("assets/dist/"));
    cb();
}

gulp.task('js', minifyJs);
gulp.task('css', minifyCss);

exports.default = gulp.series(minifyCss, minifyJs);