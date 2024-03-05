<template>
  <v-tabs
    background-color="primary"
    class="custom-tab-bar"
    :value="currentIndex"
  >
    <v-tab
      v-for="(item, index) in items"
      :key="item.slug"
      @click="setCurrentIndex(index)"
    >
      {{ item.name }}
    </v-tab>
  </v-tabs>
</template>

<script>

export default {
  name: 'TabBar',
  props: {
    items: {
      type: Array,
      default: () => ([])
    },
    setCurrentIndex: {
      type: Function,
      default: () => {}
    },
    currentIndex: {
      type: Number,
      default: 0
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .custom-tab-bar {
    margin-top: 10px;
    width: 100%;

    &::v-deep .v-item-group.theme--dark.v-slide-group.primary {
      background-color: transparent !important;

      .v-tabs-slider-wrapper{
        bottom:-2px;
        height:3px;
      }

      .v-slide-group__content{
        border-bottom: 1px solid rgba(161, 175, 211, 0.5);
        margin-bottom: 1px;
      }

      .v-tab{
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 14px;
        line-height: 94%;
        display: flex;
        align-items: center;
        text-align: center;
        color: $text-primary-color;
        opacity: 0.5;
        padding: 0 31px;

        .v-ripple__container{
          display: none;
        }

        &::before{
          background-color: transparent;
        }
      }

      .v-tabs-slider{
        color:$text-primary-color
      }

      .v-tab--active{
        opacity: 1;
      }
    }
  }

  @media only screen and (max-width: $tablet-small-width) {
    .custom-tab-bar {
      &::v-deep .v-item-group.v-slide-group {
         .v-slide-group__prev.v-slide-group__prev--disabled {
          display: none!important;
        }
      }
    }
  }

</style>
