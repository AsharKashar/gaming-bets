<template>
  <v-input
    ref="files"
    :value="files"
    validate-on-blur
    :rules="rules.uploadFiles(fileType.extensions, sizeMb)"
    name="files"
    class="upload-wrap"
  >
    <div class="images-wrap">
      <div
        v-if="!files.length"
        class="images-not-file"
      >
        <svg-icon name="camera" />
      </div>
      <div class="images-rules">
        <div class="upload">
          <button class="btn-upload">
            <svg-icon name="upload" />
            <span>upload</span>
          </button>
        </div>
        <div
          class="rules-text"
          v-text="$t(rulesText)"
        />
      </div>
      <div class="files-row">
        <div
          v-for="file in files"
          :key="file.id"
          class="files-item"
        >
          <div class="files-item__inner">
            <button
              class="files-remove"
              @click="removeFile(file.id)"
            >
              <svg-icon name="close" />
            </button>
            <video
              v-if="isVideo(file.type)"
              :src="file.blob"
              controls
            />
            <img
              v-else
              :src="file.blob"
              :alt="file.name"
            >
          </div>
        </div>
      </div>
    </div>
    <up-loader
      class="upload-file"
      :size="sizeToB"
      :value="files"
      :maximum="maxFile"
      :extensions="fileType.extensions"
      :accept="fileType.accept"
      :drop="true"
      :multiple="true"
      @input="setFiles"
      @input-filter="inputFilter"
    />
  </v-input>
</template>

<script>
import UpLoader from 'vue-upload-component';
import SvgIcon from 'components/svgIcons/SvgIcon';
import formRules from 'helpers/formRules';

export default {
  name: 'MultiUploadFiles',
  components: {
    SvgIcon,
    UpLoader
  },
  props: {
    sizeMb: {
      type: Number,
      default: 1
    },
    maxFile: {
      type: Number,
      default: 8
    },
    isImage: {
      type: Boolean,
      default: true,
    },
    isVideoEndImage: {
      type: Boolean,
      default: true,
    },
    rulesText: {
      type: String,
      default: 'max size 1 image and video 1 mb (jpg,png,gif) 8 screens max'
    },
    initVal: {
      type: Array,
      default: () => ([]),
    },
  },
  data: () => ({
    files: [],
    rules: formRules,
    error: '',
  }),
  computed: {
    fileType() {
      const data = {
        accept: '',
        extensions: ''
      };
      if (this.isImage) {
        data.accept = 'image/png,image/gif,image/jpeg';
        data.extensions = 'jpg|png|gif|jpeg';
        if (this.isVideoEndImage) {
          data.accept = data.accept + ',video/*';
          data.extensions = data.extensions + '|avi|wmv|mov|mp4|mov|m4v';
        }
      }
      data.extensions = new RegExp(`\\.(${data.extensions})$`, 'i');
      return  data;
    },
    sizeToB() {
      return this.sizeMb * 1048576;
    },
  },
  mounted() {
    this.files = this.initVal;
  },
  methods: {
    setFiles(files) {
      this.files = files;
      this.updateFiles();
    },
    removeFile(fileId) {
      this.files = this.files.filter(({id}) => id !== fileId);
      this.updateFiles();
    },
    async updateFiles() {
      await this.$nextTick();
      this.$refs.files.validate();
      console.log(this.files);
      this.$emit('update:files', this.files);
    },
    isVideo(type) {
      return /video\/\/*/g.test(type);
    },
    inputFilter(newFile, oldFile) {
      if (newFile && !oldFile) {
        if (this.fileType.extensions.test(newFile.name)) {
          newFile.blob = '';
          let URL = window.URL || window.webkitURL;
          if (URL && URL.createObjectURL) {
            newFile.blob = URL.createObjectURL(newFile.file);
          }
        }
      }

      if (newFile && oldFile) {
        if (!newFile.version) {
          newFile.version = 0;
        }
        newFile.version++;
      }

      if (!newFile && oldFile) {
        // Remove file

        // Refused to remove the file
        // return prevent()
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import '~/assets/styles/colors';

.upload {
  &-wrap {
    border: 2px dashed $text-primary-color;
    border-radius: 20px;
    padding: 24px 16px;
    margin-bottom: 40px;
    position: relative;
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    min-height: 256px;
    &.error--text {
      border-color: $text-secondary-color;
    }

    .files {
      &-wrap {
        width: 100%;
      }
      &-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -5px -5px;
      }
      &-remove {
        position: absolute;
        z-index: 2;
        right: 0;
        top: 0;
        background: $text-secondary-color;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      &-item {
        max-width: 50%;
        flex: 0 0 50%;
        padding: 0 5px 5px;
        &__inner {
          overflow: hidden;
          min-height: 156px;
          z-index: 6;
          position: relative;
          border-radius: 20px;
        }
        img,
        video {
          max-width: 100%;
          position: absolute;
          right: 0;
          left: 0;
          top: 0;
          bottom: 0;
          object-fit: cover;
          width: 100%;
          height: 100%;
        }
        video {
          height: 100%;
          background: #000;
        }
      }
      &-not-file {
        padding-bottom: 15px;
      }
      &-rules {
        padding-bottom: 32px;
        max-width: 340px;
        margin: 0 auto;
        .rules-text {
          line-height: 1.4;
          color: $text-primary-color;
        }
        & .upload {
          padding-bottom: 15px;
        }
        .btn-upload {
          display: inline-flex;
          align-items: center;
          color: $text-secondary-color;
          font-weight: 900;
          span {
            margin-left: 14px;
            text-decoration: underline;
          }
        }
      }
    }
    &::v-deep {
      .v-input__control,
      .v-input__slot,
      .v-messages {
        position: unset;
      }
      .v-messages__message {
        position: absolute;
        bottom: -18px;
        left: 15px;
      }
    }
  }
  &-file {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    &::v-deep {
      label {
        cursor: pointer;
      }
    }
  }

}

</style>
