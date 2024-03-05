<router>
{
  name: 'ch_myChallenges',
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

      <a v-ripple>
        <img
          src="~static/images/brackets/popups/search-icon.svg"
          alt=""
        >
      </a>
    </div>
    <v-row>
      <v-col
        v-for="challenge in challenges"
        :key="challenge.id"
        md="4"
        sm="12"
        xs="12"
      >
        <challenges-card
          :challenge="challenge"
        />
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

import ChallengesCard from 'components/myTournaments/challenges/ChallengesCard';
import Pagination from 'components/Pagination';
import { APP_URL } from 'configs/config';
export default {
  name: 'Challenges',
  components: {Pagination, ChallengesCard},
  data() {
    return {
      matchType: ['All', 'Live', 'Soon', 'Lost'],
      selectMatch: 'All',
      challenges: [
        {
          id: 1,
          status: 'live',
        },
        {
          id: 2,
          status: 'soon',
        },
        {
          id: 3,
          status: 'lost',
        },
        {
          id: 4,
          status: 'lost',
        },
        {
          id: 2,
          status: 'soon',
        },
        {
          id: 6,
          status: 'live',
        },
        {
          id: 1,
          status: 'live',
        },
        {
          id: 2,
          status: 'soon',
        },
        {
          id: 3,
          status: 'lost',
        },
      ],
    };
  },
  methods: {
    setField() {
      console.log('value', this.selectMatch);
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Challenges',
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
  padding: 0 0 6em;
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
