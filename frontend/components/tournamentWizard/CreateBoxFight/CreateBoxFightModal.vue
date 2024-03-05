<template>
  <div>
    <create-match
      v-if="currentTab === 1"
      :is-loading="setLoading"
      @createMatch="creatingMatch"
    />
    <invite-friends
      v-else-if="currentTab === 2"
      :links="inviteLinks"
      @nextTab="moveToNext"
    />
    <last-step
      v-else
      :experience="{ xp: 100, coins: matchData.bid_amount }"
      @finish="clearModal"
    />
  </div>
</template>

<script>
import CreateMatch from './Steps/CreateMatch';
import InviteFriends from './Steps/InviteFriends';
import LastStep from './Steps/LastStep';
import { createNamespacedHelpers } from 'vuex';
const authModule = createNamespacedHelpers('auth');
const modalModule = createNamespacedHelpers('modal');
const boxfightModule = createNamespacedHelpers('boxfight');


export default {
  components: {
    CreateMatch,
    InviteFriends,
    LastStep,
  },

  data() {
    return {
      currentTab: 1,
      inviteLinks: {},
      matchData: {},
      setLoading: false,
    };
  },
  computed: {
    ...authModule.mapState(['user']),
  },
  methods: {
    ...modalModule.mapMutations(['clearModal']),
    ...authModule.mapMutations(['updateUserBombs']),
    ...boxfightModule.mapActions(['getBoxFights']),
    moveToNext() {
      this.currentTab += 1;
    },
    creatingMatch(payload) {
      this.matchData = payload;
      this.setLoading = true;
      this.$bangerApi
        .put('box-matches/create', payload)
        .then((res) => {
          this.setLoading = false;
          this.inviteLinks.opponent = res.data['team 2'];
          this.inviteLinks.friends = res.data['same_team'];
          this.getBoxFights({
            payload: {
              game_id: this.$route.params.gameId,
              id: this.user.id,
            },
            params: {
              page: this.$route.query.page,
            },
          });
          // updating user bombs
          const remainingBombs = this.user.all_bombs - +payload.bid_amount;
          this.updateUserBombs(remainingBombs);
          this.moveToNext('nextTab');
        })
        .catch((err) => {
          console.log(err);
          this.setLoading = false;
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
