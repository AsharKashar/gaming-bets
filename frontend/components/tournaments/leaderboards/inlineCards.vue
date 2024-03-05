<template>
  <div class="inline-cards-wrapper">
    <v-row>
      <v-col
        lg="12"
        md="12"
        sm="12"
        xs="12"
      >
        <div class="board-header">
          <p class="place">
            Place
          </p>
          <p class="team">
            Team
          </p>
          <p class="prize">
            PRIZE
          </p>
        </div>
      </v-col>
    </v-row>
    <v-row>
      <template v-for="(card,index) in leaderBoard">
        <v-col
          v-if="index >= 3 && index <maxlimit"
          :key="card.id"
          lg="12"
          md="12"
          sm="12"
          xs="12"
        >
          <inline-card
            :card="card"
            :index="index"
          />
        </v-col>
      </template>
      <v-col>
        <a
          class="seemore"
          @click="loadmore"
        >see more</a>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import InlineCard from './inlineCard.vue';
export default {
  components: {
    InlineCard,
  },

  props: {
    leaderBoard: {
      type: Array,
      default: () => ([]),
    },
  },
  data() {
    return {
      maxlimit: 10,
      cards: [
        {
          id: 1,
          name: 'Navi’',
          price: '3 750€',
        },
        {
          id: 2,
          name: 'cloud9',
          price: '3 750€ ',
        },
        {
          id: 3,
          name: 'virtus pro',
          price: '1 250€ ',
        },
        {
          id: 4,
          name: 'fnatic',
          price: '1 250€ ',
        },
        {
          id: 5,
          name: 'team solo mid',
          price: '1 250€ ',
        },
      ],
    };
  },

  methods: {
    loadmore() {
      this.maxlimit += 10;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.inline-cards-wrapper {
  width: 100%;
  padding-bottom: 3em;
  padding-top: 2em;
  .board-header {
    padding: 0 2em;
    width: 100%;
    display: flex;
    p {
      font-weight: 900;
      font-size: 24px;
      line-height: 130%;
      margin: 0;
      color: $text-primary-color;
    }
    .place {
      flex-basis: 10%;
    }
    .team {
      flex-basis: 45%;
    }
    .prize {
      flex-basis: 45%;
      text-align: right;
    }
  }

  .seemore {
    float: right;
    padding-right: 1.5em;
    color: $text-secondary-color;
  }
}

@media screen and (max-width: $tablet-large-width) {
  .inline-cards-wrapper {
    padding: 2em;
    .board-header {
      padding: 0 0em;
      p {
        font-size: 18px !important;
      }
    }
  }
}
</style>
