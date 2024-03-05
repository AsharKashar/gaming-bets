import Vue from 'vue';
import { VueAuthenticate } from 'vue-authenticate';
import providers from 'Services/providers';

const vueAuth = new VueAuthenticate(Vue.prototype.$http, providers);
import swal from 'sweetalert2';

const state = {
  me: null,
  isAuthenticated: false,
};

const getters = {
  getMe: state => state.me,
  getIsAuthenticated: state => state.isAuthenticated,
  isAuthenticated: () => vueAuth.isAuthenticated(),
  getToken: () => vueAuth.getToken(),
  logout: () => vueAuth.logout(),
};

const actions = {
  /* Tested Working */
  /* form : name, email ,password, password_confirmation */
  async register ({ commit, dispatch }, form) {
    form.busy = true;
    try {
      await vueAuth.register(form).then(() => {
        dispatch('login', {
          email: form.email,
          password: form.password,
          remember: true,
        }).then(() => {
          commit('isAuthenticated', {
            isAuthenticated: vueAuth.isAuthenticated(),
          });
          window.vm.$router.push({ name: 'home' });
        });
      }).catch(error => {
        form.errors.set(error.response.data.errors);
      });

      await dispatch('fetchMe');

      form.busy = false;
      window.vm.$router.push({ name: 'dashboard' });
    } catch ({ errors, message }) {
      form.errors.set(errors);
      form.busy = false;
    }
  },
  /* Tested Working */
  /* form : username ,password */
  async login ({ commit, dispatch }, form) {
    form.busy = true;
    try {
      await vueAuth.login(form).then(() => {
        commit('isAuthenticated', {
          isAuthenticated: vueAuth.isAuthenticated(),
        });
      });

      await dispatch('fetchMe');

      form.busy = false;
      form.email = '';
      form.password = '';
      window.Bus.$emit('close-login');
      // vm.$router.go(0)
    } catch (error) {
      form.errors.set(error.response.data.errors);
      form.busy = false;
      if (error.response.status === 401) {
        let modal = swal.mixin({
          confirmButtonClass: 'v-btn blue-grey  subheading white--text',
          buttonsStyling: false,
        });
        modal.fire({
          title: `${error.response.data.error}`,
          html: `<p class="title">${error.response.data.message}</p>`,
          type: 'error',
          confirmButtonText: 'Back',
        });
      }
    }
  },
  async logout ({ commit }) {
    try {
      await vueAuth.logout().then(() => {
        commit('isAuthenticated', {
          isAuthenticated: vueAuth.isAuthenticated(),
        });
        commit('setMe', null);
        window.vm.$router.push({ name: 'home' });
      });
    } catch ({ errors, message }) {
      console.log(message, { errors });
      return null;
    }
  },
  /* Tested Working */
  /* Get User Profile , Roles and Permissions */
  async fetchMe () {
    try {
      // const payload = await window.axios.post(route('api.auth.me'));
      // commit('setMe', payload.data.data);
    } catch ({ errors, message }) {
      if (errors) {
        console.log(errors);
      }
      if (message) {
        console.log(message);
      }
    }
  },
};

const mutations = {
  setMe: (state, payload) => {
    state.me = payload;
  },
  isAuthenticated: (state, payload) => {
    state.isAuthenticated = payload.isAuthenticated;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
