<template>
  <loader
    :loading="loading"
    :overlay="false"
    :center="true"
    height="80px"
  >
    <div
      v-if="bombPackages"
      class="bomb-coins-cards"
    >
      <bomb-coins-card
        v-for="item in bombPackages"
        :key="item.id"
        :is-description="false"
        :bomb-package="item"
        :buy-coins="()=>buyCoins(item)"
      />
    </div>
  </loader>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES, PAYMENT_STEPS } from 'helpers/constants';
import Loader from 'components/Loader';
import BombCoinsCard from 'components/BombCoins/BombCoinsCard';

const bombsModule = createNamespacedHelpers('bombs');
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'BombsTabPlansList',
  components: {
    BombCoinsCard,
    Loader,
  },
  computed: {
    ...bombsModule.mapState(['bombPackages', 'status']),
    loading() {
      return this.status === STATE_STATUSES.PENDING;
    }
  },
  mounted() {
    if(!this.bombPackages.length) {
      this.getBombPackages();
    }
  },
  methods: {
    ...bombsModule.mapActions(['getBombPackages']),
    ...modalModule.mapMutations(['setActiveModal', 'setCommonData']),
    buyCoins(item) {
      this.setCommonData({ bombsPackage: item });
      this.setActiveModal({type:'Payment', options:{ step:PAYMENT_STEPS.SETUP }});
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.bomb-coins-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 0 -1px;
  &::v-deep {
    .bomb-coins-card {
      padding: 1px;
      margin-bottom: 0;
      max-width: 50%;
      &__inner {
        padding: 20px 24px 72px;
        border: 2px solid $text-primary-color;
      }
      .bombs-image {
        position: unset;
        order: -1;
        margin-bottom: 8px;
        img {
          height: 80px;
          object-fit: contain;
        }
      }
      .buy-block {
        bottom: 24px;
        left: 24px;
        right: 24px;
      }
      .default-banger-btn {
        flex-direction: row;
        height: auto;
        width: 100%;
        max-width: 121px;
        min-height: 32px;
        padding: 6px;
        font-size: 16px;
        line-height: 1;
        margin: 0 auto;
      }
      .bombs-count,
      .free-bombs-count {
        font-size: 20px;
        line-height: 1;
        text-align: center;
      }
    }
  }
}

@media all and (max-width: $tablet-small-width){
  .bomb-coins-cards {
    margin: 0 -4px;
    &::v-deep {
      .bomb-coins-card {
        max-width: 100%;
        flex: 0 0 100%;
      }
    }
  }
}

@media all and (max-width: 360px){
  .bomb-coins-cards {
    &::v-deep {
      .bomb-coins-card {
        padding: 4px;
      }
    }
  }
}
</style>
