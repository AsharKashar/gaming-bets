<router>
 {
  meta:{
    savePosition:true
  }
 }
</router>
<template>
  <div class="tournament-item-tab tournament-item-tab--overview">
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
  </div>
</template>

<script>

import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';
const { mapState } = createNamespacedHelpers('boxfight');
import dayjs from 'dayjs';
import kebabCase from 'lodash/kebabCase';
export default {
  name: 'TournamentsOverview',
  components: {},
  middleware: ['hideHeader'],
  computed: {
    ...mapState(['currentBoxFight']),
    isBoxFight() {
      return +this.$route.query.gameMode === this.boxFightId;
    },
    registration() {
      return dayjs(this.currentBoxFight.time).diff(new Date()) > 0
        ? 'Open'
        : 'Closed';
    },
    infoList(){
      return {
        game: this.currentBoxFight.game.cover_public_url,
        'wager amount': this.currentBoxFight.bid_amount,
        'match type': this.currentBoxFight.game_type_boxmatch.description,
        region: this.currentBoxFight.region.name,
        'tournament date': dayjs(this.currentBoxFight.time).format('DD MMM YYYY'),
        time: dayjs(this.currentBoxFight.time).format('hh : mm a'),
        platform: this.currentBoxFight.platform.name,
        registration: this.registration,
        host: this.currentBoxFight.user.name,
      };
    }
  },
  methods:{
    kebabCase(str) {
      return kebabCase(str);
    },
    getArrayName(arr) {
      return arr.map(({ name }) => name).join(', ');
    },
  },
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Tournaments overview',
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

<style lang="scss" scoped>
@import "~assets/styles/colors.scss";
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
.tournament-item-tab {
  padding-bottom: 120px;
}

.tournaments-overview__about {
  color: $text-primary-color;
  line-height: 1.1;
  display: flex;
  flex-wrap: wrap;
  &-col {
    width: 100%;
    &:first-child {
      max-width: calc(100% - 348px);
      padding-right: 96px;
      flex: 0 0 calc(100% - 348px);
    }
    &:last-child {
      max-width: 348px;
      flex: 0 0 348px;
    }
  }

  &-heading {
    font-size: 24px;
    margin-bottom: 8px;

    h2 {
      line-height: 1.3;
      text-transform: uppercase;
    }
  }
  &-description {
    font-size: 16px;
    line-height: 1.4;
    font-weight: 400;
    p {
      padding-bottom: 28px;
    }
  }
}
</style>
