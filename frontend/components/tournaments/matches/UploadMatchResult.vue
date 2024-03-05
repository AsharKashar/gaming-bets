<template>
  <div
    class="p-10"
    @keypress.enter="uploadImage"
  >
    <p
      class="sm"
      @click="$emit('prev-tab')"
    >
      {{ $t('Back') }}
    </p>
    <h2 class="subtitles-primary text-center">
      {{ $t('Please add screenshot to confirm the game') }}
    </h2>

    <input
      ref="avatar"
      multiple
      type="file"
      class="d-none"
      @change="setAvatar"
    >

    <div
      class="image-container mt-5 mb-8"
      @drop.prevent="dragDrop"
      @dragover.prevent
    >
      <div
        class="image-getter"
        @click="openUploadManager"
      >
        <v-avatar
          v-if="!previews.length"
          tile
          size="100"
        >
          <img
            src="~/static/icons/Camera.svg"
            alt
            class="img-fluid"
          >
        </v-avatar>

        <div class="upload-icon my-3">
          <v-avatar
            tile
            size="24"
          >
            <img
              src="~/static/icons/upload-icon.svg"
              alt
              class="img-fluid"
            >
          </v-avatar>
          <p class="sm-bold">
            Upload
          </p>
        </div>

        <p
          class="sm-bold mt-4 upload-description"
        >
          drag and drop or click to upload the image/video. maximum size 25 mb
        </p>
        <p
          v-if="error"
          class="sm-bold mt-2 upload-description text-secondary"
        >
          {{ error }}
        </p>
      </div>

      <div
        v-if="previews.length"
        class="previews"
      >
        <div
          v-for="prev in previews"
          :key="prev.id"
          class="image-preview"
        >
          <img
            v-if="prev.type !== 'video/mp4'"
            :src="prev.src"
            class="match-result-image"
            alt
          >

          <video
            v-else
            controls
          >
            <source
              :src="prev.src"
              type="video/mp4"
            >
            {{ $t('Your browser does not support the video tag.') }}
          </video>

          <div
            class="remove-icon"
            @click="showConfirmation = prev.id"
          >
            <div class="remove-image" />
          </div>
          <div
            v-if="showConfirmation === prev.id"
            class="remove-confirmation"
          >
            {{ $t('delete this image?') }}
            <div class="d-flex">
              <div
                class="cursor-pointer"
                @click="removeImage(prev)"
              >
                {{ $t('Yes') }}
              </div>
              <div
                class="cursor-pointer"
                @click="showConfirmation = null"
              >
                {{ $t('No') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <default-button
      type="button"
      :btn-class="btnClasses"
      :disabled="!isFormValid()"
      :on-click="uploadImage"
      :loading="loading"
    >
      {{ $t('Confirm') }}
    </default-button>
  </div>
</template>
<script>
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');
const authModule = createNamespacedHelpers('auth');
const boxfightModule = createNamespacedHelpers('boxfight');

export default {
  components: {
    DefaultButton,
  },
  props: {
    matchId: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      previews: [],
      totalSize: 0,
      error: null,
      loading: false,
      showConfirmation: null,
    };
  },
  computed: {
    ...boxfightModule.mapState(['currentBoxFight']),
    ...authModule.mapState(['user']),
    btnClasses() {
      return `default-banger-btn button-block mb-5 ${
        !this.isFormValid() ? 'button-disabled' : ''
      }`;
    },
    overallSize() {
      return this.totalSize / 1000000;
    }
  },
  methods: {
    ...tournamentModule.mapActions(['uploadEvidance']),
    ...boxfightModule.mapActions(['getCurrentBoxFight']),
    setAvatar() {
      this.makePreviews(this.$refs.avatar.files);
    },
    dragDrop(e) {
      this.makePreviews(e.dataTransfer.files);
    },
    makePreviews(files) {
      if (files.length > 0) {
        for (let index = 0; index < files.length; index++) {
          if (
            files[index].type !== 'video/mp4' &&
            files[index].type !== 'image/png' &&
            files[index].type !== 'image/jpeg'
          ) {
            return;
          }
          const reader = new FileReader();
          reader.readAsDataURL(files[index]);
          reader.onload = (e) => {
            this.previews.push({
              id: Date.now() + Math.random(),
              src: e.target.result,
              type: files[index].type,
              size: files[index].size,
              file: files[index],
            });
          };
          this.totalSize = this.totalSize + files[index].size;
        }
      }
    },
    isFormValid() {
      if (this.previews.length && this.overallSize <= 20) {
        this.error = null;
        return true;
      } else {
        if (this.previews.length) {
          this.error = 'Total size exceeds the maximum limit...';
        }
        return false;
      }
    },
    openUploadManager() {
      this.$refs.avatar.click();
    },
    async uploadImage() {
      if (this.previews.length >= 8) {
        return (this.error = 'File Limit Exceeds...!!!');
      }
      this.loading = true;
      const formData = new FormData();
      this.previews.forEach((prev, i) => {
        formData.append(`file[${i}]`, prev.file);
      });
      console.log('formdata',this.$refs.avatar.files);
      let matchId=this.matchId;
      this.uploadEvidance({ matchId, formData });
    },
    removeImage(prev) {
      this.previews = this.previews.filter((upload) => upload.id !== prev.id);
      this.totalSize -= prev.size;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.p-10 {
  & > p {
    cursor: pointer;
    color: $text-secondary-color;
  }
  h2 {
    color: $text-secondary-color;
    word-break: unset;
  }
}
.text-secondary {
  color: $text-secondary-color;
}
.image-container {
  border: 2px dashed #a1afd36b;
  border-radius: 20px;
  min-height: 260px;
  height: auto;
  width: 100%;
  display: grid;
  place-items: center;
  text-align: center;
  padding: 20px;

  .upload-description {
    max-width: 80%;
    margin: auto;

    span {
      color: $text-secondary-color;
    }
  }

  .upload-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    p {
      color: $text-secondary-color;
      margin-bottom: 0;
      margin-left: 20px;
    }
  }
  .image-getter {
    cursor: pointer;
  }

  .previews {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
    margin-top: 20px;

    .image-preview {
      position: relative;
      height: 100%;
      text-align: center;
      border-radius: 20px;
      max-height: 200px;

      img,
      video {
        max-height: 200px;
        height: auto;
        max-width: 100%;
        border-radius: 20px;
      }

      .remove-icon {
        cursor: pointer;
        position: absolute;
        background: $button-primary-background;
        color: $text-hover-color;
        top: -1px;
        right: -1px;
        display: inline-block;
        height: 30px;
        width: 30px;
        box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.25);
        border-top-right-radius: 20px;
        .remove-image {
          height: 100%;
          transform: rotate(45deg);

          &:before,
          &:after {
            content: "";
            width: 3px;
            height: 15px;
            background: #212652;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
          }

          &:before {
            transform: translate(-50%, -50%) rotate(90deg);
          }
        }
      }
    }
  }

  .remove-confirmation {
    padding: 1rem;
    width: 150px;
    background: $button-primary-background;
    color: $app-background;
    border-radius: 8px;
    position: absolute;
    top: -10px;
    right: -10px;
    text-transform: uppercase;
    text-align: center;
    font-weight: 900;
    font-family: Telegraf-UltraBold, serif;

    .d-flex {
      margin-top: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-evenly;
    }
  }
  .cursor-pointer {
    cursor: pointer;
  }
}
</style>
