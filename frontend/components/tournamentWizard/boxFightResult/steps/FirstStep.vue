<template>
  <loader
    :loading="loading"
    :center="true"
    height="40px"
  >
    <div
      v-if="currentBoxFight && currentBoxFightTeams"
      class="p-10"
    >
      <h2 class="subtitles-primary mb-5">
        {{ $t('Box Fight') }}
      </h2>

      <v-row>
        <v-col
          cols="12"
          sm="7"
        >
          <h3 class="subtitles-sm-bold">
            {{ currentBoxFight.boxmatch_name }}
          </h3>
        </v-col>
        <v-col
          cols="12"
          sm="5"
        >
          <p class="sm">
            {{ $t('Match type') }}:
            <strong>
              {{
                currentBoxFight.game_type_boxmatch.description
              }}
            </strong>
          </p>
          <p class="sm">
            {{ $t('Platform') }}:
            <strong>{{ currentBoxFight.platform.name }}</strong>
          </p>
          <p class="sm">
            {{ $t('Region') }}:
            <strong>{{ currentBoxFight.region.name }}</strong>
          </p>
          <p class="sm">
            {{ $t('Start Time') }}:
            <strong>{{ currentBoxFight.time.split(" ")[1] }}</strong>
          </p>
          <p class="sm">
            {{ $t('Amount') }}:
            <strong>{{ currentBoxFight.bid_amount }}</strong>
          </p>
        </v-col>
      </v-row>

      <participants />

      <v-row>
        <v-col sm="6">
          <default-button
            class="default-banger-btn button-block"
            :on-click="() => nextTab('won')"
          >
            {{ $t("i've won") }}
          </default-button>
        </v-col>
        <v-col sm="6">
          <default-button
            class="default-banger-btn button-block"
            :on-click="() => nextTab('lost')"
          >
            {{ $t("i've lost") }}
          </default-button>
        </v-col>
      </v-row>

      <p class="my-4">
        <span class="circle" /> {{ $t('LIVE') }}
        <span class="ml-4">{{ $t('review rules') }}</span>
      </p>
    </div>
  </loader>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import Loader from 'components/Loader';
import Participants from '../Participants';

import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('boxfight');

export default {
  components: {
    DefaultButton,
    Loader,
    Participants,
  },
  computed: {
    ...mapState(['currentBoxFight', 'currentBoxFightTeams']),
    loading() {
      return !this.currentBoxFight || !this.currentBoxFightTeams;
    },
  },
  methods: {
    nextTab(result) {
      this.$emit('move-next', result);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";
.p-10 {
  h2 {
    color: $text-secondary-color;
  }
  p {
    color: $text-secondary-color;
    margin-bottom: 0;
    padding-right: 1rem;

    .circle {
      height: 16px;
      width: 16px;
      border-radius: 50%;
      background: $text-secondary-color;
      margin-right: 10px;
      display: inline-block;
    }
  }

  .teams {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
    justify-content: space-between;
    margin: 1rem 0;

    // mob-view
    @media only screen and (max-width: $mobile-width) {
      grid-template-columns: 1fr;
      justify-content: center;
    }

    .team {
      background: $border-secondary-color;
      padding: 2px;
      clip-path: polygon(10% 0%, 100% 1%, 100% 87%, 92% 100%, 0 100%, 0 16%);

      .team-inner {
        padding: 20px;
        display: flex;
        align-items: center;
        background: $app-background;
        clip-path: polygon(10% 0%, 100% 1%, 100% 87%, 92% 100%, 0 100%, 0 16%);
        position: relative;
        p {
          color: $text-primary-color;
        }
        .rank {
          position: absolute;
          right: 10px;
          top: 10px;
        }
      }
    }
  }

  .button-block {
    color: $app-background;
  }
}
</style>
