<template>
  <div class="notification-filters">
    <div class="filter-tabs">
      <v-tabs
        :loading="loading"
        background-color="#010432"
        slider-color="#BE1338"
        show-arrows
        next-icon="mdi-arrow-right-bold-box-outline"
        prev-icon="mdi-arrow-left-bold-box-outline"
        :value="filtersParams.read"
        grow
        @change="setFilterKey($event, 'read')"
      >
        <v-tab :key="0">
          Read
        </v-tab>
        <v-tab :key="1">
          Unread
        </v-tab>
      </v-tabs>
    </div>
    <div class="filter-selections">
      <div class="input-wrap">
        <div class="label">
          Type :
        </div>
        <v-select
          :disabled="loading"
          :items="filterTypes"
          :value="filtersParams.types"
          flat
          item-text="title"
          item-value="name"
          :menu-props="{'offset-y': true,'tile': true, 'content-class' : 'notification-filter-menu', 'attach' : 'input-wrap'}"
          hide-details
          class="input-select"
          :append-icon="'mdi-chevron-down'"
          @change="setFilterKey($event, 'types')"
        />
      </div>
      <div class="input-wrap">
        <div class="label">
          Date :
        </div>
        <v-select
          :disabled="loading"
          :items="availableDates"
          :value="filtersParams.date"
          flat
          item-text="title"
          item-value="name"
          :menu-props="{'offset-y': true,'tile': true, 'content-class' : 'notification-filter-menu', 'attach' : true}"
          hide-details
          class="input-select"
          :append-icon="'mdi-chevron-down'"
          @change="setFilterKey($event, 'date')"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotificationFilter',
  props: {
    availableFilters: {
      type: Object,
      default: () => {},
    },
    filtersParams: {
      type: Object,
      default: () => {},
    },
    availableDates: {
      type: Array,
      default: () => ([]),
    },
    loading: {
      type: Boolean,
      default: false,
    },
    setFilterKey: {
      type: Function,
      required: true,
    },
  },
  computed: {
    filterTypes() {
      const types = [...this.availableFilters.notificationTypes || []];
      types.unshift('all');
      return types.map((item) => {
        return { name: item, title: this.formatTitle(item) };
      });
    },
  },
  methods: {
    formatTitle(text) {
      text = text.replace(/([-_]\w)/g, (g) => g[1].toUpperCase());
      return text.replace(/([A-Z])/g, ' $1').replace(/^./, function (str) {
        return str.toUpperCase();
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.notification-filters {
  display: flex;
  justify-content: space-between;
  margin: 4px 0;

  .filter-tabs {
    flex-basis: 35%;
    border-style: inset;
    border-top: 0px solid $text-primary-color;
    border-left: 0px solid $text-primary-color;
    border-right: 0px solid $text-primary-color;
    border-bottom: 1px solid #a1afd342;
    font-family: Telegraf-UltraBold, serif;
    color: $text-primary-color;

    .v-slide-group__content {
      border-bottom: 1px solid #a1afd326 !important;
    }

    .v-tab--active {
      color: $text-secondary-color !important;
      font-weight: 900 !important;
    }
  }

  .filter-selections {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    flex-basis: 55%;

    .input-wrap {
      flex-basis: 40%;
      display: flex;
      //
      align-items: center;
      min-height: 43px;
      font-style: normal;
      font-size: 18px;
      line-height: 100%;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      //

      .label {
        font-family: Telegraf-UltraBold, serif;
        color: $text-primary-color;
        flex-basis: 40%;
        min-width: fit-content;
        margin-right: 8px;
      }

      .input-select {
        flex-basis: 50%;
        border-bottom: 1px solid rgba(161, 175, 211, 0.2);

        //
        margin: 0;
        padding: 0;
        font-weight: normal;
        font-size: 16px !important;
        line-height: 140%;
        display: flex;
        align-items: center;

        /* Typography / SoftWhite */
        color: #e7e7e7;
        //
      }
    }
  }
}

.view-all {
  font-size: 14px;
  line-height: 100%;
  padding: 0 40px;
  letter-spacing: 0.05em;
  text-decoration-line: underline;
  color: $text-secondary-color;
  cursor: pointer;
}
</style>
<style lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";
.notification-filter-menu {
  width: 226px;
  background: $app-background;
  // opacity: 0.5;
  border: 1px solid #a1afd3;
  box-sizing: border-box;

  .v-list {
    padding: 0;
    background: $app-background;

    .v-list-item {
      font-weight: normal;
      font-size: 14px;
      line-height: 100%;
      display: flex;
      align-items: center;
      letter-spacing: 0.02em;
      color: #e7e7e7;
      opacity: 0.7;
      border-bottom: 2px solid $border-secondary-color;

      &:hover,
      &.v-list-item--active {
        color: $border-primary-color !important;
        opacity: 1;
      }

      &.v-list-item--active {
        background-color: #212652; //$secondary-background;
      }
    }
  }
}
</style>
