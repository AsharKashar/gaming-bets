<template>
  <div class="cards-wrapper">
    <v-row>
      <template
        v-for="(card,index) in leaderBoard"
      >
        <v-col
          v-if="index < 3"
          :key="card.id"
          lg="4"
          md="4"
          sm="12"
          xs="12"
        >
          <card :card="card" />
        </v-col>
      </template>
    </v-row>
  </div>
</template>

<script>
import Card from './card.vue';
export default {
  components: {
    Card,
  },
  props: {
    leaderBoard: {
      type: Array,
      default: () => ([]),
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.cards-wrapper {
  width: 100%;
  .card-loop {
    width: 100%;
  }
}
@media screen and (max-width: $tablet-large-width) {
  .cards-wrapper {
    padding: 2em;
  }
}
</style>
