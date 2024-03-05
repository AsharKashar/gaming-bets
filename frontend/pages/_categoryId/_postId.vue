<template>
  <div v-if="postItem.main_category">
    <loader
      :loading="loading"
      class="blog-post-container"
    >
      <breadcrumbs
        :breadcrumbs-list="breadcrumbs"
        active-crumb
        :additional-bread-crumbs="additionalBreadCrumbs"
      />
      <home-title
        :title="postItem.main_category.name"
        class="category-name"
      />
      <blog-post-content
        v-if="postItem.content_detail "
        :post-item="postItem"
      />
      <div class="more-news">
        <home-title
          title="Latest news"
          class="latest-news-title"
        />
        <cards-grid
          type="square-row"
          :items="latestPostsItems"
        />
      </div>
    </loader>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';
import Loader from 'components/Loader.vue';
import Breadcrumbs from 'components/Breadcrumbs.vue';
import HomeTitle from 'components/HomeTitle';
import get from 'lodash/get';

import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
import BlogPostContent from 'components/BlogPostContent';
import { APP_URL } from 'configs/config';
const { mapState } = createNamespacedHelpers('blog');

export default {
  name: 'BlogPost',
  components: {
    BlogPostContent,
    CardsGrid,
    Breadcrumbs,
    Loader,
    HomeTitle,
  },
  async asyncData(ctx) {
    const { route, store, i18n } = ctx;
    const params = get(route, 'params', {});
    const { postId: postSlug, categoryId: categorySlug } = params;


    await store.dispatch('blog/getBlogPost', { postSlug, categorySlug });
    const currentPostId = get(store, 'state.blog.postItem.id', '');
    await store.dispatch('blog/getLatestPosts',  {
      perPage:5,
      categorySlug,
      exclude: [currentPostId],
      random: true,
    });

    return {
      locale: get(i18n,'locale', 'en'),
      breadcrumbs: ['news', 'categoryName'],
    };
  },
  computed: {
    ...mapState(['postItem', 'status', 'latestPosts']),
    loading() {
      return this.status === STATE_STATUSES.PENDING;
    },
    latestPostsItems() {
      return [...this.latestPosts.data].slice(0, 4);
    },
    additionalBreadCrumbs() {
      return {
        categoryName: {
          text: this.postItem.main_category.name,
          href: `/${this.postItem.main_category.slug}`,
        },
      };
    },
  },
  head() {
    const title = get(this,'postItem.content_detail.meta_title');
    const description = get(this,'postItem.content_detail.meta_description', 'Blog post');
    const route = APP_URL + this.$route.path;
    const locale = get(this,'locale', 'Blog post');
    const previewImg = get(this,'postItem.preview_image_url', 'Blog post');

    return {
      title,
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ],
      meta: [
        {
          vmid: 'description',
          name: 'description',
          content: description
        },
        {
          vmid: 'og:locale',
          name: 'og:locale',
          content: locale
        },
        {
          vmid: 'og:type',
          name: 'og:type',
          content: 'website',
        },
        {
          vmid: 'og:title',
          name: 'og:title',
          content: title
        },
        {
          vmid: 'og:description',
          name: 'og:description',
          content: description,
        },
        {
          vmid: 'og:url',
          name: 'og:url',
          content: route
        },
        {
          vmid: 'og:site_name',
          name: 'og:site_name',
          content: 'Banger Games',
        },
        {
          vmid: 'og:image',
          name: 'og:image',
          content: 'image_url',
        },
        {
          vmid: 'og:image:secure_url',
          name: 'og:image:secure_url',
          content: previewImg
        },
        {
          vmid: 'og:image:width',
          name: 'og:image:width',
          content: '750',
        },
        {
          vmid: 'og:image:height',
          name: 'og:image:height',
          content: '750',
        },
        {
          vmid: 'twitter:card',
          name: 'twitter:card',
          content: previewImg
        },
        {
          vmid: 'twitter:description',
          name: 'twitter:description',
          content: description
        },
        {
          vmid: 'twitter:title',
          name: 'twitter:title',
          content: title
        },
        {
          vmid: 'twitter:site',
          name: 'twitter:site',
          content: route
        },
        {
          vmid: 'twitter:image',
          name: 'twitter:image',
          content: previewImg
        },
        {
          vmid: 'twitter:creator',
          name: 'twitter:creator',
          content: 'bangergames',
        },
      ],
    };},
};
</script>

<style scoped lang="scss">
  @import "~assets/styles/colors.scss";
  @import "~assets/styles/sizes.scss";

  .breadcrumbs {
    margin-left: 0;
  }

  @media only screen and (min-width: $min-resolution) {
    .breadcrumbs {
      display: none;
    }

    .blog-post-container {
      margin: 0 10px 0 16px;
    }
    .category-name {
      margin: 11px 0 29px;
      &::v-deep .home-title {
        font-size: 24px;
        line-height: 94%;
      }
      &::v-deep .paragraph {
        height: 47px;
      }
    }
    .latest-news-title {
      &::v-deep .home-title {
        font-size: 33px;
      }
      &::v-deep .paragraph {
        height: 63px;
      }
      margin-bottom: 23px;
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .breadcrumbs {
      margin-top: 26px;
      display: flex;
    }

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

    .blog-post-container {
      margin: 0;
    }
    .category-name {
      margin: 33px 0 29px;
      &::v-deep .home-title {
        font-size: 33px;
        line-height: 150%;
      }
      &::v-deep .paragraph {
        height: 65px;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .breadcrumbs {
      margin-top: 20px;
    }

    .blog-post {
      margin-top: 20px;

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

    .category-name {
      display: none;
    }

    .latest-news-title {
      &::v-deep .home-title {
        font-size: 32px;
      }
      &::v-deep .paragraph {
        height: 63px;
      }
      margin-bottom: 47px;
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .social-share {
      display: flex;
    }

    .blog-post {
      margin-top: 20px;

      .title-block {
        .post-title {
          margin-top: 65px;
        }
        .post-description {
          margin-top: 11px;
        }
      }
    }

    .latest-news-title {
      &::v-deep .home-title {
        font-size: 56px;
      }
      &::v-deep .paragraph {
        height: 105px;
      }
    }
  }
</style>
