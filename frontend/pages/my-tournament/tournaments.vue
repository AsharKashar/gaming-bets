<router>
{
  name: 'ch_myTournaments',
}
</router>
<template>
  <div class="card-wrapper">
    <div class="filter-wrapper">
      <div class="select-wrapper">
        <label>Sort by :</label>
        <v-select
          v-model="selectMatch"
          auto
          :items="matchType"
          :item-text="selectMatch[0]"
          :item-value="selectMatch[0]"
          class="filter-select"
          @change="setField"
        />
      </div>

      <a
        v-ripple
      ><img
        src="~static/images/brackets/popups/search-icon.svg"
        alt=""
      ></a>
    </div>
    <v-row>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
      <v-col
        md="6"
        sm="12"
        xs="12"
      >
        <my-tournament-card />
      </v-col>
    </v-row>
    <div class="pagination">
      <pagination
        :page="1"
        :total="10"
      />
    </div>
  </div>
</template>

<script>
import MyTournamentCard from 'components/myTournaments/tournament/MyTournamentCard';
import Pagination from 'components/Pagination';
import { APP_URL } from 'configs/config';
export default {
  name: 'ChallengesTournament',
  components: {Pagination, MyTournamentCard},
  data: () => ({
    matchType: ['All', 'Live', 'Soon', 'Lost'],
    selectMatch: 'All',
  }),
  middleware: ['hideHeader'],
  methods: {
    setField() {
      console.log('value', this.selectMatch);
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Challenges Tournament',
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
@import "~/assets/styles/sizes.scss";
.card-wrapper {
  position: relative;
  width: 100%;
  padding: 0em 0 6em;
  .pagination {
    position: relative;
    float: right;
    padding-top: 1.5em;
  }
  .select-wrapper,
  .filter-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    label {
      margin-right: 1em;
    }
  }

  .filter-wrapper {
    justify-content: space-between;
  }
}
</style>
