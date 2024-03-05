import get from 'lodash/get';
import { STATE_STATUSES } from 'helpers/constants';
import { VUE_MODE,REDIS_PREFIX } from 'configs/config';
import Vue from 'vue';

import oAuthApi from 'services/oAuthApi';
import { listenForNotification } from 'helpers/notifications';

export default {
  async login({ dispatch }, data) {
    if (VUE_MODE === 'production') return;
    try {
      const response = await this.$bangerApi.post('auth/login', data);
      if (response.data.error) return response;
      this.dispatch('tournament/updateTournamentFromLocation');
      const token = get(response, 'data.access_token', null);
      dispatch('handleToken', token);
    } catch (e) {
      this.$bangerApi.deleteToken();
      return e.response;
    }
  },
  async register({ dispatch }, data) {
    try {
      const response = await this.$bangerApi.post('auth/register', data, { customErrorHandling: true });

      Vue.notify({
        group: 'custom-notification',
        title: 'Registered',
        text: 'Registered successfully',
        type: 'success'
      });

      if (response.data.errors) return response;
      if (VUE_MODE !== 'production') {
        this.dispatch('tournament/updateTournamentFromLocation');
        const token = get(response, 'data.access_token', null);
        dispatch('handleToken', token);
      }
    } catch (e) {

      let errors = e.response ? e.response.data.errors : null;
      let errorDetails = [];
      if (errors) {
        Object.keys(errors).map(e => {
          errorDetails.push(errors[e]);
        });
      }

      Vue.notify({
        group: 'custom-notification',
        title: 'Error',
        text: errorDetails.length
          ? errorDetails.join()
          : 'Form filled incorrect',
        type: 'error'
      });


      this.$bangerApi.deleteToken();

      return e.response;
    }
  },
  async getMe({ commit }) {
    this.dispatch('notifications/getUserNotifications');

    try {
      const response = await this.$bangerApi.get('auth/me');
      const userData = get(response, 'data.data', null);
      commit('setMe', {
        isAuthenticated: true,
        user: userData
      });

      const userId = get(userData, 'id', null);

      if (userId && this.$echo) {
        this.$echo
          .channel(`${ REDIS_PREFIX }App.User.${ userId }`)
          .listen('.UserEvent', notification => {
            listenForNotification(notification, this);
            commit('increaseUnreadNotifications');
          });
      }
    } catch (e) {
      commit('setMe', {
        isAuthenticated: false,
        user: null
      });
      this.$bangerApi.deleteToken();
    }
  },
  async logout({ commit }) {

    this.$bangerApi.deleteToken();
    commit('setMe', {
      isAuthenticated: false,
      user: null
    });
    this.dispatch('tournament/updateTournamentFromLocation');
    this.$router.push('/');
  },
  async checkAuth({ commit, dispatch, state, }) {
    const token = this.$cookies.get('AuthToken');
    const isAuthenticated = state.isAuthenticated;

    if (!isAuthenticated && token) {
      commit('setCheckStatus', STATE_STATUSES.PENDING);
      await dispatch('handleToken', token);
      commit('setCheckStatus', STATE_STATUSES.READY);
    }
  },
  async handleToken({ dispatch }, token) {
    if (token) {
      this.$bangerApi.saveToken(token);
      await dispatch('getMe');
    } else {
      this.$bangerApi.deleteToken();
    }
  },
  async callbackOAuth({ commit, state }, { token_aut, provider }) {
    if (state.callbackOAuthStatus === STATE_STATUSES.PENDING) return;
    try {
      commit('setCallbackOAuthStatus', STATE_STATUSES.PENDING);
      const { data } = await this.$bangerApi.get('/oauth/callback', {
        params: {
          token_aut,
          provider
        }
      });
      if (!data.user.email) {
        commit('setMe', { user: data.user });
        this.commit('modal/setActiveModal', {type: 'OAuthCreateUserEmailForm'});
        return;
      }

      this.dispatch('tournament/updateTournamentFromLocation');
      this.$bangerApi.saveToken(data.token);
      commit('setMe', {
        isAuthenticated: true,
        user: data.user
      });
      this.commit('modal/clearModal');
    } catch (e) {
      console.error(e);
    } finally {
      commit('setCallbackOAuthStatus', STATE_STATUSES.READY);
    }
  },
  async createUserOauth({ state, commit }, email) {
    const { data } = await this.$bangerApi.post(
      '/oauth/create-user',
      { ...state.user, email },
      { customErrorHandling: true }
    );
    this.$bangerApi.saveToken(data.token);
    commit('setMe', {
      isAuthenticated: true,
      user: data.user
    });
  },
  async socialOAuth(ctx, provider) {
    await oAuthApi.getAuthToken(provider);
  },
  async connectSocialAccount(ctx, params) {
    try {
      await this.$bangerApi.post('/oauth/connect-account', {
        ...params
      });
    } catch (e) {
      console.error(e);
    }
  }
};
