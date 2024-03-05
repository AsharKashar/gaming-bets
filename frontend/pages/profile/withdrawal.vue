<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <Loader :loading="loader" />
    <v-container
      fluid
      class="profile-widthdrawl"
    >
      <p class="main-title mb-6">
        My Teams
      </p>
      <v-row no-gutters>
        <v-col sm="12">
          <v-tabs
            v-model="active_tab"
            background-color="transparent"
          >
            <v-tabs-slider />
            <v-tab
              :key="1"
              href="#tab-methods"
              :ripple="false"
            >
              Withdrawal
            </v-tab>
            <v-tab
              :key="2"
              href="#tab-history"
              :ripple="false"
            >
              History
            </v-tab>
          </v-tabs>
          <!-- {{account_holdertype}} -->
          <v-tabs-items
            v-model="active_tab"
            class="mt-10"
          >
            <v-tab-item :value="'tab-methods'">
              <form class="withdrawal-form">
                <input-group
                  :value="account_number"
                  name="account_number"
                  :on-change="setField"
                  :label="$t('Account Number')"
                  type="dob"
                  mask="1111111111111111"
                  :placeholder="$t('Enter Number')"
                  class="profile-input"
                />

                <input-group
                  :value="account_holdername"
                  name="account_holdername"
                  :on-change="setField"
                  :label="$t('Account Holder Name')"
                  :placeholder="$t('Enter Name')"
                  class="profile-input"
                />

                <input-group
                  :value="bank_name"
                  name="bank_name"
                  :on-change="setField"
                  :label="$t('Bank Name')"
                  :placeholder="$t('Enter Name')"
                  class="profile-input"
                />

                <input-group
                  :value="last4"
                  name="last4"
                  :on-change="setField"
                  :label="$t('Last 4')"
                  :placeholder="$t('Enter Last 4')"
                  class="profile-input"
                  type="dob"
                  mask="1111"
                />

                <input-group
                  :value="account_holdertype"
                  name="account_holdertype"
                  :on-change="setField"
                  :label="$t('Account Holder Type')"
                  :placeholder="$t('Select')"
                  :is-menu="true"
                  :menu-items="holderTypeList"
                  class="profile-input"
                />

                <input-group
                  :value="currency"
                  name="currency"
                  :on-change="setField"
                  :label="$t('Currency')"
                  :placeholder="$t('Select')"
                  :is-menu="true"
                  class="profile-input"
                  :menu-items="currencyList"
                />

                <input-group
                  :value="routing_number"
                  name="routing_number"
                  :on-change="setField"
                  :label="$t('Routing Number')"
                  :placeholder="$t('Enter Number')"
                  type="dob"
                  class="profile-input"
                  mask="111111111"
                />

                <v-row>
                  <v-col xs="6">
                    <div class="bottom-block">
                      <default-button
                        type="button"
                        :on-click="handleSubmit"
                        class="add-member-submit"
                        btn-class="secondary-banger-btn mt-5"
                        :disabled="disable"
                      >
                        Claim
                      </default-button>
                    </div>
                  </v-col>
                  <v-col xs="6">
                    {{ error }}
                  </v-col>
                </v-row>
              </form>
            </v-tab-item>
            <v-tab-item :value="'tab-history'">
              <History />
            </v-tab-item>
          </v-tabs-items>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
import History from 'components/Profile/Withdrawal/History';
const { mapActions, mapState } = createNamespacedHelpers('profile');
import Loader from 'components/Loader';
import { APP_URL } from 'configs/config';

export default {
  name: 'ProfileWithdrawal',
  components: {
    InputGroup,
    History,
    DefaultButton,
    Loader,
  },
  middleware: ['hideHeader'],
  data() {
    return {
      account_number: '',
      account_holdername: '',
      bank_name: '',
      last4: '',
      account_holdertype: '',
      currency: '',
      routing_number: '',
      holderTypeList: ['a', 'b', 'c'],
      currencyList: ['euro', 'usd'],
      active_tab: 1,
      error: '',
      disable: true,
      acError: true,
      lastError: true,
      routingError: true,
      bankNameError: true,
      acHolderNameError: true,
      acHolderTypeError: true,
      currencyError: true,
    };
  },
  computed: {
    ...mapState(['profileStatus']),
    loader() {
      return this.profileStatus === 'pending';
    },
  },
  watch: {
    account_number(val) {
      if (val != null && !val.includes('_')) {
        this.acError = false;
        this.error = '';
      } else {
        this.error = 'Kindly enter correct account number \'16 digits\' etc ';
        this.acError = true;
      }
      this.validate();
    },
    account_holdertype(val) {
      if (val) {
        this.acHolderTypeError = false;
        this.error = '';
      } else {
        this.error = 'Kindly select account holder type ';
        this.acHolderTypeError = true;
      }
      this.validate();
    },
    currency(val) {
      if (val) {
        this.currencyError = false;
        this.error = '';
      } else {
        this.error = 'Kindly select currency holder type ';
        this.currencyError = true;
      }
      this.validate();
    },
    account_holdername(val) {
      if (val != null) {
        this.acHolderNameError = false;
        this.error = '';
      } else {
        this.error = 'Kindly enter account holder name ';
        this.acHolderNameError = true;
      }
      this.validate();
    },
    bank_name(val) {
      if (val != null) {
        this.bankNameError = false;
        this.error = '';
      } else {
        this.error = 'Kindly enter bank  name ';
        this.bankNameError = true;
      }
      this.validate();
    },
    last4(val) {
      if (val != null && !val.includes('_')) {
        this.lastError = false;
        this.error = '';
      } else {
        this.error = 'Kindly enter last 4 digits your card';
        this.lastError = true;
      }
      this.validate();
    },
    routing_number(val) {
      if (val != null && !val.includes('_')) {
        this.routingError = false;
        this.error = '';
      } else {
        this.error = 'Kindly enter routing number \'9 digits\' etc';
        this.routingError = true;
      }
      this.validate();
    },
  },
  methods: {
    validate() {
      if (
        !this.acError &&
        !this.lastError &&
        !this.routingError &&
        !this.bankNameError &&
        !this.acHolderNameError &&
        !this.acHolderTypeError &&
        !this.currencyError
      ) {
        this.error = '';
        this.disable = false;
      } else {
        this.disable = true;
      }
    },
    reset() {
      this.account_number = '';
      this.account_holdername = '';
      this.bank_name = '';
      this.last4 = '';
      this.account_holdertype = '';
      this.currency = '';
      this.routing_number = '';
    },
    ...mapActions(['saveWithDrawal']),

    async handleSubmit() {
      let data = {
        account_number: this.account_number,
        account_holdername: this.account_holdername,
        bank_name: this.bank_name,
        last4: this.last4,
        account_holdertype: this.account_holdertype,
        currency: this.currency,
        routing_number: this.routing_number,
      };
      await this.saveWithDrawal(data);
      this.reset();
    },

    setField(name, value, index) {
      if (index >= 0) {
        this[name][index] = value;
      } else {
        this[name] = value;
      }
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Withdrawal',
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
  .main-title {
    font-weight: 900;
    font-size: 32px;
    line-height: 115%;
    color: $text-primary-color;
  }
.input-group {
  text-transform: capitalize !important; 
}

.profile-widthdrawl {
  max-width: 100% !important;
  // padding: 0 0 0 7em;
}
.bottom-block {
  margin-top: 20px;
}
.v-tabs-items {
  background-color: transparent;
}
.add-button {
  float: right;
  background: transparent;
  border-radius: 59px;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 800;
  font-size: 14px;
  line-height: 100%;
  display: flex;
  align-items: center;
  text-align: center;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #be1338;
  padding: 15px 25px;
  margin: 35px 30px;
  border: 1px solid #be1338;
}
.history {
  float: right;
  cursor: pointer;
  color: #be1338;
  margin: 45px 5px;
}
.v-tab {
  font-family: Telegraf-UltraBold, Serif;
  font-style: normal;
  font-weight: 900;
  font-size: 16px;
  text-transform: none;
  width: 160px;
}
.v-tab--active {
  color: #be1338;

  background-image: url("~static/images/design/button-active.svg");
}
.v-tabs-slider {
  display: none;
}
.v-tab:before,
.v-tab:focus,
.v-tab:active {
  background-color: transparent !important;
}

@media only screen and (max-width: $tablet-small-width) {
  .profile-widthdrawl {
    padding: 0 0 0 0;
  }
}
@media only screen and (min-width: $tablet-large-width) {
  .container {
    max-width: 550px;
  }
}
</style>
