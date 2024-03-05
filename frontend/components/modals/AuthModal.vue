<template>
  <div>
    <v-dialog
      :value="dialog"
      max-width="540"
      class="auth-modal"
      persistent
      overlay-opacity="0.4"
      overlay-color="#A1AFD3"
      @input="setModal($event)"
      @keydown="setModal($event.key === 'Escape')"
    >
      <div class="banger-default-dialog invisible-scrollbar">
        <login-form
          v-if="dialogType==='login'"
          @setDialogType="setDialogType($event)"
          @onSubmit="closeModal"
        />
        <register-form
          v-if="dialogType==='create'"
          @setDialogType="setDialogType($event)"
          @onSubmit="closeModal"
        />
        <o-auth-create-user-email-form
          v-if="dialogType === 'notEmail'"
          @onSubmit="closeModal"
          @setDialogType="setDialogType($event)"
        />
      </div>
      <div @click="closeModal">
        <cross class="close-btn" />
      </div>
    </v-dialog>
  </div>
</template>

<script>
import LoginForm from 'components/forms/LoginForm.vue';
import RegisterForm from 'components/forms/RegisterForm.vue';
import Cross from 'components/svgIcons/Cross.vue';
import OAuthCreateUserEmailForm from 'components/forms/OAuthCreateUserEmailForm';

export default {
  name: 'LoginModal',
  components: {
    OAuthCreateUserEmailForm,
    LoginForm,
    RegisterForm,
    Cross,
  },
  props: {
    dialogType: {
      type: String,
      default: 'login',
    },
    dialog: {
      type: Boolean,
      default: false,
    },
    closeModal: {
      type: Function,
      default: () => {},
    },
    setDialogType: {
      type: Function,
      default: () => {},
    },
  },
  methods: {
    setModal(close = true) {
      if (close) this.closeModal();
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
.static {
  padding: 20px;
}

.auth-modal {
  position: relative;
}
.banger-default-dialog {
  max-height: 85vh;
  overflow: auto;
  border: none;
}

.close-btn {
  position: absolute;
  cursor: pointer;
  height: 40px;
  width: 40px;
}
@media all and (max-width: $tablet-small-width) {
  .close-btn {
    top: -35px;
    right: 0;
    height: 30px;
    width: 30px;
  }
}
@media all and (min-width: $tablet-small-width) {
  .close-btn {
    top: 0;
    right: -65px;
  }
}
</style>
