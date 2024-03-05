<template>
  <div
    class="banger-container"
    :class="animate && 'active'"
  >
    <transition name="slide">
      <img
        v-if="animate && initial"
        :src="gifPath()"
        class="banger-image"
        alt="banger-games"
      >
    </transition>

    <div
      v-ripple="{ center: true }"
      class="banger-controls"
      link
      @click="toggleAnimation"
    >
      <v-avatar
        v-if="animate"
        title
      >
        <img
          src="~/static/icons/banger-close.svg"
          class="question-mark"
          alt
        >
      </v-avatar>
      <v-avatar v-else>
        <img
          src="~/static/icons/banger-question-mark.svg"
          class="close"
          alt
        >
      </v-avatar>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    time: {
      type: Number,
      default: 0,
    },
    path: {
      type: String,
      default: '',
    },
    initial: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      animate: true,
      timmer: null,
    };
  },
  computed: {},
  mounted() {
    this.hideAnimation();
  },
  methods: {
    toggleAnimation() {
      this.animate = !this.animate;
      if (this.animate) {
        this.hideAnimation();
      } else {
        clearTimeout(this.timmer);
      }
    },
    hideAnimation() {
      this.timmer = setTimeout(() => {
        this.animate = false;
      }, this.time);
    },
    gifPath() {
      switch (this.path) {
        case 'comming-soon':
          return require('~/static/banger/comming-soon.gif') + '?' + Date.now();
        case 'banger-officials':
          return (
            require('~/static/banger/banger-officials.gif') + '?' + Date.now()
          );
        case 'blog-page':
          return require('~/static/banger/blog-page.gif') + '?' + Date.now();
        case 'checking-guide':
          return (
            require('~/static/banger/Checking-guide.gif') + '?' + Date.now()
          );
        default:
        // code block
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
.banger-container {
  position: fixed;
  right: 0;
  transition: background 0.3s ease-in;
  width: 100%;
  height: 32vh;
  bottom: 0;
  text-align: right;
  pointer-events: none;

  background-image: linear-gradient(
    328deg,
    transparent 0%,
    #040735 5%,
    rgba(4, 7, 53, 0) 70%
  );
  transition: all 0.4s;
  background-size: 250%;
  &.active {
    background-position: 100%;
  }

  .banger-image {
    max-width: 100%;
    height: auto;
  }
  .banger-controls {
    position: absolute;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
    pointer-events: all;
  }
}
// banger animation
.slide {
  &-enter-active {
    animation: slide-in 0.3s linear;
  }
  &-leave-active {
    animation: slide-in 0.3s reverse;
  }
}

@keyframes slide-in {
  0% {
    transform: translateX(100%);
  }

  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@media all and (max-width: 500px) {
  .banger-container {
    bottom: 72px;
    .banger-image {
      height: 25vh;
    }
  }
}
</style>
