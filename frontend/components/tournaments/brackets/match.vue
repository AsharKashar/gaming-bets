<template>
  <div class="match-wrapper">
    <div class="match">
      <div class="header">
        <p class="header__no">
          {{ match.title }}
        </p>
        <p class="header__date">
          {{ match.start_at_formatted }}
        </p>
      </div>
      <team-panel :match="match" />
    </div>
  </div>
</template>

<script>
import TeamPanel from './teamPanel.vue';

export default {
  components: {
    TeamPanel,
  },
  props: {
    match: {
      type: Object,
      default: () => ({})
    },
  },
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.match-wrapper {
  width: 100%;
  position: relative;
  .match {
    width: 100%;
    padding: 1em 1em 1em 0em;
    .header {
      width: 100%;
      display: flex;
      justify-content: space-between;
      p {
        font-size: 12px;
        line-height: 110%;
      }
    }

    &__team {
      width: 100%;
    }

    .upper_team {
      border-bottom-right-radius: 0px;
      border-top-right-radius: 8px;
    }
  }
}
</style>
