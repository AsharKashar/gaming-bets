<template>
  <div class="home-title-content">
    <div class="paragraph" />
    <div class="col-left">
      <div class="home-title-wrap">
        <div class="home-title">
          {{ title }}
        </div>
        <div class="home-subtitle">
          {{ subtitle }}
        </div>
      </div>
    </div>
    <div class="col-right">
      <div
        v-if="description"
        class="col home-title-description"
      >
        <template
          v-if="!clampDes"
        >
          {{ description }}
        </template>
        <v-clamp
          v-else
          autoresize
        >
          {{ description }}
        </v-clamp>
      </div>
      <div
        v-if="rightIcon"
        v-ripple="{ center: true }"
        class="icon"
        @click="$emit('handleClick')"
      >
        <search v-if="rightIcon==='search'" />
      </div>
    </div>
  </div>
</template>

<script>
import Search from 'components/svgIcons/Search';
import VClamp from 'vue-clamp';

export default {
  name: 'HomeTitle',
  components: {
    Search,
    VClamp
  },
  props: {
    title: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    clampDes: {
      type: Boolean,
      default: false
    },
    rightIcon: {
      type: String,
      default: ''
    },
    rightIconColor: {
      type: String,
      default: '#BE1338'
    },
    subtitle: {
      type: String,
      default: ''
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.home-title-content {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  color: $text-primary-color;
  font-weight: 800;
  padding: 0 16px 0 22px;

  .paragraph {
    height: 100%;
    width: 6px;
    clip-path: polygon(0 0, 100% 7%, 100% 93%, 0% 100%);
    background: $border-primary-color;
    position: absolute;
    left: 16px;
    top: 0;
    bottom: 0;
  }

  .home-title-wrap {
    flex-wrap: wrap;
    justify-content: center;
    flex-direction: column;
    padding: 8px;
  }

  .home-title {
    font-weight: 800;
    line-height: 1.1;
    display: flex;
    align-items: center;

    font-size: 25px;
  }

  .home-title-description {
    font-style: normal;
    font-weight: 800;
    line-height: 94%;
    display: flex;
    align-items: center;
    font-size: 16px;
    padding: 8px;
  }

  .col-left {
    align-items: center;
  }

  .col-left,
  .col-right {
    flex-basis: 100%;
    display: flex;
    padding: 0;
  }

  .icon {
    margin-left: auto;
    cursor: pointer;
    svg {
      width: 20px;
      height: 20px;
    }
  }
}

@media only screen and (min-width: $mobile) {
  .home-title-content {

    .home-title-description {
      font-size: 20px;
      padding: 14px;
    }

    .col-right {
      align-items: center;
    }

    .icon {
      padding: 26px;
      svg {
        width: 30px;
        height: 30px;
      }
    }
  }
}
@media only screen and (min-width: $tablet-small-width) {
  .home-title-content {
    padding: 0 0 0 22px;

    .paragraph {
      left: 0;
    }

    .home-title {
      font-size: 36px;
    }
  }
}
@media only screen and (min-width: $tablet-large-width) {
  .home-title-content {
    padding: 0 0 0 24px;
    .paragraph {
      width: 8px;
      clip-path: polygon(0 0, 100% 12%, 100% 88%, 0% 100%);
    }

    .col-right {
      flex-basis: 40%;
    }

    .col-left {
      flex-basis: 60%;
    }

    .home-title-wrap {
      padding-left: 32px;
    }

  }
}

@media only screen and (min-width: $desktop-width) {
  .home-title {
    align-items: flex-start;
    font-size: 56px;
  }
}
</style>
