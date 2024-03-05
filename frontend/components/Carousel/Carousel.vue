<template>
  <div class="carousel">
    <v-carousel
      :height="carouselHeight"
      hide-delimiter-background
      hide-delimiters
      :show-arrows="false"
      :value="slideIndex"
      @change="onChange"
    >
      <slot />
    </v-carousel>
    <div class="custom-arrows">
      <div
        class="next-arrow"
        @click="prevSlide"
      >
        <arrow icon-fill="#fff" />
      </div>
      <div
        class="prev-arrow"
        @click="nextSlide"
      >
        <arrow icon-fill="#fff" />
      </div>
    </div>
    <div class="slide-controls">
      <div class="slide-dots">
        <div
          v-for="(dot,i) in slidesCount"
          :key="i"
          class="dot"
          :class="{'active-dot':i===slideIndex}"
        >
          <div class="subdot" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Arrow from 'components/svgIcons/Arrow';

export default {
  name: 'Carousel',
  components: {
    Arrow
  },
  props: {
    slidesCount: {
      type: Number,
      default: 0
    }
  },
  data: () => ({
    slideIndex: 0,
    carouselHeight:540
  }),
  mounted() {
    window.addEventListener('resize', this.getWindowWidth);
    this.getWindowWidth();

  },
  beforeDestroy() {
    window.removeEventListener('resize', this.getWindowWidth);
  },
  methods: {
    onChange(index){
      this.slideIndex = index;
    },
    nextSlide(){
      let nextIndex = this.slideIndex + 1;

      if (nextIndex > this.slidesCount) {
        nextIndex = 0;
      }

      this.slideIndex = nextIndex;
    },
    prevSlide(){
      let prevIndex = this.slideIndex - 1;

      if (prevIndex < 0) {
        prevIndex = this.slidesCount-1;
      }

      this.slideIndex = prevIndex;
    },
    getWindowWidth() {
      const width = document.documentElement.clientWidth;

      if (width > 1024) {
        return this.carouselHeight = 540;
      }

      if (width > 768) {
        return this.carouselHeight = 428;
      }

      if (width > 375) {
        return this.carouselHeight = 434;
      }

      return this.carouselHeight = 504;
    },
  }
};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';
  @import '~/assets/styles/sizes.scss';

  .carousel{
    border: 2px solid $app-background;
    position: relative;

    .custom-arrows{
      position: absolute;
      top: calc(50% - 45px);
      display: flex;
      justify-content: space-between;
      width: 100%;
      cursor: pointer;
      height: 0;

      .next-arrow,
      .prev-arrow{
        background: $border-primary-color ;
        height: 78px;
        width: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 9px 0 0 9px;
        position: relative;

        &:before,
        &:after {
          content: "";
          height: 13px;
          width: 23px;
          right: 0;
          background: $border-primary-color;
          position: absolute;
        }

        &:before{
          content: "";
          top: -12px;
          clip-path: polygon(100% 0, 0% 100%, 100% 100%);
        }

        &:after{
          content: "";
          bottom: -12px;
          clip-path: polygon(100% 100%, 0% 0%, 100% 0%);
        }
      }

      .next-arrow{
        transform: matrix(-1, 0, 0, 1, 0, 0);
      }
    }

    .slide-controls {
      display: flex;
      justify-content: center;
      position: absolute;
      bottom: 0;
      width: 100%;
      align-items: center;

      .slide-dots {
        display: flex;
        justify-content: center;
        height: 40px;
        background: $app-background;
        align-items: center;
        padding: 0 25px;
        position: relative;
        border-radius: 12px 12px 0 0;

        &:after,
        &:before{
          content: "";
          clip-path: polygon(100% 0, 0% 100%, 100% 100%);
          background: $app-background;
          position: absolute;
          height: 40px;
          top: 0;
          height: 40px;
          width: 24px;
          border-radius: 50px 50px 0 0;
        }

        &:before{
          right: -19px;
          transform: matrix(-1, 0, 0, 1, 0, 0);
        }

        &:after{
          left: -19px;
        }

        .dot {
          height: 4px;
          width: 30px;
          margin: 0px 9px;
          border-radius: 50px;
          background: rgba(231, 231, 231, 0.2);

          .subdot{
            height: 4px;
            width: 24px;
            border-radius: 50px;
          }

          &.active-dot{
            background: rgba(190, 19, 56, 0.5);

            .subdot{
              background: $border-primary-color;
            }
          }
        }
      }
    }
  }

</style>
