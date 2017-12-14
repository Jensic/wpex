var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
//var uglify = require('gulp-uglify');
var bs = require('browser-sync').create();
var notify = require('gulp-notify');
var growl = require('gulp-notify-growl');
var growlNotifier = growl();
var jscs = require('gulp-jscs');
var jshint = require('gulp-jshint');
var eslint = require('gulp-eslint');
var babelify = require('babelify');
var browserify = require('gulp-browserify');
var source = require('vinyl-source-stream');

var webpack = require('webpack');
var babel = require('gulp-babel');

let uglifyes = require('uglify-es');
let composer = require('gulp-uglify/composer');
let uglify = composer(uglifyes, console);

gulp.task('compress', function () {
    return gulp.src('src/js/**/*.js')
	.pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./js'))
});

gulp.task('jsscripts', function () {
    return gulp.src('src/js/**/*.js')
        .pipe(babel())
        .pipe(concat('all.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js'));
});

gulp.task('jsscripts2', function(callback) {
  webpack(require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });
});

gulp.task('scripts', function() {
    return gulp.src('src/js/**/*.js')
    //return gulp.src('src/**/*.js')
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(jscs())
    .pipe(notify({
            title: 'JSCS',
            message: 'JSCS Passed. Let it fly!',
            notifier: growlNotifier
        }))
    .pipe(gulp.dest('./js'))

});

gulp.task('sass', function() {

    return gulp.src('src/scss/**/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('css'))
        .pipe(bs.reload({ stream: true }))

});

gulp.task('browser-sync', ['sass'], function() {

    bs.init({
        server: {
            baseDir: "./"
        }
    })

});

gulp.task('jscs', function() {
    gulp.src('src/js/**/*.js')
        .pipe(jscs())
        .pipe(notify({
            title: 'JSCS',
            message: 'JSCS Passed. Let it fly!',
            notifier: growlNotifier
        }))
});

gulp.task('lint', function() {
    gulp.src('src/js/**/*.js')
        //.pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'))
        .pipe(notify({
            title: 'JSHint',
            message: 'JSHint Passed. Let it fly!',
        }))
});

gulp.task('eslint', () => {
    // ESLint ignores files with "node_modules" paths. 
    // So, it's best to have gulp ignore the directory as well. 
    // Also, Be sure to return the stream from the task; 
    // Otherwise, the task may end before the stream has finished. 
    return gulp.src(['src/js/**/*.js','!node_modules/**'])
        // eslint() attaches the lint output to the "eslint" property 
        // of the file object so it can be used by other modules. 
        .pipe(eslint())
        // eslint.format() outputs the lint results to the console. 
        // Alternatively use eslint.formatEach() (see Docs). 
        .pipe(eslint.format())
        // To have the process exit with an error code (1) on 
        // lint error, return the stream and pipe to failAfterError last. 
        .pipe(eslint.failAfterError());
});
 
gulp.task('default', ['lint'], function () {
    // This will only run if the lint task is successful... 
});

/*//Default task. This will be run when no task is passed in arguments to gulp
gulp.task("default", ["build"]);

//Convert ES6 ode in all js files in src/js folder and copy to 
//build folder as bundle.js
gulp.task("build", function(){
    return browserify({
      entries: ["./js/app.js"]
    })
    .transform(babelify)
    .bundle()
    .pipe(source("bundle.js"))
    .pipe(gulp.dest("./build"));
});*/

gulp.task('watch',['browser-sync'], function() {
    gulp.watch('src/scss/**/*.scss', ['sass']);
    gulp.watch('src/**/*.js', ['scripts']);
    gulp.watch('*.html').on("change", bs.reload);
});