<template>
  <div class="copy-right radios mt-10 mb-5">
    <div
      class="radio"
      :class="copyRight && 'selected'"
      @click="toggleCopyright"
    >
      <span class="circle mr-4" />
      <div class="radio-title">
        {{ $t('I agree with') }}
      </div>
    </div>
    <router-link
      to="#"
      class="mr-2"
    >
      {{ $t('Terms & Conditions') }}
    </router-link>and
    <router-link
      to="#"
      class="ml-2"
    >
      {{ $t('Privacy Policy') }}
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    copyRight: {
      type: Boolean,
      default: false,
    },
    toggleCopyright: {
      type: Function,
      default: () => {},
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.radios {
  display: flex;
  align-items: center;
  .radio {
    display: flex;
    align-items: center;
    margin-right: 10px;
    cursor: pointer;
    &-title {
      font-size: 16px;
      line-height: 140%;
      color: $text-hover-color;
    }
    .circle {
      display: inline-block;
      height: 16px;
      width: 16px;
      border-radius: 50%;
      border: 1px solid $text-hover-color;
      margin-right: 5px;
      position: relative;
    }

    &.selected {
      .radio-title {
        color: $text-secondary-color;
        font-family: Telegraf-UltraBold;
      }
      .circle {
        border: 1px solid $text-secondary-color;

        &:before {
          content: "";
          position: absolute;
          height: 9px;
          width: 9px;
          background: $text-secondary-color;
          border-radius: 100%;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        }
      }
    }
  }
}
.copy-right {
  a {
    text-decoration: none;
    color: $text-secondary-color;
    font-weight: bold;
  }
}
</style>
