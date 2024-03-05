<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div
    v-if="brackets[`${$route.params.id}`] && brackets[`${$route.params.id}`].round1"
    class="group-wrapper"
  >
    <Loader :loading="loader" />
    <v-row class="mobile-navidation">
      <v-col md="12">
        <mobile-group-navi @mobileMenu="mobileMenu" />
      </v-col>
    </v-row>
    <rounds
      v-if="groups[0].show && brackets[`${$route.params.id}`].round1.length <=8"
      :matches="brackets[`${$route.params.id}`].round1"
      round="1"
    />
    <rounds
      v-if="groups[1].show&& brackets[`${$route.params.id}`].round1.length <=8"
      :matches="brackets[`${$route.params.id}`].round2"
      round="2"
    />
    <rounds
      v-if="groups[2].show&& brackets[`${$route.params.id}`].round1.length <=8"
      :matches="brackets[`${$route.params.id}`].round3"
      round="3"
    />
    <rounds
      v-if="groups[3].show && brackets[`${$route.params.id}`].round1.length <=8"
      :matches="brackets[`${$route.params.id}`].round4"
      round="4"
    />
    <div
      v-else
      class=""
    >
      <p>Can't render groups because list contain 16 teams kindly </p>
    </div>
    <div
      v-if="winner"
      class="winner-gourp"
    >
      <info-board class="info-baord" />
      <div>
        <p class="winner-text">
          Winner Group A
        </p>
        <div class="team-wrapper">
          <div class="team">
            <v-expansion-panels>
              <team
                :round="brackets[`${$route.params.id}`].round4[0].round"
                :winner="brackets[`${$route.params.id}`].round4[0].winner_id"
              />
            </v-expansion-panels>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Rounds from 'components/tournaments/brackets/rounds';
import Team from 'components/tournaments/brackets/team';
import InfoBoard from 'components/tournaments/brackets/InfoBoard';
import MobileGroupNavi from 'components/tournaments/brackets/mobileGroupNavi';
import Loader from 'components/Loader';

import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';

const tournamentModule = createNamespacedHelpers('tournament');

export default {
  name: 'Group',
  components: {
    MobileGroupNavi,
    InfoBoard,
    Team,
    Rounds,
    Loader,
  },
  data() {
    return {
      groups: [
        { round: 1, show: true, matches: 4 },
        { round: 2, show: true, matches: 2 },
        { round: 3, show: true, matches: 1 },
        { round: 4, show: true, matches: 0 },
      ],
      winner: true,
      mobileSize: false,
    };
  },
  computed: {
    ...tournamentModule.mapState(['brackets', 'tournamentsStatus']),
    loader() {
      return this.tournamentsStatus.status !== 'pending';
    },
  },
  watch: {
    mobileSize(newValue) {
      if (newValue) {
        this.groups.map((round) => {
          round.show = false;
        });
        this.winner = false;
        this.groups[0].show = true;
      } else {
        this.groups.map((round) => {
          round.show = true;
        });
        this.winner = true;
      }
    },
  },
  mounted() {
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    mobileMenu(id) {
      if (id == 5) {
        this.winner = true;
        this.groups.map((round) => {
          round.show = false;
        });
      } else {
        this.groups.map((round) => {
          if (round.round == id) {
            round.show = true;
          } else {
            this.winner = false;
            round.show = false;
          }
        });
      }
    },

    handleResize() {
      if (window.innerWidth > 1024) {
        this.mobileSize = false;
      } else {
        this.mobileSize = true;
      }
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Withdrawal',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.group-wrapper {
  width: 100%;
  padding: 3em 1em;
  display: flex;
  position: relative;

  .full-w {
    width: 100%;
    display: flex;
    position: relative;
  }
  .winner-gourp {
    display: flex;
    width: 100%;
    flex-direction: column;
    justify-content: space-around;
    position: relative;
    text-align: center;
    .info-baord {
      position: absolute;
      top: 1.5em;
      left: 0;
    }
    .winner-text {
      color: $text-secondary-color;
      font-size: 12px;
      line-height: 110%;
    }
  }
}
.v-expansion-panels {
  div {
    width: 100%;
  }
}
@media screen and (max-width: $tablet-large-width) {
  .group-wrapper {
    flex-direction: column;
    padding: 10em 2em 4em 4em;
  }

  .roundOne,
  .roundTwo,
  .roundThree,
  .roundFour {
    margin-top: 6em;
  }

  .info-baord {
    display: none;
  }
  .winner-gourp {
    margin-top: 10em;
  }
}
@media screen and (min-width: $tablet-large-width) {
  .mobile-navidation {
    display: none;
  }
}
.v-tab {
  font-size: 0.7rem;
}
</style>
