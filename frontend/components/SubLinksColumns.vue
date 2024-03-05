<template>
  <div class="links-container">
    <router-link
      v-for="(link, index) in links"
      :key="index"
      :to="link.to"
      class="link-item"
      :class="{'active font-red': $route.path === link.to }"
    >
      {{ link.title }}
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'SubLinksColumns',
  props: {
    links: {
      type: Array,
      default: () => [],
    },
    colorsClass: {
      type: String,
      default: 'font-red',
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.links-container {
  display: flex;
  max-width: 430px;
  margin-top: 4rem;

  .link-item {
    flex-basis: 50%;
    text-decoration: none;
    font-style: normal;
    text-transform: uppercase;
    font-family: Telegraf-UltraBold, serif;

    &:focus {
      outline: none;
    }

    &.font-red {
      color: #be1338;
      &:hover {
        color: #bf1438;
      }
    }

    &.font-gray {
      color: #a1afd3;
      &:hover {
        color: #be1338;
      }
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .links-container {
    padding: 0 5% 0 2%;
    overflow: auto;
    .link-item {
      display: flex;
      justify-content: center;
      align-items: center;
      line-height: 94%;
      padding: 0 10px;
      text-align: center;
      position: relative;
      font-size: 12px;
      max-width: 143px;
      height: 47px;
    }
  }

  .link-item:hover,
  .active {
    background-color: rgba(190, 19, 56, 0.1);
    &:before {
      content: "";
      height: 2px;
      width: 100%;
      background: $border-primary-color;
      position: absolute;
      top: 0;
      clip-path: polygon(0 0, 100% 0, 94% 100%, 6% 100%);
    }
    &:after {
      content: "";
      height: 2px;
      width: 100%;
      background: $border-primary-color;
      position: absolute;
      bottom: 0;
      clip-path: polygon(6% 0, 94% 0%, 100% 100%, 0% 100%);
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .links-container {
    .link-item {
      font-size: 12px;
      height: 64px;
    }

    .link-item:hover,
    .active {
      &:before {
        height: 5px;
      }
      &:after {
        height: 5px;
      }
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
    .links-container {
    padding: 0;
    .link-item {
      display: flex;
      justify-content: flex-start;
      align-items: left;
      max-width: 100%;
      padding: 15px 0 10px 13px;
      font-weight: 900;
      font-size: 16px;
      line-height: 100%;
      border-radius: 5px;
      height: auto;
      text-align: left;
      position: relative;
      margin: 7px 0;
    }
  }

  .link-item:hover,
  .active {
    background-color: rgba(190, 19, 56, 0.1);
    border-left: 3px solid #be1338;
    border-right: 3px solid #be1338;
    border-top: none;
    border-bottom: none;

    &:before,
    &:after {
      display: none;
    }
  }
}

@media only screen and (max-width: $tablet-large-width) {
  .links-container {
    margin-top: 0;
  }
}
</style>
