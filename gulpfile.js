var gulp = require("gulp");
var gutil = require("gulp-util");
var rename = require('gulp-rename');
var clean = require('gulp-clean');
var webpack = require("webpack");
var WebpackDevServer = require("webpack-dev-server");

gulp.task("webpack-dev-server", function (callback) {
    var configDev = require("./webpack.dev.config");

    // Start a webpack-dev-server
    var compiler = webpack(configDev);

    new WebpackDevServer(compiler, {
        // server and middleware options
    }).listen(8080, "localhost", function (err) {
        if (err) throw new gutil.PluginError("webpack-dev-server", err);
        // Server listening
        gutil.log("[webpack-dev-server]", "http://localhost:8080/webpack-dev-server/index.html");

        // keep the server alive or continue?
        // callback();
    });
});

gulp.task("webpack", function (callback) {
    var configProd = require("./webpack.prod.config");

    // run webpack
    webpack(configProd, function (err, stats) {
        if (err) throw new gutil.PluginError("webpack", err);
        gutil.log("[webpack]", stats.toString({
            // output options
        }));
        callback();
    });
});

gulp.task("build", ["webpack"], function (callback) {
    gulp.src("public/dist/index.html")
        .pipe(clean())
        .pipe(rename('index.php'))
        .pipe(gulp.dest("resources/views"));
});