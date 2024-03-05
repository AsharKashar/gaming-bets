<template>
  <div class="tournament-details">
    <div class="tournament-details__row">
      <div
        v-for="item in details"
        :key="item.title"
        class="tournament-details__item"
      >
        <div class="tournament-details__item-inner">
          <div
            class="tournament-details__item-title"
            v-text="item.title"
          />
          <div
            class="tournament-details__item-description"
            v-text="item.description"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BoxfightDetails',
  props: {
    details: {
      type: Array,
      required: true,
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/colors.scss";
  .tournament-details {
    margin-bottom: 48px;
    color: $text-primary-color;
    &__row {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -15px;
    }
    &__item {
      flex: 0 0 25%;
      max-width: 25%;
      padding: 0 15px;
      width: 100%;
      &-title {
        font-size: 20px;
        line-height: 1.2;
        margin-bottom: 8px;
      }
      &-description {
        font-weight: 800;
        font-size: 24px;
        line-height: 1.1;
      }
    }
  }
</style>
