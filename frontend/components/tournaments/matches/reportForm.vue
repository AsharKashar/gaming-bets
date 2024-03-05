<template>
  <div class="report-wrapper">
    <Loader :loading="disable" />
    <div
      v-if="congrats"
      class="congrats"
    >
      <p class="heading">
        Congratulations
      </p>
      <p class="sub-heading">
        report has been submited to admin till then wait for final action
      </p>
    </div>
    <div v-else>
      <div class="report-header">
        <p class="report-heading">
          Report Form
        </p>
        <p
          class="report-subtitle"
        >
          Write here all your questions or problems, we will reply to you as soon as possible within our working days
        </p>
      </div>
      <div class="report-body">
        <input-group
          :value="topic"
          name="topic"
          :on-change="setField"
          :label="$t('Topic')"
          placeholder="No invite"
          type="text"
        />

        <v-textarea
          v-model="description"
          name="input-7-1"
          label="Description of problem / question"
        />
      </div>
      <ul>
        <li
          v-for="(filename, i) in label"
          :key="i"
        >
          {{ filename }}
        </li>
      </ul>
      <div class="report-footer">
        <input
          ref="avatar"
          multiple
          type="file"
          class="dnone"
          @change="selectFiles"
        >
        <div
          class="upload-btn"
          @click="openAvatar()"
        >
          <a>
            <img
              src="~/static/images/brackets/upload.svg"
              alt
              class="upload-icon"
            >
            <span>Upload files</span>
          </a>
        </div>

        <div class="footer-btn">
          <default-button
            type="button"
            class="default-banger-btn"
            :on-click="submitReport"
            :disabled="disablee"
          >
            SUBMIT
          </default-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton.vue';
import Loader from 'components/Loader.vue';
export default {
  components: {
    InputGroup,
    DefaultButton,
    Loader,
  },
  data() {
    return {
      label: [],
      topic: '',
      description: '',
      disable: false,
      congrats: false,
    };
  },
  computed: {
    disablee() {
      if (this.topic == '' || this.description == '') {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    setField(name, value) {
      this[name] = value;
    },
    openAvatar() {
      this.$refs.avatar.click();
    },
    selectFiles() {
      let files = this.$refs.avatar.files;
      console.log('files', files[0]);
      for (let index = 0; index < files.length; index++) {
        this.label.push(files[index].name);
      }
    },

    submitReport() {
      this.disable = true;
      setTimeout(() => {
        this.topic = '';
        this.description = '';
        this.$refs.avatar.files = null;
        this.disable = false;
        this.congrats = true;
      }, 3000);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.report-wrapper {
  padding: 3em 3em 3em 3em;
  .report-header {
    .report-heading {
      font-weight: 900;
      font-size: 28px;
      line-height: 10%;
      color: $text-secondary-color;
    }
    .report-subtitle {
      margin-top: 2em;
      font-weight: normal;
      font-size: 16px;
      line-height: 140%;
      color: $text-secondary-color;
    }
  }

  .dnone {
    display: none;
  }
  ul {
    padding: 0;
    margin: 0;
    list-style: none;
    li {
      font-size: 8px;
      color: $text-secondary-color;
    }
  }
  .report-footer {
    display: flex;
    align-items: center;

    .upload-btn {
      flex-basis: 50%;
      a {
        display: flex;
        width: 100%;
        align-items: center;
        span {
          margin-left: 1em;
          font-size: 16px;
          line-height: 94%;
          color: $text-secondary-color;
        }
      }
    }
    img {
      width: 30px;
    }
    .footer-btn {
      flex-basis: 50%;
      width: 100%;
      display: flex;
      justify-content: flex-end;
    }
  }

  .congrats {
    width: 100%;
    text-align: center;
    .heading {
      font-weight: 900;
      font-size: 24px;
      color: $text-secondary-color;
    }
    .sub-heading {
      font-weight: normal;
      font-size: 16px;
      color: $text-hover-color;
    }
  }
}
@media screen and (max-width: $mobile-width) {
  .report-wrapper {
    .report-header {
      .report-heading {
        font-size: 22px;
      }
      .report-subtitle {
        margin-top: 1em;
        font-size: 12px;
      }
    }
  }
  .report-footer {
    flex-direction: column;
  }
  .footer-btn {
    .default-banger-btn {
      width: 100%;
      margin: 1em;
    }
  }
}
</style>
