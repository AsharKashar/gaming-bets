<template>
  <div class="upload-image">
    <input
      :id="id"
      ref="file"
      class="upload-image__input"
      type="file"
      accept="image/png, image/jpeg"
      @change="changeFile"
    >
    <slot />
    <div
      v-if="!$slots.default"
      class="upload-image__label-wrap"
    >
      <label
        class="upload-image__label"
        :for="id"
      >
        <span class="upload-image__img">
          <img
            v-if="imageSrc"
            :src="imageSrc"
          >
          <span
            v-else
            class="upload-image__not-icon"
          >
            <upload-icon />
          </span>
        </span>
        <span class="upload-image__rules">
          <span class="upload-image__rules-title">{{ $t('upload your team avatar') }}</span>
          <span class="upload-image__rules-description">
            {{ $t('max size avatar 240x240, formats:jpeg, png, jpg') }}
          </span>
        </span>
      </label>
      <div
        v-if="isImg"
        class="upload-image__close"
        @click="closeImg"
      >
        <cross />
      </div>
    </div>
    <v-slide-y-transition>
      <div
        v-if="error[0]"
        class="upload-image__error"
        v-text="error[0]"
      />
    </v-slide-y-transition>
  </div>
</template>

<script>
import uniqueId from 'lodash/uniqueId';
import UploadIcon from 'components/svgIcons/UploadIcon.vue';
import Cross from 'components/svgIcons/Cross';

export default {
  name: 'UploadImage',
  components: {
    Cross,
    UploadIcon
  },
  props: {
    name: {
      type: String,
      required: true,
    },
    rules: {
      type: Array,
      default: () => ([]),
    }
  },
  data: () => ({
    file: null,
    error: [],
    imageSrc: null,
    isImg: false,
    id: null,
  }),
  mounted() {
    this.id = uniqueId('upload_input_');
  },
  methods: {
    closeImg() {
      this.error = [];
      this.file = null;
      this.imageSrc = null;
      this.isImg = false;
      this.$emit('isError', {name: 'uploadImage'});
    },
    setError() {
      this.error = this.rules.map((fun) => {
        const isError = fun(this.file);
        return isError;
      }).filter((error) => typeof error === 'string');
      const error = this.error.length ? this.error : false;
      this.$emit('isError', {
        name: 'uploadImage',
        error,
      });
      return error;
    },
    changeFile({target}) {
      this.file = target.files[0];
      if (this.file) {
        const reader = new FileReader();
        reader.addEventListener('load', () => this.setImageReader(reader));
        reader.readAsDataURL(this.file);
      } else {
        this.imageSrc = null;
      }
    },
    setImageReader(reader) {
      const img = new Image();
      img.src = reader.result;
      img.addEventListener('load', () => {
        this.$set(this.file, 'width', img.width);
        this.$set(this.file, 'height', img.height);
        this.isImg = true;
        if (this.setError().length) {
          this.file = null;
          this.imageSrc = null;
        } else {
          this.imageSrc = img.src;
        }

        this.$emit('setData', {[this.name]: this.file});
      });
    },
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
.upload-image {
  position: relative;
  overflow: hidden;
  color: $text-primary-color;
  margin-bottom: 20px;
  &__input {
    left: -99999px;
    position: absolute;
  }
  &__label {
    clip-path: polygon(3% 0, 100% 0, 100% 85%, 97% 100%, 0 100%, 0 15%);
    background: $app-background;
    display: flex;
    flex-wrap: wrap;
    cursor: pointer;
    & span {
      display: block;
      width: 100%;
    }
    &-wrap {
      clip-path: polygon(3% 0, 100% 0, 100% 85%, 97% 100%, 0 100%, 0 15%);
      padding: 2px;
      background: $text-primary-color;
    }
  }
  &__error {
    color: $accent-error-color;
  }
  & &__img {
    max-width: 99px;
    flex: 0 0 99px;
    border-right: 2px solid $text-primary-color;
    background: rgb(190 19 56 / 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    img {
      max-width: 100%;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  &__close {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
    svg {
      width: 15px;
      height: 15px;
    }
  }
  &__rules {
    padding: 26px 20px;
    max-width: calc(100% - 99px);
    flex: 0 0 calc(100% - 99px);
    &-title {
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 8px;
    }
    &-description {
      font-size: 12px;
      line-height: .94;
    }
  }
}
</style>
