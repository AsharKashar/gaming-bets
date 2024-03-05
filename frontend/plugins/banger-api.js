import Vue from 'vue';
import axios from 'axios';
import get from 'lodash/get';
import {
  BASE_URL,
  BASE_AUTH_LOGIN,
  BASE_AUTH_PASSWORD,
  VUE_MODE
} from 'config';

export default (context, inject) => {
  const { app, $cookies, redirect } = context;
  const { i18n } = app;

  let config = {
    baseURL: `${BASE_URL}/api/`,
    params: {},
    headers: {
      locale: i18n.locale
    }
  };

  if ('production' !== VUE_MODE) {
    config.auth = {
      username: BASE_AUTH_LOGIN,
      password: BASE_AUTH_PASSWORD
    };
  }

  const handeledErrorStatuses = [404, 403, 400, 301];
  const service = axios.create(config);

  const saveToken = token => {
    $cookies.set('AuthToken', token);
  };

  const deleteToken = () => {
    $cookies.remove('AuthToken');
  };

  service.interceptors.response.use(
    response => {
      return response;
    },
    error => {
      if (process.browser) {
        let message = error.message;
        const data = get(error, 'response.data', null);
        const status = get(error, 'response.status', null);
        const customErrorHandling = get(error, 'response.config.customErrorHandling', null);

        if (data && data.errors && data.errors.lenght) {
          message = data.errors;
        } else if (data && data.error) {
          message = data.error;
        } else if (data && data.message) {
          message = data.message;
        }

        if (customErrorHandling) {
          return Promise.reject(error);
        }

        if (status === 404) {
          Vue.notify({
            group: 'custom-notification',
            title: 'Error',
            text: 'Not found',
            type: 'error'
          });
          redirect(app.localeRoute('/'));
        }

        if (status === 403) {
          Vue.notify({
            group: 'custom-notification',
            title: 'Not logged in',
            text: 'Login again',
            type: 'error'
          });
        }

        if (status === 400) {
          Vue.notify({
            group: 'custom-notification',
            title: 'Bad request',
            text: message,
            type: 'error'
          });
        }

        if (status === 301) {
          redirect(app.localeRoute(error.response.data.url));
          return;
        }

        if (handeledErrorStatuses.indexOf(status) === -1) {
          Vue.notify({
            group: 'custom-notification',
            title: 'Server error ' + status,
            text: message,
            type: 'error'
          });
        }
      }

      return Promise.reject(error);
    }
  );

  service.interceptors.request.use(config => {
    const token = $cookies.get('AuthToken');

    if (token) {
      config.params = config.params || {};
      config.params['token'] = token;
    }

    return config;
  });

  const bangerApi = {
    ...service,
    saveToken,
    deleteToken
  };


  inject('bangerApi', bangerApi);
};
