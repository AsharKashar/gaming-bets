<template>
  <div class="store">
    <div class="title-block">
      <div class="store-title">
        {{ $t('Store') }}
      </div>
      <user-info-heading />
    </div>
    <bomb-coins />
  </div>
</template>

<script>
import UserInfoHeading from 'components/UserInfoHeading';
import BombCoins from 'components/BombCoins';
import { APP_URL } from 'configs/config';

export default {
  name: 'Store',
  middleware: ['hideHeader'],
  components: {
    BombCoins,
    UserInfoHeading
  },
  async asyncData(ctx) {
    const { store } = ctx;
    await store.dispatch('bombs/getBombPackages');
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Store',
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

<style scoped lang="scss">
  .store {
    padding: 0 12.5%;

    .title-block {
      margin-top: 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;

      .store-title{
        font-size: 24px;
        font-style: normal;
        font-weight: 900;
        line-height: 37px;
        letter-spacing: 0.02em;
        text-align: left;
      }
    }
  }
</style>
