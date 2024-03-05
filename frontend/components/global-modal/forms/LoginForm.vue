<template>
  <v-form
    ref="form"
    class="custom-forms"
    @submit.prevent="sendForm"
  >
    <div class="form-heading modal-heading">
      <div class="modal-title">
        {{ $t('Sign in') }}
      </div>
      <div class="modal-subtitle">
        {{ $t('Welcome to Banger Games ') }}
      </div>
    </div>
    <v-text-field
      :label="$t('E-mail')"
      placeholder="Jane Cooper"
      name="email"
      :rules="rules.email"
    />
    <v-text-field
      :label="$t('Password')"
      placeholder="**********"
      type="password"
      name="password"
      :rules="[rules.password[0]]"
    />
    <div class="forgot-password">
      <a href="#">
        {{ $t('Forgot password?') }}
      </a>
    </div>

    <div
      v-if="errors"
      class="form-error"
      v-text="errors"
    />

    <div class="actions">
      <default-button
        :loading="loading"
        class="default-banger-btn button-block"
        type="submit"
      >
        {{ $t('Sign In') }}
      </default-button>
    </div>
    <social-auth @auth="this.$emit('onSubmit')" />
    <div class="member">
      {{ $t("Don't have an account?") }}
      <a
        href="#"
        @click.prevent="setActiveModal({type:'SignUp'})"
      >
        {{ $t('Sign Up') }}
      </a>
    </div>
  </v-form>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import SocialAuth from 'components/SocialAuth';
import mixinForm from '@/mixins/mixinForm';
import { createNamespacedHelpers } from 'vuex';
const moduleModal = createNamespacedHelpers('modal');
const authModal = createNamespacedHelpers('auth');
import get from 'lodash/get';

export default {
  name: 'LoginForm',
  components: {
    DefaultButton,
    SocialAuth,
  },
  mixins: [mixinForm],
  data: () => ({
    errors: null,
  }),
  computed: moduleModal.mapState(['activeModal','modalOptions']),
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
    ...authModal.mapActions(['login']),
    async sendForm() {
      if(this.isError()) {
        return;
      }
      this.errors = null;
      this.loading = true;

      this.setDataForm();
      const res = await this.login(this.formData);
      this.loading = false;

      if (res && res.data && res.data.error) {
        this.errors = res.data.error;
        return;
      }

      const callback = get(this, 'modalOptions.callback', null);

      if (callback) {
        callback();
        return;
      }
      this.setActiveModal({});
    },
  },
};
</script>
<style lang="scss" scoped>
@import '~/components/global-modal/forms/forms.scss';
@import '~/components/global-modal/modal.scss';
</style>
