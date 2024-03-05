<template>
  <div class="default-layout">
    <default-header
      v-if="showHeader"
      :profile="isProfile"
    />
    <default-sidebar />
    <default-bottombar />
    <div
      class="layout-content"
      :class="{'layout-content-demo':demoLayout}"
    >
      <nuxt />
    </div>
    <default-footer v-if="showFooter" />
  </div>
</template>

<script>
import DefaultHeader from './DefaultHeader.vue';
import DefaultFooter from './DefaultFooter.vue';
import DefaultSidebar from './DefaultSidebar.vue';
import DefaultBottombar from './DefaultBottombar.vue';

import { createNamespacedHelpers } from 'vuex';
const layoutModule = createNamespacedHelpers('layout');
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'DefaultLayout',
  components: {
    DefaultHeader,
    DefaultFooter,
    DefaultSidebar,
    DefaultBottombar,
  },
  computed: {
    ...modalModule.mapMutations(['setActiveModal']),
    ...layoutModule.mapState(['showHeader', 'showFooter', 'demoLayout', 'isProfile'])
  },
  mounted() {
    const { login, redirect } = this.$route.query;
    if (login === 'true') {
      this.setActiveModal({type: 'LoginForm'});
    }

    if (redirect) {
      this.$router.push(redirect);
    }

  },
  methods: {

  },
};
</script>

<style scoped lang="scss">
 @import "~/assets/styles/sizes";

  .layout-content {
    min-height: 82vh;
  }

  .default-layout {
    overflow-x: hidden;
    overflow-y: auto;
    position: relative;
  }

  .layout-content-demo {
    background-image: url("https://cdn.bangergames.com/demo-files/coming-soon-background.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: 96px;
    min-height: 100vh;
    background-position: center;
  }

  @media only screen and (min-width: $min-resolution) {
    .footer-container {
      // display: none;
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .footer-container {
      display: block;
    }
    .layout-content {
      padding: 0 20px 0 120px;
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .layout-content {
      padding: 0 4.5% 0 12%;
    }
  }

  @media all and (min-width: $desktop-width) {
    .layout-content {
      padding: 0 11% 0 11.4%;
    }
    .layout-content-demo {
      padding: 0 0 0 7%;
    }
  }
  @media only screen and (max-width: $tablet-small-width) {
    .footer-container {
      // margin-bottom: 100px;
    }
  }
</style>
