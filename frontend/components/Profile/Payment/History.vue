<template>
  <div class="payment-history">
    <v-row align-items="right">
      <v-col
        sm="2"
        offset="7"
        class="sort"
        align="right"
      >
        {{ $t("Sort By") }} :
      </v-col>
      <v-col
        sm="3"
        align-content="right"
      >
        <v-select
          v-model="sortBy"
          :items="items"
          item-text="title"
          item-value="name"
          :menu-props="{ offsetY: true }"
        />
      </v-col>
    </v-row>

    {{ Historydetail }}
    <v-simple-table :loading="loading">
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">
              {{ $t("ID") }}
            </th>
            <th class="text-left">
              {{ $t("NAME") }}
            </th>
            <th class="text-left">
              {{ $t("AMOUNT") }}
            </th>
            <th class="text-left">
              {{ $t("DATE") }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(history, i) in HistoryData"
            :key="i"
          >
            <td>#{{ history.id }}</td>
            <td>
              <!-- {{ history.JSON.parse(response_pay) }} -->
              <!-- {{ $t("Payment Description") }} -->
            </td>
            <td class="colored">
              - {{ history.pay }} €
            </td>
            <td class="colored">
              {{ history.formated_date }}
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('auth');
export default {
  name: 'History',
  data() {
    return {
      HistoryData: [],
      Historydetail: [],
      loading: false,
      sortBy: 'all',
      items: [
        {
          name: 'all',
          title: 'All',
        },
        {
          name: 'id',
          title: 'ID',
        },
        {
          name: 'name',
          title: 'NAME',
        },
        {
          name: 'pay',
          title: 'AMOUNT',
        },
        {
          name: 'formated_date',
          title: 'DATE',
        },
      ],
    };
  },
  computed: {
    ...mapState(['user']),
    paymentHistory() {
      /* eslint-disable */
      if (this.sortBy === "all" && this.sortBy === "name")
        return this.HistoryData;
      return this.HistoryData.sort((a, b) =>
        a[this.sortBy] > b[this.sortBy] ? 1 : -1
      );
      /* eslint-disable */
    },
   
  },

  
  created() {
    this.loading = true;
    this.$bangerApi
      // .get(`/payment/payment-history/{10}`)
      .get('/payment/payment-history/10')
      .then((response) => {
        debugger;
        this.HistoryData = response.data;
        console.log("testing",JSON.parse(this.HistoryData.response_pay[1]))
    
        // this.Historydetail = JSON.parse(this.HistoryData.response_pay)
      })
      .finally(() => {
        this.loading = false;
      });
  },
};
</script>

<style scoped lang="scss">
.v-data-table {
  background-color: transparent !important;
  font-family: Telegraf-Regular, serif;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  color: #a1afd3;
}
.colored {
  color: #be1338;
}
.sort {
  font-family: Telegraf-UltraBold;
  font-weight: 800;
  padding: 36px 0px;
  text-transform: uppercase;
  color: #a1afd3;
  font-size: 16px;
}
.mdi-menu-down::before {
  color: red !important;
}
.v-list {
  background-color: rgb(17, 21, 66);
}
.payment-history {
  &::v-deep .v-select {
    .v-text-field > .v-input__control > .v-input__slot:before {
      border-color: rgba(161, 175, 211, 0.2);
    }
    .v-input__icon {
      i {
        color: #be1338;
      }
    }
    .v-select__selections {
      font-weight: 900;
      font-size: 16px;
      line-height: 120%;
      color: #e7e7e7;
    }
  }
}
</style>
