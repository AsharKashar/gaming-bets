<template>
  <div class="last-step">
    <img
      v-if="!hideBanger"
      src="~/static/images/bangerman.png"
      class="img-fluid"
      alt
    >
    <h3 class="subtitles-primary">
      {{ title }}
    </h3>

    <div class="experience mb-5 mt-10">
      <div v-if="xp">
        <p class="subtitles-primary">
          {{ xp }}
        </p>
        <p class="bold">
          {{ $t('xp') }}
        </p>
      </div>
      <div>
        <p class="subtitles-primary">
          {{ coins }}+
        </p>
        <p class="bold">
          {{ $t('COINS') }}
        </p>
      </div>
    </div>

    <default-button
      type="button"
      btn-class="default-banger-btn button-block"
      :on-click="finish"
    >
      {{ $t('Continue') }}
    </default-button>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
export default {
  components: {
    DefaultButton
  },
  props: {
    title: {
      type: String,
      default: ''
    },
    hideBanger: {
      type: Boolean,
      default: false
    },
    coins: {
      type: String,
      default: ''
    },
    xp: {
      type: String,
      default: ''
    }
  },
  methods: {
    finish() {
      this.$emit('finish');
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.last-step {
  text-align: center;
  padding: 2rem;

  h3 {
    color: $text-secondary-color;
    word-break: unset;
  }

  .img-fluid {
    max-width: 190px;
    height: auto;
  }
  .experience {
    display: flex;
    justify-content: space-evenly;
  }
}
</style>
