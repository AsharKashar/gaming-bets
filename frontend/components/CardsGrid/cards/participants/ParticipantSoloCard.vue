<template>
  <div class="member__item">
    <div class="member__inner">
      <div class="member__content">
        <div class="member__avatar">
          <v-avatar
            height="58"
            width="58"
            class="profile-picture"
          >
            <img
              :src="avatarUrl"
              :alt="name"
            >
          </v-avatar>
        </div>
        <div class="member__info">
          <div
            class="member__nickname"
            v-text="nickname"
          />
          <div
            class="member__name"
            v-text="name"
          />
        </div>
        <div class="member__rank">
          <img
            src="~/static/images/brackets/golden-rank.svg"
            alt="rank icon"
            class="rank-icon"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ParticipantSoloCard',
  props: {
    nickname: {
      type: String,
      required: true,
    },
    avatarUrl: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      required: true,
    },
    rank: {
      type: String,
      default: '',
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .member {
    &__item {
      width: 100%;
      max-width: 25%;
      flex: 0 0 25%;
      padding: 12px 15px;
    }
    &__inner {
      padding: 2px;
      background: $border-secondary-color;
      clip-path: polygon(5% 0, 100% 0, 100% 84%, 94% 100%, 0 100%, 0 15%);
      &:hover {
        background: $border-primary-color;
      }
    }
    &__content {
      clip-path: polygon(5% 0, 100% 0, 100% 84%, 94% 100%, 0 100%, 0 15%);
      background: $app-background;
      display: flex;
      flex-wrap: wrap;
      padding: 15px 16px 21px;
      & > div {
        width: 100%;
      }
    }
    &__avatar {
      max-width: 68px;
      flex: 0 0 68px;
      padding-right: 10px;
    }
    &__rank {
      max-width: 40px;
      flex: 0 0 40px;
      padding-left: 7px;
      img {
        width: 100%;
      }
    }
    &__info {
      max-width: calc(100% - 108px);
      flex: 0 0 calc(100% - 108px);
      align-self: center;
    }
    &__nickname {
      font-weight: 800;
      color: $text-hover-color;
      line-height: 1;
      padding-bottom: 5px;
      text-transform: uppercase;
    }
    &__name {
      line-height: 1.4;
      text-transform: capitalize;
      color: $text-primary-color;
    }
  }
</style>
