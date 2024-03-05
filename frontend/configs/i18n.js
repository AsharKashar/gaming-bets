module.exports = {
  detectBrowserLanguage: {
    useCookie: true,
    cookieKey: 'i18n_lang',
  },
  defaultLocale: 'en',
  locales: [
    {
      code: 'en',
      file: 'dynamicLocale.js'
    },
    {
      code: 'es',
      file: 'dynamicLocale.js'
    }
  ],
  lazy: true,
  langDir: 'lang/'
};
