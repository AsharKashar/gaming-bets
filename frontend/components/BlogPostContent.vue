<template>
  <div class="blog-post">
    <div class="title-block">
      <h1 class="heading-primary">
        {{ postItem.content_detail.name }}
      </h1>
      <div class="post-description">
        {{ postItem.content_detail.description }}
      </div>
      <div class="separator" />
      <p class="post-updated">
        {{ updatedAt }} PDT
      </p>
    </div>
    <div class="post-body-wrapper">
      <div
        v-if="postItem.preview_image_url"
        class="preview-img"
        :style="{
          'background-image': `url(${postItem.preview_image_url})`
        }"
      />
      <div
        ref="postContent"
        class="post-body"
      />
      <subscribe-card class="subscribe-card" />
      <div class="social-share">
        <ShareNetwork
          network="facebook"
          :url="pageUrl"
          :title="postItem.content_detail.name"
          :description="postItem.content_detail.description"
          hashtags="bangergames"
          class="share-button"
        >
          <img
            src="~/static/icons/facebook-ico.svg"
            alt="facebook"
          >
        </ShareNetwork>
        <ShareNetwork
          network="twitter"
          :url="pageUrl"
          :title="postItem.content_detail.name"
          :description="postItem.content_detail.description"
          hashtags="bangergames"
          class="share-button"
        >
          <img
            src="~/static/icons/twitter.svg"
            alt="twitter"
          >
        </ShareNetwork>
      </div>
    </div>
  </div>
</template>

<script>
import SubscribeCard from './CardsGrid/cards/SubscribeCard';
import postscribe from 'assets/scripts/postscribe';
import config from 'configs/config';

import dayjs from 'dayjs';
export default {
  name: 'BlogPostContent',
  components: { SubscribeCard },
  props: {
    postItem: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    userScripts: null,
  }),
  computed: {
    pageUrl() {
      return config.APP_URL +this.$route.fullPath;
    },
    updatedAt() {
      return dayjs(this.postItem.updated_at).format('on DD MMMM, YYYY at LT');
    },
  },
  mounted() {
    postscribe(this.$refs.postContent, this.postItem.content_detail.body);
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors.scss";
  @import "~/assets/styles/sizes.scss";

  .social-share {
    position: absolute;
    top: 0;
    right: -56px;
    flex-direction: column;

    .share-button {
      height: 40px;
      width: 40px;
      border: 1px solid $text-primary-color;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 7px;
    }
  }

  .preview-img {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin-bottom: 20px;
  }

  .blog-post {
    .title-block {
      .post-title {
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        display: flex;
        align-items: center;
        color: $text-primary-color;
      }

      .post-description {
        font-family: Telegraf-Regular, serif;
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 94%;
        color: $text-primary-color;
        word-break: break-all;
      }

      .separator {
        width: 100%;
        height: 5px;
        background: $text-primary-color;
        margin: 25px 0;
      }

      .post-updated {
        font-family: Telegraf-Regular, serif;
        font-style: normal;
        font-weight: normal;
        line-height: 94%;
        color: $text-primary-color;
      }
    }
    .post-body-wrapper {
      margin-top: 37px;
      position: relative;

      &::v-deep .post-body {
        color: $text-primary-color;

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
          font-family: Telegraf-UltraBold, serif !important;
          font-style: normal;
          font-weight: 800;
          line-height: 94%;
        }
        p,
        span {
          font-family: Telegraf-Regular, serif !important;
        }
      }
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .social-share {
      display: none;
    }

    .blog-post {
      .title-block {
        .post-title {
          font-size: 32px;
          line-height: 120%;
        }
      }

      .post-description {
        margin-top: 10px;
      }

      .post-updated {
        display: none;
      }

      .subscribe-card-wrapper {
        display: none;
      }
    }

    .post-body-wrapper::v-deep .post-body {
      color: $text-primary-color;

      img {
        max-width: 100%;
        height: auto;
      }
    }

    .post-body,
    .preview-img {
      max-width: 100%;
      min-height: 300px;
    }
  }
  @media only screen and (min-width: $tablet-small-width) {
    .blog-post {
      .title-block {
        .post-title {
          font-size: 56px;
          line-height: 59px;
        }
      }
      .post-description {
        margin-top: 16px;
      }
      .post-updated {
        font-size: 16px;
        display: block;
      }
    }
    .post-body,
    .preview-img {
      min-height: 500px;
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .blog-post {
      .title-block {
        .post-title {
          margin-top: 42px;
        }
      }
      .post-description {
        margin-top: 20px;
      }

      .post-updated {
        font-size: 24px;
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .social-share {
      display: flex;
    }

    .post-body,
    .preview-img {
      max-width: calc(100% - 293px);
      min-height: 432px;
    }

    .post-body-wrapper::v-deep .post-body {
      color: $text-primary-color;

      p {
        font-size: 24px;
      }
    }

    .blog-post {
      .title-block {
        .post-title {
          margin-top: 65px;
        }
        .post-description {
          margin-top: 11px;
        }
      }

      .subscribe-card-wrapper {
        display: flex;
      }
    }
  }

  @media only screen and (max-width: $tablet-small-width) {
    .post-body-wrapper::v-deep .post-body {
      iframe {
        max-width: 100%;
        height: 300px;
      }
    }
  }
</style>
