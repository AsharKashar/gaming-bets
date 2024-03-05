<template>
  <div class="team-card">
    <div class="team-card__inner">
      <div class="team-card__img">
        <div class="team-card__img-inner">
          <img :src="imgSrc">
        </div>
      </div>
      <div
        class="team-card__heading"
        v-text="title"
      />
    </div>
  </div>
</template>

<script>

export default {
  name: 'TournamentTeamCard',
  props: {
    imgSrc: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/colors.scss";
  .team-card {
    width: 100%;
    max-width: 50%;
    flex: 0 0 50%;
    padding: 7px 10px;
    &__img {
      width: 100%;
      height: 96px;
      background: $text-primary-color;
      margin-bottom: 10px;
      padding: 2px;
      clip-path: polygon(6% 0, 100% 0, 100% 86%, 94% 100%, 0 100%, 0 16%);
      &-inner {
        background: #000;
        width: 100%;
        height: 100%;
        clip-path: polygon(6% 0, 100% 0, 100% 86%, 94% 100%, 0 100%, 0 16%);
        padding: 10px;
        text-align: center;
        cursor: pointer;
        img {
          max-width: 100%;
          max-height: 100%;
        }
      }
    }
    &.active &__img {
      background: $border-primary-color;
    }
    &__heading {
      font-weight: 900;
      line-height: 1.2;
    }
  }
</style>
