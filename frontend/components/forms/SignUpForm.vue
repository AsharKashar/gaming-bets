<template>
  <form>
    <v-text-field
      v-model="name"
      :label="$t('Username')"
      required
    />
    <v-text-field
      v-model="email"
      :label="$t('E-mail')"
      required
    />
    <v-text-field
      v-model="password"
      :label="$t('Password')"
      :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
      :type="showPassword ? 'text' : 'password'"
      @click:append="showPassword = !showPassword"
    />
    <v-text-field
      v-model="passwordConfirmation"
      :label="$t('Confirm password')"
      :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
      :type="showConfirmPassword ? 'text' : 'password'"
      @click:append="showConfirmPassword = !showConfirmPassword"
    />
    <div class="action-buttons">
      <default-button
        :loading="loading"
        type="button"
        :on-click="handleSubmit"
      >
        {{ $t('Sign up') }}
      </default-button>
    </div>
  </form>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('auth');

export default {
  name: 'SignUpForm',
  components:{
    DefaultButton
  },
  props:{
    onSubmit:{
      type:Function,
      default: () => {}
    }
  },
  data:() => ({
    email: '',
    name: '',
    password: '',
    passwordConfirmation: '',
    showPassword: false,
    showConfirmPassword: false,
    loading: false
  }),
  computed: {
    form () {
      return {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      };
    }
  },
  methods: {
    ...mapActions([
      'register'
    ]),
    async handleSubmit() {
      this.loading = true;
      await this.register(this.form);
      this.onSubmit();
      this.loading = false;
    },
  }
};
</script>

<style scoped lang="scss">
  form{
    padding: 44px;
  }

  .action-link{
    cursor: pointer;
    color: #bf1438;
    user-select: none;
  }

  .action-buttons{
    display: flex;
    justify-content: space-between;
  }
</style>
