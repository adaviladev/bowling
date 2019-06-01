let mix = require('laravel-mix');
let path = require('path');
// let nodeExternals = require('webpack-node-externals');
let isCoverage = process.env.NODE_ENV === 'coverage';

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

function resolve(dir) {
  return path.join(__dirname, '/', dir)
}

mix.ts('resources/assets/js/main.ts', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')

  .webpackConfig({
    output: {
      // use absolute paths in sourcemaps (important for debugging via IDE)
      devtoolModuleFilenameTemplate        : '[absolute-resource-path]',
      devtoolFallbackModuleFilenameTemplate: '[absolute-resource-path]?[hash]',
    },
    module: {
      rules: [].concat(
        {
          test   : /\.js$/,
          loader : 'babel-loader',
          exclude: /node_modules/,
        },
        // {
        //   test: /\.vue$/,
        //   loader: 'vue-loader',
        // },
        isCoverage ? {
          test   : /\.(vue|ts)/,
          include: path.resolve('resources/assets/js'), // instrument only testing sources with Istanbul, after ts-loader runs
          loader : 'vue-loader',
        } : [],
        // We're registering the TypeScript loader here. It should only
        // apply when we're dealing with a `.ts` or `.tsx` file.
        {
          test   : /\.tsx?$/,
          loader : 'ts-loader',
          exclude: /node_modules/,
          options: {appendTsSuffixTo: [/\.vue$/]}
        }
      ),
    },

    resolve  : {
      // We need to register the `.ts` extension so Webpack can resolve
      // TypeScript modules without explicitly providing an extension.
      // The other extensions in this list are identical to the Mix
      // defaults.
      extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],
      alias     : {
        '@': resolve('resources/assets/js'),
      },
    },
    target   : isCoverage ? 'node' : 'web',  // webpack should compile node compatible code
    // externals: [nodeExternals()], // in order to ignore all modules in node_modules folder
    devtool  : 'inline-cheap-module-source-map',
  })
