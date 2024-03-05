<template>
  <div class="card-header">
    <img
      src="~/static/images/brackets/popups/game-logo.svg"
      alt=""
      class="game-logo"
    >
    <img
      src="~/static/images/brackets/popups/platfom-icon.svg"
      alt=""
      class="game-platform"
    >

    <p class="game-type">
      Box fights
    </p>
  </div>
</template>

<script>
export default {
  name: 'ChallengesHeader'
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.card-header {
  padding-top: 0em;
  width: 100%;
  .game-platform {
    margin-left: 1em;
  }
  .game-type {
    padding-top: 0.5em;
    font-weight: 800;
    font-size: 20px;
    line-height: 110%;
    color: $text-hover-color;
  }
}
</style>
