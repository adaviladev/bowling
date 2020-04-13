const path = require('path');

module.exports = {
  devServer: {
    proxy: 'http://bowling.test',
  },
  filenameHashing: false,
  publicPath: '/',
  outputDir: '../public',
  runtimeCompiler: true,
  configureWebpack: {
    resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
        '@': path.resolve('src')
      }
    },
  },
  indexPath: process.env.NODE_ENV === 'production'
    ? '../resources/views/index.blade.php'
    : 'index.html'
}
