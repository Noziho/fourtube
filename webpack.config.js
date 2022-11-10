const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin");


module.exports = {
    //Point d'entrée JS, fichier qui contiendra les includes.
    entry: {
        app: './assets/js/app.js',
    },
    //Objet contenant le chemin de sortie, ainsi que le nom à donner au fichier
    output: {
        path: path.resolve(__dirname, 'public/build'),
        filename: "./js/[name]-bundle.js",
        publicPath: '',
    },

    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                    },
                    {
                        loader: "css-loader",
                        options: {
                            import: true,
                            url: false,
                            sourceMap: true,
                        },
                    },
                ],
            },
            {
                test: /\.(mp4)$/i,
                use: [
                    {
                        loader: "file-loader",
                        options: {
                            name: "[name].[ext]",
                            outputPath: 'video/',
                            publicPath: 'build/video',
                        }
                    },
                ]
            },
        ],
    },

    optimization: {
        minimizer: [
            new CssMinimizerPlugin(),
        ],
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: "./css/[name].css",
        }),

        new CopyPlugin({
           patterns: [
               { from: 'assets/video/', to: 'video/',}
           ]
        }),
    ]
}