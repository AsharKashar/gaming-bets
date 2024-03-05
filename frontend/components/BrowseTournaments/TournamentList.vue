<template>
  <div class="tournament-wrap">
    <div
      class="tournament__game-banner"
      :style="{background: `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), url(${gameImage})`}"
    />
    <cards-grid
      class="not-replace-clip"
      type="tournaments-grid"
      :items="tournaments"
    />
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid/CardsGrid';

export default {
  name: 'TournamentList',
  components: {
    CardsGrid,
  },
  props: {
    gameImage: {
      type: String,
      default: '',
    },
    tournaments: {
      type: Array,
      default: () => ([]),
    }
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.tournament {
  &__game {
    &-banner {
      background-blend-mode: normal, luminosity;
    }
  }
}
::v-deep {
  .tournament-info-heading {
    padding-left: 20px;
    position: relative;
    &::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      background: $text-secondary-color;
      clip-path: polygon(0 0, 100% 6%, 100% 94%, 0% 100%);
    }
  }
  @media all and (min-width: 1600px) {
    .tournaments-card__item {
      max-width: 33.33333%;
      flex: 0 0 33.33333%;
    }
  }
}

@media all and (max-width: $tablet-small-width) {
  .tournament-list {
    padding: 0 15px;
  }
  ::v-deep {
    .tournaments-grid {
      margin: 0;
      .tournaments-card {
        background-color: $secondary-background;
        &__item {
          padding: 0 0 15px;
        }
      }
    }
  }
}

</style>
