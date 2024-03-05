<template>
  <div>
    <Loader :loading="false" />
    <div class="conformation-box-wrapper">
      <div class="header-info">
        <p class="from-title">
          {{ title }}
        </p>
        <p class="steps-title">
          {{ subTitle }}
        </p>
      </div>
      <div class="body-info">
        <input-group
          :value="cardName"
          name="cardName"
          :on-change="setField"
          :label="$t('Card Name')"
          placeholder="Stripe Card"
          type="text"
        />
        <div class="input-wrapper wrapper-card">
          <div class="label-wrapper">
            <label
              for="card-number"
              class="label"
            >{{ $t('Card Number') }}*</label>
            <p
              for="card-number"
              class="error-stripe"
            >
              {{ $t('16 digt number') }}
            </p>
          </div>
          <div id="card-number" />
        </div>
        <div class="input-wrapper">
          <label
            for="card-cvc"
            class="label"
          >{{ $t('CVV') }}*</label>
          <div id="card-cvc" />
        </div>
        <div class="input-wrapper">
          <label
            for="card-cvc"
            class="label"
          >{{ $t('Expiry Date') }}*</label>
          <div id="card-expiry" />
        </div>
      </div>

      <p class="steps-title">
        {{ error }}
      </p>
      <div class="footer-info">
        <default-button
          type="button"
          class="default-banger-btn button-block"
          :on-click="subscription"
          :disabled="disable"
        >
          {{ $t('Confirm') }}
        </default-button>
      </div>
    </div>
  </div>
</template>


<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton.vue';

import { loadStripe } from '@stripe/stripe-js';
import { STRIPE_API_KEY } from 'config';

import { createNamespacedHelpers } from 'vuex';
const membershipModule = createNamespacedHelpers('membership');
const auth = createNamespacedHelpers('auth');
import Loader from 'components/Loader';
var stripe;
var elements;
export default {
  components: {
    DefaultButton,
    InputGroup,
    Loader
  },
  data() {
    return {
      cardName: '',
      cardCvc: '',
      cardExpiry: '',
      cardNumber: '',
      stripe: '',
      stripeToken: null,
      error: null,
      disable: true,
      title: 'Confirmation',
      subTitle: 'Kindly read instruction carefully',

      loading: true,
      options: {
        style: {
          base: {
            color: '#A1AFD3',
            fontSize: '18px',
            fontWeight: 100,

            '::placeholder': {
              color: '#A1AFD3',
              fontSize: '18px',
              fontWeight: 100,
            },
          },
        },
      },
    };
  },
  computed: {
    ...auth.mapState(['user']),
    ...membershipModule.mapState(['selectMemberShip', 'membershipStatus']),

    loader() {
      return this.membershipStatus !== 'pending';
    },
  },
  watch: {
    cardName(val) {
      if (val == null || val.length === 0) {
        this.error = 'Kindly Enter Name';
        this.disable = true;
      } else {
        this.error = '';
        this.disable = false;
      }
    },
  },
  async created() {
    stripe = await loadStripe(STRIPE_API_KEY);

    elements = stripe.elements();

    var style = {
      base: {
        color: '#a1afd3',
        background: '#010431',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontWeight: '500',

        fontSize: '18px',
        '::placeholder': {
          color: '#aab7c4',
          fontWeight: '500',
        },
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
      },
    };

    let cvc = document.getElementById('card-cvc');
    let ce = document.getElementById('card-expiry');
    let cn = document.getElementById('card-number');

    this.cardCvc = elements.create('cardCvc', {
      style: style,
      placeholder: '123',
    });
    this.cardExpiry = elements.create('cardExpiry', {
      style: style,
      placeholder: 'MM/YY',
    });
    this.cardNumber = elements.create('cardNumber', {
      style: style,
      placeholder: 'Enter number',
    });

    this.cardCvc.mount(cvc);
    this.cardExpiry.mount(ce);
    this.cardNumber.mount(cn);
    this.loading = false;
  },
  methods: {
    ...membershipModule.mapActions([
      'setMembershipPackages',
      'addPaymentMethod',
    ]),
    async subscription() {
      await stripe.createToken(this.cardNumber).then((result) => {
        if (result.error) {
          this.error = result.error.message;
        } else {
          this.stripeToken = result.token.id;
          this.addPaymentMethod({
            id: this.user.id,
            token: this.stripeToken,
            name: this.cardName,
          }).then(()=> {
            this.$emit('closeModal');
          });
        }
      });
    },
    setField(name, value) {
      this[name] = value;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.input-wrapper {
  display: flex;
  justify-items: center;
  align-items: center;
  background: #010431;
  border-bottom: 1px solid #a1afd3;
  .label-wrapper {
  }

  .label {

    font-weight: 600;
    margin: 0;
    padding: 0;
    padding: 10px 0 10px 0px;
    font-size: 18px;
    color: #a1afd3;
    flex-basis: 55%;
  }
}

.StripeElement {
  width: 93%;
}
.error-stripe {
  font-size: 14px;
  line-height: 94%;
  padding-top: 10px;
  color: #be1338;
}
#card-number {
  width: 60%;
  padding-left: 3.1em;
  align-self: flex-start;
}
.wrapper-card
{
  padding-top: 1em;
}
.conformation-box-wrapper {
  padding: 1.5em;
  .header-info {
    padding: 1em 0;
    .from-title,
    .steps-title {
      color: #be1338;
      margin: 3px 0;
    }

    .from-title {
      font-size: 32px;
      font-weight: 600;
    }

    .label-title {
      padding-top: 1em;
    }
  }

  .body-info {
    padding-top: 1em;
    padding-bottom: 3em;
  }

  .footer-info {
    padding-bottom: 1em;
  }
}
@media all and (max-width: $tablet-small-width) {
  .input-wrapper {
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    #card-number {
      padding-left: 0em;
      width: 100% !important;
    }
  }
  .StripeElement {
    padding-bottom: 0.8em !important;
  }
}
@media all and (max-width: $min-resolution) {
  .input-wrapper {
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    #card-number {
      padding-left: 0em;
      width: 100% !important;
    }
  }
  .StripeElement {
    padding-bottom: 0.8em !important;
  }
}
</style>
