<template>
  <div
    class="tournament__card-wrap"
    @click="openTournament(tournament.id)"
    @mouseover="hover = true"
    @mouseleave="hover = false"
  >
    <div
      class="tournament__card"
    >
      <div class="tournament__card-inner">
        <div
          class="tournament__card-img"
          :style="tournamentImageStyle"
        />
        <div class="tournament__card-content">
          <div class="tournament__card-content-heading">
            <div class="tournament__card-content-heading__inner">
              <div
                class="tournament__title"
                v-text="tournament.name"
              />
              <div class="tournament__info-grid">
                <div
                  v-for="(val, key) in tournamentInfoItems"
                  :key="key"
                  class="tournament__info--col tournament__info--date"
                >
                  <div
                    class="tournament__info-heading"
                    v-text="key"
                  />
                  <div
                    class="tournament__info-content"
                    v-text="val"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="tournament__card-content-action">
            <default-button
              class="join-btn"
              :class="actionButtonText(tournament).class"
              :disabled="actionButtonText(tournament).disabled"
              @click.native.stop="openJoinTournamentWizard(tournament)"
            >
              <span
                class="inner-btn-dynamic"
                v-html="actionButtonText(tournament).text"
              />
            </default-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import tournamentMixin from '@/mixins/tournamentMixin';
import DefaultButton from 'components/DefaultButton';
import dayjs from 'dayjs';
import get from 'lodash/get';

export default {
  name: 'TournamentCard',
  components: {DefaultButton},
  mixins: [tournamentMixin],
  props: {
    tournament: {
      type: Object,
      default: () => ({}),
    }
  },
  data: () => ({
    hover: false,
  }),
  computed: {
    tournamentImageStyle() {
      let gradient = 'linear-gradient(359.11deg, #111542 -24.55%, rgba(17, 21, 66, 0.28) 99.27%),';
      if (this.hover) {
        gradient = '';
      }
      return ({
        backgroundImage: `${gradient} url(${this.tournament.image_url})`,
      });
    },
    formatDate() {
      return dayjs(this.tournament.start_at).format('MMMM DD / hh:mm A');
    },
    tournamentInfoItems() {
      return ({
        starts: this.formatDate,
        reward: Math.round(+get(this.tournament, 'prizes[0]prize', 0)),
        playtype: get(this.tournament, 'game_type.name', ''),
      });
    }
  },
};
</script>

<style scoped>

</style>
