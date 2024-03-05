<template>
  <div class="cards-grid-square-row">
    <sub-accent-card-fadeless
      v-for="item in items"
      :key="item.id"
      :title="item.content_detail.name"
      :subtitle="item.content_detail.description"
      :background-image="item.preview_image_url"
      :slug="'/'+item.full_post_slug"
    />
  </div>
</template>

<script>
import SubAccentCardFadeless from '../cards/SubAccentCardFadeless';


export default {
  name: 'SquareGrid',
  components: {
    SubAccentCardFadeless,
  },
  props:{
    items:{
      type:Array,
      default:() => ([])
    }
  }
};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';
  @import '~/assets/styles/sizes.scss';

  .cards-grid-square-row{
    display: flex;

    .sub-accent{
      flex-basis: 24%;
      margin-bottom: 50px;

      &:nth-child(4n+4) {
        margin-right: 0;
      }
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .cards-grid-square-row {
      flex-wrap: wrap;
      justify-content: space-around;

      .sub-accent {
        flex-basis: 24%;
        margin-right: 0;
        min-width: 160px;
      }

      margin-bottom: 50px;
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .cards-grid-square-row {
      flex-wrap: wrap;
      justify-content: space-around;

      .sub-accent {
        flex-basis: 24%;
        margin-right: 0;
        min-width: 304px;
      }

      margin-bottom: 0px;
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .cards-grid-square-row {
      flex-wrap: nowrap;
      justify-content: space-between;

      .sub-accent {
        flex-basis: 24%;
        margin-right: 13px;
        min-width: auto;
      }
    }
  }
</style>
