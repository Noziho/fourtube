const webpack = require('webpack');
const path = require('path');

module.exports = {

    entry: './assets/js/app.js',
    output: {
        path: path.resolve('public/assets/js'),
        filename: "bundle.js",
    },

    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
            }
        ]
    }
}