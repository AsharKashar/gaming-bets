import { loadLanguage } from 'plugins/locizer';

export default async (context, locale) => {
  return await loadLanguage(locale);
};
