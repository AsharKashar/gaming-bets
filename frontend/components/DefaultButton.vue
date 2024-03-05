<template>
  <button
    :class="{
      'banger-btn': true,
      [btnClass]: true,
      'banger-btn-disabled':disabled
    }"
    v-bind="vBind"
    :type="type"
    :disabled="loading || disabled"
    v-on="vOn"
    @click="onClick"
  >
    <slot />
    <div
      v-if="loading"
      class="loader"
    >
      <v-progress-circular indeterminate />
    </div>
  </button>
</template>

<script>
export default {
  name: 'DefaultButton',
  props: {
    vOn: {
      type: Object,
      default: () => ({}),
    },
    btnClass: {
      type: String,
      default: 'default-banger-btn',
    },
    vBind: {
      type: Object,
      default: () => ({}),
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    onClick: {
      type: Function,
      default: () => {},
    },
    loading: {
      type: Boolean,
    },
    type: {
      type: String,
      default: 'button',
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.banger-btn {
  border-radius: 59px;
  outline: none;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  line-height: 100%;
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
  text-transform: none;
  font-size:16px;
  color: $app-background;
  position: relative;
  overflow: hidden;
  user-select: none;
  border: 1px solid transparent;

  .loader {
    position: absolute;
    width: 100%;
    left: 0;
  }

  &:hover {
    border-radius: 59px;
  }

  @media only screen and (max-width: 1439px) {
    font-size: 18px;
    letter-spacing: 0.05em;
    padding: 10px 22px;
  }

  @media only screen and (min-width: $desktop-width) {
    font-size: 24px;
    letter-spacing: 0.05em;
    padding: 16px 31px;
  }
}

.default-banger-btn {
  background: $button-primary-background;

  .loader {
    background: $button-primary-background;
  }

  &:hover {
    color: $text-hover-color;
    box-shadow: 3px 20px 30px rgba(190, 19, 56, 0.48);
  }
}

.secondary-banger-btn {
  background: $text-primary-color;

  .loader {
    background: $text-primary-color;
  }

  &:hover {
    color: $text-hover-color;
    box-shadow: 3px 20px 30px rgba(160, 175, 211, 0.22);
  }
}


.outline-banger-btn  {
  color: $button-primary-background;
  background: transparent;
  border-color: $button-primary-background;
  .loader,
  &:disabled,
  &:active,
  &:hover {
    color: $app-background;
    background: $button-primary-background;
  }
}

.banger-btn-disabled {
  background: rgba(90, 91, 89, 0.66);
  &:hover {
    color: black;
    box-shadow: none;
    cursor: not-allowed;
  }
}

.button-block {
  width: 100%;
}
.button-disabled {
  opacity: 0.7;
  &:hover {
    color: #000000;
    box-shadow: inherit;
  }
}
</style>
