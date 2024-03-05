<template>
  <form @keyup.enter="handleEnter()">
    <div
      class="steps-title"
      @click="step = 1"
    >
      {{ 'Step' }} {{ step }} of 2
    </div>
    <div class="from-title">
      {{ step === 1 ? 'Let’s Get Started' : 'Sign up' }}
    </div>

    <template v-if="step == 1">
      <input-group
        is-auth
        :value="name"
        name="name"
        :on-change="setField"
        placeholder="Jane Cooper"
        :label="$t('Name')"
      />
      <input-group
        is-auth
        :value="user_name"
        name="user_name"
        :on-change="setField"
        placeholder="jane99"
        :label="$t('User Name')"
        type="text"
        :prevent-space="true"
      />
      <input-group
        is-auth
        :value="email"
        name="email"
        :on-change="setField"
        placeholder="janecooper@example.com"
        :label="$t('E-mail')"
        type="email"
        @focusout="validateEmail = !validateEmail"
      />

      <input-group
        is-auth
        :value="dateOfBirth"
        name="dateOfBirth"
        :on-change="setField"
        placeholder="dd/mm/yyyy"
        :label="$t('Date of Birth')"
        type="dob"
        @focusout="validateDate"
      />

      <input-group
        is-auth
        :value="password"
        name="password"
        placeholder="**********"
        :type="showPassword ? 'text' : 'password'"
        :on-change="setField"
        :label="$t('Password')"
        @focusout="validatePassword = !validatePassword"
      />
      <input-group
        is-auth
        :value="passwordConfirmation"
        name="passwordConfirmation"
        :type="showPassword ? 'text' : 'password'"
        :on-change="setField"
        placeholder="**********"
        :label="$t('Confirm password')"
      />
      <div class="input-hint">
        <p
          v-for="(err, index) in formErrors"
          :key="index"
        >
          {{ err }}
        </p>
      </div>
    </template>
    <template v-else>
      <input-group
        is-auth
        is-menu
        :menu-items="countries"
        :is-menu-loading="loadCountry"
        :value="selected_country"
        menu-text="name"
        menu-value="id"
        name="selected_country"
        :on-change="setField"
        :label="$t('Country')"
      />
      <input-group
        is-menu
        is-auth
        :menu-items="['Male', 'Female']"
        :value="gender"
        name="gender"
        :on-change="setField"
        :label="$t('Gender')"
      />

      <SelectPlatform
        :active="platform"
        @onSelect="pl => (platform = pl)"
      />
    </template>

    <div class="action-buttons">
      <default-button
        :loading="loading"
        type="button"
        :btn-class="btnClasses"
        :disabled="!isFormValid"
        :on-click="step === 1 ? nextStep : handleSubmit"
      >
        {{ step === 1 ? 'Continue' : 'Sign up' }}
      </default-button>

      <div
        v-if="step === 2"
        class="terms-text"
      >
        <span>
          {{ $t('By signing up i have read and agree to') }}
          <span class="secondery--text">{{ $t('terms and conditions') }}</span>
          {{ $t('and') }}
          <span class="secondery--text">{{ $t('privacy policy') }}</span>
          {{ $t('and i am') }}
          <span class="secondery--text">13+</span>
        </span>
      </div>

      <template v-if="step === 1">
        <social-auth
          v-if="!isProd"
          is-sign-up
          @auth="this.$emit('onSubmit')"
        />
        <!-- <div class="singup-with-text">Or signup with?</div> -->
        <!-- <div class="singup-with-icon">
          <v-btn small fab dark color="primary" class="mr-8">
            <img src="~/static/icons/facebook_login.svg" alt="Facebook" />
          </v-btn>
          <v-btn small fab dark color="primary">
            <img src="~/static/icons/google_login.svg" alt="Google" />
          </v-btn>
        </div>-->
        <div
          v-if="!fromDemo"
          class="member"
        >
          <div>{{ $t('Already have a account?') }}</div>
          <div
            class="action-link"
            @click="$emit('setDialogType','login')"
          >
            {{ $t('Login') }}
          </div>
        </div>
      </template>
    </div>
  </form>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import InputGroup from 'components/forms/parts/InputGroup.vue';
import { VUE_MODE } from 'config';

import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('auth');
const moduleCountry = createNamespacedHelpers('country');
import { emailReg, passwordReg } from 'helpers/regExpRules';

import dayjs from 'dayjs';
import SelectPlatform from './parts/SelectPlatform';
import SocialAuth from 'components/SocialAuth.vue';

export default {
  name: 'RegisterForm',
  components: {
    DefaultButton,
    InputGroup,
    SelectPlatform,
    SocialAuth
  },
  props: {
    setDialogType: {
      type: Function,
      default: () => {}
    },
    onSubmit: {
      type: Function,
      default: () => {}
    },
    fromDemo: {
      type: Boolean,
      default: false
    },
    fromComingSoon: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    isProd: VUE_MODE === 'production',
    currentInput: '',
    formErrors: {},
    errors: '',
    step: 1,
    email: '',
    name: '',
    user_name: '',
    selected_country: '',
    dateOfBirth: '',
    password: '',
    gender: '',
    platform: 'cross platform',
    passwordConfirmation: '',
    showPassword: false,
    inputHint: '',
    dateMenu: false,
    showConfirmPassword: false,
    loading: false,
    emailReg,
    passwordReg,
    validatePassword: false,
    validateEmail: false
  }),
  computed: {
    ...moduleCountry.mapState(['countries', 'loadCountry']),
    computedDateFormatted() {
      return this.formatDate(this.dateOfBirth);
    },
    getMaxAllowedDate() {
      let date = new Date();
      let y = date.getFullYear() - 18;
      let m = date.getMonth() + 1;
      let d = date.getDate();
      return new Date((m + '/' + d + '/' + y).toString()).toISOString();
    },
    form() {
      return {
        name: this.name,
        email: this.email,
        date_of_birth: this.dateOfBirth,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
        gender: this.gender,
        platform: this.platform,
        username: this.user_name,
        country_id: this.selected_country
      };
    },
    btnClasses() {
      return `default-banger-btn button-block ${
        !this.isFormValid ? 'button-disabled' : ''
      }`;
    },
    isFormValid() {
      let valid = true;
      // return valid;
      if (
        this.step === 1 &&
        (this.password !== this.passwordConfirmation ||
          !this.name ||
          !this.email ||
          !this.dateOfBirth ||
          !this.password ||
          this.password.length < 8 ||
          !this.user_name ||
          !this.emailReg.test(this.email) ||
          !this.passwordReg.test(this.password) ||
          !!this.formErrors.dateOfBirth)
      ) {
        valid = false;
      }
      if (
        this.step === 2 &&
        Object.keys(this.form).findIndex(item => !this.form[item]) !== -1
      ) {
        valid = false;
      }
      return valid;
    }
  },
  watch: {
    validateEmail() {
      if (this.email && this.emailReg.test(this.email)) {
        this.formErrors = this.createObject(this.formErrors, { email: null });
      } else {
        this.formErrors.email = 'Email is invalid';
      }
    },
    validatePassword() {
      const { password, passwordReg, passwordConfirmation } = this;
      if (password && passwordReg.test(password) && password.length >= 8) {
        this.formErrors = this.createObject(this.formErrors, {
          password: null
        });
        if (passwordConfirmation && passwordConfirmation !== password) {
          this.formErrors = this.createObject(this.formErrors, {
            passNotMatch: 'Your password didn\'t match...'
          });
        } else {
          this.formErrors = this.createObject(this.formErrors, {
            passNotMatch: null
          });
        }
      } else {
        this.formErrors.password =
          'Password must include 8 characters and 1 special character';
      }
    },
    passwordConfirmation(val) {
      if (val && this.password === val) {
        this.formErrors = this.createObject(this.formErrors, {
          passNotMatch: null
        });
      } else {
        this.formErrors = this.createObject(this.formErrors, {
          passNotMatch: 'Your password didn\'t match...'
        });
      }
    }
  },
  mounted() {
    if(!this.countries.length) {
      this.getCountries();
    }
  },
  methods: {
    ...moduleCountry.mapActions(['getCountries']),
    ...mapActions(['register']),
    async handleSubmit() {
      this.loading = true;
      let res = await this.register(this.form);
      if (res && res.data && res.data.errors) {
        this.errors = res.data.errors;
      } else {
        this.onSubmit();
      }
      this.step = 1;
      this.loading = false;
    },
    handleEnter() {
      if (this.isFormValid && this.step === 1) this.step = 2;
      else if (this.isFormValid && this.step === 2) this.handleSubmit();
    },
    setField(name, value) {
      this[name] = value;
    },
    formatDate(date) {
      if (!date) return null;
      const [year, month, day] = date.split('-');
      return `${month}/${day}/${year}`;
    },
    validateDate() {
      // checking valid birthday
      // TODO: this can be optimized
      const date = this.dateOfBirth.split('/');
      const enteredDate = dayjs([date[2], date[1] - 1, date[0]]);
      const today = dayjs();
      const valid = enteredDate.isValid();
      const diff = today.diff(enteredDate, 'years');

      if (valid) {
        if (diff >= 13 && diff <= 90) {
          this.formErrors = this.createObject(this.formErrors, {
            dateOfBirth: null
          });
          return true;
        } else {
          this.formErrors.dateOfBirth =
            'You must be 13 years old or above for signup';
          return false;
        }
      } else {
        this.formErrors.dateOfBirth = 'Date of birth is invalid...!!!';
        return false;
      }
    },
    nextStep() {
      if (this.validateDate()) {
        this.step = 2;
      }
    },
    createObject(oldObj, newObj) {
      return { ...oldObj, ...newObj };
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.input-group input {
  font-size: 24px;
  line-height: 94%;
  color: #a1afd3;
  opacity: 0.5;
}

.action-link {
  cursor: pointer;
  color: #bf1438;
  font-weight: 900;
  user-select: none;
  padding-left: 5px;
}
.steps-title {
  // font-size: 32px;
  // line-height: 120%;
  color: $text-secondary-color;
  font-style: normal;
  font-weight: normal;
  font-size: 20px;
  line-height: 94%;
}

.from-title {
  // font-size: 56px;
  // line-height: 59px;

  font-family: Telegraf-UltraBold, serif;
  font-weight: 800;
  font-size: 32px;
  line-height: 100%;
  color: $text-secondary-color;
  margin-bottom: 35px;
  padding-top: 0.6rem;
  // padding-right: 140px;
}

.terms-text,
.member {
  // font-size: 24px;
  // line-height: 94%;
  font-size: 16px;
  line-height: 94%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: $text-primary-color;
}
.terms-text {
  padding: 10px 50px;
  text-align: center;
  margin-top: 24px;
}
.member {
  margin-top: 24px;
  font-family: Telegraf-UltraBold, serif;
  font-weight: 900;
}

.input-hint {
  margin-left: auto;
  width: 63%;
  padding: 15px 0;
  font-size: 16px;
  line-height: 94%;
  color: #f2994a;
}

.action-buttons .banger-btn {
  padding: 16px 24px;
}
.action-buttons {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 32px;
}

@media all and (max-width: $mobile-width) {
  .steps-title {
    font-size: 20px;
    line-height: 94%;
  }
  .from-title {
    font-weight: 800;
    font-size: 32px;
    padding-top: 0.8rem;
    margin-bottom: 1rem;
  }
  .action-buttons {
    margin-top: 20px;
  }
  .input-hint {
    width: 100%;
  }
  .singup-with-text,
  .singup-with-icon,
  .terms-text,
  .member {
    font-size: 16px;
    line-height: 94%;
    margin: 10px 0;
  }
  .terms-text {
    padding: 10px;
  }
}
</style>
