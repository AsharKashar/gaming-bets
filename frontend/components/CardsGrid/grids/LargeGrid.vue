<template>
  <div>
    <div
      class="cards-grid cards-grid-large"
    >
      <large-card />
      <large-card
        v-for="item in items"
        :key="item.id"
        :title="item.name"
        :background-image="item.preview_image_url"
        :slug="item.slug"
      />
    </div>
  </div>
</template>

<script>
import LargeCard from '../cards/LargeCard';


export default {
  name: 'LargeGrid',
  components: {
    LargeCard,
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
  @import '~/assets/styles/sizes';

  .cards-grid-large{
    display: flex;
    flex-wrap: wrap;
  }

  .grid-card {
    &:first-child {
      display: none;
    }
    &:nth-child(2){
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .grid-card{
      &:nth-child(2){
        align-items: baseline;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .grid-card{
      margin: 0 11px 28px;

      &:nth-child(2){
        flex-basis: 65.5%;
        margin-left: 0;
        display: flex;
        justify-content: flex-end;
        flex-direction: column;
        text-align: left;

        &::v-deep .category-title {
          font-size: 24px;
        }
      }
      &:nth-child(3n+3) {
        margin-right: 0;
      }
      &:nth-child(4){
        margin-right: 13px;
        margin-left: 0;
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .grid-card{
      margin: 0 13px 28px;

      &:nth-child(2){
        flex-basis: 65.5%;
        margin-left: 0;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        text-align: left;

        &::v-deep .category-title {
          font-size: 56px;
          text-align: center;
        }
      }
      &:nth-child(3n+3) {
        margin-right: 0;
      }
      &:nth-child(4){
        margin-right: 13px;
        margin-left: 0;
      }
    }
  }
</style>
