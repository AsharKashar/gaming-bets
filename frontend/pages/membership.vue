<template>
  <div
    v-if="membershipPackages.length>0"
    class="membership-container"
  >
    <membership-plans />
  </div>
</template>

<script>
import MembershipPlans from 'components/MembershipPlans';
import { APP_URL } from 'configs/config';
import { createNamespacedHelpers } from 'vuex';
const membershipModule = createNamespacedHelpers('membership');

export default {
  name: 'Membership',
  components: {
    MembershipPlans
  },
  async asyncData(ctx) {
    const { store } = ctx;
    await store.dispatch('membership/getMembershipPackages');
  },
  computed: {
    ...membershipModule.mapState(['membershipPackages']),
  },
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Membership',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  @media only screen and (min-width: $min-resolution) {
    .membership-container{
      padding: 20px 15px 100px;
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .membership-container{
      padding: 50px 0 100px;
    }
  }

  @media all and (min-width: $desktop-width) {
    .membership-container{
      padding: 50px 15% 100px;
    }
  }
</style>
