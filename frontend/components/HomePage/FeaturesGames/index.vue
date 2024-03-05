<template>
  <v-row no-gutters>
    <v-col md="12">
      <title-search-bar
        @setSearchText="setSearchText"
      />
      <games-listing
        :key="keyGame"
        :loading="loading"
        :games="isSearchText ? gamesSearchList : games"
      />

      <div class="view-all-btn-wrap">
        <default-button
          type="button"
          :on-click="() => $router.push('/tournaments')"
          class="view-all-btn"
        >
          {{ $t("View All") }}
        </default-button>
      </div>
    </v-col>
  </v-row>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import TitleSearchBar from './TitleSearchBar.vue';
import GamesListing from './GamesListing.vue';

import { createNamespacedHelpers } from 'vuex';
const gameModule = createNamespacedHelpers('game');

export default {
  name: 'FeaturesGames',
  components: {
    DefaultButton,
    TitleSearchBar,
    GamesListing,
  },
  data: () => {
    return {
      loading: false,
      isSearchText: false,
      keyGame: 1,
    };
  },
  computed: {
    ...gameModule.mapState(['games', 'gamesSearchList']),
  },
  methods: {
    ...gameModule.mapActions(['getGames']),
    async setSearchText(name) {
      this.isSearchText = !!name;
      if(!name || this.loading) {
        this.keyGame+=1;
        return;
      }
      this.loading = true;
      try {
        await this.getGames({params: {name}, commitName: 'setGamesSearchList'});
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.view-all-btn-wrap {
  display: flex;
  justify-content: flex-end;
  margin-top: 36px;
  margin-bottom: 26px;
}

.view-all-btn {
  max-width: 124px;
  padding: 19px 12px;
  font-size: 18px;
}
@media only screen and (max-width: $tablet-small-width) {
  .view-all-btn-wrap {
    margin-top: 26px;
    margin-bottom: 16px;
  }
  .view-all-btn {
    width: 100%;
    max-width: 100%;
    margin: 0 25px;
  }
}
</style>
