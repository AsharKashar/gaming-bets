<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <v-container>
    <v-form
      ref="form"
      class="custom-forms"
      @submit.prevent="onSubmit"
    >
      <div class="back-header-button">
        <a
          class="go-back"
          @click="$router.go(-1)"
        > {{ $t('Go back') }}</a>
      </div>
      <v-text-field
        v-model="currentPassword"
        :label="$t('Current Password')"
        placeholder="**********"
        type="password"
        name="current_password"
        :rules="[rules.password[0]]"
      />
      <v-text-field
        v-model="newPassword"
        :label="$t('New Password')"
        placeholder="**********"
        type="password"
        name="new_password"
        :rules="[...rules.password, ... [(v) => v !== currentPassword || 'New Password should not be same as current password']]"
      />
      <v-text-field
        v-model="confirmPassword"
        :label="$t('Confirm Password')"
        placeholder="**********"
        type="password"
        name="password_confirmation"
        :rules="[...rules.password, ...rules.confirmPass(newPassword)]"
      />
      <div class="actions-btns">
        <default-button
          :loading="loading"
          type="submit"
        >
          {{ $t('Save') }}
        </default-button>
      </div>
    </v-form>
  </v-container>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('auth');
import DefaultButton from 'components/DefaultButton';
import mixinForm from '@/mixins/mixinForm';
import Vue from 'vue';
import { APP_URL } from 'configs/config';

export default {
  name: 'ChangePassword',
  components: {
    DefaultButton,
  },
  middleware: ['hideHeader'],
  mixins: [mixinForm],
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
    };
  },
  computed: {
    ...mapState(['user']),
  },
  methods: {
    onSubmit() {
      if (!this.form.validate()) {
        return;
      }
      this.loading = true;
      this.$bangerApi
        .post('/profile/changePassword', {
          id: this.user.id,
          currentPassword: this.currentPassword,
          newPassword: this.newPassword,
          confirmPassword: this.confirmPassword,
        })
        .then((response) => {
          this.currentPassword = '';
          this.newPassword = '';
          this.confirmPassword = '';

          Vue.notify({
            group: 'custom-notification',
            title: 'Password Changed',
            text: response.data.message,
            type: 'success',
          });
        })
        .catch(() => {
          Vue.notify({
            group: 'custom-notification',
            title: 'Error',
            text: 'Error',
            type: 'error',
          });
        })
        .finally(() => {
          this.$router.go(-1);
          this.form.resetValidate();
          this.loading = false;
        });
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Change Password',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.go-back {
  font-family: Telegraf-Regular;
  font-weight: 800;
  font-size: 20px;
  line-height: 94%;
  text-decoration: none;
  color: #be1338;
  margin-bottom: 44px;
}

.v-application .custom-forms {
  color: $text-primary-color;
  .error--text {
    color: $text-secondary-color !important;
    caret-color: $text-secondary-color !important;
  }

  .back-header-button {
    margin: 22px 0;
  }

  .actions-btns {
    margin: 36px 0 4px;
  }

  a {
    text-decoration: none;
    color: $text-secondary-color;
  }

  .v-text-field {
    padding-top: 0;
    margin: 0 0 10px;
    & > .v-input__control {
      position: relative;
      & > .v-input__slot {
        &::before {
          border-color: currentColor;
        }
        & > .v-text-field__slot {
          align-items: center;
          padding: 0;
          .v-label {
            @media all and (min-width: $tablet-small-width) {
              position: static !important;
              width: 100%;
              flex: 0 0 200px;
              max-width: 200px;
              text-align: right;
              color: $text-primary-color;
              line-height: 1.4;
              transform-origin: unset;
              height: auto;
              transform: none;
              padding-right: 33px;
            }
            &.error--text + input {
              &::-webkit-input-placeholder,
              &::-moz-placeholder,
              &:-moz-placeholder,
              &:-ms-input-placeholder,
              &::placeholder {
                color: $text-secondary-color;
                opacity: 1;
              }
            }
          }
          input {
            @media all and (min-width: $tablet-small-width) {
              width: 100%;
              flex: 0 0 calc(100% - 200px);
              max-width: calc(100% - 200px);
            }
          }
        }
      }
      & > .v-text-field__details {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -12px;
        .v-messages__message {
          text-align: center;
        }
      }
    }
  }

  .member {
    text-align: center;
    font-weight: 800;
  }

  .form-error {
    padding: 15px;
    text-align: center;
    font-weight: bold;
    color: $text-secondary-color;
  }
}

@media all and (max-width: $tablet-small-width) {
  .v-application .custom-forms {
    .back-header-button {
      margin: 22px 0;
    }

    .v-text-field {
      margin-bottom: 20px;
    }
  }
}
</style>
