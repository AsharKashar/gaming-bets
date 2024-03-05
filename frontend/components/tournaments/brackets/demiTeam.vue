<template>
  <div>
    <v-expansion-panel>
      <v-expansion-panel-header>
        <div class="team-info demi">
          <div class="team-img">
            <img
              src="~/static/images/brackets/watingwinner.svg"
              alt
              class="team-img wating-winner"
            >
          </div>
          <div class="team-name-match">
            <span>Waitng for winner</span>
          </div>

          <div
            class="team-points"
            :class="{'upper-team':borderTop}"
          >
            <p>0</p>
          </div>
        </div>
      </v-expansion-panel-header>
    </v-expansion-panel>
  </div>
</template>

<script>
export default {

  props: {
    borderTop: {
      type: Boolean,
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

@media screen and (max-width: 1120px) {
  .winner-icon {
    display: none;
  }
}
@media screen and (max-width: 1024px) {
  .winner-icon {
    display: inline-block;
  }
}
.wating-winner {
  margin: 0 0 0 2px;
  width: 80% !important;
}
.team-info {
  .team-name-match {
    font-size: 12px;
  }
}
.demi
{
  .team-points
  {
    border: 2px solid $text-hover-color !important;
    p{
      color: $text-hover-color !important;
    }
  }
}
</style>
