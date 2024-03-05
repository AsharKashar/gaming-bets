<template>
  <div
    v-if="gameImage"
    class="participants__not-item"
  >
    <div
      class="participants__not-item-bg"
      :style="{background: `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), linear-gradient(180deg, #010432 0%, rgba(1, 4, 50, 0) 100%), url(${gameImage}) 50% / cover no-repeat`}"
    />
    <div
      class="heading"
      v-text="$t('Nobody Has Joined')"
    />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('tournament');

export default {
  name: 'NotParticipants',
  computed: mapState({
    gameImage: ({currentTournament}) =>  currentTournament.game.image,
  }),
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.participants__not-item {
  height: 465px;
  position: relative;
  &::before {
    content: '';
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    position: absolute;
    background: $app-background;
    z-index: -1;
  }
  &-bg {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    mix-blend-mode: luminosity;
  }
  .heading {
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    font-weight: 800;
    font-size: 56px;
    color: $text-primary-color;
  }
}
</style>
