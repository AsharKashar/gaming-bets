<template>
  <banger-layout :class="[contentClass]">
    <b-section>
      <main-slider />
    </b-section>
    <b-section>
      <featured-games />
    </b-section>

    <cash-area />
    <bomb-area />
    <news-area />
    <topPlayer />
    <bottom-top />
    <signup-popup />
  </banger-layout>
</template>

<script>
import MainSlider from 'Components/home/MainSlider.vue';
import FeaturedGames from 'Components/home/FeaturedGames';
import CashArea from 'Components/home/CashArea.vue';
import BombArea from 'Components/home/BombArea.vue';
import NewsArea from 'Components/home/NewsArea.vue';
import TopPlayer from 'Components/home/TopPlayerArea.vue';
import SignupPopup from 'Partials/SignupPopup.vue';
import BottomTop from 'Partials/BottomTopbutton.vue';
import BangerLayout from 'Layouts/BangerLayout.vue';

export default {
  components: {
    BangerLayout,
    MainSlider,
    FeaturedGames,
    CashArea,
    BombArea,
    NewsArea,
    TopPlayer,
    SignupPopup,
    BottomTop
  },
  data: () => ({
    contentClass: { white: true, 'accent--text': true },
  }),
  mounted () {
    window.Bus.$emit('footer-content-visible', true);
  },
};
</script>
<style scoped>
  .image {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    border: 2px solid #ba9a5a;
    margin: 15px;
  }
</style>
