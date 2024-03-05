<template>
  <div
    class="match-team-item"
    :class="{'match-team-item--right': isRight}"
  >
    <div class="match-team-item__row">
      <div class="match-team-item__col  match-team-item__col--left">
        <v-avatar
          round
          size="40"
        >
          <img
            :src="avatarUrl"
            class="img-fluid"
            :alt="name"
          >
        </v-avatar>
      </div>
      <div class="match-team-item__col match-team-item__col--right">
        <div class="match-team-item__heading">
          <v-clamp
            autoresize
            :max-lines="1"
            class="match-team-item__name"
          >
            {{ name }}
          </v-clamp>
          <div
            v-if="isWon || isHost"
            class="match-team-item__icons"
          >
            <svg-icon
              v-if="isWon"
              name="crown"
            />
            <svg-icon
              v-if="isHost"
              name="home"
            />
          </div>
        </div>
        <div class="match-team-item__rank">
          <img
            v-for="i in 5"
            :key="i"
            src="~/static/images/brackets/golden-rank.svg"
            alt="rank icon"
            class="rank-icon"
            :class="{'rank-icon--active': rank >= i}"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SvgIcon from 'components/svgIcons/SvgIcon';
import VClamp from 'vue-clamp';

export default {
  name: 'MatchTeamItem',
  components: {SvgIcon, VClamp},
  props: {
    isRight: {
      type: Boolean,
      default: true,
    },
    avatarUrl: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    rank: {
      type: Number,
      required: true,
    },
    isWon: {
      type: Boolean,
      default: false,
    },
    isHost: {
      type: Boolean,
      default: false,
    }
  }
};
</script>

<style lang="scss" scoped>


.match-team-item {
  color: #A1AFD3;
  &__row {
     display: flex;
     margin: 0 -4px;
  }
  &__col {
    width: 100%;
    padding: 0 4px 5px;
    &--left {
      flex: 0 0 48px;
      max-width: 48px;
    }
  }
  &__name {
    padding-bottom: 4px;
    padding-right: 18px;
  }
  &__heading {
    display: flex;
    align-items: center;
  }
  &__icons svg {
    margin: 0 4px;
  }

  &__rank {
    display: flex;
    align-items: center;
    .rank-icon {
      padding: 0 3px;
      height: 14px;
      &:not(.rank-icon--active) {
        opacity: 0.5;
      }
    }
  }

  &--right {
    .match-team-item {
      &__row,
      &__heading,
      &__rank {
        flex-direction: row-reverse;
        text-align: right;
      }
      &__name {
        padding-right: 0;
        padding-left: 18px;
      }
    }
  }
}
</style>
