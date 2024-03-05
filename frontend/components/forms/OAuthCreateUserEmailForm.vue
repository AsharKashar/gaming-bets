<template>
  <form @submit.prevent="onSubmit">
    <div class="steps-title">
      {{ $t('Welcome to Banger Games') }}
    </div>
    <div class="from-title">
      {{ $t('Please enter your email to continue') }}
    </div>
    <input-group
      is-auth
      :value="email"
      name="email"
      :on-change="(name, val) => email = val"
      :label="$t('Username or Email')"
      placeholder="Jane Cooper"
    />
    <v-expand-transition>
      <ul
        v-if="errors"
        class="errors"
      >
        <li
          v-for="(val, key) in errors"
          :key="key"
          v-text="val"
        />
      </ul>
    </v-expand-transition>
    <div class="action-buttons">
      <default-button
        :loading="loading"
        class="default-banger-btn button-block"
        :class="{'button-disabled': !email}"
        type="submit"
        :disabled="!email"
      >
        {{ $t('Sign In') }}
      </default-button>
    </div>
  </form>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import InputGroup from 'components/forms/parts/InputGroup.vue';

import get from 'lodash/get';
import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('auth');
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'OAuthCreateUserEmailForm',
  components: {
    DefaultButton,
    InputGroup
  },
  data: () => ({
    email: null,
    errors: null,
    loading: false,
  }),
  methods: {
    ...mapActions(['createUserOauth']),
    ...modalModule.mapMutations(['clearModal']),
    async onSubmit() {
      if (this.loading) return;
      this.loading = true;
      this.errors = null;
      try {
        await this.createUserOauth(this.email);
        this.clearModal();
      } catch (e) {
        const errors = get(e, 'response.data.errors', {});
        this.errors = Object.keys(errors).reduce((a,b) => errors[a].concat(errors[b]));
      } finally {
        this.loading = false;
      }
    }
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes";

  .from-title {
    font-style: normal;
    font-weight: 800;
    font-size: 42px;
    line-height: 1.1;
    color: $border-primary-color;
    margin-bottom: 35px;
    @media all and (max-width: $tablet-small-width) {
      padding-top: 20px;
      font-size: 26px;
      padding-right: 20px;
    }
  }

  .action-buttons {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 40px;
  }

  .errors {
    margin: 15px 0 0;
    padding: 0;
    color: $border-primary-color;
    list-style: none;
  }
</style>
