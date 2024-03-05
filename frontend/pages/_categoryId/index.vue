<template>
  <div>
    <loader :loading="loading">
      <div class="blog-category-content">
        <breadcrumbs
          :breadcrumbs-list="breadcrumbs"
          active-crumb="categoryName"
          :additional-bread-crumbs="additionalBreadCrumbs"
        />
        <blogs-fadeless
          :title="categoryItem.name"
          :description="categoryItem.description"
          :clamp-des="true"
        />
        <cards-grid
          type="blog-table-grid"
          :items="categoryPosts.data"
          class="table-grid"
          :set-page="page => getPostsForCategoryGrid({ page, categorySlug })"
        />
      </div>
      <!--  -->
      <Banger
        v-if="animationData.show"
        :time="animationData.time"
        :path="animationData.path"
      />
    </loader>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';
import Loader from 'components/Loader.vue';
import Breadcrumbs from 'components/Breadcrumbs.vue';
import BlogsFadeless from 'components/BlogsFadeless.vue';
import Banger from 'components/Banger/Banger';

import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
import { APP_URL } from 'configs/config';
import get from 'lodash/get';
const { mapActions, mapState } = createNamespacedHelpers('blog');

export default {
  name: 'BlogCategory',
  components: {
    CardsGrid,
    Loader,
    Breadcrumbs,
    BlogsFadeless,
    Banger
  },
  async asyncData(ctx) {
    const { store, route } = ctx;
    const categorySlug = route.params.categoryId;
    await store.dispatch('blog/getBlogCategoryDetail',{ categorySlug });
    await store.dispatch('blog/getLatestPosts',{ perPage: 6, categorySlug });
    await store.dispatch('blog/getPostsForCategoryGrid',{ page:1, categorySlug });

    return {
      breadcrumbs: ['news', 'categoryName'],
      animationData: {
        path: '',
        time: 0,
        show: false
      }
    };
  },
  computed: {
    ...mapState(['categoryItem', 'status', 'categoryPosts', 'latestPosts']),
    loading() {
      return this.status === STATE_STATUSES.PENDING;
    },
    subcategories() {
      return [{ name: 'All', slug: '' }, ...this.categoryItem.subcategories];
    },
    additionalBreadCrumbs() {
      return {
        categoryName: {
          text: this.categoryItem.name,
          href: ''
        }
      };
    },
    categorySlug() {
      return get(this, '$route.params.categoryId', null);
    }
  },
  mounted() {
    this.setAnimations();
  },
  methods: {
    ...mapActions(['getPostsForCategoryGrid']),
    async setAnimations() {
      const { name } = this.categoryItem;
      const animation = {
        show: true,
        path: 'banger-officials',
        time: 5000
      };
      switch (name) {
        case 'Banger Games Official':
          this.animationData = animation;
          break;
        case 'Guides':
          animation.time = 10000;
          animation.path = 'checking-guide';
          this.animationData = animation;
          break;
        default:
          break;
      }
    },
  },
  head () {
    const { name, description } = this.categoryItem;
    const route = APP_URL + this.$route.path;

    return {
      title: name,
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ],
      meta: [
        { vmid: 'description', name: 'description', content: description || 'Category' }
      ]
    };
  },
};
</script>

<style scoped lang="scss">
  @import "~assets/styles/colors.scss";
  @import "~assets/styles/sizes.scss";

  .blog-category-content {
    &::v-deep .home-title-content {
      .col-left {
        flex-basis: 55%;
      }

      .col-right {
        flex-basis: 45%;
      }
    }

    .blogs-block {
      &::v-deep .articles-grid {
        margin-bottom: 0;
      }
    }

    .table-grid {
      margin-bottom: 150px;
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .breadcrumbs {
      display: none;
    }
    .blogs-block {
      margin-top: 12px;
    }
    .blog-category-content {
      &::v-deep .home-title {
        font-size: 24px;
        line-height: 94%;
      }
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .breadcrumbs {
      display: flex;
    }

    .blogs-block {
      margin-top: 33px;
    }

    .blog-category-content {
      margin-top: 25px;
      &::v-deep .paragraph {
        height: 65px;
      }

      &::v-deep .home-title {
        font-size: 33px;
        line-height: 150%;
      }
    }

    .blogs-block {
      &::v-deep .articles-grid {
        margin-top: 29px;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .blog-category-content {
      margin-top: 21px;

      &::v-deep .paragraph {
        height: 105px;
      }

      &::v-deep .home-title {
        font-size: 56px;
      }
    }

    .blogs-block {
      &::v-deep .articles-grid {
        margin-top: 14px;
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .blog-category-content {
      &::v-deep .paragraph {
        height: 105px;
      }

      .blogs-block {
        &::v-deep .articles-grid {
          margin-top: 46px;
        }
      }
    }
  }
</style>
