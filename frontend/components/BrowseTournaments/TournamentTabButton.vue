
<template>
  <div
    class="tab_button"
    :class="[value === vValue?'tab_button--checked':'', disabled]"
    @click.stop="disabled ? () => ({}) : onClick()"
  >
    <img
      :src="item.cover_public_url"
      :alt="item.name"
      class="item-cover"
    >
  </div>
</template>

<script>
export default {
  name: 'TournamentTabButton',
  props: {
    value: {
      type: Number,
      default: 0,
    },
    vValue: {
      type: Number,
      default: 0,
    },
    label: {
      type: String,
      default: '',
    },
    onClick: {
      type: Function,
      default: () => {},
    },
    item: {
      type: Object,
      default: () => ({}),
    },
    id: {
      type: String,
      default: '',
    },
    disabled: {
      type: Boolean,
      default: false,
    }
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.tab_button {
  opacity: 0.5;
  display: flex;
  max-width: 177px;
  width: 177px;
  justify-content: center;
  align-items: center;
  transform: skewX(-15deg);
  border-right: 1px solid $text-primary-color;
  padding: 0 25px;
  margin-bottom: 30px;

  &.disabled {
    cursor: not-allowed;
  }

  .item-cover {
    max-width: 100%;
    max-height: 56px;
    height: 56px;
    transform: skewX(15deg);
  }
}
.tab_button--checked {
  opacity: 1;
  .item-name {
    color: $border-primary-color;
  }
}


@media only screen and (max-width: $tablet-small-width) {
  .tab_button {
    border: none;
  }
}
</style>
