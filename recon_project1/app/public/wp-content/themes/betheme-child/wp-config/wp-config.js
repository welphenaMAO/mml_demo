// webpack 环境搭建
// 1、es6 bable编译
// 2、eslint 语法检查
// 3、sass 、less 编译 : 暂时使用 gulp 处理
// 目录设计
// 1、dist 发布目录
// 2、src 源码目录
// 3、wp-config  配置 
//  不需要提取公共代码、只处理 js 文件

const path = require('path')
const utils = require('./utils.js')
const projectRoot = path.resolve(__dirname, '../src/')

const entries = utils.getEntry('./src/js/**/*.js', '../src/js/')

const wpConfig = {
	entry: entries,
	output: {
		path: path.resolve(__dirname, '../dist/js/'),
		filename: '[name].js'
	},
	devtool: '#source-map',
	devServer: {
		clientLogLevel: 'warning',
    contentBase: '../dist',
    compress: true,
    overlay: { warnings: false, errors: true }
	},
	module: {
		rules: [
      // {
      //   enforce: "pre",
      //   test: /\.js$/,
      //   exclude: /node_modules/,
      //   loader: "eslint-loader",
      // },
			{
				test: /\.js$/,
				use: {
					loader: 'babel-loader'
				},
        include: projectRoot,
        exclude: /node_modules/
			} // , 
			// {
   //      test: /\.scss$/,
   //      use: [
   //        "style-loader", // creates style nodes from JS strings
   //        "css-loader", // translates CSS into CommonJS
   //        "sass-loader" // compiles Sass to CSS, using Node Sass by default
   //      ]
   //    }
		]
	}
}

module.exports = wpConfig
