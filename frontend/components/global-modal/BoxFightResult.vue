<template>
  <div class="last-step">
    <img
      v-if="matchResult.result"
      src="~/static/images/bangerman.png"
      class="img-fluid"
      alt
    >
    <h3 class="subtitles-primary">
      {{ matchResult.title }}
    </h3>

    <div class="experience mb-5 mt-10">
      <div v-if="matchResult.XP">
        <p class="subtitles-primary">
          +{{ matchResult.XP }}
        </p>
        <p class="bold">
          {{ $t('XP') }}
        </p>
      </div>
      <div>
        <p class="subtitles-primary">
          {{ matchResult.result ? '+' : '-' }}{{ matchResult.coins }}
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
import DefaultButton from 'components/DefaultButton';

import { createNamespacedHelpers } from 'vuex';
const { mapState, mapMutations } = createNamespacedHelpers('modal');

export default {
  name: 'BoxFightReult',
  components: {
    DefaultButton,
  },
  computed: {
    ...mapState(['modalOptions']),
    matchResult() {
      return this.modalOptions;
    },
  },
  methods: {
    ...mapMutations(['clearModal']),
    finish() {
      this.clearModal();
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
