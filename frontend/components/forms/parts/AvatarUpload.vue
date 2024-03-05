<template>
  <div class="avatar-upload-container">
    <input
      ref="avatar"
      type="file"
      class="avatar-input"
      @change="setAvatar"
    >
    <div
      class="avatar-upload"
      :style="{'background-image': `url(${avatarPreview})`}"
      @click="openUploadManager"
    >
      <upload-icon v-if="!avatarPreview" />
    </div>
    <div class="avatar-name">
      {{ $t('Team Avatar') }}
    </div>
  </div>
</template>

<script>
import UploadIcon from 'components/svgIcons/UploadIcon.vue';
import { toBase64 } from 'helpers/methods';

export default {
  name: 'AvatarUpload',
  components: {
    UploadIcon
  },
  props: {
    setField: {
      type: Function,
      default: () => {}
    },
    name: {
      type: String,
      default: ''
    }
  },
  data: () => ({
    avatarPreview:null
  }),
  methods: {
    async setAvatar () {
      const avatar = this.$refs.avatar.files[0];
      this.avatarPreview = await toBase64(avatar);
      this.setField(this.name, avatar);
      this.setField(`${ this.name }Preview`, this.avatarPreview);
    },
    openUploadManager() {
      this.$refs.avatar.click();
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .avatar-upload-container{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
    flex-direction: column;

    .avatar-input{
      display: none;
    }

    .avatar-upload{
      height: 120px;
      width: 120px;
      border: 2px solid $text-primary-color;
      border-radius: 50%;
      justify-content: center;
      display: flex;
      align-items: center;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .avatar-name{
      margin-top: 15px;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 18px;
      line-height: 100%;
      display: flex;
      align-items: center;
      letter-spacing: 0.05em;
      color: $text-primary-color;
    }
  }
</style>
