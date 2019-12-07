module.exports = {
  devServer: {
    proxy: 'http://bowling.test',
  },
  filenameHashing: false,
  publicPath: '/',
  outputDir: '../public',
  runtimeCompiler: true,
  indexPath: process.env.NODE_ENV === 'production'
    ? '../resources/views/index.blade.php'
    : 'index.html'
}
