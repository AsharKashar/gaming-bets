<template>
  <div class="tournaments-card-wrapper">
    <div
      class="tournaments-card"
      :style="{
        'background-image': `linear-gradient(180deg, rgba(1, 4, 50, 0) 20.52%, #010432 106.23%), url(${item.image_url ||
          item.game.image_public_url})`
      }"
      @click.self="openTournament(item.id)"
    >
      <div
        v-if="item.featured"
        class="tournament-status"
      >
        {{ $t('Featured') }}
      </div>
      <div class="tournament-content">
        <div class="tournament-title">
          {{ item.name || item.boxmatch_name }}
        </div>
        <div class="stats-row">
          <tournament-action :item="item" />
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
              {{ prizes }} {{ $t('Bombs') }}
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
    </div>
  </div>
</template>

<script>
import tournamentMixin from '@/mixins/tournamentMixin';
import dayjs from 'dayjs';
import get from 'lodash/get';
import TournamentAction from './TournamentAction';

export default {
  name: 'LargeTournamentCard',
  components: {
    TournamentAction,
  },
  mixins: [tournamentMixin],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
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
    }
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "./index.scss";
.tournaments {
  &-card {
    background: no-repeat center;
    background-size: cover;
    height: 385px;
    padding: 72px 20px 35px;

    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;

    .tournament {
      &-content {
        width: 100%;
      }
      &-status {
        width: max-content;
        font-style: normal;
        font-size: 14px;
        padding: 7px;
        background: linear-gradient(
          90deg,
          #be1338 0%,
          rgba(190, 19, 56, 0) 100%
        );
        margin-bottom: 15px;
        color: $text-hover-color;
        position: absolute;
        left: 20px;
        top: 22px;
      }
      &-title {
        font-size: 48px;
        margin-bottom: 35px;
      }
    }

    .stats-row {
      max-width: 80%;
      & > :first-child {
        margin-right: auto;
      }
      .info-item {
        margin: 0 15px;
      }
    }
  }
}
</style>
