<template>
  <div class="steps-content">
    <v-text-field
      label="Name"
      :placeholder="$t('Name')"
      name="name"
      :value="propsFormData.name"
      :rules="rules.name"
    />
    <v-text-field
      label="Nickname"
      :placeholder="$t('Your Nickname')"
      name="username"
      :value="propsFormData.username"
      :rules="rules.username"
    />
    <v-text-field
      label="E-mail"
      placeholder="janecooper@example.com"
      name="email"
      :rules="rules.email"
      :value="propsFormData.email"
      :error="!!errors.email"
      :error-messages="errors.email"
      @input="$emit('setError', {name: 'email'})"
    />
    <v-text-field
      v-model="dateOfBirth"
      v-mask="'##/##/####'"
      masked="true"
      placeholder="DD/MM/YYYY"
      name="date_of_birth"
      :label="$t('Date of Birth')"
      validate-on-blur
      type="dob"
      :rules="rules.dateOfBirth"
    />

    <v-text-field
      v-model="pass"
      :label="$t('Password')"
      placeholder="**********"
      type="password"
      name="password"
      validate-on-blur
      :rules="rules.password"
    />
    <v-text-field
      :label="$t('Confirm Password')"
      placeholder="**********"
      type="password"
      name="password_confirmation"
      :value="propsFormData.password_confirmation"
      :rules="[...rules.password, ...rules.confirmPass(pass)]"
    />
    <div class="actions">
      <default-button
        type="button"
        @click.native="$emit('nextStep')"
      >
        {{ $t('Continue') }}
      </default-button>
    </div>
    <social-auth @auth="this.$emit('onSubmit')" />
    <div class="member">
      {{ $t('Already have an account?') }}
      <a
        href="#"
        @click.prevent="setActiveModal({type: 'LoginForm'})"
      >Login</a>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import SocialAuth from 'components/SocialAuth';
import props from 'components/global-modal/forms/DefaultPropsValidation';
import { createNamespacedHelpers } from 'vuex';
const moduleModal = createNamespacedHelpers('modal');

export default {
  name: 'SignUpStep1',
  components: {
    SocialAuth,
    DefaultButton,
  },
  props,
  data: () => ({
    pass: null,
    dateOfBirth: '',
  }),
  mounted() {
    this.pass = this.propsFormData.password;
    this.dateOfBirth = this.propsFormData.date_of_birth;
  },
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
  },
};
</script>

<style scoped lang="scss">
@import '~/components/global-modal/forms/forms.scss';
@import '~/components/global-modal/modal.scss';
</style>
