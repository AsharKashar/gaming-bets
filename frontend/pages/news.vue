<template>
  <div>
    <loader :loading="loading">
      <div class="blog-content">
        <breadcrumbs
          :breadcrumbs-list="breadcrumbs"
          active-crumb="news"
        />
        <carousel :slides-count="latestPosts.data.length">
          <blog-post-slide
            v-for="(slide, i) in latestPosts.data"
            :key="i"
            :slide="slide"
          />
        </carousel>
        <div class="categories-grid">
          <cards-grid
            type="large"
            :items="categories"
          />
        </div>
        <blogs />
      </div>

      <Banger
        :time="17000"
        path="blog-page"
      />
    </loader>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';
import Breadcrumbs from 'components/Breadcrumbs.vue';
import Carousel from 'components/Carousel';
import BlogPostSlide from 'components/Carousel/parts/BlogPostSlide';
import Loader from 'components/Loader.vue';
import Blogs from 'components/Blogs';
import Banger from 'components/Banger/Banger';

import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
import { APP_URL } from 'configs/config';
const { mapState } = createNamespacedHelpers('blog');

export default {
  name: 'News',
  components: {
    Breadcrumbs,
    CardsGrid,
    Loader,
    Carousel,
    BlogPostSlide,
    Blogs,
    Banger
  },
  async asyncData(ctx) {
    const { store } = ctx;
    await store.dispatch('blog/getBlogCategories');
    await store.dispatch('blog/getLatestPosts', { perPage:6 });

    return {
      breadcrumbs: ['main', 'news']
    };
  },
  computed: {
    ...mapState(['categories', 'status', 'latestPosts']),
    loading() {
      return this.status === STATE_STATUSES.PENDING;
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'News',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>

<style scoped lang="scss">
@import "~assets/styles/colors.scss";
@import "~assets/styles/sizes.scss";

@media only screen and (min-width: $min-resolution) {
  .breadcrumbs {
    display: none;
  }

  .blog-content {
    .categories-grid {
      margin-top: 44px;
      padding: 0 15px 0 20px;
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .breadcrumbs {
    display: flex;
  }

  .blog-content {
    margin-top: 23px;

    .carousel {
      margin-top: 31px;
    }

    .categories-grid {
      margin-top: 22px;
      padding: 0;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .blog-content {
    margin-top: 20px;

    .carousel {
      margin-top: 48px;
    }

    .categories-grid {
      margin-top: 41px;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .blog-content {
    margin-top: 21px;

    .categories-grid {
      margin-top: 106px;
    }

    .carousel {
      margin-top: 88px;
    }

    .blogs-block {
      margin-bottom: 116px;
    }
  }
}
</style>
