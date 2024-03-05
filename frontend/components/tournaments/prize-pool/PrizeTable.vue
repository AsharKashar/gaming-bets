<template>
  <div class="prize-table__wrap">
    <div class="prize-table">
      <div class="prize-table__heading">
        <div class="prize-table__row">
          <div
            v-for="item in heading"
            :key="item"
            class="prize-table__col"
            v-text="item"
          />
        </div>
      </div>
      <div class="prize-table__body">
        <div
          v-for="item in body"
          :key="item.id"
          class="prize-table__row"
        >
          <div
            class="prize-table__col prize-table__col--place"
            v-text="item.position"
          />
          <div
            class="prize-table__col prize-table__col--team"
            v-text="item.teams.name"
          />
          <div
            class="prize-table__col prize-table__col--wl"
            v-text="item.prize"
          />
          <div
            class="prize-table__col prize-table__col--wr"
            v-text="item.prize"
          />
        </div>
      </div>
    </div>
    <pagination
      class="justify-end"
      :page="page"
      :total="totalPage"
      :set-page="setPage"
    />
  </div>
</template>

<script>
import Pagination from 'components/Pagination';

export default {
  name: 'PrizeTable',
  components: { Pagination },
  props: {
    heading: {
      type: Array,
      default: () => ['place', 'team', 'wl', 'wr'],
    },
    body: {
      type: Array,
      default: () => [
        {
          id: 1,
          teams: {
            name: 'AJD Go',
          },
          position: 1,
          prize: 10,
        },
        {
          id: 2,
          teams: {
            name: 'AJD Go',
          },
          position: 1,
          prize: 20,
        },
        {
          id: 3,
          teams: {
            name: 'AJD Go',
          },
          position: 1,
          prize: 30,
        },
      ],
    },
    totalPage: {
      type: Number,
      default: 1,
    },
  },
  data: () => ({
    page: 1,
  }),
  methods: {
    setPage(page) {
      this.page = page;
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
.prize-table {
  font-size: 24px;
  color: $text-primary-color;
  letter-spacing: 0.05em;
  padding-bottom: 45px;
  &__wrap {
    padding-bottom: 40px;
  }
  &__heading {
    font-weight: 800;
    text-transform: uppercase;
    padding-bottom: 16px;
    .prize-table__row {
      border-bottom-width: 2px;
      padding-bottom: 21px;
    }
  }
  &__row {
    display: flex;
    padding: 16px 0 8px;
    border-bottom: 1px solid $border-secondary-color;
  }

  &__col {
    width: 100%;
    flex: 0 0 25%;
    max-width: 25%;
  }
}
</style>
