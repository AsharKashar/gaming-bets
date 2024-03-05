<template>
  <div>
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide
        caption="Call of Duty"
        text="Nulla vitae elit libero, a pharetra augue mollis interdum."
        img-src="assets/images/Content-coder/Call-of-duty-homepage2.jpg"
      />

      <!-- Slides with custom text -->
      <b-carousel-slide img-src="assets/images/Content-coder/Fortnite-Homepage2.png">
        <h1>Fortnite</h1>
      </b-carousel-slide>

      <!-- Slides with image only -->
      <b-carousel-slide img-src="assets/images/Content-coder/Csgo-Homepage2.png" />
    </b-carousel>

    <p class="mt-4">
      Slide #: {{ slide }}<br>
      Sliding: {{ sliding }}
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      slide: 0,
      sliding: null
    };
  },
  methods: {
    onSlideStart() {
      this.sliding = true;
    },
    onSlideEnd() {
      this.sliding = false;
    }
  }
};
</script>
