<template>
  <div class="last-step">
    <img
      src="~/static/images/bangerman.png"
      class="img-fluid"
      alt
    >
    <h3 class="subtitles-primary">
      {{ $t('Match Created') }}
    </h3>

    <div class="experience mb-5 mt-10">
      <div>
        <p class="subtitles-primary">
          +{{ experience.xp }}
        </p>
        <p class="bold">
          {{ $t('XP') }}
        </p>
      </div>
      <div>
        <p class="subtitles-primary">
          {{ experience.coins }}+
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
    DefaultButton,
  },
  props: {
    experience: {
      type: Object,
      default: () => ({}),
    },
  },
  methods: {
    finish() {
      this.$emit('finish');
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.last-step {
  text-align: center;

  h3 {
    color: $text-secondary-color;
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
