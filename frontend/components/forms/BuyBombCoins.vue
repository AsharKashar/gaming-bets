<template>
  <div class="buy-coins">
    <Loader :loading="loader" />
    <div v-if="haveBuy==false">
      <div class="form-title-block">
        <p class="form-title">
          {{ $t('Bomb coins') }}
        </p>
        <p class="form-subtitle">
          {{ $t('Please enter your payment method to buy bombs.') }}
        </p>
      </div>
      <div class="input-wrapper">
        <label
          for="card-number"
          class="label"
        >Card Number</label>
        <div id="card-number" />
      </div>
      <p class="error-stripe">
        {{ error }}
      </p>
      <div class="inputs-wrapper">
        <div class="input-wrapper inputs-align-expiry">
          <label
            for="card-cvc"
            class="label"
          >{{ $t('Expiry Date') }}</label>
          <div id="card-expiry" />
        </div>
        <div class="input-wrapper inputs-align-cvv">
          <label
            for="card-cvc"
            class="label"
          >{{ $t('CVV') }}</label>
          <div id="card-cvc" />
        </div>
      </div>

      <div class="input-wrapper card-number-wrapper">
        <label
          for="card-number"
          class="label"
        >{{ $t('Discount code') }}</label>
        <input-group
          :placeholder="$t('Discount Code')"
          class="border-set"
          :value="discount"
          name="discount"
          :on-change="setField"
        />
      </div>

      <div class="footer-booms">
        <div class="left-footer">
          <div class="img-box">
            <img
              src="/img/small_bombs_bunch.ac39808f.svg"
              alt
            >
          </div>
          <div class="info-box">
            <p class="total-bombs">
              {{ selectedBombPackage.bombs.toString() }} BOMBS
            </p>
            <p
              class="total-price"
            >
              {{ $t('Total') }}: &euro;{{ selectedBombPackage.price.toString() }}
            </p>
          </div>
        </div>
        <div class="right-footer">
          <div class="submit-block">
            <default-button
              :on-click="submitPayment"
              :disabled="once"
            >
              {{ $t('pay') }}
            </default-button>
          </div>
        </div>
      </div>
    </div>

    <congratulation-bombs v-if="haveBuy==true" />
  </div>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton';
import Loader from 'components/Loader.vue';
import CongratulationBombs from 'components/BombCoins/CongratulationBombs.vue';
import { loadStripe } from '@stripe/stripe-js';
import { STRIPE_API_KEY } from 'config';

import { createNamespacedHelpers } from 'vuex';

const authModule = createNamespacedHelpers('auth');
const bombsModule = createNamespacedHelpers('bombs');
var stripe;
var elements;
export default {
  name: 'BuyBombCoins',
  components: {
    DefaultButton,
    InputGroup,
    Loader,
    CongratulationBombs,
  },
  props: {
    onConfirm: {
      type: Function,
      default: () => {},
    },
    onCancel: {
      type: Function,
      default: () => {},
    },
    selectedBombPackage: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      discount: '',
      complete: false,
      cardCvc: '',
      cardExpiry: '',
      cardNumber: '',
      stripe: '',
      stripeToken: '',
      error: '16 digt number',
      loading: true,
      disable: true,
      once: false,
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
    ...bombsModule.mapState(['status', 'haveBuy']),
    ...authModule.mapState(['user']),
    loader() {
      if (this.status == 'init') {
        return false;
      } else if (this.status == 'ready') {
        return false;
      } else if (this.status == 'pending') {
        return true;
      }
      return false;
    },
  },

  watch: {
    discount(val) {
      if (val == null || val.length == 0) {
        this.error = 'Kindly Enter dicount';
        this.disable = true;
      } else {
        this.error = '16 digt number';
        this.disable = false;
      }
    },
  },

  async created() {
    this.getPreUserCoins(this.user.id);
    stripe = await loadStripe(STRIPE_API_KEY);

    elements = stripe.elements();

    var style = {
      base: {
        color: '#A1AFD3',
        background: '#010431',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontWeight: '500',

        fontSize: '16px',
        '::placeholder': {
          color: '#a1afd394',
          fontWeight: '500',
        },
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
      },
      focused: {
        color: '#0000',
        iconColor: '#fa755a',
      },
    };

    let cvc = document.getElementById('card-cvc');
    let ce = document.getElementById('card-expiry');
    let cn = document.getElementById('card-number');

    this.cardCvc = elements.create('cardCvc', {
      style: style,
      placeholder: '***',
    });
    this.cardExpiry = elements.create('cardExpiry', {
      style: style,
      placeholder: 'MM/YY',
    });
    this.cardNumber = elements.create('cardNumber', {
      style: style,
      placeholder: 'XXXX-XXXX-XXXX-XXXX',
    });

    this.cardCvc.mount(cvc);
    this.cardExpiry.mount(ce);
    this.cardNumber.mount(cn);
    this.loading = false;
  },

  mounted() {
    this.setHaveBuy(false);
  },

  methods: {
    setField(name, value) {
      this[name] = value;
    },
    ...bombsModule.mapActions([
      'buyBombPackage',
      'getPreUserCoins',
      'setHaveBuy',
    ]),
    update() {
      this.complete = this.number && this.expiry && this.cvc;
    },
    async submitPayment() {
      await stripe.createToken(this.cardNumber).then((result) => {
        if (result.error) {
          this.error = result.error.message;
        } else {
          const data = {
            name: this.user.name,
            tokenId: result.token.id,
            saveCard: 0,
            packageID: this.selectedBombPackage.id,
            newCoins: this.selectedBombPackage.bombs,
            freeCoins: this.selectedBombPackage.free_bombs,
          };
          if (this.once == false) {
            this.buyBombPackage(data);
            this.once = true;
          }
        }
      });
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.ElementsApp .InputElement::placeholder {
  opacity: 0.5;
}
.footer-booms {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 1.5em;
  .left-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    .img-box {
      width: 75px;
      height: 75px;

      img {
        width: 100%;
        object-fit: cover;
        width: 100%;
        margin-left: -1.5em;
      }
    }
    .info-box {
      padding-right: 1.5em;
      padding-left: 1em;
      p {
        font-size: 20px;
        line-height: 21px;
        font-weight: 600;
        margin: 2px 0;
      }
      .total-price {
        color: #be1338;
      }
    }
  }
  .right-footer {
    width: 45%;
    .default-banger-btn {
      margin: 0 auto;
      width: 100%;
      padding: 14px 0px;
      font-size: 20px;
      line-height: 94%;
      text-transform: uppercase;
    }
  }
}
.inputs-wrapper {
  display: flex;
  width: 100%;
  .inputs-align-expiry {
    width: 70%;
    .label {
      width: 65%;
    }
  }
  .inputs-align-cvv {
    width: 30%;
    .label {
      text-align: left;
    }

    #card-cvc {
      padding: 0;
    }
  }
}
.card-number-wrapper {
  padding: 5px 0px;
}
.input-wrapper {
  width: 100%;
  display: flex;
  justify-items: center;
  align-items: center;
  margin: 0 auto;
  background: #010431;
  border-bottom: 1px solid #a1afd3;

  .label {
    font-weight: normal;
    margin: 0;
    padding: 0;
    padding: 10px 0 10px 0px;
    font-size: 16px;
    color: #a1afd3;
    width: 35%;
    text-align: right;
  }
}
.input-group {
  border-bottom: 0px;
  margin-bottom: 0 !important;
  padding-left: 1.5em;
  .label {
    width: 35%;
    .label-title {
      text-align: right !important;
    }
  }
}

.StripeElement {
  width: 65%;
  padding-left: 2em;
}
.error-stripe {
  font-size: 14px;
  line-height: 140%;
  padding-top: 10px;
  color: #a1afd3;
  width: 100%;

  margin-bottom: 0px;
}

.buy-coins {
  padding: 36px 40px;
}
.form-title-block {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
  .form-title {
    flex-basis: 100%;
    font-family: "Telegraf-UltraBold", serif;
    font-style: normal;
    font-weight: 900;
    font-size: 32px;
    line-height: 120%;
    letter-spacing: -1px;
    color: #be1338;
    margin-bottom: 5px;
  }

  .form-subtitle {
    flex-basis: 100%;
    font-style: normal;
    font-weight: normal;
    font-size: 19px;
    line-height: 120%;
    color: #be1338;
  }
}
.modal-body {
  border: 4px solid #a1afd3 !important;
}
.input-group {
  margin-bottom: 9px;

  &::v-deep .label-title {
    flex-basis: 39%;
    text-transform: capitalize;
  }

  &::v-deep input::placeholder {
    text-transform: capitalize;
    opacity: 0.5;
  }
}

.submit-block {
  display: flex;
  justify-content: flex-end;

  &::v-deep .default-banger-btn {
    font-size: 19px;
    padding: 11px 31px;
  }
}

@media all and (max-width: $tablet-small-width) {
  .input-wrapper {
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    .label {
      text-align: left;
      width: 100%;
    }

    #card-number {
      padding-left: 0em;
      width: 100% !important;
    }
  }
  .card-number-wrapper,
  .input-group {
    padding-left: 0em;
    margin-top: -30px;
  }
  .card-number-wrapper {
    padding-top: 2em;
  }
  .error-stripe {
    width: 100%;
    text-align: left;
  }
  .StripeElement {
    padding-bottom: 0.8em !important;
    padding-left: 0;
  }

  .footer-booms {
    flex-direction: column;
    .left-footer {
      justify-content: flex-start;
      width: 100%;
    }
    .right-footer {
      padding-top: 1em;
      width: 100%;
      .default-banger-btn {
        width: 100%;
      }
    }
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
