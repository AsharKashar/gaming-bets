<template>
  <v-bottom-navigation
    v-model="bottomNav"
    app
    background-color="#111542"
    color
    grow
    dark
    mandatory
    class="default-bottombar"
  >
    <v-btn
      link
      :class="{'button-active': $route.name === 'home'}"
      to="/"
    >
      <div class="sidebar-selection" />
      <span>{{ $t('Home') }}</span>
      <v-avatar
        tile
        size="32"
      >
        <img
          v-if="$route.name === 'home'"
          src="~/static/icons/Home.svg"
          alt="Home"
        >
        <img
          v-else
          src="~/static/icons/Home_p.svg"
          alt="Home"
        >
      </v-avatar>
    </v-btn>

    <v-btn
      link
      :class="{'button-disabled' : isDemo, 'button-active': $route.name === 'coins' || buttonActive === 'coins'}"
      @click="goToPage('/coins')"
    >
      <span>{{ $t('Bomb Coins') }}</span>
      <v-avatar
        tile
        size="32"
      >
        <img
          v-if="$route.name === 'coins' || buttonActive === 'coins'"
          src="~/static/icons/Bombcoins.svg"
          alt="Bombcoins"
        >
        <img
          v-else
          src="~/static/icons/Bombcoins_p.svg"
          alt="Bombcoins"
        >
      </v-avatar>
    </v-btn>

    <v-btn
      link
      :class="{'button-disabled' : isDemo, 'button-active': $route.name === 'tournaments-game-list' || buttonActive === 'tournaments-game-list'}"
      @click="goToPage('/tournaments')"
    >
      <span>{{ $t('Games') }}</span>
      <v-avatar
        tile
        size="32"
      >
        <img
          v-if="$route.name === 'tournaments-game-list' || buttonActive === 'tournaments-game-list'"
          src="~/static/icons/Gamepad.svg"
          alt="Gamepad"
        >
        <img
          v-else
          src="~/static/icons/Gamepad_p.svg"
          alt="Gamepad"
        >
      </v-avatar>
    </v-btn>

    <v-btn
      link
      :class="{'button-active': $route.name === 'news'}"
      to="/news"
    >
      <span>{{ $t('News') }}</span>
      <v-avatar
        tile
        size="32"
      >
        <img
          v-if="$route.name === 'news'"
          src="~/static/icons/News.svg"
          alt="News"
        >
        <img
          v-else
          src="~/static/icons/News_p.svg"
          alt="News"
        >
      </v-avatar>
    </v-btn>

    <v-btn
      link
      :class="{'button-disabled' : isDemo, 'button-active': $route.name === 'leaderboards' || buttonActive === 'leaderboards'}"
      @click="goToPage('/leaderboards')"
    >
      <span>{{ $t('Leaderboards') }}</span>
      <v-avatar
        tile
        size="32"
      >
        <img
          v-if="$route.name === 'leaderboards' || buttonActive === 'leaderboards'"
          src="~/static/icons/Leaderboards.svg"
          alt="Leaderboards"
        >
        <img
          v-else
          src="~/static/icons/Leaderboards_p.svg"
          alt="Leaderboards"
        >
      </v-avatar>
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
import Vue from 'vue';
import { VUE_MODE } from 'config';
export default {
  name: 'DefaultBottombar',
  data() {
    return {
      mini: true,
      bottomNav: 0,
      buttonActive: null,
    };
  },
  computed: {
    isDemo() {
      return VUE_MODE === 'production';
    },
  },
  methods: {
    isActiveRoute(route) {
      return this.$route.name === route ? true : false;
    },

    goToPage(page) {
      if (this.isDemo) {
        this.showComingSoonNotice();
        this.buttonActive = page.replace('/', '');
      } else this.$router.push(page);
    },
    showComingSoonNotice() {
      Vue.notify({
        group: 'custom-notification',
        title: 'Feature Coming Soon',
        text: 'The best is yet to come, hold tight',
        type: 'info',
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.default-bottombar {
  color: $text-primary-color;
  clip-path: polygon(96% 0, 100% 30%, 100% 100%, 0 100%, 0 30%, 4% 0);
  height: 75px !important;

  .button-active,
  .button-active::v-deep .v-btn__content {
    color: $button-primary-background !important;
  }

  .button-active::v-deep .v-btn__content {
    color: $button-primary-background !important;
    background-color: #be133847 !important;
  }

  .button-disabled {
    opacity: 0.5;
  }

  span {
    white-space: nowrap;
  }
}

.sidebar-selection {
  display: none !important;
  // important is used to overwrite it with default vuetify styles which should't
  clip: auto !important;
  position: absolute;
  background: $border-primary-color;
  bottom: 0;
  border-radius: 5px 20px 20px 5px;
  width: 41px !important;
  height: 21px !important;
}

.sidebar-list-active > .sidebar-selection {
  display: block !important;
}
.default-bottombar {
  .v-btn.v-btn--disabled:not(.v-btn--flat):not(.v-btn--text):not(.v-btn--outlined) {
    background-color: transparent !important;
  }
}

@media all and (min-width: $min-resolution) {
  .default-bottombar {
    // padding: 0 0 75px; //Do not change, this is bottom padding for iphoneX BG-310
    padding: 0 1rem 1rem 1rem; //  change the height to make it same
    display: grid;
    grid-template-columns: repeat(5, 1fr);

    .v-btn {
      min-width: 59px;
      font-size: 10px;
      max-width: 59px;
      white-space: pre-wrap;
      padding: 0;
      padding-bottom: 0.6rem;

      &::v-deep .v-btn__content {
        // word-break: break-word !important;
        flex: 1 1 auto !important;

        .v-avatar {
          height: 32px !important;
          min-width: 32px !important;
          width: 32px !important;
        }
      }

      .v-btn__content > *:not(.v-icon) {
        height: 15px;
      }
    }
  }
}

@media all and (min-width: $mobile-width) {
  .default-bottombar {
    .v-btn {
      min-width: 69px;
      max-width: 69px;
    }
  }
}
@media all and (min-width: 500px) {
  .default-bottombar {
    .v-btn {
      min-width: 69px;
      max-width: 100%;
      font-size: 0.75rem;

      .v-btn__content {
        word-break: break-word;
        flex: 1 1 auto !important;

        .v-avatar {
          height: 35px !important;
          min-width: 35px !important;
          width: 35px !important;
        }
      }
    }
  }
}

@media all and (min-width: $tablet-small-width) {
  .default-bottombar {
    display: none !important;
  }
}
</style>
