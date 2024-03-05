import { Store } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
/* Add Below All Your Modules */
import auth from 'Modules/auth';
import acl from 'Modules/acl';
import permission from 'Modules/permission';

export default new Store({
  modules: {
    auth,
    acl,
    permission
    /* add other modules here */
  },

  plugins: [
    createPersistedState({
      /* Check All Options You Can Pass At this Link */
      /* https://github.com/robinvdvleuten/vuex-persistedstate#createpersistedstateoptions */
      key: 'vuex-ls',
      // Declare All The State We Want to Persist (use dot anotation for object.key)
      paths: ['auth', 'permission', 'acl']
    })
  ]
});
