<template>
  <div class="bomb-coins">
    <div class="bomb-coins-title">
      <p class="main-title">
        {{ $t('Select your best choice') }}
      </p>
      <div class="subtitle">
        <p
          class="subtitle-text"
        >
          {{ $t('Bombs act as Banger Games digital currency. Enter tournaments, wager or purchase from our live store with bombs. Buy bombs today and jump straight into the fight!') }}
        </p>
        <p class="subtitle-url">
          <router-link to="/withdrawals">
            {{ $t('Further withdrawal information') }}
          </router-link>
        </p>
      </div>
    </div>
    <div class="bomb-coins-cards">
      <bomb-coins-card
        v-for="item in bombPackages"
        :key="item.id"
        :bomb-package="item"
        :buy-coins="actionBuyCoins"
      />
    </div>

    <default-modal
      :show="showBuyCoinsModal"
      :close-modal="closeModal"
    >
      <buy-bomb-coins :selected-bomb-package="selectedBombPackage" />
    </default-modal>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const bombsModule = createNamespacedHelpers('bombs');
const authModule = createNamespacedHelpers('auth');

import { VUE_MODE } from 'config';
import BombCoinsCard from './BombCoinsCard';
import DefaultModal from 'components/modals/DefaultModal.vue';
import BuyBombCoins from 'components/forms/BuyBombCoins';
const moduleModal = createNamespacedHelpers('modal');
export default {
  name: 'BombCoins',
  components: {
    BuyBombCoins,
    BombCoinsCard,
    DefaultModal,
  },
  data() {
    return {
      showBuyCoinsModal: false,
      selectedBombPackage: {},
      isProd: VUE_MODE === 'production',
    };
  },
  computed: {
    ...bombsModule.mapState(['bombPackages']),
    ...authModule.mapState(['isAuthenticated']),

    actionBuyCoins() {
      if (this.isAuthenticated) {
        return this.buyCoins;
      }
      if (!this.isProd) {
        return () => this.setActiveModal({type: 'LoginForm'});
      }
      return () => {};
    },
  },
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
    buyCoins(bombPackage) {
      this.selectedBombPackage = bombPackage;
      this.showBuyCoinsModal = true;
    },
    closeModal() {
      this.showBuyCoinsModal = false;
    },
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";

  .bomb-coins {
    width: 100%;
    max-width: 1140px;
    margin: auto;
    padding: 80px 15px 56px;
    .bomb-coins-title {
      padding: 4em 0 2em 0;
      width: 100%;
      display: flex;
      justify-content: flex-start;
      .main-title {
        flex-basis: 50%;
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 900;
        display: flex;
        align-items: center;
        color: $text-primary-color;
        font-size: 4rem;
      }
      .subtitle {
        flex-basis: 50%;
        margin-top: 12px;
        p {
          padding: 0;
          margin: 0;
        }
        .subtitle-text {
          line-height: 120%;
          color: $text-primary-color;
          font-size: 22px;
        }
        .subtitle-url {
          a {
            font-size: 16px;
            line-height: 94%;
            color: $border-primary-color;
          }
        }
      }
    }
  }

  .bomb-coins-cards {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }
  @media screen and (max-width: $laptop-width) {
    .bomb-coins-cards {
      padding-bottom: 5em;
    }
    .subtitle-text {
      line-height: 120%;
      color: $text-primary-color;
      font-size: 18px !important;
    }
    .bomb-coins-cards {
      &>:nth-child(3n) {
        margin-left: 1px;
        margin-right: 1px;
      }
    }
  }


  @media screen and (max-width: $tablet-large-width) {
    .bomb-coins {
      padding: 4em 4em 2em;
      .bomb-coins-title {
        padding-top: 0;
        flex-direction: column;
        .main-title {
          font-size: 3rem;
        }
        .subtitle-text {
          font-size: 16px;
        }
      }
    }
  }

  @media screen and (max-width: $mobile-width) {
    .bomb-coins {
      padding: 4em 2em 2em;
      .bomb-coins-title {
        .main-title {
          font-size: 1.5rem;
        }
        .subtitle-text {
          font-size: 12px;
        }
      }
    }
  }
</style>
