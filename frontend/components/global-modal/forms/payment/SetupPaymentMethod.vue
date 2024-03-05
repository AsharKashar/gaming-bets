<template>
  <div>
    <div class="title-block">
      <div class="modal-title">
        {{ $t('Setup payment method') }}
      </div>
      <div class="modal-subtitle">
        {{ $t('Choose Card Type') }}
      </div>
    </div>
    <div class="payment-cards">
      <div
        class="payment-card"
        @click="cardsStep"
      >
        <div class="card-title">
          <div class="text">
            {{ $t('Credit or debit card') }}
          </div>
          <div class="arrow">
            <img src="~/static/icons/arrow.svg">
          </div>
        </div>
        <div class="card-icons">
          <img
            src="~/static/icons/visa.svg"
            alt="Visa"
            class="visa"
          >
          <img
            src="~/static/icons/mastercard.svg"
            alt="MasterCard"
            class="mastercard"
          >
          <img
            src="~/static/icons/american-express.svg"
            alt="Visa"
            class="american-express"
          >
        </div>
      </div>
      <div class="payment-card disabled-method">
        <div class="card-title">
          <div class="text">
            {{ $t('Proceed with PayPal') }}
          </div>
          <div class="arrow">
            <img
              src="~/static/icons/arrow.svg"
              alt="arrow"
            >
          </div>
        </div>
        <div class="card-icons">
          <img
            src="~/static/icons/pay-pal.svg"
            alt="PayPal"
            class="pay-pal"
          >
        </div>
      </div>
    </div>
    <div class="summary-block">
      <div class="left-side">
        <img
          src="~/static/icons/small_bombs_bunch.png"
          alt="bunch"
        >
        <div class="bombs">
          {{ commonData.bombsPackage.bombs }} {{ $t('bombs') }}
        </div>
      </div>
      <div class="separator" />
      <div class="right-side">
        {{ $t('Total') }}: €{{ commonData.bombsPackage.price }}
      </div>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { PAYMENT_STEPS } from 'helpers/constants';

const modalModule = createNamespacedHelpers('modal');
const paymentsModule = createNamespacedHelpers('payments');

export default {
  name: 'SetupPaymentMethod',
  computed: {
    ...paymentsModule.mapState(['savedCards']),
    ...modalModule.mapState(['commonData']),
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal']),
    cardsStep() {
      if (this.savedCards.length > 0) {
        this.setActiveModal({type: 'Payment', options: {step: PAYMENT_STEPS.CHOOSE_CARD}});
      } else {
        this.setActiveModal({type: 'Payment', options: {step: PAYMENT_STEPS.ADD_CARD}});
      }
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.title-block{
  display: flex;
  flex-direction: column;
  color: $text-secondary-color;
  margin-bottom: 32px;

  .modal-title{
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 32px;
    line-height: 120%;
  }

  .modal-subtitle{
    font-family: Telegraf-Regular, serif;
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    line-height: 120%;
  }
}

.payment-cards{
  display: flex;
  justify-content: space-between;

  .payment-card{
    border: 2px solid rgba(161, 175, 211, 0.2);
    box-sizing: border-box;
    border-radius: 8px;
    flex-basis: 49%;
    min-height: 120px;
    max-height: 120px;
    padding: 24px 26px;
    cursor: pointer;
    user-select: none;

    &:hover{
      border-color: $border-primary-color;
    }

    &.disabled-method{
      &:hover{
        border-color: rgba(161, 175, 211, 0.2);
      }
    }

    .card-title{
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;

      .arrow{
        display: flex;
      }
    }

    .card-icons{
      display: flex;
      align-items: center;
      justify-content: space-between;

      .visa{
        height: 16px;
      }
      .mastercard{
        height: 21px;
      }
      .american-express{
        height: 31px;
      }
    }
  }
}

.summary-block{
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 55px;
  background: rgba(161, 175, 211, 0.2);
  border-radius: 8px;
  margin-top: 46px;
  padding: 6px 26px;

  .left-side, .right-side{
    display: flex;
    align-items: center;
    flex-basis: 47%;
  }

  .left-side{
    img{
      height: 44px;
    }
    .bombs{
      font-size: 20px;
      line-height: 21px;
      display: flex;
      align-items: center;
      text-transform: uppercase;
      margin-left: 24px;
    }
  }
  .right-side{
    justify-content: center;
    font-weight: 800;
    font-size: 20px;
    line-height: 21px;
    display: flex;
    align-items: center;
    text-align: center;
    color: $border-primary-color;
  }

  .separator{
    background: #E7E7E7;
    opacity: 0.5;
    height: 100%;
    width: 1px;
  }
}

@media only screen and (min-width: $min-resolution) {
  .payment-cards{
    flex-wrap: wrap;

    .payment-card {
      min-width: 100%;
      margin-bottom: 20px;
    }
  }
  .summary-block{
    padding: 6px;
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .payment-cards{
    flex-wrap: nowrap;

    .payment-card {
      min-width: auto;
      margin-bottom: 0;
    }
  }

  .summary-block{
    padding: 24px 26px;
  }
}


</style>
