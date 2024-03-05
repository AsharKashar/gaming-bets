<template>
  <div>
    <loader :loading="loading">
      <div class="join-container">
        <join-box-fight
          v-if="currentBoxFight"
          :token="token"
        />
      </div>
    </loader>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const authentication = createNamespacedHelpers('auth');
const modalModule = createNamespacedHelpers('modal');
const boxfightModule = createNamespacedHelpers('boxfight');

import Loader from 'components/Loader.vue';
import JoinBoxFight from 'components/tournamentWizard/joinBoxFight/JoinBoxFight';

export default {
  name: 'Tournaments',
  components: {
    Loader,
    JoinBoxFight,
  },
  data() {
    return {
      authModalType: 'login',
      showAuthModal: false,
      matchID: this.$route.query.match_id,
      token: this.$route.query.token,
    };
  },
  middleware: ['hideHeader'],
  computed: {
    ...authentication.mapState(['isAuthenticated', 'user']),
    ...boxfightModule.mapState(['boxFightStatus', 'currentBoxFight']),
    loading() {
      return this.boxFightStatus === STATE_STATUSES.PENDING;
    },
  },
  watch: {
    isAuthenticated(val) {
      if (val) {
        this.getCurrentBoxFight({
          match_id: this.matchID,
          user_id: this.user.id,
        });
      }
    },
  },
  mounted() {
    if (!this.isAuthenticated) {
      this.setActiveModal({type: 'LoginForm'});
    } else {
      this.getCurrentBoxFight({
        match_id: this.matchID,
        user_id: this.user.id,
      });
    }
  },
  
  methods: {
    ...modalModule.mapMutations(['setActiveModal']),
    ...boxfightModule.mapActions(['getCurrentBoxFight']),
    closeAuthModal() {
      this.showAuthModal = false;
      this.authModalType = 'login';
    },
    openAuthModal(type = 'login') {
      this.setAuthModalType(type);
      this.showAuthModal = true;
    },
    setAuthModalType(type) {
      this.authModalType = type;
    },
  },
 
};
</script>

<style lang="scss" scoped>
.join-container {
  max-width: 600px;
  width: 90%;
  margin: auto;
  margin-top: 3rem;
}
</style>
