import '~/bootstrap';
import 'babel-polyfill';
import 'vuetify/src/stylus/app.styl';
import '~/plugins';
import store from '~/store';
import App from '~/App.vue';
import router from './router';
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Notifications from 'vue-notification';


Vue.use(Notifications);
Vue.use(BootstrapVue);

// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

window.vm = new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});
