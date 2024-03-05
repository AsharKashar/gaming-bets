const mix = require('laravel-mix');

mix.js('resources/js/admin/app.js', 'public/admin/js/')
  .webpackConfig({
    module: {
      rules: [
        {
          test: /\.styl$/,
          loader: ['style-loader', 'css-loader', 'stylus-loader'],
        },
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /node_modules/
        }
      ],
    }
  });

/*
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/images', 'public/images');

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css')
  .styles([
    'resources/assets/css/main.css',
  ], 'public/css/old.css')
  .options({
    extractVueStyles: false,
    processCssUrls: true,
    purifyCss: false,
    uglify: {
      uglifyOptions: {
        // fixes error on sweetalert2
        compress: {
          unused: false,
        },
      },
    },
    postCss: [],
    hmrOptions: {
      host: 'dev.bangergames.com',
      port: 8080,
    }
  })
  .webpackConfig({
    module: {
      rules: [
        {
          test: /\.styl$/,
          loader: ['style-loader', 'css-loader', 'stylus-loader'],
        },
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /node_modules/
        }
      ],
    },
    resolve: {
      extensions: ['.js', '.json', '.vue'],
      /!* Path Shortcuts *!/
      alias: {
        '~': path.join(__dirname, './resources/js'),
        Components: path.resolve(__dirname, 'resources/js/components'),
        Routes: path.resolve(__dirname, 'resources/js/routes'),
        Pages: path.resolve(__dirname, 'resources/js/pages'),
        /!* vuex modules *!/
        Modules: path.resolve(__dirname, 'resources/js/modules'),
        Layouts: path.resolve(__dirname, 'resources/js/layouts'),
        Partials: path.resolve(__dirname, 'resources/js/partials'),
        Modals: path.resolve(__dirname, 'resources/js/components/modals'),
        Services: path.resolve(__dirname, 'resources/js/services'),
        Api: path.resolve(__dirname, 'resources/js/api'),
        Mixins: path.resolve(__dirname, 'resources/js/mixins'),
        /!* Jquery Plugins *!/
        Plugins: path.resolve(__dirname, 'resources/js/plugins'),
      },
    },
    output: {
      chunkFilename: 'js/[name].[chunkhash].js',
    },
    devServer: {
      proxy: {
        host: '127.0.0.1',
        port: 8080,
      },
      watchOptions:{
        aggregateTimeout:200,
        poll:5000
      },

    }
  });



if (mix.inProduction()) {
  mix.version();
  mix.sourcemaps();
  mix.extract(['axios', 'vue', 'vuetify']);
  mix.disableNotifications();
}
*/
