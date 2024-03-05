<template>
  <div class="table-wrapper">
    <loader
      :loading="loading"
      :overlay="false"
      class="table-loader"
    >
      <div class="blog-table-grid">
        <div
          v-for="(item, index) in items"
          :key="item.id"
        >
          <blog-table-row :item="item" />
          <subscribe-card
            v-if="index === parseInt(items.length/2)"
            class="subscribe-card"
          />
        </div>
        <subscribe-card
          v-if="!items.length"
          class="subscribe-card subcscribe-card-force"
        />
      </div>
    </loader>
    <pagination
      v-if="items.length"
      :page="currentPage"
      :total="categoryPosts.last_page"
      :set-page="setPage"
    />
  </div>
</template>

<script>
import BlogTableRow from 'components/CardsGrid/cards/BlogTableRow';
import SubscribeCard from 'components/CardsGrid/cards/SubscribeCard';
import Pagination from 'components/Pagination';
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const { mapState } = createNamespacedHelpers('blog');
import Loader from 'components/Loader.vue';

export default {
  name: 'BlogTableGrid',
  components:{
    BlogTableRow,
    SubscribeCard,
    Pagination,
    Loader
  },
  props:{
    items:{
      type:Array,
      default:() => ([])
    },
    setPage:{
      type:Function,
      default:() => ([])
    }
  },
  computed:{
    ...mapState(['categoryPosts','postsStatus']),
    currentPage () {
      return this.categoryPosts.current_page || 1;
    },
    loading () {
      return this.postsStatus === STATE_STATUSES.PENDING;
    },
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";

  .table-wrapper {
    position: relative;
    min-height: 250px;

    .blog-table-grid {
      display: flex;
      flex-direction: column;
    }

    .table-loader{
      &::v-deep .loader-spinner-wrapper{
        display: flex;
        justify-content: center;
        min-height: 300px;
        align-items: center;
      }
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .table-wrapper {
      .pagination-container{
        margin-top: 52px;
        margin-left: 0;
      }
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .table-wrapper {
      .blog-table-grid {
        width: 100%;
        margin-top: 10px;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .table-wrapper {
      .blog-table-grid {
        margin-top: 40px;
      }

      .pagination-container{
        margin-left: 67px;
      }
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .table-wrapper {
      .blog-table-grid {
        width: calc(100% - 292px);
        margin-top: 0;
      }

      &::v-deep .subcscribe-card-force {
        height: 193px;
        margin-top: 47px;
        margin-left: 0;
        margin-bottom: 51px;
        width: 100%;
        clip-path: polygon(100% 0, 100% 88%, 97% 100%, 0 100%, 0 0)!important;

        .subscribe-card {
          clip-path: polygon(100% 0, 100% 88%, 97% 100%, 0 100%, 0 0);
          padding: 21px 21px 0 72px;
        }

        .pseudo-form{
          display: flex;
          justify-content: space-between;
          padding-right: 78px;
          align-items: baseline;
        }

        .subscribe-terms{
          display: none;
        }

        .logo {
          position: absolute;
          left: 14px;
          top: 11px;
        }

        .subscribe-title{
          font-size: 24px;
        }

        .subscribe-description{
          font-size: 16px;
          margin: 12px 0 23px;
        }

        .subscribe-email{
          height: 45px;
          width: 100%;
          border-bottom: 2px solid #E7E7E7;
          max-width: 290px;
        }
      }
    }
  }
</style>
