<template>
  <div>
    <v-row align-items="right">
      <v-col
        sm="2"
        offset="7"
        class="sort"
        align="right"
      >
        {{ $t('Sort By') }} :
      </v-col>
      <v-col
        sm="3"
        align-content="right"
      >
        <v-select
          :items="items"
          value="All"
          :menu-props="{ offsetY: true }"
        />
      </v-col>
    </v-row>
    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">
              {{ $t('ID') }}
            </th>
            <th class="text-left">
              {{ $t('Account Number') }}
            </th>
            <th class="text-left">
              {{ $t('Account Holder Name') }}
            </th>
            <th class="text-left">
              {{ $t('Bank Name') }}
            </th>
            <th class="text-left">
              {{ $t('Last 4') }}
            </th>
            <th class="text-left">
              {{ $t('Account Holder Type') }}
            </th>
            <th class="text-left">
              {{ $t('Currency') }}
            </th>
            <th class="text-left">
              {{ $t('Routing Number') }}
            </th>
            <th class="text-left">
              {{ $t('DATE') }}
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
              {{ history.account_number }}
            </td>
            <td class="colored">
              {{ history.account_holdername }}
            </td>
            <td class="colored">
              {{ history.bank_name }}
            </td>
            <td class="colored">
              {{ history.last4 }}
            </td>
            <td class="colored">
              {{ history.account_holdertype }}
            </td>
            <td class="colored">
              {{ history.currency }}
            </td>
            <td class="colored">
              {{ history.routing_number }}
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
      HistoryData: '',
      items: ['All', 'Foo', 'Bar', 'Buzz'],
    };
  },
  computed: {
    ...mapState(['user'])
  },
  created() {
    this.HistoryData = this.$bangerApi
      .get('profile/getWithdrawal')
      .then(response => {
        this.HistoryData = response.data.data;
      });
  }
};
</script>

<style scoped>
.v-data-table {
  background-color: transparent !important;
  font-family: Telegraf-Regular, serif;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  color: #A1AFD3;
}
.colored {
  color: #be1338;
}
  .sort{
    font-family: Telegraf-UltraBold;
    font-weight: 800;
    padding: 36px 0px;
    text-transform: uppercase;
    color:#A1AFD3;
    font-size: 16px;
  }
.mdi-menu-down::before {
    color:red !important;
  }
  .v-list{
    background-color:rgb(17, 21, 66);
  }
</style>
