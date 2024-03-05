const path = require('path');
const config = require('./configs/config');
const { getDynamicRoutes } = require('./services/sitemapApi');

module.exports = {
  telemetry: false,
  head: {
    title: 'Banger Games',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Competitive gaming platform' },
      { hid: 'robots', name: 'robots', content: 'noindex' },
      { hid: 'theme-color', name: 'theme-color', content: '#020432' },
      { hid: 'msapplication-navbutton-color', name: 'msapplication-navbutton-color', content: '#020432' },
      { hid: 'apple-mobile-web-app-status-bar-style', name: 'apple-mobile-web-app-status-bar-style', content: 'black' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  loading: 'components/LoadingBar',
  sitemap:{
    hostname: config.APP_URL,
    routes: getDynamicRoutes
  },
  build: {
    extend (config, { isDev, isClient }) {
      config.resolve.alias['configs'] = path.resolve(__dirname, 'configs');
      config.resolve.alias['config'] = path.resolve(__dirname, 'configs/config');
      config.resolve.alias['plugins'] = path.resolve(__dirname, 'plugins');
      config.resolve.alias['services'] = path.resolve(__dirname, 'services');
      config.resolve.alias['helpers'] = path.resolve(__dirname, 'helpers');
      config.resolve.alias['modules'] = path.resolve(__dirname, 'store/modules');
      config.resolve.alias['layouts'] = path.resolve(__dirname, 'layouts');
      config.resolve.alias['components'] = path.resolve(__dirname, 'components');
      config.resolve.alias['assets'] = path.resolve(__dirname, 'assets');
      config.resolve.alias['mixins'] = path.resolve(__dirname, 'mixins');

      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        });
      }
    }
  },
  plugins: [
    '~plugins/banger-api',
    '~plugins/locizer',
    '~plugins/vue-directive-mask',
    '~plugins/vue-hotjar',
    '~plugins/vue-sentry',
    '~plugins/vue-social-sharing',
    { src:'~plugins/vue-notifications', ssr:false }
  ],
  buildModules: [
    ['@nuxtjs/laravel-echo', require('./configs/echo'), '@nuxtjs/pwa',]
  ],
  modules: [
    ['nuxt-i18n', require('./configs/i18n')],
    ['@nuxtjs/vuetify', require('./configs/vuetify')],
    '@nuxtjs/feed',
    'cookie-universal-nuxt',
    '@nuxtjs/sitemap',
    '@nuxtjs/router-extras',
    'nuxt-lazy-load'
  ],
  feed: require('./configs/rss'),
  css: [
    '@/assets/styles/main.scss'
  ],
  server: {
    port: 8080,
    host: '0.0.0.0'
  },
  router: {
    middleware: ['auth','oAuth', 'adminLogin']
  },
  pwa: {
    manifest: {
      theme_color: '#020432'
    }
  }
};

