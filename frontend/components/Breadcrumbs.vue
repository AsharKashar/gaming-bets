<template>
  <div class="breadcrumbs">
    <div
      v-for="(breadcrumb,i) in Object.keys(breadcrumbs)"
      :key="i"
      class="breadcrumb"
      :class="{ 'active-crumb':breadcrumbs[breadcrumb].active }"
    >
      <router-link
        :to="breadcrumbs[breadcrumb].href"
        class="crumb-text"
      >
        {{ $t(breadcrumbs[breadcrumb].text) }}
      </router-link>
      <div class="crumb-separator">
        /
      </div>
    </div>
  </div>
</template>

<script>

import { breadcrumbObjects } from 'helpers/links';

export default {
  name: 'Breadcrumbs',
  props: {
    breadcrumbsList:{
      type: Array,
      default: () => ([])
    },
    additionalBreadCrumbs:{
      type: Object,
      default: () => ({})
    },
    activeCrumb:{
      type: String,
      default: ''
    }
  },
  computed:{
    breadcrumbs () {
      const result = {};
      this.breadcrumbsList.map((breadcrumb) => {
        result[breadcrumb] = this.additionalBreadCrumbs[breadcrumb] || {...breadcrumbObjects[breadcrumb]};

        if (this.activeCrumb === breadcrumb) {
          result[breadcrumb]['active'] = true;
        }
      });

      return {...result};
    }
  }

};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';
  @import '~/assets/styles/sizes.scss';

  .breadcrumbs{
    display: flex;

    .breadcrumb{
      font-family: Telegraf-UltraBold, serif;
      display: flex;
      font-style: normal;
      font-weight: 800;
      font-size: 24px;
      line-height: 94%;
      overflow: hidden;

      .crumb-separator{
        margin: 0 7px;
        color:$border-primary-color;
        text-decoration: none;
      }

      .crumb-text{
        text-decoration-line: underline;
        cursor: pointer;
        color: #FFFFFF;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      &.active-crumb{
        .crumb-text {
          color: $text-primary-color;
          text-decoration: none;
          pointer-events: none;
        }
      }

      &:last-child{
        .crumb-separator{
          display:none;
        }
      }
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .breadcrumbs {
      margin-left: 10px;

      .breadcrumb {
        font-size: 16px;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .breadcrumbs {
      margin-left: 10px;

      .breadcrumb {
        font-size: 24px;
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .breadcrumbs {
      margin-left: 0;

      .breadcrumb {
        font-size: 24px;
      }
    }
  }
</style>
