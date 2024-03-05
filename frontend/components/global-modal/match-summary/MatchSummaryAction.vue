<template>
  <div class="join-tournament__action">
    <div
      class="join-tournament__action-heading"
      v-text="$t('Do you agree to join this tournament?')"
    />
    <div class="join-tournament__action-row">
      <default-button
        class="outline-banger-btn"
        @click.native="prevModal"
      >
        Back
      </default-button>
      <default-button
        :loading="load"
        class="py-2"
        @click.native="join"
      >
        <span class="inner-btn-dynamic">
          {{ $t('JOIN') }}
          <img
            :src="bombImage"
            alt="bombs"
          > {{ tournament.entry_fee }}
        </span>
      </default-button>
    </div>
  </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
import { get } from 'lodash';
import DefaultButton from 'components/DefaultButton';
import bombImage from '~/static/images/bombs_pay.png';

const modalModule = createNamespacedHelpers('modal');
const tournamentModule = createNamespacedHelpers('tournament');

export default {
  name: 'MatchSummaryAction',
  components: {DefaultButton},
  data: () => ({
    load: false,
    bombImage,
  }),
  computed: {
    ...modalModule.mapState({
      teamId: ({commonData}) => get(commonData, 'team.team_id', false),
      tournament: ({commonData}) => commonData.tournament,
    }),
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal']),
    ...tournamentModule.mapActions(['joinTournament']),
    prevModal() {
      this.setActiveModal({type: 'TournamentTeamModal'});
    },
    async join() {
      if(this.load) return;
      this.load = true;
      try {
        const joined = await this.joinTournament({
          tournamentId: this.tournament.id,
          teamId: this.teamId
        });
        if (joined) {
          this.setActiveModal({type: 'JoinedSuccessfully'});
        } else {
          console.error('Joined invalid');
        }
      } finally {
        this.load = false;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
.join-tournament {
  &__action {
    margin-top: 10px;
    &-heading {
      color: $text-primary-color;
      font-weight: 900;
      font-size: 32px;
      letter-spacing: 0.02em;
      margin-bottom: 36px;
    }
    &-row {
      display: flex;
      align-items: center;
      justify-content: center;
      button {
        margin: 0 12px 15px;
        min-width: 206px;
        height: 59px;
      }
    }
  }
}
</style>
