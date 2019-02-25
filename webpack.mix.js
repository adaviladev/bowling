let mix = require('laravel-mix')

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

mix.ts('resources/assets/js/app.ts', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

   .webpackConfig({
     module: {
       rules: [
         {
           test: /\.js$/,
           loader: 'babel-loader',
           exclude: /node_modules/,
         },
         // {
         //   test: /\.vue$/,
         //   loader: 'vue-loader',
         // },
         // We're registering the TypeScript loader here. It should only
         // apply when we're dealing with a `.ts` or `.tsx` file.
         // {
         //   test   : /\.tsx?$/,
         //   loader : 'ts-loader',
         //   exclude: /node_modules/,
         //   options: {appendTsSuffixTo: [/\.vue$/]}
         // }
       ]
     },

     resolve: {
       // We need to register the `.ts` extension so Webpack can resolve
       // TypeScript modules without explicitly providing an extension.
       // The other extensions in this list are identical to the Mix
       // defaults.
       extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx']
     },
   })
