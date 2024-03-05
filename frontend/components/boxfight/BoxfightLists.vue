<template>
  <loader
    :loading="loading"
    :overlay="false"
    :center="true"
    height="200px"
  >
    <div class="tournaments-list">
      <div
        ref="tournamentsCount"
        class="tournaments-count"
        v-text="tournamentsCount"
      />

      <cards-grid
        v-if="currentPage === 1 && isDesktop"
        type="tournaments-featured"
        :items="featuredTournaments"
      />
      <cards-grid
        type="tournaments-grid"
        :items="tournamentsCardItem"
      />
      <pagination
        :page="currentPage"
        :total="lastPage"
        :set-page="setPage"
      />
    </div>
  </loader>
</template>

<script>
import Pagination from 'components/Pagination';
import CardsGrid from 'components/CardsGrid';
import Loader from 'components/Loader.vue';
import { STATE_STATUSES } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import debounce from 'lodash/debounce';
import get from 'lodash/get';

const authModule = createNamespacedHelpers('auth');
const boxfightModule = createNamespacedHelpers('boxfight');
export default {
  name: 'TournamentsList',
  components: {
    Loader,
    CardsGrid,
    Pagination,
  },
  props: {
    filters: {
      type: Object,
      required: true,
    },
    setFilters: {
      type: Function,
      required: true,
    },
  },
  data: () => ({
    debounce: null,
  }),
  computed: {
    ...authModule.mapState(['user']),
    ...boxfightModule.mapState(['boxFights' , 'boxFightStatus' , 'boxFightPagination']),
    isDesktop() {
      return this.$vuetify.breakpoint.width > 767;
    },
    loading() {
      return this.boxFightStatus === STATE_STATUSES.PENDING;
    },
    tournamentsCount() {
      const to = get(this , 'boxFightPagination.to' , 0);
      const all = get(this , 'boxFightPagination.total' , 0);
      return `Results ${to ? to : 0} of ${all}`;
    },
    currentPage() {
      return +this.$route.query.page || 1;
    },
    tournamentsCardItem() {
      const data = [...this.boxFights];
      if (this.currentPage === 1) {
        return data.slice(2);
      } 
      return data;
    },
    featuredTournaments() {
      return this.boxFights.slice(0, 2);
      
    },
    lastPage() {
      return get(this , 'boxFightPagination.last_page' , 1);
    },
  },
  watch: {
    $route() {
      this.debounce();
    },
  },
  mounted() {
    this.updateBoxFights();
    this.debounce = debounce(() => {
      this.updateBoxFights();
    }, 1500);
  },
  methods: {
    ...boxfightModule.mapActions(['getBoxFights']),
    updateBoxFights(){
      let id = 0;
      if (this.user) id = this.user.id;
      this.getBoxFights({
        payload:{ game_id: this.$route.params.gameId, id },
        params:{
          page:this.$route.query.page
        }
      });
    },
    setPage(page) {
      try {
        document.getElementById('wrap-scroll-bar').scrollTo(0, this.$refs.tournamentsCount.offsetTop - 200);
      } catch (e) {
        console.error(e);
      }
      this.setFilters({ ...this.filters, page });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";

.tournaments-count {
  margin-bottom: 15px;
  font-weight: 800;
}
.tournaments-list {
  display: flex;
  flex-direction: column;
  &::v-deep {
    .pagination-container {
      margin: 6px 0 274px auto;
    }
  }
}

@media only screen and (max-width: $tablet-large-width) {
  .tournaments-list {
    &::v-deep {
      .pagination-container {
        margin-bottom:50px;
      }
    }
  }
}
</style>
