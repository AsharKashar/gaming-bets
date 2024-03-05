<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <p>linked Accounts page</p>
    <v-row>
      <button
        v-if="!user.connections.epic_games"
        @click="setOAuth('epicGames')"
      >
        {{ $t('Epic games auth') }}
      </button>
      <div
        v-if="user.connections.epic_games"
        :style="{'word-break':'break-all'}"
      >
        {{ $t('Epic games connected!') }}
        {{ user.connections.epic_games }}
      </div>
    </v-row>
    <v-row>
      <button
        v-if="!user.connections.steam"
        @click="setOAuth('steam')"
      >
        {{ $t('Steam auth') }}
      </button>
      <div
        v-if="user.connections.steam"
        :style="{'word-break':'break-all'}"
      >
        {{ $t('Steam connected!') }}
        {{ user.connections.steam }}
      </div>
    </v-row>
  </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
import { APP_URL } from 'configs/config';
const { mapActions, mapState } = createNamespacedHelpers('auth');

export default {
  name: 'LinkedAccounts',
  middleware: ['hideHeader'],
  data: () => ({
    activeAuth: null
  }),
  computed:{
    ...mapState(['user'])
  },
  created() {
    window.addEventListener('storage', this.setStorage);
  },
  beforeDestroy() {
    window.removeEventListener('storage', this.setStorage);
  },
  methods: {
    ...mapActions(['socialOAuth', 'connectSocialAccount', 'getMe']),
    setOAuth(provider) {
      this.activeAuth = provider;
      this.socialOAuth(provider);
    },
    setStorage({ key, newValue }) {
      if (key === 'oAuthApi' && newValue) {
        const data = JSON.parse(newValue)[this.activeAuth];
        const { code, state } = data;
        this.connectSocialAccount({ code, network:state.network }).then(() => this.getMe());
      }
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Linked Accounts',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>

<style scoped>

</style>
