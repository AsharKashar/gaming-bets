import snakeCase from 'lodash/snakeCase';
import {
  DISCORD_CLIENT_ID,
  FACEBOOK_CLIENT_ID,
  GOOGLE_CLIENT_ID,
  TWITCH_CLIENT_ID,
  BASE_URL,
  EPIC_GAMES_CLIENT_ID
} from 'configs/config';


export default {
  data: () => ({
    google: {
      path: 'https://accounts.google.com/o/oauth2/v2/auth',
      options: {
        scope: 'openid%20email%20profile',
        clientID: GOOGLE_CLIENT_ID
      }
    },
    facebook: {
      path: 'https://www.facebook.com/v7.0/dialog/oauth',

      options: {
        scope: 'public_profile%2Cemail',
        display: 'popup',
        ret: 'login',
        clientID: FACEBOOK_CLIENT_ID
      }
    },
    discord: {
      path: 'https://discord.com/oauth2/authorize',
      options: {
        scope: 'identify%20email',
        clientID: DISCORD_CLIENT_ID
      }
    },
    twitch: {
      path: 'https://id.twitch.tv/oauth2/authorize',
      options: {
        scope: 'user:read:email',
        clientID: TWITCH_CLIENT_ID,
      }
    },
    epicGames: {
      path: 'https://www.epicgames.com/id/authorize',
      options: {
        scope: 'basic_profile',
        clientID: EPIC_GAMES_CLIENT_ID,
        responseType: 'code',
      }
    },
    steam: {
      path: BASE_URL + '/api/steam/auth',
      options: {
        token: window.$nuxt.$cookies.get('AuthToken'),
        responseType: 'code',
      }
    }
  }),
  createWindowAuth(path, provider) {
    window.open(path, provider, 'width=600,height=800,status=yes');
  },
  createPath(provider) {
    const activeProvider = this.data()[provider];
    const defaultOptions = {
      responseType: 'token',
      state:JSON.stringify({
        network: provider,
        'oauth-callback': ''
      }),
      redirectUri: BASE_URL,
    };
    const params = {
      ...defaultOptions,
      ...activeProvider.options
    };
    const addParams = Object.keys(params).map(key => `${snakeCase(key)}=${params[key]}`).join('&');
    return `${activeProvider.path}?${addParams}`;
  },
  getAuthToken(provider) {
    const path = this.createPath(provider);
    this.createWindowAuth(path, provider);
  },
  setStoreCallback(url, query) {
    if (url.search('%22oauth-callback%22') === -1) {
      return false;
    }
    const replaceUrl = url.replace(/(.*?)\/#/g, '');

    let dataStore = query || replaceUrl.split('&')
      .reduce((params, param) => {
        let [key, value] = param.split('=');
        value = value ? decodeURIComponent(value.replace(/\+/g, ' ')) : '';
        if (key === 'state') {
          params[key] = JSON.parse(value);
        } else {
          params[key] = value;
        }
        return params;
      }, {});


    if (query) {
      dataStore = {
        ...dataStore,
        state: JSON.parse(query.state)
      };
    }

    let prevStore = localStorage.getItem('oAuthApi');
    if (prevStore) {
      prevStore = JSON.parse(prevStore);
      dataStore = {
        ...prevStore,
        [dataStore.state.network]: {
          ...dataStore,
          time: new Date().getTime()
        }
      };
    } else {
      dataStore = {
        [dataStore.state.network]: dataStore
      };
    }

    localStorage.setItem('oAuthApi', JSON.stringify(dataStore));
    return true;
  }
};
