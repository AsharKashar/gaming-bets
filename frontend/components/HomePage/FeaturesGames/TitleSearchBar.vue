<template>
  <div class="fg-search-bar-wrapper">
    <home-title
      v-if="!displaySearch"
      :title="$t(title)"
      :subtitle="$t(subtitle)"
      right-icon="search"
      @handleClick="displaySearch = !displaySearch"
    />
    <div
      v-else
      class="search-bar-inner"
    >
      <input
        v-model="search"
        class="search-input-bar"
        type="text"
        placeholder="Type Game Name"
        autofocus
        @change="setSearch"
      >
      <div
        v-ripple="{ center: true }"
        class="search-bar-actions"
        @click="handleAction"
      >
        <div v-if="search">
          <cross class="cross-btn" />
        </div>
        <div v-else>
          <search color="#A1AFD3" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Search from '~/components/svgIcons/Search';
import Cross from '~/components/svgIcons/Cross';
import HomeTitle from '~/components/HomeTitle';
export default {
  name: 'TitleSearchBar',
  components: {
    HomeTitle,
    Search,
    Cross,
  },
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    title: {
      type: String,
      default: 'Features Games',
    },
    subtitle: {
      type: String,
      default: 'Select a game and choose how you want to play',
    },
  },
  data: () => {
    return {
      displaySearch: false,
      search: '',
    };
  },
  methods: {
    handleAction() {
      this.displaySearch = !this.displaySearch;
      if (!this.displaySearch) {
        this.search = '';
        this.setSearch();
      }
    },
    setSearch() {
      this.$emit('setSearchText', this.search);
    }
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.fg-search-bar-wrapper {
  min-height: 200px;
  display: flex;
  align-items: center;
  padding: 50px 0 32px;
  color: $text-primary-color;

  & > div {
    width: 100%;
  }

  .search-bar-inner {
    height: 100%;
    display: flex;
    align-items: center;

    .search-input-bar {
      flex-basis: 95%;
      outline: none;
      font-weight: 800;
      font-size: 25px;
      line-height: 1.1;
      color: rgba(161, 175, 211, 0.3);
    }

    .search-bar-actions {
      padding: 0;
      margin-left: auto;
      cursor: pointer;
      svg {
        height: 20px;
        width: 20px;
      }
    }
  }
  &::v-deep {
    .home-title-content {
      .col-left {
        flex-basis: 70%;
      }
      .col-right {
        flex-basis: 30%;
      }
    }
  }
}

@media only screen and (min-width: $mobile) {
  .fg-search-bar-wrapper {
    .search-bar-inner {
      .search-bar-actions {
        padding: 26px;
        svg {
          height: 30px;
          width: 30px;
        }
      }
    }
  }
}

@media all and (min-width: $tablet){
  .fg-search-bar-wrapper {
    min-height: 200px;
    padding: 15px 0;
  }
}

@media all and (min-width: $tablet-large-width) {
  .search-input-bar {
    font-size: 56px;
  }
  .fg-search-bar-wrapper {
    &::v-deep {
      .home-title-content {
        .col-left {
          flex-basis: 70%;
        }
        .col-right {
          flex-basis: 30%;
        }
      }
    }
  }
}
</style>
