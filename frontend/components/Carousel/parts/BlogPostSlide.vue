<template>
  <v-carousel-item
    class="blog-slide"
    :style="{ backgroundImage: `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), url(${slide.preview_image_url})` }"
  >
    <div class="blog-content">
      <div
        class="slide-title"
      >
        {{ slide.content_detail.name }}
      </div>
      <div class="slide-subtitle">
        <div class="read-time">
          {{ $t('read time 5 min') }}
        </div>
        <div class="read-more">
          <default-button
            type="button"
            :on-click="redirectToPost"
          >
            {{ $t('read more') }}
          </default-button>
        </div>
      </div>
    </div>
  </v-carousel-item>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';

export default {
  name: 'BlogPostSlide',
  components: {
    DefaultButton
  },
  props:{
    slide:{
      type: Object,
      default: () => ({})
    }
  },
  methods:{
    redirectToPost () {
      this.$router.push('/'+this.slide.full_post_slug);
    }
  }
};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';
  @import '~/assets/styles/sizes.scss';

  .blog-slide{
    background-blend-mode: normal, luminosity;
    mix-blend-mode: normal;
    border-radius: 16px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    user-select: none;
    cursor: pointer;

    .blog-content{
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      height: 100%;
      width: 100%;

      .slide-title{
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        color: #E7E7E7;
        cursor: pointer;
        text-decoration: none;
      }
      .slide-subtitle{
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 16px;
        line-height: 94%;
        color: #A1AFD3;
        cursor: pointer;
        text-decoration: none;
      }
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .blog-slide{
      .blog-content{
        padding: 0 15px 64px;

        .slide-title{
          font-size: 20px;
          line-height: 99%;
          letter-spacing: 0;
          text-align: center;
        }

        .read-time{
          display: none;
        }

        .read-more{
          display: block;
          .default-banger-btn{
            padding: 15px 31px;
            // text-transform: lowercase;
            margin-top: 20px;
          }
        }

        .slide-subtitle{
          display: flex;
          justify-content: center;
        }
      }
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .blog-slide{
      .blog-content{
        padding: 0 32px 64px;

        .slide-title{
          font-size: 24px;
          line-height: 99%;
          letter-spacing: 0;
          text-align: left;
        }

        .slide-subtitle{
          display: block;
        }

        .read-time{
          display: none;
        }

        .read-more{
          display: block;
          .default-banger-btn{
            padding: 15px 31px;
            // text-transform: lowercase;
            margin-top: 20px;
          }
        }
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .blog-slide{
      .blog-content{
        padding: 0 39px 74px;

        .slide-title{
          font-size: 24px;
          line-height: 99%;
          letter-spacing: 0;
          padding: 0 207px 0 0;
        }

        .read-time{
          display: block;
        }

        .read-more{
          display: block;
        }
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .blog-slide{
      .blog-content{
        .slide-title{
          font-size: 32px;
          line-height: 120%;
          letter-spacing: 0.05em;
          padding: 0 150px 9px 0;
        }
      }
    }
  }

</style>
