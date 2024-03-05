import locizer from 'locizer';
import locizeEditor from 'locize-editor';

import {
  LOCIZE_NAMESPACE,
  LOCIZE_PROJECTID,
  LOCIZE_APIKEY,
  LOCIZE_REFERENCELANGUAGE,
  VUE_APP_I18N_FALLBACK_LOCALE,
  VUE_APP_I18N_LOCALE,
  LOCIZE_VERSION,
} from 'configs/config';

if (process.browser) {
  locizeEditor.init({
    lng: VUE_APP_I18N_LOCALE,
    defaultNS: LOCIZE_NAMESPACE,
    referenceLng: LOCIZE_REFERENCELANGUAGE,
    projectId: LOCIZE_PROJECTID,
  });
}

export default locizer.init({
  lng: VUE_APP_I18N_LOCALE,
  fallbackLng:
  VUE_APP_I18N_FALLBACK_LOCALE,
  referenceLng: LOCIZE_REFERENCELANGUAGE,
  projectId: LOCIZE_PROJECTID,
  apiKey: LOCIZE_APIKEY,
  saveMissing: true,
  ns: LOCIZE_NAMESPACE,
  allowedAddOrUpdateHosts: ['localhost', 'dev.bangergames.com'],
  allowedHosts: ['localhost', 'dev.bangergames.com'],
  version: LOCIZE_VERSION,
});

export const loadLanguage  = (locale) => {
  locizer.options.fallbackLng = locale;

  return new Promise(resolve => {
    locizer.load(LOCIZE_NAMESPACE, locale, (err, messages) => {
      if(Object.keys(messages).length) {
        resolve(messages);
      }
      resolve ({});
    });
  });
};
