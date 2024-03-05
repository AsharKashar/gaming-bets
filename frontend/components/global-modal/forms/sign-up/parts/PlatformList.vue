<template>
  <div class="platforms-list">
    <div
      v-for="({name, title}) in platforms"
      :key="name"
      class="platforms-item"
      :class="{active: activePlatform === name}"
      @click="setActivePlatform(name)"
    >
      <div
        v-ripple
        class="platforms-item__inner"
      >
        <div class="platforms-item__icon">
          <svg-icon :name="name" />
        </div>
        <div
          class="platforms-item__title"
          v-text="title"
        />
      </div>
    </div>
  </div>
</template>

<script>
import SvgIcon from 'components/svgIcons/SvgIcon';
export default {
  name: 'PlatformList',
  components: {SvgIcon},
  props: {
    platforms: {
      type: Array,
      default: () => ([
        {
          name: 'pc',
          title: 'PC'
        },
        {
          name: 'x-box',
          title: 'X-Box'
        },
        {
          name: 'ps-4',
          title: 'PS 4'
        },
        {
          name: 'cross-platform',
          title: 'Cross Platform'
        },
      ]),
    },
    activePlatformDefault: {
      type: String,
      default: 'cross-platform',
    },
  },
  data: () => ({
    activePlatform: null,
  }),
  mounted() {
    if (this.activePlatformDefault) {
      this.setActivePlatform(this.activePlatformDefault);
    }
  },
  methods: {
    setActivePlatform(name) {
      this.activePlatform = name;
      this.$emit('setActivePlatform', name);
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  .platforms {
    &-list {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -10px 32px;
      justify-content: center;
    }
    &-item {
      padding: 0 10px;
      width: 100%;
      flex: 0 0 25%;
      max-width: 25%;
      &__inner {
        cursor: pointer;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        text-align: center;
        padding: 10px 16px;
        border: 1px solid rgba(161, 175, 211, 0.2);
      }
      &__title {
        width: 100%;
        font-size: 14px;
        font-weight: 800;
        color: $text-primary-color;
        line-height: .94;
      }
      &__icon {
        padding-bottom: 14px;
        line-height: .5;
      }
      &.active {
        .platforms-item {
          &__inner {
            background: #be133847;
            border: none;
            &::v-deep {
              svg path {
                &[stroke] {
                  stroke: $text-secondary-color;
                }
                &[fill] {
                  fill: $text-secondary-color;
                }
              }
            }
          }
          &__title {
            color: $text-secondary-color;
          }
        }
      }
    }
  }
</style>
