<template>
  <v-app>
    <div
      id="wrap-scroll-bar"
      class="hide-mobile"
    >
      <div id="root">
        <div v-if="!loading">
          <DefaultLayout>
            <Nuxt />
          </DefaultLayout>
        </div>
        <div v-if="loading">
          <v-overlay>
            <v-progress-circular
              indeterminate
              size="64"
            />
          </v-overlay>
        </div>
        <global-modal />
        <cookie-accept v-if="showCookie" />

        <client-only>
          <notifications
            group="error"
            position="top center"
            :duration="15000"
          />
          <notifications
            group="app"
            position="top center"
            :duration="20000"
          />
          <notifications
            group="custom-notification"
            position
            :duration="4000"
            :class="{
              'custom-notification-demo': isDemo,
              'custom-notification': !isDemo
            }"
          >
            <template
              slot="body"
              slot-scope="props"
            >
              <custom-notification :properties="{ ...props, duration: 4000 }" />
            </template>
          </notifications>
        </client-only>
      </div>
    </div>
  </v-app>
</template>

<script>
import { STATE_STATUSES } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import CustomNotification from 'components/notifications/CustomNotification';
import { VUE_MODE, ENABLE_COOKIE_ACCEPT } from 'config';
import CookieAccept from 'components/modals/CookieAccept';
import GlobalModal from 'components/global-modal';
import DefaultLayout from './Defaultlayout';

const authModule = createNamespacedHelpers('auth');

export default {
  name: 'App',
  metaInfo() {
    return {
      title: 'BangerGames',
      meta: [
        {
          vmid: 'description',
          name: 'description',
          content: 'Competitive gaming platform',
        },
      ],
    };
  },
  components: {
    DefaultLayout,
    GlobalModal,
    CookieAccept,
    CustomNotification,
  },
  data: () => ({
    showCookie:  ENABLE_COOKIE_ACCEPT,
  }),
  computed: {
    ...authModule.mapState(['checkStatus']),
    loading() {
      return this.checkStatus === STATE_STATUSES.PENDING;
    },
    isDemo() {
      return VUE_MODE === 'production';
    },
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";

  #root {
    min-height: 100vh;
    height: auto;
  }

  @media screen and (-webkit-min-device-pixel-ratio: 0) {
    #safari {
      background-color: #010432;
    }
  }

  .custom-notification {
    left: 24px;
    bottom: 20px;
    width: 444px !important;
    max-width: calc(100% - 48px);
  }
  .custom-notification-demo {
    right: 24px;
    top: 20px;
    width: 444px !important;
    max-width: calc(100% - 48px);
  }
</style>
