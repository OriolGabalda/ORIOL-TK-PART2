const gulp = require('gulp'),
 sass = require('gulp-sass'),
 autoprefixer = require('gulp-autoprefixer');

const minify = require('gulp-minify');

gulp.task( 'sass', ()=>
	gulp.src('./scss/*.scss')
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(autoprefixer({
			version: ['last 2 browsers']
		}))
		.pipe(gulp.dest('./css'))
);

gulp.task( 'compress', () =>
	gulp.src('./js/*.js')
	.pipe(minify())
	.pipe(gulp.dest('./js'))
);
