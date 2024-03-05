<template>
  <div
    class="team"
  >
    <div class="team__border">
      <div class="team__inner">
        <div class="team-avatar">
          <v-avatar
            round
            size="30"
          >
            <img
              :src="avatarUrl"
              class="img-fluid"
              :alt="name"
            >
          </v-avatar>
        </div>
        <div class="team-info">
          <v-clamp
            autoresize
            :max-lines="1"
            class="team-name"
          >
            {{ name }}
          </v-clamp>
        </div>
        <div class="team-rank">
          <img
            src="~/static/images/badges-rank-silver.png"
            alt="rank icon"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VClamp from 'vue-clamp';

export default {
  name: 'EvidenceTeamCard',
  components: {
    VClamp,
  },
  props: {
    avatarUrl: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    rank: {
      type: String,
      default: null,
    },
  }
};
</script>

<style lang="scss" scoped>

@import "~/assets/styles/colors";
.team {
  padding: 5px;
  width: 187px;
  &__inner {
    display: flex;
    align-items: center;
    padding: 14px 10px;
    clip-path: polygon(10% 1%, 100% 0, 100% 71%, 90% 100%, 0 100%, 0 30%);
    background: $app-background;
  }
  &__border {
    clip-path: polygon(10% 1%, 100% 0, 100% 71%, 90% 100%, 0 100%, 0 30%);
    padding: 2px;
    background: $text-primary-color;
  }
  &-name {
    font-size: 14px;
    font-weight: 900;
  }
  &-avatar {
    margin-right: 10px;
  }
  &-info {
    max-width: 82px;
    margin-right: 5px;
  }
  &-rank {
    img {
      max-width: 23px;
    }
  }
}
</style>
