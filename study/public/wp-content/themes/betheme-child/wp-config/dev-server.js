const Webpack = require('webpack')
const WebpackDevServer = require('webpack-dev-server')
const webpackConfig = require('./wp-config')

const compiler = Webpack(webpackConfig);

const devServerOpt = Object.assign({}, webpackConfig.devServer, {
	stats: {
		colors: true
	}
})

const server = new WebpackDevServer(compiler, devServerOpt)

server.listen(8080, () => {
	console.log('Starting server on http://localhost:8080');
})