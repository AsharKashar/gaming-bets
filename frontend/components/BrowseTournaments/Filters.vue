<template>
  <div class="filters">
    <div
      v-for="(filter) in filtersList"
      :key="filter.name"
      class="filter-dropdown"
    >
      <div class="filter-title">
        {{ filter.title }}
      </div>
      <v-select
        v-model="filters[filter.name]"
        attach
        auto
        :items="filter.options"
        item-text="name"
        item-value="id"
        :menu-props="{bottom: true, offsetY: true}"
        class="filter-select"
        :append-icon="'mdi-chevron-down'"
        @change="(value) => setFilter(filter.name, value)"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Filters',
  props: {
    availableFilters: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      filters: {
        gameMode: 0,
        matchType: 0,
        gameType: 0,
        platform: 0,
        repeat: 0,
      },
      filtersList: [],
    };
  },
  created() {
    const list = [
      {
        title: this.$t('Game Mode'),
        name: 'gameMode',
      },
      {
        title: this.$t('Game Type'),
        name: 'gameType',
      },
      {
        title: this.$t('Platform'),
        name: 'platform',
      },
      {
        title: this.$t('Held On'),
        name: 'repeat',
      },
    ];

    const query = this.$router.currentRoute.query;
    const filters = {};
    list.map((item) => {
      const filterItem = {
        ...item,
        options: [...this.availableFilters[item.name]],
      };

      if (filterItem.name !== 'platform') {
        filterItem.options.unshift({
          name: 'All',
          id: 0,
        });
        filters[item.name] = parseInt(query[item.name]) || 0;
      } else {
        filters[item.name] =
          parseInt(query[item.name]) || this.availableFilters[item.name][0].id;
      }

      this.filtersList.push(filterItem);
    });
    this.filters = filters;
    this.$router
      .push({
        query: { ...query, ...filters },
        params: {
          savedPosition: true,
        },
      });
  },
  methods: {
    setFilter(name, value) {
      this.filters[name] = value;
      const query = { ...this.$router.currentRoute.query, [name]: value };
      this.$router.push({
        query,
        params: {
          savePosition: true,
        },
      });
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes.scss";
.filters {
  display: flex;
  flex-wrap: wrap;
  margin-top: 43px;

  .filter-dropdown {
    display: flex;
    flex-direction: column;
    margin-right: 30px;
    width: 23%;
    min-width: 200px;

    .filter-title {
      text-transform: uppercase;
      font-family: Telegraf-UltraBold, serif;
      font-weight: 800;
      font-size: 16px;
      line-height: 94%;
      display: flex;
      align-items: center;
      letter-spacing: 0.12em;
      color: #a1afd3;
    }

    .filter-select {
      font-family: Telegraf-Regular, serif;
      font-style: normal;
      font-weight: normal;
      font-size: 20px;
      line-height: 94%;
      display: flex;
      align-items: center;
    }

    .filter-select::v-deep .v-input__control {
      i {
        color: #be1338;
        font-size: 36px;
      }
      .v-select__selections {
        font-family: Telegraf-Regular, serif;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 94%;
        display: flex;
        align-items: center;
        padding-bottom: 10px;
      }

      .v-select__selection {
        color: #a1afd3;
      }
    }
  }
}

@media all and (min-width: $desktop-width) {
  .filters {
    flex-wrap: nowrap;
  }
}

@media only screen and (max-width: 1439px) {
  .filters {
    justify-content: center;
  }
}

@media only screen and (max-width: $mobile-width) {
  .filters {
    .filter-dropdown {
      width: 100%;
      margin-right: 0;
    }
  }
}
</style>
