<template>
  <div
    class="tournament-detail"
    :class="{'tournament-detail--is-sidebar': $slots.sidebar}"
  >
    <div class="tournament-detail__col tournament-detail__content">
      <slot />
    </div>
    <div
      v-if="$slots.sidebar"
      class="tournament-detail__col tournament-detail__sidebar"
    >
      <slot
        name="sidebar"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'TournamentDetailWrap'
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.tournament-detail {
  display: flex;
  flex-wrap: wrap;
  margin: 10px -15px 120px;
  color: $text-primary-color;

  &::v-deep {
    .heading {
      margin-bottom: 30px;
      line-height: 1.3;
      font-weight: 900;
      font-size: 24px;
    }
  }

  &__col {
    width: 100%;
    padding: 0 15px;
  }
  &--is-sidebar {
    .tournament-detail {
      &__content {
        max-width: 65%;
        flex: 0 0 65%;
      }
      &__sidebar {
        max-width: 35%;
        flex: 0 0 35%;
      }
    }
  }
}

</style>
