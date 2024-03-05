<template>
  <div
    class="custom-forms"
  >
    <component
      :is="currentStep"
    />
  </div>
</template>

<script>

import SetupPaymentMethod from 'components/global-modal/forms/payment/SetupPaymentMethod';
import AddNewCard from 'components/global-modal/forms/payment/AddNewCard';
import ChooseCard from 'components/global-modal/forms/payment/ChooseCard';

import { createNamespacedHelpers } from 'vuex';
import { PAYMENT_STEPS } from 'helpers/constants';
import get from 'lodash/get';
const modalModule = createNamespacedHelpers('modal');
const paymentModule = createNamespacedHelpers('payments');

export default {
  name: 'Payment',
  components: {
    SetupPaymentMethod,
    AddNewCard,
    ChooseCard
  },
  computed: {
    ...modalModule.mapState(['activeModal','modalOptions']),
    currentStep(){
      return get(this, 'modalOptions.step', PAYMENT_STEPS.SETUP);
    }
  },
  mounted() {
    this.getSavedCards();
  },
  methods: {
    ...paymentModule.mapActions(['getSavedCards']),
    buyCoins() {
      this.setActiveModal({type:'Payment', options:{ step:PAYMENT_STEPS.SETUP }});
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";
</style>
