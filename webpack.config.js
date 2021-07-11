const autoprefixer = require("autoprefixer");
const CompressionPlugin = require("compression-webpack-plugin");

module.exports = [{
  plugins: [new CompressionPlugin()],
	entry: ['./webpack/app.scss', './webpack/app.js'],
  output: {
    filename: "../public/js/bundle.js"
  },
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '../public/css/bundle.css',
						},
					},
					{ loader: 'extract-loader' },
					{ loader: 'css-loader' },
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									'autoprefixer'
								]
							}
						}
					},
					{
						loader: 'sass-loader',
						options: {
							// Prefer Dart Sass
							implementation: require('sass'),

							// See https://github.com/webpack-contrib/sass-loader/issues/804
							webpackImporter: false,
							sassOptions: {
								includePaths: ['./node_modules']
							},
						}
					}
				]
			},
			{
				test: /\.js$/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'],
					},
				}
			}
		]
	},
}];
