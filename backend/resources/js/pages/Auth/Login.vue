<template>
  <modal-layout class="white">
    <v-card :flat="true">
      <v-toolbar class="primary">
        <v-btn
          flat
          icon
          color="white"
          @click.native="redirectBack()"
        >
          <v-icon>arrow_back</v-icon>
        </v-btn>
        <v-spacer />
        <v-toolbar-title class="text-xs-center white--text">
          Customer Login Page
        </v-toolbar-title>
        <v-spacer />
        <v-toolbar-items>
          <!-- If There is no User Account Login Yet Redirect to Authentication Page -->
          <v-btn
            flat
            color="white"
            @click.native="goHome()"
          >
            <v-icon>fa-home</v-icon>
          </v-btn>
        </v-toolbar-items>
      </v-toolbar>
      <v-card-text style="padding-top:150px;">
        <v-container fluid>
          <form @submit.prevent="login()">
            <v-layout row>
              <v-flex
                xs12
                sm12
                md4
                offset-md4
                lg4
                offset-lg4
                xl4
                offset-xl4
              >
                <v-text-field
                  v-model="form.email"
                  v-validate="'required|email'"
                  :error-messages="errorMessages('email')"
                  :class="{ 'error--text': hasErrors('email') }"
                  class="primary--text"
                  name="email"
                  label="Type Your Account Email"
                  data-vv-name="email"
                  prepend-icon="email"
                  counter="255"
                />
              </v-flex>
            </v-layout>
            <v-layout row>
              <v-flex
                xs12
                sm12
                md4
                offset-md4
                lg4
                offset-lg4
                xl4
                offset-xl4
              >
                <v-text-field
                  v-model="form.password"
                  v-validate="'required|min:6'"
                  :append-icon="icon"
                  :type="!password_visible ? 'password' : 'text'"
                  :error-messages="errorMessages('password')"
                  :class="{ 'error--text': hasErrors('password') }"
                  class="primary--text"
                  name="password"
                  label="Enter your password"
                  hint="At least 6 characters"
                  data-vv-name="password"
                  counter="255"
                  prepend-icon="fa-key"
                  @click:append="() => (password_visible = !password_visible)"
                />
              </v-flex>
            </v-layout>
            <v-flex
              xs12
              sm12
              md4
              offset-md4
              lg4
              offset-lg4
              xl4
              offset-xl4
              text-xs-center
            >
              <v-btn
                :loading="form.busy"
                :disabled="errors.any()"
                block
                type="submit"
                color="primary"
              >
                Sign In
                <v-icon right>
                  fa-sign-in
                </v-icon>
              </v-btn>
            </v-flex>
          </form>
          <v-layout
            row
            wrap
          >
            <v-flex
              xs6
              md2
              offset-md4
              pa-0
            >
              <v-btn
                dark
                block
                color="secondary"
                @click.native="goToRegister()"
              >
                No Account Yet?
              </v-btn>
            </v-flex>
            <v-flex
              xs6
              md2
              pa-0
            >
              <v-btn
                dark
                block
                color="error"
                @click.native="resetPassword()"
              >
                Forgot Password?
              </v-btn>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
  </modal-layout>
</template>

<script>
import ModalLayout from 'Layouts/ModalLayout.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapState } = createNamespacedHelpers('auth');
import validationError from 'Mixins/validation-error';
import { Form } from 'vform';

export default {
  components: {
    ModalLayout
  },
  mixins: [validationError],
  data: () => ({
    form: new Form({
      email: '',
      password: '',
      remember: false
    }),
    password_visible: false
  }),
  computed: {
    icon() {
      return this.password_visible ? 'visibility' : 'visibility_off';
    },
    ...mapState({
      isAuthenticated: 'isAuthenticated'
    })
  },
  mounted() {
    let self = this;
    /* Make Sure We Only Load Login Page If Not Authenticated */
    if (self.isAuthenticated) {
      /* nextick make sure our modal wount be visible before redirect */
      return self.$nextTick(() => self.$router.go(-1));
    }
  },
  methods: {
    resetPassword() {
      let self = this;
      self.$nextTick(() => self.$router.push({ name: 'forgotpassword' }));
    },
    goHome() {
      let self = this;
      self.$nextTick(() => self.$router.push({ name: 'home' }));
    },
    goToRegister() {
      let self = this;
      self.$nextTick(() => self.$router.push({ name: 'register' }));
    },
    redirectBack() {
      let self = this;
      return self.$nextTick(() => self.$router.go(-1));
    },
    login() {
      let self = this;
      self.$validator.validateAll();
      if (!self.errors.any()) {
        self.submit(self.form);
      }
    },
    ...mapActions({
      submit: 'login'
    })
  }
};
</script>
