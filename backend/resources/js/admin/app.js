import Vue from 'vue';
import vuetify from './plugins/vuetify';
import store from './store';
import './plugins/laravel-admin';
import './global-components';
import './css/app.scss';

new Vue({
  vuetify,
  store,
}).$mount('#vue-app');
