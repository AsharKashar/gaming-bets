<template>
  <div class="links-container">
    <router-link
      v-for="(link, index) in links"
      :key="index"
      :to="link.disabled ? '' : link.to"
      :class="{
        'active-link':link.disabled ? false: currentRoute.path === link.to,
        [colorsClass]:true,
        [fontClass]:true,
        'link-item': true,
        'link-item-disabled': link.disabled,
      }"
    >
      {{ $t(link.title) }}
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'LinksColumns',
  props: {
    links: {
      type: Array,
      default: () => []
    },
    colorsClass: {
      type: String,
      default: 'font-red'
    },
    fontClass: {
      type: String,
      default: 'font-footer'
    }
  },
  data(){
    return {
      currentRoute: {...this.$router.currentRoute}
    };
  },
  watch: {
    $route() {
      this.currentRoute = { ...this.$router.currentRoute };
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";

.links-container {
  display: flex;
  flex-wrap: wrap;
  max-width: 51%;
  width: 100%;

  .link-item-disabled {
    color: currentColor;
    opacity: 0.5;

    &:hover {
      font-family: Telegraf-Regular, serif !important;

      &:hover {
        font-family: Telegraf-Regular, serif !important;
      }
    }
  }

  .link-item {
    flex-basis: 50%;
    text-decoration: none;
    text-align: left;
    font-family: Telegraf-Regular, serif;
    font-style: normal;
    font-weight: normal;
    text-transform: uppercase;
    padding: 2px 0;

    &.active-link {
      font-family: Telegraf-UltraBold, serif;
    }

    &:hover {
      font-family: Telegraf-UltraBold, serif;
      text-transform: uppercase;
      font-style: normal;
      font-weight: normal;
      font-size: 23px;
      line-height: 24px;
      text-transform: uppercase;
      padding: 2px 0;

      &:hover {
        font-family: Telegraf-UltraBold, serif;
      }
    }

    &.font-header {
      font-size: 23px;
      line-height: 24px;
    }

    &.font-footer {
      font-size: 16px;
      line-height: 17px;
    }

    &.font-red {
      color: #bf1438;
      &:hover {
        color: #bf1438;
      }
    }

    &.font-gray {
      color: #a1afd3;
      &:hover {
        color: #a1afd3;
      }
    }
  }

  @media only screen and (max-width: 1439px) {
    .links-container {
      display: flex;
      flex-direction: column;
      flex-wrap: nowrap;
    }
  }

  @media only screen and (max-width: $tablet-small-width) {
    .links-container {
      max-width: 100%;
    }
  }
}
</style>
