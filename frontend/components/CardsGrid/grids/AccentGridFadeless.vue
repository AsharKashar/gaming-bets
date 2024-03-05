<template>
  <div class="cards-grid-accent">
    <div
      v-if="items.length"
      class="accent-cards"
    >
      <accent-card-fadeless
        :key="items[0].id"
        :title="items[0].content_detail.name"
        class="main-accent"
        :slug="'/'+items[0].full_post_slug"
        :background-image="items[0].preview_image_url"
      />
      <accent-card-fadeless
        :key="items[1].id"
        :title="items[1].content_detail.name"
        :subtitle="items[1].content_detail.description"
        class="secondary-accent"
        :slug="'/'+items[1].full_post_slug"
        :background-image="items[1].preview_image_url"
      />
    </div>

    <div class="secondary-cards">
      <sub-accent-card-fadeless
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
import AccentCardFadeless from '../cards/AccentCardFadeless';
import SubAccentCardFadeless from '../cards/SubAccentCardFadeless';

export default {
  name: 'AccentGrid',
  components: {
    AccentCardFadeless,
    SubAccentCardFadeless
  },
  props: {
    items: {
      type: Array,
      default: () => []
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.accent-cards {
  display: flex;
  justify-content: flex-start;

  .secondary-accent {
    .accent-card-btn {
      display: none;
    }
  }
}

.secondary-cards {
  display: flex;
  justify-content: space-between;
}

@media only screen and (min-width: $min-resolution){
  .accent-cards {
    flex-wrap: wrap;
    margin-bottom: 21px;

    .main-accent,
    .secondary-accent{
      width: 100%;
      border-color: $app-background;

      &:hover{
        mix-blend-mode: inherit;
        border-color: $border-primary-color;

        .accent-card-btn {
          display: block;
          color: white;
          box-shadow: none;
        }
      }
    }
  }

  .accent-cards {
    margin-bottom: 0;

    .main-accent,
    .secondary-accent{
      padding: 23px 23px 42px;
      margin-bottom: 23px;
    }
  }

  .secondary-cards{
    flex-wrap: wrap;

    .sub-accent{
      flex-basis: 46.5%;
      margin-bottom: 35px;
    }
  }
}

@media only screen and (min-width: $tablet-small-width){
  .accent-cards {
    .main-accent,
    .secondary-accent{
      padding: 23px 23px 42px;
      margin-bottom: 15px;
    }
  }

  .secondary-cards{
    .sub-accent{
      flex-basis: 48.5%;
      margin-bottom: 41px;
    }
  }
}

@media only screen and (min-width: $tablet-large-width){
  .accent-cards {
    margin-bottom: 50px;
    flex-wrap: nowrap;

    .main-accent,
    .secondary-accent{
      padding: 0;
      margin-bottom: 0;
    }

    .main-accent {
      flex-basis: 70%;
      margin-right: 17px;
    }

    .secondary-accent {
      display: flex;
      flex-basis: 34%;

      .titles-block {
        padding: 28px 10px;
      }
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

      .titles-block {
        padding: 28px 70px 38px 10px;
      }
    }
  }

  .secondary-cards {
    .sub-accent {
      flex-basis: 23%;
      margin-bottom: 32px;
    }
  }
}

</style>
