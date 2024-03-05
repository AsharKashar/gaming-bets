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
        {{ $t('Add New Card') }}
      </div>
    </div>

    <div class="card-fields">
      <div class="input-wrapper">
        <label class="input-col">{{ $t('Name') }}</label>
        <div class="input-col">
          <input
            v-model.trim="name"
            placeholder="Jane Cooper"
            :class="{'input-error': errorName}"
            @change="errorName = !name.length"
          >
        </div>
      </div>
      <div class="input-wrapper">
        <label
          class="input-col"
        >{{ $t('Card Number') }}</label>
        <div
          ref="cardNumber"
          class="input-col"
        />
      </div>
      <div class="input-wrapper input-wrapper--group">
        <div class="input-col">
          <label>{{ $t('Expiry Date') }}</label>
          <div ref="cardExpiry" />
        </div>

        <div class="input-col">
          <label>{{ $t('CVV') }}</label>
          <div ref="cardCvc" />
        </div>
      </div>
    </div>

    <payment-actions
      :complete="!!complete"
      :submit-payment="() => submitPayment()"
    />
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import { STRIPE_API_KEY } from 'config';
import Vue from 'vue';
import { PAYMENT_STEPS } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import get from 'lodash/get';
import SvgIcon from 'components/svgIcons/SvgIcon';
import PaymentActions from './PaymentActions';

const bombsModule = createNamespacedHelpers('bombs');
const authModule = createNamespacedHelpers('auth');
const modalModule = createNamespacedHelpers('modal');
const paymentsModule = createNamespacedHelpers('payments');
const style = {
  base: {
    color: '#A1AFD3',
    background: '#010431',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',

    fontSize: '16px',
    lineHeight: 1.4,
    '::placeholder': {
      color: '#737ea5',
      fontWeight: '400',
    },
  },
  invalid: {
    color: '#be1338',
    iconColor: '#be1338',
  },
  focused: {
    color: '#A1AFD3',
    iconColor: '#be1338',
  },
};


export default {
  name: 'AddNewCard',
  components: {
    PaymentActions,
    SvgIcon,
  },
  data: () => ({
    cardCvc: '',
    cardExpiry: '',
    cardNumber: '',
    stripe: null,
    stripeElements: null,
    name: '',
    errorName: false,
    load: false,
  }),
  computed: {
    ...authModule.mapState(['user']),
    ...modalModule.mapState(['commonData']),
    ...paymentsModule.mapState(['savedCards']),
    complete(){
      return this.cardCvc._complete && this.cardExpiry._complete && this.cardNumber._complete && this.name.length;
    }
  },
  mounted() {
    this.innitStripe();
  },
  methods: {
    ...bombsModule.mapActions([
      'buyBombPackage'
    ]),
    ...modalModule.mapMutations(['setActiveModal']),
    goBack() {
      this.setActiveModal({type: 'Payment',options: {step: PAYMENT_STEPS.SETUP}});
    },
    async innitStripe() {
      this.stripe = await loadStripe(STRIPE_API_KEY);
      this.elements = this.stripe.elements();

      this.cardCvc = this.elements.create('cardCvc', {
        style: style,
        placeholder: '***',
      });
      this.cardExpiry = this.elements.create('cardExpiry', {
        style: style,
        placeholder: 'MM/YY',
      });
      this.cardNumber = this.elements.create('cardNumber', {
        style: style,
        placeholder: 'XXXX-XXXX-XXXX-XXXX',
      });

      const { cardCvc, cardExpiry, cardNumber } = this.$refs;

      this.cardCvc.mount(cardCvc);
      this.cardExpiry.mount(cardExpiry);
      this.cardNumber.mount(cardNumber);
    },
    async submitPayment() {

      const stripeResult = await this.stripe.createToken(this.cardNumber);
      const token = get(stripeResult, 'token.id', '');

      if (!token) {
        Vue.notify({
          group: 'custom-notification',
          title: 'Error',
          text: 'Payment failed. Please try again later.',
          type: 'error'
        });
        return;
      }

      const user = await this.buyBombPackage({
        name: this.user.name,
        tokenId: token,
        saveCard: 0,
        packageID: this.commonData.bombsPackage.id
      });

      if (!user) {
        Vue.notify({
          group: 'custom-notification',
          title: 'Error',
          text: 'Something went wrong.',
          type: 'error'
        });
        return;
      }

      if(user.all_bombs<=this.commonData.tournament.entry_fee) {
        Vue.notify({
          group: 'custom-notification',
          title: 'Error',
          text: 'Not enough bomb!',
          type: 'error'
        });

        this.setActiveModal({type: 'NotEnoughCoins'});

        return;
      }

      this.setActiveModal({type: 'TournamentTeamModal'});
    },
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";

  .color-red,
  .input-error {
    color: $text-secondary-color;
    &::placeholder {
      color: $text-secondary-color!important;
    }
  }

  .input-wrapper {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid $text-primary-color;
    input {
      width: 100%;
      border: none;
      line-height: 1.4;
      color: $text-primary-color;
      &::placeholder {
        color: #737ea5;
      }
      &:focus {
        outline: none;
      }
    }
    .input-col {
      width: 100%;
      max-width: calc(100% - 200px);
      flex: 0 0 calc(100% - 200px);
    }
    label {
      padding-right: 33px;
      line-height: 1.4;
      text-align: right;
      width: 100%;
      &.input-col {
        flex: 0 0 200px;
        max-width: 200px;
      }
    }
    &--group {
      .input-col {
        display: flex;
        flex: 40%;
        max-width: 60%;
        &:first-child {
          flex: 0 0 60%;
          max-width: 60%;
          label {
            flex: 0 0 200px;
            max-width: 200px;
          }
          & > div {
            width: 100%;
            max-width: calc(100% - 200px);
            width: calc(100% - 200px);
          }
        }
        &:last-child {
          label {
            max-width: calc(100% - 80px);
            width: calc(100% - 80px);
          }
          & > div {
            width: 100%;
            max-width: 80px;
            flex: 80px;
          }
        }
      }
    }
  }
  .card-fields {
    margin-bottom: 30px;
  }

</style>
