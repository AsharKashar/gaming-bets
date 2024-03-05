<template>
  <div
    class="tab_button"
    :class="{'tab_button--checked': activeItem}"
    @click="action"
  >
    <div
      class="item-icon"
      :style="{'background-image': `url(${item.image})`}"
    />
    <div class="item-name">
      {{ item.name }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'TabButton',
  props: {
    value: {
      type: Number,
      default: 0
    },
    vValue: {
      type: Number,
      default: 0
    },
    label: {
      type: String,
      default: ''
    },
    onClick: {
      type: Function,
      default: () => {}
    },
    item: {
      type: Object,
      default: () => ({})
    },
    id: {
      type: String,
      default: ''
    }
  },
  computed: {
    activeItem() {
      return +this.value === this.vValue;
    },
  },
  methods: {
    action() {
      if (this.activeItem) return;
      this.onClick();
    },
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .tab_button{
    opacity: 0.5;
    display: flex;
  }
  .tab_button--checked{
    opacity: 1;
    .item-name{
      color: $border-primary-color;
    }
  }

  .item-icon{
    height: 54px;
    width: 54px;
    border-radius: 50%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .item-name{
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-size: 16px;
    line-height: 94%;
    display: flex;
    align-items: center;
    color: $text-hover-color;
    margin: 0 40px 0 16px;
    text-transform: capitalize;
  }
</style>
