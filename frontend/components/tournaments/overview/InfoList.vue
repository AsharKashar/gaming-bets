<template>
  <div class="tournaments-overview__info">
    <div class="tournaments-overview__info-list">
      <slot name="before-block" />
      <div
        v-for="(val, key) in infoList"
        :key="key"
        class="tournaments-overview__info-col"
        :class="kebabCase(key)"
      >
        <div class="tournaments-overview__info-col-inner">
          <div
            class="tournaments-overview__info-heading"
            v-text="key"
          />
          <div class="tournaments-overview__info-description">
            <img
              v-if="/(jpe?g|png|gif|svg)/gi.test(val)"
              :src="val"
              :alt="key"
            >
            <span v-else>{{ val }}</span>
          </div>
        </div>
      </div>
      <slot name="after-block" />
    </div>
  </div>
</template>

<script>
import dayjs from 'dayjs';
import kebabCase from 'lodash/kebabCase';
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');
export default {
  name: 'TournamentsOverviewInfoList',
  props: { 
    tournament: {
      type: Object,
      required: true,
    }
  },
  computed: {
    ...tournamentModule.mapState([ 'currentTournament']),
    registration() {
      return dayjs(this.currentTournament.reg_end_at).diff(new Date()) > 0
        ? 'Open'
        : 'Closed';
    },
    infoList() {
      let tournament = this.currentTournament;
      return {
        game: tournament.game.cover_public_url,
        'entry fee': tournament.entry_fee,
        'prize pool': '$300',
        host: tournament.hosted_by,
        'tournament date': dayjs(tournament.reg_start_at).format(
          'DD MMM YYYY'
        ),
        platform: this.getArrayName(tournament.platforms),
        region: this.getArrayName(tournament.regions),
        'game mode': tournament.game_mode.name,
        registration: this.registration,
      };
    },
  },
  methods: {
    kebabCase(str) {
      return kebabCase(str);
    },
    getArrayName(arr) {
      return arr.map(({ name }) => name).join(', ');
    },
  },
};
</script>

<style scoped lang="scss">
@import "~assets/styles/colors.scss";
.tournaments-overview {
  &__info {
    color: $text-primary-color;
    margin-bottom: 48px;
    &-list {
      display: flex;
      flex-wrap: wrap;
    }
    &-col {
      width: 100%;
      flex: 1 0 25%;
      padding: 22px 0 16px;
      border-bottom: 1px solid $text-primary-color;
    }
    &-heading {
      font-size: 16px;
      text-transform: uppercase;
      line-height: 1.4;
      margin-bottom: 5px;
      font-weight: 900;
      letter-spacing: 0.08em;
    }
    &-description {
      font-weight: 800;
      font-size: 24px;
      line-height: 1.1;
      color: $text-hover-color;
      img {
        max-width: 100px;
      }
    }
  }
}
</style>
