<template>
  <mdb-carousel
    :items="9"
    multi
    indicators
    controlls
    slide
    :interval="8000"
  >
    <template
      v-for="(img, i) in basic"
      #[i+1]
    >
      <mdb-card :key="i">
        <mdb-card-image
          :src="img.image"
          alt="Card image cap"
        />
        <mdb-card-body>
          <mdb-card-title>{{ i + 1 }}</mdb-card-title>
          <mdb-card-text>
            Some quick example text to build on the card title and
            make up the bulk of the card's content.
          </mdb-card-text>
          <mdb-btn
            color="primary"
            size="md"
          >
            Button
          </mdb-btn>
        </mdb-card-body>
      </mdb-card>
    </template>
  </mdb-carousel>
</template>

<script>
import {
  mdbCarousel,
  mdbBtn,
  mdbCard,
  mdbCardImage,
  mdbCardText,
  mdbCardBody
} from 'mdbvue';
import { getFeaturedGames } from 'Api/home';

export default {
  name: 'CarouselPage',
  components: {
    mdbCarousel,
    mdbBtn,
    mdbCard,
    mdbCardImage,
    mdbCardText,
    mdbCardBody
  },
  data() {
    return {
      basic: []
    };
  },
  mounted () {
    getFeaturedGames().then(response => {
      this.basic = response.data;
    });
  }
};
</script>
