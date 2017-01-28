var path = require('path');
var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
    devtool: 'source-map',
    entry: {
        app: [
            'babel-polyfill',
            path.join(__dirname, 'resources/assets', 'app/app.js')
        ]
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: [/app\/lib/, /node_modules/],
                loader: 'ng-annotate!babel?presets[]=es2015'
            },
            {
                test: /\.html$/,
                loader: 'raw'
            },
            {
                test: /\.(scss|sass)$/,
                loader: 'style!css!sass'
            },
            {
                test: /\.css$/,
                loader: 'style!css'
            },
            {
                test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: "url-loader?limit=10000&minetype=application/font-woff"
            },
            {
                test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: "file-loader"
            }
        ]
    },
    plugins: [
        new HtmlWebpackPlugin({
            template: 'resources/assets/index.html',
            inject: 'body',
            hash: true
        }),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            minChunks: function (module, count) {
                return module.resource && module.resource.indexOf(path.resolve(__dirname, 'resources/assets/app')) === -1;
            }
        })
    ]
};