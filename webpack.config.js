const webpack = require('webpack')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const nodeSassGlobImporter = require('node-sass-glob-importer')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const path = require('path')

const mode = process.env.NODE_ENV
const isProd = mode === 'production'

const getAssets = dir => (
  path.join(__dirname, `assets/${dir}`)
)

const jsIndex = type => (
  getAssets(`js/${type}/src/index.js`)
)

module.exports = {
  mode,
  devtool: isProd ? false : 'source-map',
  entry: {
    admin: jsIndex('admin'),
    front: jsIndex('front'),
  },
  output: {
    filename: '[name].widget.js',
    path: path.resolve(__dirname, 'build'),
  },
  resolve: {
    extensions: ['.js', '.jsx', '.css', '.scss', '.json'],
    alias: {
      css: getAssets('css'),
      scss: getAssets('scss'),
    },
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: 'babel-loader',
      },
      {
        test: /\.jsx?$/,
        enforce: 'pre',
        exclude: /node_modules/,
        use: 'eslint-loader',
      },
      {
        test: /\.s?css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: !isProd,
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: !isProd,
              importer: nodeSassGlobImporter(),
            },
          },
        ],
      },
    ],
  },
  optimization: {
    minimizer: [
      new UglifyJsPlugin({
        cache: true,
        parallel: true,
      }),
      new OptimizeCssAssetsPlugin({}),
    ],
  },
  plugins: [
    new CleanWebpackPlugin('build', { verbose: true }),
    new MiniCssExtractPlugin({
      filename: '[name].widget.css',
    }),
  ],
}
