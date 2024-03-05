<template>
  <div
    class="about-section"
    :style="`padding-top: ${videoHeight}px`"
  >
    <div
      ref="video"
      class="video__wrap"
    >
      <video
        controls
        class="video__content"
      >
        <source
          src="/media/examples/flower.webm"
          type="video/webm"
        >
        <source
          src="/media/examples/flower.mp4"
          type="video/mp4"
        >
        {{ $t('Sorry, your browser doesnt support embedded videos.') }}
      </video>
    </div>
    <div class="text-after-video">
      <v-row>
        <v-col md="3">
          <div class="static-page-title text-center">
            {{ $t('About Us') }}
          </div>
        </v-col>
        <v-col
          md="4"
          class="detail-text"
        >
          <span>{{ $t('Incididunt deserunt ut cillum nisi id elit. Laborum esse anim officia deserunt magna aliquip fugiat esse Lorem velit magna. Labore aliquip') }}</span>
        </v-col>
        <v-col
          md="4"
          class="detail-text"
        >
          <span>{{ $t('Incididunt deserunt ut cillum nisi id elit. Laborum esse anim officia deserunt magna aliquip fugiat esse Lorem velit magna. Labore aliquip') }}</span>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'About',
  data: () => ({
    videoHeight: 0,
    header: null,
  }),
  created() {
    this.$router.push('/');
  },
  mounted() {
    this.header = document.querySelector('.header-container');
    this.setHeightVideo();
    window.addEventListener('resize', this.setHeightVideo);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.setHeightVideo);
  },
  methods: {
    setHeightVideo() {
      let height = this.$refs.video.clientHeight;
      if (this.header) {
        height = height - this.header.clientHeight;
      }
      this.videoHeight = height;
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'About',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.about-section {
  max-width: 1010px;
  margin: 0 auto;
}

.video {
  &__wrap {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    min-height: 500px;
    max-height: 900px;
    height: 100vh;
  }
  &__content {
    width: 100%;
    height: 100%;
  }
}

.static-page-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  text-align: start;
  font-weight: 900;
  color: $text-primary-color;
  font-size: 32px;
  line-height: 120%;
}

.text-after-video {
  color: $text-primary-color;
  padding: 40px 0 59px;

  .detail-text {
    font-size: 24px;
    line-height: 120%;
  }
  @media only screen and (min-width: $tablet-small-width) {
    padding: 20px 0 30px;
  }
}
</style>
