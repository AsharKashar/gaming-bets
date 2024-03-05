<template>
  <div
    class="filters-list-wrapper"
    :class="{disabledFilter, 'filters--show': !hideFilter}"
  >
    <div class="filters-list__inner">
      <v-slide-x-transition>
        <div
          v-show="!hideFilter"
          class="filters-list"
          :class="{'filters-list--col-3': filtersList.length > 3}"
        >
          <div
            v-for="(filter,i) in filtersList"
            :key="i"
            class="tournament-filter"
          >
            <div class="tournament-filter-title">
              {{ filter.title }}
            </div>
            <div class="options">
              <div
                v-for="(option) in filter.options"
                :key="option.id"
                class="tournament-filter-option"
                :class="{
                  'active-filter':option.id === +filtersParams[filter.name]
                }"
                @click="toggleFilter(filter, option)"
              >
                {{ option.name }}
              </div>
            </div>
          </div>
        </div>
      </v-slide-x-transition>

      <div class="burger">
        <img
          src="~/static/icons/filters-burger.svg"
          alt="burger"
          @click="hideFilter = !hideFilter"
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TournamentsFilters',
  props:{
    availableFilters: {
      type: Object,
      default: () => ({}),
    },
    toggleFilter:{
      type: Function,
      default: null
    },
    setFilters:{
      type: Function,
      default: null
    },
    disabledFilter: {
      type: Boolean,
      default: false,
    },
    initFilterList: {
      type: Array,
      default: () => ([
        {
          title: 'Held on',
          name: 'repeat',
        },
        {
          title: 'Game type',
          name: 'gameType',
        },
        {
          title: 'Platform',
          name: 'platform',
        }
      ]),
    },
    addToDefaultFilter: {
      type: Array,
      default: () => ([]),
    },
    filtersParams: {
      type: Object,
      default: () => ({}),
    },
    isQuery: {
      type: Boolean,
      default: true,
    },
  },
  data: () =>  ({
    hideFilter: false,
  }),
  computed: {
    filtersList() {
      return [...this.initFilterList, ...this.addToDefaultFilter].map((item) => {
        return ({
          ...item,
          options: this.availableFilters[item.name] || [],
        });
      });
    },
  },
  mounted() {
    this.initializeFilters();
  },
  methods:{
    initializeFilters(){
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/colors.scss";
  @import "~/assets/styles/sizes.scss";


  .filters-list-wrapper {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 1% 100%, 0% 89%);
    background: rgba(161, 175, 211, 0.2);
    padding: 1px;
    margin-bottom: 40px;

    .burger {
      width: 100%;
      margin-left: auto;
      max-width: 50px;
      flex: 0 0 50px;
      text-align: right;
      padding: 15px 20px 0 0;
      img {
        cursor: pointer;
      }
    }
    .filters-list {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding-right: 50px;
      width: 100%;
      max-width: calc(100% - 50px);
      flex: 0  0 calc(100% - 50px);
      &__inner {
        background: $app-background;
        min-height: 70px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 1% 100%, 0% 89%);
        padding: 12px 8px 2px;
      }

      &--col-3 {
        padding-right: 0;
        .tournament-filter {
          width: 100%;
          max-width: 33.333333%;
          flex: 0 0 33.333333%;
        }
      }

      .tournament-filter {
        padding-bottom: 7px;

        .options {
          display: flex;
          flex-wrap: wrap;
        }
        .tournament-filter-title {
          font-weight: 800;
          font-size: 12px;
          display: flex;
          align-items: center;
          letter-spacing: 0.04em;
          text-transform: uppercase;
          color: $text-primary-color;
          margin-left: 16px;
        }

        .tournament-filter-option{
          font-weight: 800;
          font-size: 14px;
          line-height: .94;
          display: flex;
          align-items: center;
          padding: 8px 12px;
          margin: 3px;
          color: $text-hover-color;

          &:hover{
            color: $accent-error-color;
            cursor: pointer;
          }

          &.active-filter{
            background-color: rgba(190, 19, 56, 0.2);
            color: $accent-error-color;
          }
        }
      }
    }
  }

  .disabledFilter.filters-list-wrapper .filters-list .tournament-filter {
    &-option {
      &:hover {
        cursor: not-allowed;
      }
    }
  }



  @media all and (max-width: $laptop-width) {
    .filters-list-wrapper {
      .filters-list {
        &__inner {
          padding: 10px;
          min-height: 67px;
        }
        .tournament-filter {
          .tournament-filter-title {
            margin-left: 13px;
          }
          .tournament-filter-option {
            padding: 8px 10px;
          }
        }
      }
    }
  }
  @media all and (max-width: $tablet) {
    .filters-list-wrapper {
      clip-path: none;
      background: transparent;
      position: relative;
      margin-bottom: 16px;
      &.filters--show {
        .filters-list {
          &__inner {
            padding: 56px 0 0;
          }
        }
      }
      .filters-list {
        padding: 15px 0;
        border-top: 2px solid  rgba(161,175,211, 0.5);
        border-bottom: 2px solid  rgba(161,175,211, 0.5);
        &__inner {
          clip-path: none;
          padding: 0;
          flex-direction: column-reverse;
          justify-content: flex-end;
          background: transparent;
          min-height: 40px;
        }
        .tournament-filter {
          max-width: 100%;
          flex: 0 0 100%;
        }
        .tournament-filter {
          width: 100%;
          margin-bottom: 0;
          &:not(:last-child) {
            margin-bottom: 24px;
          }
          .tournament-filter-title {
            margin-bottom: 10px;
          }
        }
      }
      .burger {
        padding: 0;
        position: absolute;
        top: 0;
        right: 0;
        img {
          padding: 10px;
          border: 1px solid $text-primary-color;
          height: 40px;
          width: 40px;
        }
      }
      .burger,
      .filters-list {
        max-width: 100%;
        flex: 0 0 100%;
      }
    }
  }
</style>
