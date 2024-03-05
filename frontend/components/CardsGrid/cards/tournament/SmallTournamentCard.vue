<template>
  <div class="tournaments-card__item">
    <div class="tournaments-card-wrapper">
      <div
        class="tournaments-card"
        @click="openTournament(item.id)"
        @mouseover="hover = true"
        @mouseleave="hover = false"
      >
        <div
          class="tournament-image"
          :style="tournamentImageStyle"
        />

        <div class="tournament-content">
          <div class="tournament-info-heading">
            <div class="tournament-title">
              <v-clamp
                autoresize
                :max-lines="2"
                class="category-title"
              >
                {{ item.name || item.boxmatch_name }}
              </v-clamp>
            </div>
            <div class="stats-row">
              <div class="info-item">
                <div class="info-item-title">
                  {{ $t('Starts') }}
                </div>
                <div class="info-item-value">
                  {{ formatDate }}
                </div>
              </div>
              <div class="info-item">
                <div class="info-item-title">
                  {{ $t('Reward') }}
                </div>
                <div class="info-item-value">
                  {{ prizes }} Bombs
                </div>
              </div>
              <div class="info-item">
                <div class="info-item-title">
                  {{ $t('Playtype') }}
                </div>
                <div class="info-item-value">
                  {{
                    item.game_type_boxmatch
                      ? item.game_type_boxmatch.description
                      : "SOLO"
                  }}
                </div>
              </div>
            </div>
          </div>
          <div class="tournament-action">
            <tournament-action :item="item" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import tournamentMixin from '@/mixins/tournamentMixin';
import VClamp from 'vue-clamp';
import dayjs from 'dayjs';
import TournamentAction from './TournamentAction';
import get from 'lodash/get';
export default {
  name: 'SmallTournamentCard',
  components: {
    VClamp,
    TournamentAction,
  },
  mixins: [tournamentMixin],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    hover: false,
  }),
  computed: {
    formatDate() {
      if(this.item.start_at){
        return  dayjs(this.item.start_at).format('MMM DD/HH:mmA');
      } else {
        return  dayjs(this.item.time).format('MMM DD/HH:mmA');
      }
    },
    joinBtn() {
      return this.actionButtonText(this.item);
    },
    prizes() {
      if(!this.item.bid_amount){
        return Math.round(+get(this, 'item.prizes[0]prize', 0));
      } else {
        return this.item.bid_amount;
      }
    },
    tournamentImageStyle() {
      let gradient = 'linear-gradient(359.11deg, #111542 -24.55%, rgba(17, 21, 66, 0.28) 99.27%),';
      if (this.hover) {
        gradient = '';
      }
      return ({
        backgroundImage: `${gradient} url(${this.item.image_url || this.item.game.image_public_url})`,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "./index.scss";
@import "~assets/styles/sizes.scss";

.tournaments-card {
  height: 100%;
  &-wrapper {
    margin: 0;
    height: 100%;
  }
  &__item {
    width: 100%;
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px 30px;
  }
  .tournament-action button {
    font-size: 20px;
    padding: 15px;
    white-space: nowrap;
    text-transform: uppercase;
  }
  .tournament {
    &-content {
      padding: 24px 20px 29px;
    }
    &-title {
      height: 46px;
      font-size: 24px;
      margin-bottom: 16px;
    }
    &-image {
      height: 200px;
      background-position: 50%;
      background-size: cover;
      background-repeat: no-repeat;
    }
  }
  .stats-row {
    width: 100%;
    margin: 0 -12px 23px;
    justify-content: space-between;
    .info-item {
      padding: 0 12px;
    }
  }
}

@media all and (max-width: $tablet-large-width) {
  .tournaments-card {
    &__item {
      padding: 0 5px 20px;
    }
    font-size: 14px;
    .tournament-content {
      padding: 24px 10px 29px;
    }
  }
}

</style>
