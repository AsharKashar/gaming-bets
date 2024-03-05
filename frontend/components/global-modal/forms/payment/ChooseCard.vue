<template>
  <div class="custom-forms">
    <div class="form-heading modal-heading">
      <a
        href="#"
        class="modal-subtitle d-flex"
        @click.prevent="goBack"
      >
        <svg-icon
          class="mr-1"
          name="prev"
        /> {{ $t('Go Back') }}
      </a>
      <div class="modal-title">
        {{ $t('Choose Card') }}
      </div>
    </div>
    <div class="choose-card">
      <div class="choose-card__inner">
        <payment-card
          v-for="i in 2"
          :key="i"
          :card-id="i"
          :class="{active: i === activeCard}"
          @clickCard="setActiveCard($event)"
        />
      </div>
    </div>
    <div class="choose-card__action">
      <default-button
        btn-class="button-block choose-card--add-card"
        :on-click="() => setActiveModal(newPaymentModal)"
      >
        + {{ $t('Add New Payment Method') }}
      </default-button>
    </div>
    <payment-actions
      :complete="true"
      :submit-payment="() => {}"
    />
  </div>
</template>

<script>
import { PAYMENT_STEPS } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import PaymentCard from 'components/CardsGrid/cards/PaymentCard';
import DefaultButton from 'components/DefaultButton';
import PaymentActions from './PaymentActions';
import SvgIcon from 'components/svgIcons/SvgIcon';
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'ChooseCard',
  components: {SvgIcon, PaymentActions, DefaultButton, PaymentCard},
  data: () => ({
    activeCard: null,
  }),
  computed: {
    newPaymentModal() {
      return ({
        type: 'Payment',
        options: {step: PAYMENT_STEPS.ADD_CARD}
      });
    }
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal']),
    goBack() {
      this.setActiveModal({type: 'Payment',options: {step: PAYMENT_STEPS.SETUP}});
    },
    setActiveCard(cardId) {
      this.activeCard = cardId === this.activeCard ? null : cardId;
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";

  .choose-card {
    &__inner {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -10px 18px;
    }
    &--add-card {
      border: 1px solid $border-primary-color;
      color: $text-secondary-color;
      &:hover {
        background: $text-secondary-color;
        color: $text-hover-color;
      }
    }
    &__action {
      margin-bottom: 32px;
    }
  }
</style>
