<template>
  <div
    class="contact-us-card"
    :class=" {'primary-card' :!isFaq, 'secondery-card': isFaq }"
  >
    <v-form class="form-section">
      <v-row>
        <v-col md="4">
          <span class="card-title">{{ pageTitle }}</span>
        </v-col>
        <v-col
          md="8"
          class="pl-12"
        >
          <span
            class="normal-text card-detail-text"
          >{{ $t('Please fill the form and we will reply to you as soon as possible within our working days.') }}</span>
        </v-col>
      </v-row>
      <div class="input-box mt-6">
        <span class="label">{{ $t('Title') }}</span>
        <input
          v-model="form.subjectTitle"
          type="text"
          placeholder="Enter title here"
        >
      </div>
      <v-divider class="custom-divider" />

      <div class="input-box">
        <span class="label">{{ $t('E-mail') }}</span>
        <input
          v-model="form.email"
          type="text"
          placeholder="example@email.com"
        >
      </div>
      <v-divider class="custom-divider" />

      <div class="input-box">
        <span class="label description-border">{{ $t('Description') }}</span>
        <v-textarea
          v-model="form.description"
          rows="1"
          auto-grow
          single-line
          :placeholder="$t('Enter your question here')"
        />
      </div>
      <v-row class="action-bar">
        <v-col md="6">
          <div class="file-upload">
            <v-file-input
              v-model="form.files"
              hide-details
              prepend-icon
              :placeholder="$t('Upload Image')"
            >
              <template v-slot:selection="{ text }">
                <v-chip
                  small
                  label
                >
                  {{ text }}
                </v-chip>
              </template>
            </v-file-input>
            <div class="max-size">
              {{ $t('Max Size') }} : 3MB
            </div>
          </div>
        </v-col>
        <v-spacer />
        <v-col
          md="4"
          class="d-flex align-center justify-end"
        >
          <default-button
            :loading="loading"
            type="button"
            :disabled="!isFormValid"
            :class="{'send-button' : false, 'button-disabled' : !isFormValid}"
            :on-click="submitForm"
          >
            {{ $t('Send') }}
          </default-button>
        </v-col>
      </v-row>
    </v-form>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import Vue from 'vue';

import { createNamespacedHelpers } from 'vuex';
import { emailReg } from 'helpers/regExpRules';
const faqModule = createNamespacedHelpers('faq');

export default {
  name: 'ContactForm',
  components: {
    DefaultButton,
  },
  props: {
    pageTitle: {
      type: String,
      default: 'Ask question',
    },
    isFaq: {
      type: Boolean,
      default: false,
    },
    closeModal: {
      type: Function,
      default: () => {},
    },
  },
  data: () => ({
    files: [],
    loading: false,
    form: {
      subjectTitle: null,
      email: null,
      description: null,
      files: [],
    },
  }),
  computed: {
    isFormValid() {
      let valid = false;
      if (
        !this.form.subjectTitle ||
          !this.form.email ||
          !this.form.description
      ) {
        valid = false;
      } else {
        if (emailReg.test(this.form.email)) {
          valid = true;
        }
      }
      return valid;
    },
  },
  methods: {
    ...faqModule.mapActions(['askQuestion']),
    submitForm() {
      const data = {
        username: this.form.subjectTitle,
        email: this.form.email,
        description: this.form.description,
        file: this.form.files,
      };
      this.loading = true;
      this.askQuestion(data)
        .then((res) => {
          Vue.notify({
            group: 'custom-notification',
            title: res.message,
            text: 'Question asked successfully',
            type: 'success',
          });
          this.$emit('closeDailouge');
        })
        .catch((err) => {
          Vue.notify({
            group: 'custom-notification',
            title: err.message || 'Error',
            text: 'Error Occured',
            type: 'error',
          });
        })
        .finally(() => {
          this.loading = false;
        });
     
    },

  },
};
</script>


<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .primary-card {
    border: 8px solid $text-primary-color;
    box-sizing: border-box;
    border-radius: 32px;

    .file-upload,
    .card-title,
    .card-detail-text {
      color: $text-primary-color;
    }

    .send-button {
      background: $text-primary-color;
      box-shadow: none;
      padding: 24px 16px;
      color: $app-background;
    }
  }

  .secondery-card {
    .card-title,
    .card-detail-text,
    .file-upload {
      color: $border-primary-color;
    }
  }
  .card-detail-text {
    font-size: 20px;
    line-height: 120%;
  }

  .contact-us-card {
    min-height: 569px;
    padding: 56px 40px;
    max-width: 100%;
    position: relative;
    background: $app-background;

    .card-title {
      font-weight: 900;
      font-size: 32px;
      line-height: 115%;
      /* or 37px */
      letter-spacing: 0.02em;
    }
    .custom-divider {
      margin: 16px 0;
      border-bottom: 2px solid;
      color: $text-primary-color;
    }

    .input-box {

      
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: $text-primary-color;

      .label {
        width: 40%;
        font-weight: 800;
        font-size: 20px;
        line-height: 110%;
      }

      .description-border
      {
        border-bottom: 2px solid $text-primary-color;
        margin-bottom: -3px;
      }

      input,
      textarea {
        width: 60%;
        outline: 0;
        color: $text-primary-color;
        font-weight: normal;
        font-size: 16px;
        line-height: 140%;
      }

      input::placeholder,
      textarea::placeholder {
        color: $text-primary-color;
        font-weight: normal;
        font-size: 16px;
        line-height: 140%;
      }

      &::v-deep textarea {
        max-height: 95px;
        overflow-y: auto;
        color: $text-primary-color;
        border-bottom: 1px solid $text-primary-color;

        &::-webkit-scrollbar {
          width: 6px;
          border-radius: 22px;
        }

        &::-webkit-scrollbar-track {
          background: #010431; /* color of the tracking area */
        }
        &::-webkit-scrollbar-thumb {
          background-color: $text-secondary-color; /* color of the scroll thumb */
          border-radius: 20px; /* roundness of the scroll thumb */
        }
        &::-webkit-scrollbar-thumb:hover {
          background-color: #920a27;
        }
      }
    }

    .action-bar {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      width: inherit;
      bottom: 30px;
      width: 90%;

      .file-upload {
        .v-input__prepend-outer {
          display: none !important;
        }

        &::v-deep .v-file-input__text--placeholder {
          font-family: Telegraf-UltraBold, serif;
          font-style: normal;
          font-weight: 800;
          font-size: 18px;
          line-height: 110%;
          letter-spacing: 0.12em;
          text-transform: uppercase;
          color: $text-secondary-color;
        }

        &::v-deep .v-input__slot:before {
          display: none;
          border: none;
        }

        .max-size {
          color: $text-primary-color;
          margin-top: 2px;
          font-size: 16px;
          line-height: 140%;
        }
      }
    }
  }
</style>

