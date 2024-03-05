<template>
  <div class="grid-card">
    <div
      class="square-card default-card"
      :style="cardStyle"
    />
    <v-clamp
      autoresize
      :max-lines="2"
      class="square-title"
    >
      {{ title }}
    </v-clamp>
    <v-clamp
      autoresize
      :max-lines="2"
      class="square-subtitle"
    >
      {{ subtitle }}
    </v-clamp>
    <default-button
      class="card-btn"
      :on-click="openCard"
    >
      {{ $t('Read more') }}
    </default-button>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import VClamp from 'vue-clamp';

export default {
  name: 'SquareCardForList',
  components:{
    DefaultButton,
    VClamp

  },
  props: {
    onClick: {
      type: Function,
      default: () => {}
    },
    title: {
      type: String,
      default: 'Untitled'
    },
    subtitle: {
      type: String,
      default: 'Untitled'
    },
    backgroundImage: {
      type: String,
      default: ''
    },
    slug: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      cardStyle: {
        'background-image': `url(${this.backgroundImage})`
      },
    };
  },
  methods: {
    openCard () {
      this.$router.push(this.slug);
    }
  }
};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';

  .square-card{
    height: 244px;
    width: 256px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-position: center;
  }
  .grid-card{
    max-width: 256px;

    .square-title{
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      line-height: 118%;
      letter-spacing: 0.01em;
      font-size: 20px;
      margin-top: 27px;
      min-height: 46px;
      color: $text-primary-color;

    }
    .square-subtitle{
      font-style: normal;
      font-weight: normal;
      font-size: 16px;
      line-height: 94%;
      margin-top: 7px;
      min-height: 30px;
      color: $text-primary-color;
    }
    .card-btn{
      font-size: 16px;
      max-height: 56px;
      max-width: 111px;
      margin-top: 23px;
    }
  }
</style>
