<template>
  <div class="cards-grid-accent">
    <div
      v-if="items.length"
      class="accent-cards"
    >
      <accent-card
        :key="items[0].id"
        :title="items[0].content_detail.name"
        class="main-accent"
        :slug="'/'+items[0].full_post_slug"
        :background-image="items[0].preview_image_url"
      />
      <accent-card
        :key="items[1].id"
        :title="items[1].content_detail.name"
        class="secondary-accent"
        :slug="'/'+items[1].full_post_slug"
        :background-image="items[1].preview_image_url"
      />
    </div>

    <div
      v-if="items.length"
      class="secondary-cards"
    >
      <sub-accent-card
        :key="'mobile-'+items[1].id"
        :title="items[1].content_detail.name"
        :subtitle="items[1].content_detail.description"
        :slug="'/'+items[1].full_post_slug"
        :background-image="items[1].preview_image_url"
        class="mobile-secondary-accent"
      />
      <sub-accent-card
        v-for="item in items.slice(2)"
        :key="item.id"
        :title="item.content_detail.name"
        :subtitle="item.content_detail.description"
        :slug="'/'+item.full_post_slug"
        :background-image="item.preview_image_url"
      />
    </div>
  </div>
</template>

<script>
import AccentCard from '../cards/AccentCard';
import SubAccentCard from '../cards/SubAccentCard';

export default {
  name: 'AccentGrid',
  components: {
    AccentCard,
    SubAccentCard
  },
  props: {
    items: {
      type: Array,
      default: () => []
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.accent-cards {
  display: flex;
  justify-content: flex-start;
  cursor: pointer;

  &::v-deep .secondary-accent {
    mix-blend-mode: luminosity;

    .accent-card-btn {
      display: none;
    }
    border-color: $app-background;

    &:hover{
      mix-blend-mode: inherit;
      border-color: $border-primary-color;

      .accent-card-btn {
        display: block;
        // box-shadow: none;

        &:hover{
          color: white;
        }
      }
    }
  }

  &::v-deep .main-accent {
    .accent-card-btn {
      display: none;
    }
    border-color: $app-background;

    &:hover {
      border-color: $border-primary-color;

      .accent-card-btn {
        display: block;
        // box-shadow: none;

        &:hover{
          color: white;
        }
      }
    }
  }
}

.secondary-cards {
  display: flex;
  justify-content: space-between;

  &::v-deep .sub-accent{
    cursor: pointer;
    user-select: none;

    .accent-card{
      border: 2px solid $app-background;
    }

    &:hover{
      .accent-card{
        border-color: $border-primary-color;
        mix-blend-mode: inherit!important;
      }
    }
  }
}

@media only screen and (min-width: $min-resolution){
  .accent-cards {
    flex-wrap: wrap;
    margin-bottom: 21px;

    .main-accent,
    .secondary-accent{
      padding: 23px 23px 42px;
      margin-bottom: 23px;
    }

    .main-accent{
      width: 100%;
    }

    .secondary-accent{
      display: none;
    }
  }

  .secondary-cards{
    flex-wrap: wrap;

    .mobile-secondary-accent{
      display: block;
    }
    .sub-accent:nth-child(n+5){
      display: none;
    }
    .sub-accent{
      flex-basis: 100%;
      margin-bottom: 41px;
    }
  }
}

@media only screen and (min-width: $tablet-small-width){
  .accent-cards {
    margin-bottom: 32px;
  }

  .secondary-cards{
    flex-wrap: wrap;

    .sub-accent{
      flex-basis: 48.5%;
      margin-bottom: 41px;
    }
  }
}

@media only screen and (min-width: $tablet-large-width){
  .accent-cards {
    margin-bottom: 24px;
    flex-wrap: nowrap;

    .main-accent,
    .secondary-accent{
      padding: 0;
    }

    .main-accent {
      flex-basis: 70%;
      margin-right: 17px;
    }

    .secondary-accent {
      display: flex;
      flex-basis: 34%;
      margin-bottom: 0;
    }
  }

  .secondary-cards {
    flex-wrap: nowrap;

    .sub-accent {
      flex-basis: 24%;
    }

    .mobile-secondary-accent {
      display: none;
    }

    .sub-accent:nth-child(n+5){
      display: block;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .accent-cards {
    margin-bottom: 40px;

    .main-accent {
      flex-basis: 70%;
      margin-right: 30px;
    }

    .secondary-accent {
      flex-basis: 34%;
    }
  }

  .secondary-cards {
    .sub-accent {
      flex-basis: 23%;
    }
  }
}

</style>
