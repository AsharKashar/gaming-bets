<router>
{
  name: 'ch_myHistory',
}
</router>

<template>
  <div class="card-wrapper">
    <div class="filter-wrapper">
      <div class="select-wrapper">
        <div>
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
        <div>
          <label>Filter By :</label>
          <v-select
            v-model="filterSelect"
            auto
            :items="filter"
            :item-text="filter[0]"
            :item-value="filter[0]"
            class="filter-select"
            @change="setField"
          />
        </div>
      </div>
      <a v-ripple>
        <img
          src="~static/images/brackets/popups/search-icon.svg"
          alt=""
        >
      </a>
    </div>

    <v-row>
      <inline-card />
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
import InlineCard from 'components/myTournaments/history/inlineCard';
import Pagination from 'components/Pagination';
export default {
  name: 'Challengeshistory',
  components: { Pagination, InlineCard },
  data() {
    return {
      matchType: ['All', 'Live', 'Soon', 'Lost'],
      filter: ['Challenges', 'Lose', 'Won'],
      filterSelect:'Challenges',
      selectMatch: 'All',
    };
  },
};
</script>

<style lang='scss' scoped>
@import '~/assets/styles/colors';
@import '~/assets/styles/sizes.scss';
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
    div {
      display: flex;
      align-items: center;
      justify-content: center;
      label {
        margin: 0 1em;
      }
    }
  }

  .filter-wrapper {
    justify-content: space-between;
  }
}
</style>
