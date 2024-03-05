<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <v-row class="profile">
      <v-col cols="12">
        <h1 class="subtitles-primary">
          {{ $t("Payments") }}
        </h1>
      </v-col>
    </v-row>
    <div class="tournament-nav">
      <div class="tournament-nav__list">
        <div
          :key="1"
          class="tournament-nav__item"
          :class="{ active: active_tab === 'tab-methods' }"
          @click="active_tab = 'tab-methods'"
        >
          <div class="tournament-nav__item-inner">
            <div
              class="tournament-nav__item-link"
              v-text="$t('Methods')"
            />
          </div>
        </div>
        <div
          :key="2"
          class="tournament-nav__item"
          :class="{ active: active_tab === 'tab-history' }"
          @click="active_tab = 'tab-history'"
        >
          <div class="tournament-nav__item-inner">
            <div
              class="tournament-nav__item-link"
              v-text="$t('History')"
            />
          </div>
        </div>
      </div>
    </div>
    <!--  -->

    <v-tabs-items v-model="active_tab">
      <v-tab-item :value="'tab-methods'">
        <debit-cart :cards="cardList" />

        <v-row>
          <button
            class="add-button"
            @click="showCartModal = true"
          >
            {{ $t("ADD METHOD +") }}
          </button>

          <default-modal
            :show="showCartModal"
            :close-modal="closeCartModal"
          >
            <CartForm :close-modal="closeCartModal" />
          </default-modal>
        </v-row>
      </v-tab-item>

      <v-tab-item :value="'tab-history'">
        <History />
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import DebitCart from 'components/Profile/Payment/cart.vue';
import History from 'components/Profile/Payment/History';
import DefaultModal from 'components/modals/DefaultModal';
import CartForm from 'components/forms/profile/AddCartForm';
import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';

const authModule = createNamespacedHelpers('auth');

export default {
  name: 'ProfilePayment',
  components: {
    History,
    DefaultModal,
    CartForm,
    DebitCart,
  },
  middleware: ['hideHeader'],
  data() {
    return {
      cardList: [],
      active_tab: 'tab-methods',
      showCartModal: false,
    };
  },
  computed: {
    ...authModule.mapState(['user']),
  },
  created() {
    this.loadCards();
  },
  methods: {
    closeCartModal() {
      this.showCartModal = false;
      this.loadCards();
    },
    loadCards() {
      this.$bangerApi
        .get('/card/view-cards/' + this.user.id)
        .then((response) => {
          this.cardList = response.data;
        });
    },
    setHistory() {
      this.active_tab = 'tab-history';
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Payment',
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

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.subtitles-primary {
  font-weight: 900;
  font-size: 32px;
  letter-spacing: 0.02em;
  margin-bottom: 10px;
  text-transform: capitalize;
}
.v-tabs-items {
  background-color: transparent;
}
.add-button {
  float: right;
  background: transparent;
  border-radius: 59px;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 800;
  font-size: 14px;
  line-height: 100%;
  display: flex;
  align-items: center;
  text-align: center;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #be1338;
  padding: 15px 25px;
  margin: 35px 30px;
  border: 1px solid #be1338;
}
.history {
  float: right;
  cursor: pointer;
  color: #be1338;
  margin: 45px 5px;
}
.v-tab {
  font-family: Telegraf-UltraBold, Serif;
  font-style: normal;
  font-weight: 900;
  font-size: 16px;
  text-transform: none;
  width: 160px;
}
.v-tab--active {
  color: #be1338;

  background-image: url("~static/images/design/button-active.svg");
}
.v-tabs-slider {
  display: none;
}
.v-tab:before,
.v-tab:focus,
.v-tab:active {
  background-color: transparent !important;
}

.tournament-nav {
  margin: 32px 0;
  &__list {
    display: flex;
    font-size: 20px;
    line-height: 1.2;
    background: $app-background;
    clip-path: polygon(
      19px 0,
      calc(100% - 10px) 0,
      100% 17px,
      calc(100% - 19px) 100%,
      11px 100%,
      0 61px
    );
    width: auto;
    max-width: max-content;
    padding: 0 10px;
  }
  &__item {
    display: block;
    text-align: center;
    position: relative;
    width: 160px;
    &:hover,
    &.active {
      z-index: 2;
      &::before {
        display: none;
      }
      .tournament-nav__item-inner {
        background: $border-primary-color;
        color: $text-secondary-color;
      }
    }
    &-inner {
      display: inline-block;
      font-family: Telegraf-UltraBold, serif;
      color: $text-primary-color;
      text-transform: uppercase;
      width: 100%;
      padding: 3px;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
      transition: 0.5s easy;
      font-weight: 900;
      font-size: 16px;
      line-height: 120%;
    }
    &:not(:last-child) {
      &::before {
        content: "";
        width: 1px;
        height: 30px;
        position: absolute;
        top: 50%;
        right: 0;
        z-index: 1;
        opacity: 0.5;
        transform: translateY(-50%) rotate(25deg);
        background: $text-primary-color;
      }
    }
    &-link {
      padding: 8px 16px;
      cursor: pointer;
      background: $app-background;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
    }
  }
}
</style>
