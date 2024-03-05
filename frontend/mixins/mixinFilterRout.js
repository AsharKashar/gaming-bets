import debounce from 'lodash/debounce';

export default {
  data: () => ({
    filtersParams: {},
    debounce: null,
  }),
  created() {
    this.debounce = debounce(() => {
      this.callbackFilter(this.filtersParams);
    }, this.debounceTime || 1500);
  },
  mounted() {
    this.filtersParams = this.initFilter || {};
  },
  methods: {
    setFilterKey(val, key = 'gameId', isQuery = false, debounce = true) {
      this.$set(this.filtersParams, key, val);
      this.updateRouteDataAndQuery(this.filtersParams, isQuery, debounce);
    },
    toggleFilter(filter, options, isQuery = false) {
      const prevVal = this.filtersParams[filter.name];
      const newVal = options.id;
      this.$set(this.filtersParams, 'page', 1);

      if (prevVal === newVal) {
        this.$delete(this.filtersParams, filter.name);
      } else {
        this.$set(this.filtersParams, filter.name, newVal);
      }
      this.updateRouteDataAndQuery(this.filtersParams, isQuery);
    },
    setFilters(filter, isQuery = false, debounce= false) {
      this.filtersParams = filter;
      this.updateRouteDataAndQuery(filter, isQuery, debounce);
    },
    updateRouteDataAndQuery(filter = {}, isQuery = false, debounce = true) {
      debounce ? this.debounce() : this.callbackFilter(filter);
      if (isQuery) {
        const { query } = this.$route;
        this.$router.push({query: {...query, ...filter}, params: {savePosition: true}});
      }
    },
    setPage(page, scrollTop = 0, isQuery) {
      if (scrollTop) {
        window.scrollTo({
          top: scrollTop,
          behavior: 'smooth',
        });
      }

      this.setFilters({ ...this.filtersParams, page }, isQuery);
    },
  }
};
