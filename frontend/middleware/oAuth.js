import oAuthApi from 'services/oAuthApi';

export default () => {
  if (process.browser) {
    const { fullPath, query } = window.$nuxt.$route;
    const finalQuery = Object.keys(query).length ? query : undefined;

    if(oAuthApi.setStoreCallback( fullPath,  finalQuery)) {
      window.close();
    }
  }
};
