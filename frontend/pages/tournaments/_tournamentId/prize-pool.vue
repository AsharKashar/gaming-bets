<router>
  {
    name: 'tournamentPrizePool',
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="tournament-item-tab tournament-item-tab--prize-pool">
    <awards-list />
    <prize-table />
  </div>
</template>

<script>
import AwardsList from 'components/tournaments/prize-pool/AwardsList';
import PrizeTable from 'components/tournaments/prize-pool/PrizeTable';
import { APP_URL } from 'configs/config';
export default {
  name: 'PrizePool',
  middleware: ['hideHeader'],
  components: {PrizeTable, AwardsList},
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Prize pool',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>
