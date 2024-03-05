<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="membership-container">
    <Loader :loading="loading" />
    <!-- TODO::Add membership check!-->

    <p class="main-title mb-6">
      Membership
    </p>
    <membership-info
      v-if="currentMembership"
      :membership="currentMembership"
    />
    <div
      v-if="currentMembership"
      class="action-btn-block"
    >
      <default-button
        type="button"
        :on-click="tougleMembershipPlans"
        class="secondary-banger-btn"
      >
        {{ $t('Change membership') }}
      </default-button>
      <div class="cancel-membership">
        {{ $t('Cancel membership') }}
      </div>
    </div>
    <div v-if="memberShipIsActive==true">
      <active-memberShip
        :active-member-ship-data="activeMemberShipData"
        :user-id="user.id"
        @changeMembership="changeMembership"
      />
    </div>
    <div v-if="toggleMembership==false">
      <div v-if="showPlans">
        <membership-plans
          :show-info-message="!currentMembership"
          :selected-membership="currentMembership"
          :set-selected-membership="setSelectedMembership"
        />
      </div>
      <div class="btn-wrapper">
        <default-button
          v-if="selectedMembership.id"
          type="button"
          class="get-membership secondary-banger-btn"
          :on-click="()=> showModal = true"
        >
          {{ $t('Get membership') }}
        </default-button>
      </div>
    </div>
    <default-modal
      :close-modal="()=> showModal = false"
      :show="showModal"
      min-width="auto"
      persistent
    >
      <member-confirmation @closeModal="showModal = false" />
    </default-modal>
  </div>
</template>

<script>
import MembershipInfo from 'components/MembershipInfo';
import MembershipPlans from 'components/MembershipPlans';
import DefaultButton from 'components/DefaultButton.vue';
import DefaultModal from 'components/modals/DefaultModal';
import MemberConfirmation from 'components/membership/MemberConfIrmation';
import ActiveMemberShip from 'components/membership/activeMemberShip';
import Loader from 'components/Loader.vue';
import { createNamespacedHelpers } from 'vuex';
const membershipModule = createNamespacedHelpers('membership');
const auth = createNamespacedHelpers('auth');
import { APP_URL } from 'configs/config';

export default {
  name: 'MemberShip',
  components: {
    MembershipInfo,
    DefaultButton,
    MembershipPlans,
    DefaultModal,
    MemberConfirmation,
    ActiveMemberShip,
    Loader,
  },
  middleware: ['hideHeader'],
  data: () => ({
    showMembershipPlans: false,
    currentMembership: false,
    selectedMembership: {},
    showModal: false,
    toggleMembership: true,
  }),
  computed: {
    ...membershipModule.mapState([
      'membershipPackages',
      'selectMemberShip',
      'memberShipIsActive',
      'activeMemberShipData',
      'isSubscribed',
      'membershipStatus',
    ]),
    ...auth.mapState(['user']),
    loading() {
      return this.membershipStatus === 'pending';
    },
    showPlans() {
      return (
        (!this.currentMembership || this.showMembershipPlans) &&
        this.membershipPackages.length > 0
      );
    },
  },
  watch: {
    async isSubscribed() {
      if (this.isSubscribed) {
        await this.checkMemberShipActive(this.user.id);
        this.showModal = false;
        this.toggleMembership = true;
      } else {
        this.toggleMembership = false;
        this.setIsMemberShipActive(false);
      }
    },
  },
  mounted() {
    this.toggleMembership = this.memberShipIsActive;
  },
  async created() {
    await this.checkMemberShipActive(this.user.id);
    if (!this.memberShipIsActive) {
      await this.getMembershipPackages();
      this.currentMembership = false;
      this.selectedMembership = this.membershipPackages[0];
    } else {
      await this.getMembershipPackages();
    }
  },
  methods: {
    ...membershipModule.mapActions([
      'getMembershipPackages',
      'checkMemberShipActive',
      'setIsMemberShipActive',
    ]),
    tougleMembershipPlans() {
      this.showMembershipPlans = !this.showMembershipPlans;
    },
    setSelectedMembership(membership) {
      this.selectedMembership = membership;
    },
    async changeMembership() {
      this.toggleMembership = !this.toggleMembership;
      await this.getMembershipPackages();
    },
  },
  head () {
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
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.membership-container {
  width: 100%;
      padding: 15px 0 0 0;
   .main-title {
   font-weight: 900;
    font-size: 32px;
    line-height: 115%;
    color: $text-primary-color;
   }
}

.action-btn-block {
  display: flex;
  align-items: center;
  margin-top: 32px;

  &::v-deep .secondary-banger-btn {
    font-size: 12px;
    letter-spacing: 0.05em;
    padding: 12px 25px;
  }

  .cancel-membership {
    margin-left: 36px;
    color: $text-primary-color;
    text-decoration: underline;
    font-size: 15px;
  }
}

@media only screen and (min-width: $min-resolution) {
  .membership-container {
    // padding: 45px 0 0;
  }

  .btn-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 53px;
  }

  .get-membership {
    font-size: 24px;
    padding: 16px 32px;
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .get-membership {
    margin-top: 26px;
    font-size: 24px;
    letter-spacing: 0.05em;
    padding: 16px 35px;
    display: block;
  }

  .action-btn-block {
    margin-bottom: 48px;
  }

  .btn-wrapper {
    display: block;
    margin-top: 0;
  }
}

@media only screen and (min-width: $desktop-width) {
  .membership-container {
    // padding: 5px 144px 0 89px;
  }

  .get-membership {
    margin-top: 51px;
    font-size: 18px;
    letter-spacing: 0.05em;
    padding: 12px 25px;
  }
}
</style>
