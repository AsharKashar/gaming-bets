<template>
  <form>
    <p @click="goBack">
      {{ $t('Step') }} 2 of 3
    </p>
    <h3 class="subtitles-primary mb-3">
      {{ $t('Overview & Rule') }}
    </h3>

    <div class="input-box">
      <div class="label">
        {{ $t('Overview') }}
      </div>
      <textarea
        v-model="overview"
        rows="4"
        :placeholder="$t('Type overview here')"
      />
    </div>

    <div class="input-box mb-5">
      <div class="label">
        {{ $t('Rules') }}
      </div>
      <textarea
        v-model="rules"
        rows="4"
        :placeholder="$t('Type rules here')"
      />
    </div>

    <default-button
      type="button"
      :btn-class="btnClasses"
      :disabled="!isFormValid"
      :on-click="next"
    >
      {{ $t('Next') }}
    </default-button>
  </form>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';

export default {
  components: {
    DefaultButton,
  },
  data() {
    return {
      overview: '',
      rules: '',
    };
  },
  computed: {
    btnClasses() {
      return `default-banger-btn button-block ${
        !this.isFormValid ? 'button-disabled' : ''
      }`;
    },
    isFormValid() {
      let valid = true;
      // return valid;
      if (!this.overview.trim() || !this.rules.trim()) {
        valid = false;
      }
      return valid;
    },
  },
  methods: {
    setField(name, value) {
      this[name] = value;
    },
    next() {
      this.$emit('nextTab');
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
form {
  p,
  h3 {
    color: $text-secondary-color;
  }

  .input-box {
    width: 100%;
    color: $text-primary-color;

    input,
    textarea {
      outline: 0;
      color: $text-primary-color;
      width: 100%;
      resize: none;
      border-bottom: 1px solid $border-secondary-color;
    }

    input::placeholder,
    textarea::placeholder {
      color: $text-primary-color;
      opacity: 0.6;
    }
  }
}
</style>
