<template>
  <form class="create-company-form">
    <div class="from-title">
      {{ $t('Upload Avatar') }}
    </div>

    <avatar-upload
      name="avatar"
      :set-field="setField"
    />

    <div class="bottom-block">
      <div class="copy-link" />
      <default-button
        type="button"
        :on-click="handleSubmit"
        class="create-company-submit"
        :loading="formSubmitting"
      >
        {{ $t('Upload İmage') }}
      </default-button>
    </div>
  </form>
</template>

<script>
import AvatarUpload from 'components/forms/profile/AvatarUpload.vue';
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('profile');

export default {
  name: 'UploadPhoto',
  components: {
    AvatarUpload,
    DefaultButton
  },
  props: {
    onSubmit: {
      type: Function,
      default: () => {}
    },
  },
  data:() => ({
    avatar: '',
    avatarPreview: null,
    formSubmitting: false,
  }),
  computed: {
    form () {
      return {
        avatar: this.avatar,
      };
    }
  },
  methods: {
    ...mapActions(['uploadAvatar']),
    async handleSubmit() {
      this.formSubmitting = true;
      await this.uploadAvatar(this.form).then(() => {
        this.onSubmit();
      });
      this.formSubmitting = false;
    },
    setField(name, value, index) {
      if (index >= 0) {
        this[name][index] = value;
      } else {
        this[name] = value;
      }
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .create-company-form{
    padding: 28px 37px;

    .from-title{
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 42px;
      line-height: 59px;
      color: $border-primary-color;
      margin-bottom: 35px;
    }

    .members-container {
      .subtitle {
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 24px;
        line-height: 120%;
        display: flex;
        align-items: center;
        letter-spacing: 0.05em;
        margin-top: 30px;
        color: $text-primary-color;
        margin-bottom: 11px;
      }

      .add-member {
        font-family: Telegraf-UltraBold, serif;
        color: $border-primary-color;
        font-style: normal;
        font-weight: 800;
        font-size: 17px;
        line-height: 100%;
        display: flex;
        align-items: center;
        letter-spacing: 0.05em;
        margin-top: 20px;

        svg {
          height: 9px;
          width: 9px;
          margin-left: 7px;
        }
      }

      &::v-deep .input-group{
        .label{
          text-transform: capitalize;
        }
        input{
          margin-left: 90px;
        }
      }
    }

    .bottom-block{
      display: flex;
      justify-content: space-between;
      margin-top: 20px;

      &::v-deep .create-company-submit {
        font-size: 19px;
        letter-spacing: 0.05em;
        padding: 15px 20px;
      }

      .copy-link{
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 18px;
        line-height: 100%;
        display: flex;
        align-items: center;
        letter-spacing: 0.05em;
        text-decoration-line: underline;
      }
    }
  }
</style>
