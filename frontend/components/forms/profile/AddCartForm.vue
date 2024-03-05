<template>
  <div class="cart-form">
    <Loader :loading="loading" />
    <form class="invite-member-form">
      <a
        class="go-back"
        @click="Close()"
      >&#60; {{ $t('Go back') }}</a>
      <div class="from-title">
        {{ $t('Add New Card') }}
      </div>
      <div class="input-wrapper card-number-wrapper">
        <label
          for="Name"
          class="label"
        >{{ $t('Name') }}</label>
        <input-group
          :value="name"
          name="name"
          :on-change="setField"
          placeholder="Name"
        />
      </div>

      <!-- <input-group
        is-auth
        :value="cardnumber"
        name="cardnumber"
        :on-change="setField"
        label="Card Number"
      />-->

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

      <div class="bottom-block">
        <default-button
          type="button"
          :on-click="handleSubmit"
          class="add-member-submit"
          :loading="formSubmitting"
        >
          {{ $t('Add payment method') }}
        </default-button>
      </div>
    </form>
  </div>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton';
import Loader from 'components/Loader.vue';
import { loadStripe } from '@stripe/stripe-js';
import { STRIPE_API_KEY } from 'config';

import { createNamespacedHelpers } from 'vuex';
import Vue from 'vue';

const authModule = createNamespacedHelpers('auth');
var stripe;
var elements;

export default {
  name: 'CartForm',
  components: {
    InputGroup,
    DefaultButton,
    Loader,
  },
  props: {
    closeModal: {
      type: Function,
      default: () => {},
    },
  },
  data: () => ({
    name: '',
    // cardnumber: "",
    // mmyy: "",
    // cvc: "",
    cardCvc: '',
    cardExpiry: '',
    cardNumber: '',
    formSubmitting: false,
    stripe: '',
    stripeToken: '',
    error: '16 digt number',
    loading: true,
    disable: true,
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
  }),
  computed: {
    ...authModule.mapState(['user']),
    form() {
      return {
        name: this.name,
        cardNumber: this.cardNumber,
        cardExpiry: this.cardExpiry,
        cardCvc: this.cvc,
      };
    },
  },

  async created() {
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

  methods: {
    async handleSubmit() {
      this.formSubmitting = true;
      await stripe.createToken(this.cardNumber).then((result) => {
        if (result.error) {
          this.error = result.error.message;
          this.formSubmitting = false;
        } else {
          const data = {
            name: this.user.name,
            token: result.token.id,
          };
          this.$bangerApi.post('card/add-payment-method/' + this.user.id, data)
            .then((res) => {
              Vue.notify({
                group: 'custom-notification',
                title: 'Success',
                text: res.data.message,
                type: 'success',
              });
              this.Close();
              return res;
            })
            .catch((err) => {
              Vue.notify({
                group: 'custom-notification',
                title: 'Error',
                text: err.message,
                type: 'error',
              });
            })
            .finally(() => {
              this.formSubmitting = false;
            });
        }
      });
    },


    setField(name, value) {
      this[name] = value;
    },
    Close() {
      this.closeModal();
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.cart-form {
  padding: 30px;
}
h2 {
  margin-top: 30px;
  font-family: Telegraf-UltraBold, serif;
  color: #a1afd3;
  font-style: normal;
  font-weight: 800;
  font-size: 16px;
  line-height: 94%;
}
.invite-member-form {
  // padding: 28px 37px;
  .from-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 36px;
    line-height: 49px;
    color: $border-primary-color;
    margin-bottom: 35px;
  }

  &::v-deep .input-group {
    .label {
      text-transform: capitalize;
      padding-top: 0 !important;
    }
    input {
      &::placeholder {
        text-transform: capitalize;
        opacity: 0.5;
      }
    }
    // input {
    //   margin-left: 135px;
    // }
  }

  .bottom-block {
    display: flex;
    justify-content: space-between;
    margin-top: 57px;

    &::v-deep .add-member-submit {
      font-size: 20px;
      letter-spacing: 0.05em;
      padding: 15px 32px;
    }

    .copy-link {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 18px;
      line-height: 100%;
      display: flex;
      align-items: center;
      letter-spacing: 0.05em;
      text-decoration-line: underline;
      cursor: pointer;
    }
  }
}
.go-back {
  font-family: Telegraf-Regular;
  font-weight: 800;
  font-size: 20px;
  line-height: 94%;
  text-decoration: none;
  color: #be1338;
}

// style for stripe elements
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

// .modal-body {
//   border: 4px solid #a1afd3 !important;
// }
.input-group {
  margin-bottom: 9px;

  &::v-deep .label-title {
    flex-basis: 39%;
    text-transform: capitalize;
  }

  &::v-deep input::placeholder {
    text-transform: capitalize;
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
