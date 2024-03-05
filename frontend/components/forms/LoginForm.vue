<template>
  <form @keyup.enter="handleEnter()">
    <div class="from-title">
      {{ $t('Sign in') }}
    </div>
    <div class="steps-title">
      {{ $t('Welcome to Banger Games ') }}
    </div>
    <input-group
      is-auth
      :value="email"
      name="email"
      :on-change="setField"
      :label="$t('Username or Email')"
      placeholder="Jane Cooper"
    />
    <input-group
      is-auth
      :value="password"
      name="password"
      placeholder="**********"
      :type="showPassword ? 'text' : 'password'"
      :on-change="setField"
      :label="$t('Password')"
    />
    <div class="forgot-password">
      {{ $t('Forgot password?') }}
      <div class="action-link">
        {{ $t('Reset') }}
      </div>
    </div>
    <div
      v-if="errors"
      class="action-link mt-2 text-center"
    >
      {{ $t('Invalid Email or Password') }}
    </div>

    <!--  -->
    <div class="action-buttons">
      <default-button
        :loading="loading"
        :btn-class="btnClasses"
        type="button"
        :disabled="!isFormValid"
        :on-click="handleSubmit"
      >
        {{ $t('Sign In') }}
      </default-button>

      <social-auth
        v-if="!isProd"
        @auth="this.$emit('onSubmit')"
      />
      <div class="member">
        <div>{{ $t('Does’nt have an account?') }}</div>
        <div
          class="action-link"
          @click="$emit('setDialogType','create')"
        >
          {{ $t('signup') }}
        </div>
        <!-- <div class="action-link">Forgotten password</div> -->
      </div>
    </div>
    <!--  -->
  </form>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import InputGroup from 'components/forms/parts/InputGroup.vue';
import SocialAuth from 'components/SocialAuth.vue';
import { VUE_MODE } from 'config';

import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('auth');

export default {
  name: 'LoginForm',
  components: {
    SocialAuth,
    DefaultButton,
    InputGroup,
  },
  data: () => ({
    isProd: VUE_MODE === 'production',
    email: '',
    password: '',
    showPassword: false,
    loading: false,
    errors: '',
  }),
  computed: {
    form() {
      return {
        email: this.email,
        password: this.password,
      };
    },
    btnClasses() {
      return `default-banger-btn button-block ${
        !this.isFormValid ? 'button-disabled' : ''
      }`;
    },
    isFormValid() {
      let valid = true;
      if (!this.email || !this.password) valid = false;
      return valid;
    },
  },
  methods: {
    ...mapActions(['login']),
    async handleSubmit() {
      this.loading = true;
      let res = await this.login(this.form);
      if (res && res.data && res.data.error) {
        this.errors = res.data.error;
      } else {
        this.$emit('onSubmit');
      }
      this.loading = false;
    },
    handleEnter() {
      if (this.isFormValid) this.handleSubmit();
    },
    setField(name, value) {
      this[name] = value;
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.modal-type-change {
  display: flex;
  justify-content: space-between;

  .action-link {
    cursor: pointer;
    color: #bf1438;
    user-select: none;
  }
}

.forgot-password {
  color: $text-primary-color;
  display: flex;
  padding: 16px 0;
  font-size: 16px;
  line-height: 94%;
}
.action-link {
  cursor: pointer;
  color: #bf1438;
  font-weight: 900;
  user-select: none;
  padding-left: 5px;
}

.steps-title {
  color: $text-secondary-color;
  font-style: normal;
  font-weight: normal;
  font-size: 20px;
  line-height: 94%;
  margin-bottom: 35px;
  padding-top: 0.6rem;
}
.from-title {
  font-family: Telegraf-UltraBold, serif;
  font-weight: 800;
  font-size: 32px;
  line-height: 100%;
  color: $border-primary-color;
}

.member {
  font-family: Telegraf-UltraBold, serif;
  font-weight: 900;
  font-size: 16px;
  line-height: 94%;
  display: flex;
  margin-top: 24px;
  align-items: center;
  justify-content: center;
  color: $text-primary-color;
}

.action-buttons {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 32px;
}

.action-buttons .banger-btn {
  padding: 16px 24px;
}

@media all and (max-width: $tablet-small-width) {
  .forgot-password .action-link {
    font-size: 11px;
  }
}
</style>
