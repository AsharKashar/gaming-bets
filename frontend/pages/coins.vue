<template>
  <bomb-coins />
</template>

<script>
import BombCoins from 'components/BombCoins';
import { APP_URL } from 'configs/config';

export default {
  name: 'Coins',
  components: {
    BombCoins
  },
  async asyncData(ctx) {
    const { store } = ctx;
    await store.dispatch('bombs/getBombPackages');
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Coins',
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
