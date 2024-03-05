import Vue from 'vue';
import Hotjar from 'vue-hotjar';
import { HOTJAR_PRODUCTION_MODE, HOTJAR_ID } from 'configs/config';

Vue.use(Hotjar, {
  id: HOTJAR_ID,
  isProduction: HOTJAR_PRODUCTION_MODE
});
