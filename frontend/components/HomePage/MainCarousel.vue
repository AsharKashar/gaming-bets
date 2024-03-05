<template>
  <div class="carousel-container">
    <carousel
      class="carousel"
      :slides-count="carouselTournaments.data.length"
    >
      <home-page-slide
        v-for="(slide, i) in carouselTournaments.data"
        :key="i"
        :slide="slide"
      />
    </carousel>
  </div>
</template>

<script>
import Carousel from 'components/Carousel';
import HomePageSlide from 'components/Carousel/parts/HomePageSlide';

import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');

export default {
  components: {
    Carousel,
    HomePageSlide
  },
  props: {},
  data: () => {
    return {
      carousal: 0,
    };
  },
  computed: {
    ...tournamentModule.mapState(['carouselTournaments']),
    activeTournament() {
      return this.carouselTournaments.data[this.carousal] || {};
    }
  },
  async created() {
    await this.getTournaments({
      params: {
        featured: '1'
      },
      commit: 'setCarouselTournaments'
    });
  },
  methods: {
    ...tournamentModule.mapActions(['getTournaments']),
    doNothing() {
      console.log('doNothing');
    }
  }
};
</script>
