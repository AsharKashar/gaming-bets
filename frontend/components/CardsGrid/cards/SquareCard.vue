<template>
  <div class="grid-card">
    <div
      class="square-card default-card"
      :style="cardStyle"
    >
      <default-button
        class="card-btn"
        :on-click="openCard"
      >
        {{ $t('Read more') }}
      </default-button>
    </div>
    <div class="square-title">
      {{ title }}
    </div>
    <div class="square-subtitle">
      {{ subtitle }}
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';

export default {
  name: 'SquareCard',
  components: {
    DefaultButton,
  },
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    title: {
      type: String,
      default: 'Untitled',
    },
    subtitle: {
      type: String,
      default: 'Untitled',
    },
    slug: {
      type: String,
      default: '',
    },
    backgroundImage: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      cardStyle: {
        'background-image': `url(${this.backgroundImage})`,
      },
    };
  },
  methods: {
    openCard() {
      this.$router.push(this.slug);
    },
  },
};
</script>

<style scoped lang="scss">
.square-card {
  height: 191px;
  width: 200px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-size: cover;
  background-position: center;

  .category-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-size: 25px;
    line-height: 120%;
    letter-spacing: 0.03em;
    text-align: center;
    padding: 0 5%;
    word-break: break-all;
  }

  .card-btn {
    position: absolute;
    font-size: 12px;
    max-height: 41px;
    max-width: 84px;
  }
}
.grid-card {
  max-width: 200px;

  .square-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-size: 16px;
    padding: 32px 20px 0 5px;
    line-height: 118%;
    letter-spacing: 0.01em;
  }
  .square-subtitle {
    padding: 6px 0 0 4px;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 94%;
  }
}
</style>
