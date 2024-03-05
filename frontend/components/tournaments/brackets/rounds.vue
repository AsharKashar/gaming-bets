<template>
  <div class="round-wrapper">
    <div>
      <div v-if="round===1">
        <div
          v-for="(match,index) in matches"
          :key="index"
          class="couple-matches"
        >
          <div
            v-if="index %2 === 0"
            class="link-bar"
            :class="{'white-bar':match.winner_id==null}"
          />
          <match
            v-if="index %2 === 0"
            :match="match"
          />
          <match
            v-if="index %2 === 1 "
            :match="match"
          />
        </div>
      </div>
      <div v-if="round === 2">
        <div
          v-for="(match,index) in matches"
          :key="index"
          class="couple-matches"
        >
          <div
            v-if="index %2 === 0"
            class="link-bar onePool"
            :class="{'white-bar':match.winner_id==null}"
          />
          <match
            v-if="index %2 === 0"
            :match="match"
          />
          <match
            v-if="index %2 === 1 "
            :match="match"
          />
        </div>
      </div>
      <div v-if="round === 3">
        <div
          v-for="(match,index) in matches"
          :key="index"
          class="couple-matches"
        >
          <div
            v-if="index %2 === 0"
            class="link-bar secondPool"
            :class="{'white-bar':match.winner_id==null}"
          />
          <match
            v-if="index %2 === 0"
            :match="match"
          />
          <match
            v-if="index %2 === 1 "
            :match="match"
          />
        </div>
      </div>
      <div v-if="round === 4">
        <div
          v-for="(match,index) in matches"
          :key="index"
          class="couple-matches"
        >
          <match
            v-if="index %2 === 0"
            :match="match"
          />
          <match
            v-if="index %2 === 1 "
            :match="match"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Match from './match.vue';
export default {
  components: {
    Match,
  },
  props: {
    matches: {
      type: Array,
      default: () => ([])
    },
    round: {
      type: Number,
      default: null
    },
  },
  data() {
    return {};
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.round-wrapper {
  width: 100%;
  padding: 0 1em;
  display: flex;
  // align-items: center;

  .couple-matches {
    position: relative;
    .link-bar {
      width: 23px;
      border: 1px solid $text-secondary-color;
      background: transparent;
      border-radius: 0px;
      border-left: transparent;

      content: "";
      position: absolute;
      right: 0;
      top: 94px;
      bottom: -6em;

      &::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 50%;
        width: 34px;
        height: 1px;
        border: 1px solid $text-secondary-color;
      }
    }
    .onePool {
      bottom: -16em;
    }
    .secondPool {
      bottom: -36.2em;
    }
  }
  .second-pool {
    &::before {
      position: absolute;
      content: "";
      width: 30px;
      height: 1px;
      background: $text-secondary-color;
      top: 6em;
      left: -2em;
    }
    .match-wrapper {
      &:nth-child(3) {
        margin-top: 10.5em;
        &::before {
          position: absolute;
          content: "";
          width: 30px;
          height: 1px;
          background: $text-secondary-color;
          top: 6em;
          left: -2em;
        }
      }
    }
  }
  .third-pool {
    &::before {
      position: absolute;
      content: "";
      width: 30px;
      height: 1px;
      background: $text-secondary-color;
      top: 6em;
      left: -2em;
    }
    .match-wrapper {
      &:nth-child(3) {
        margin-top: 30em;
        &::before {
          position: absolute;
          content: "";
          width: 30px;
          height: 1px;
          background: $text-secondary-color;
          top: 6em;
          left: -2em;
        }
      }
    }
  }
  .fourth-pool {
    &::before {
      position: absolute;
      content: "";
      width: 30px;
      height: 1px;
      background: $text-secondary-color;
      top: 6em;
      left: -2em;
    }
  }
}
.round-wrapper > div {
  display: flex;
}
.round-wrapper > div,
.round-wrapper > div > div {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
}

@media screen and (max-width: $tablet-large-width) {
  .link-bar {
    display: none;
  }
  .second-pool {
    &::before {
      display: none;
    }
    .match-wrapper {
      &:nth-child(3) {
        margin-top: 0em !important;
        &::before {
          display: none;
        }
      }
    }
  }
  .third-pool {
    &::before {
      display: none;
    }
    .match-wrapper {
      &:nth-child(3) {
        margin-top: 0em !important;
        &::before {
          display: none;
        }
      }
    }
  }
  .fourth-pool {
    &::before {
      display: none;
    }
    .match-wrapper {
      &:nth-child(3) {
        margin-top: 0em !important;
        &::before {
          display: none;
        }
      }
    }
  }
}

.white-bar {
  border: 1px solid $text-hover-color !important;
  background: transparent;
  border-radius: 0px;
  border-left: transparent !important;

  &::before {
    content: "";
    position: absolute;
    left: 22px;
    top: 50%;
    width: 34px;
    height: 1px;
    border: 1px solid $text-hover-color !important;
  }
}
</style>
