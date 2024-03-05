<template>
  <loader
    :loading="loading"
    :overlay="false"
    :center="true"
    height="300px"
  >
    <div class="sidebar">
      <div class="team-joined">
        <div
          class="register-info"
          :class="{ 'register--closed': !status }"
        >
          <div class="register-info__heading">
            {{ registration.status }}
          </div>
          <countdown :tomorrow="registration.date" />
          <div class="register-info__team">
            <div class="register-info__team-heading">
              <b v-if="currentBoxFightTeams">
                {{ boxFightTeams.playersJoined }}
              </b>
            </div>
            <div>{{ $t("Players") }}</div>
          </div>

          <div>
            <div class="register-info__team-icons">
              <div
                v-for="team in boxFightTeams.formatedTeams.team1"
                :key="team.id"
                class="register-info__team-join"
              >
                <v-avatar
                  v-if="!team.empty"
                  width="40"
                  height="40"
                  min-width="40"
                  class="register-info__team-join-avatar"
                >
                  <img
                    v-if="team.user.avatar_url"
                    :src="team.user.avatar_url"
                    :alt="team.user.name"
                  >
                  <img
                    v-else
                    src="~/static/icons/userIcon.svg"
                    alt
                  >
                </v-avatar>
                <div
                  v-else
                  class="placeholder"
                />
              </div>

              <p class="bold ml-5 mr-7 mb-0">
                VS
              </p>

              <div
                v-for="(team, i) in boxFightTeams.formatedTeams.team2"
                :key="team.id + i"
                class="register-info__team-join"
              >
                <v-avatar
                  v-if="!team.empty"
                  width="40"
                  height="40"
                  min-width="40"
                  class="register-info__team-join-avatar"
                >
                  <img
                    v-if="team.user.avatar_url"
                    :src="team.user.avatar_url"
                    :alt="team.user.name"
                  >
                  <img
                    v-else
                    src="~/static/icons/userIcon.svg"
                    alt
                  >
                </v-avatar>
                <div
                  v-else
                  class="placeholder"
                />
              </div>
            </div>
            <!--ONLY if match is in live state  -->
            <p
              v-if="currentBoxFight.remarks === matchState.LIVE"
              class="text-center bold relative"
            >
              <span class="green-circle" /> Match is live
            </p>
          </div>
          <box-match-action />
        </div>
      </div>
    </div>
  </loader>
</template>

<script>
import Countdown from 'components/Countdown';
import Loader from 'components/Loader';
import BoxMatchAction from './BoxFightAction';
import dayjs from 'dayjs';
import { createNamespacedHelpers } from 'vuex';
const boxfightModule = createNamespacedHelpers('boxfight');
import { JOINING_MATCH_STATES } from 'helpers/constants';
export default {
  name: 'TournamentsSideBar',
  components: { Countdown, Loader ,BoxMatchAction },
  props: {
    registerDateFinished: {
      type: String,
      default: '',
    },
    teamJoined: {
      type: Array,
      default: () => ([]),
    },
    maxTeam: {
      type: Number,
      default: 0,
    },
    teamJoinedTotal: {
      type: Number,
      default: 0,
    },
    status: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    ...boxfightModule.mapState([
      'currentBoxFight',
      'currentBoxFightTeams',
    ]),
    registration() {
      let finishDate = this.currentBoxFight.time;

      const reg = {
        status: 'Registration Open',
        date: new Date(finishDate),
      };

      if (dayjs(reg.date).diff(new Date()) < 0) {
        reg.status = 'Registration Closed';
        reg.date = null;
      }

      if (
        (this.boxFightTeams.isBoxMatchFull) ||
        dayjs(reg.date).diff(new Date()) < 0
      ) {
        reg.status = 'Fight Time';
      }

      return reg;
    },
    teamCount() {
      if (this.teamJoinedTotal <= this.maxTeam) {
        return `${this.teamJoinedTotal}/${this.maxTeam}`;
      }
      return this.teamJoinedTotal;
    },
    loading() {
      return !this.currentBoxFightTeams ? true : false;
    },
    boxFightTeams() {
      if(this.currentBoxFightTeams){
        const team1 = [...this.currentBoxFightTeams.team1];
        const team2 = [...this.currentBoxFightTeams.team2];
        // #1 === 1v1 ,,,, #2 === 2v2
        const matchTypeId = this.currentBoxFight.game_type_boxmatch.id;
  
        let isBoxMatchFull = false;
        if (+matchTypeId === 1 && team2.length) {
          isBoxMatchFull = true;
        }
        if (team1.length === 2 && team2.length === 2) {
          isBoxMatchFull = true;
        }
  
        let teamA = [...team1];
        let teamB = [...team2];
  
        if (+matchTypeId === 1) {
          if (teamB.length <= 0) {
            teamB.push({ empty: true, id: Date.now() + Math.random() });
          }
        } else {
          if (teamA.length < 2) {
            teamA.push({ empty: true, id: Date.now() + Math.random() });
          }
  
          for (let i = 0; i < 2; i++) {
            if (teamB.length < 2) {
              teamB.push({ empty: true, id: Date.now() + Math.random() });
            }
          }
        }
  
        let totalPlayers = 4;
        let joinedPlayers = 0;
        if (+matchTypeId === 1) {
          totalPlayers = 2;
          team2.length ? joinedPlayers++ : 0;
        }
        joinedPlayers = team1.length + team2.length;
        return {
          formatedTeams: {
            team1: teamA,
            team2: teamB,
          },
          playersJoined: joinedPlayers + '/' + totalPlayers,
          isBoxMatchFull,
        };
      }

      return {
        formatedTeams: {
          team1: [],
          team2: [],
        },
        playersJoined: 0 + '/' + 0,
        isBoxMatchFull : false,
      };
    },
    matchState() {
      return JOINING_MATCH_STATES;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
.sidebar {
  .team-joined {
    background: $light-blue-background;
    padding: 24px 20px 40px;
    clip-path: polygon(100% 0, 100% 92%, 88% 100%, 0 100%, 0 0);
    .register-info {
      color: $text-primary-color;
      line-height: 1;
      &__heading {
        font-size: 20px;
        font-weight: 800;
        padding-bottom: 13px;
      }
      &__team {
          display: flex;
          align-items: center;   
          margin-bottom: 0.7rem;
        &-heading {
          display: flex;
          justify-content: space-between;
          font-size: 20px;
          line-height: 1.1;
          margin-right: 1rem;
        }
        &-icons {
          display: flex;
          max-width: 100%;
          margin-bottom: 45px;
          align-items: center;
        }
        &-not-joined {
          font-weight: 700;
          color: $text-secondary-color;
          line-height: 1.5;
          margin-bottom: 37px;
        }
        &-join {
          &-avatar {
            border: 2px solid $secondary-background;
            img {
              object-fit: cover;
            }
          }
          &:not(:first-child) {
            margin-left: -10px;
          }

          .placeholder {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background: #515982;
            border: 2px solid $secondary-background;
          }
        }
      }
      &.register--closed {
        .register-info {
          &__heading {
            padding-bottom: 2rem;
          }
          &__team {
            &-icons {
              margin-bottom: 2.5rem;
            }
            &-not-joined {
              margin-bottom: 71px;
            }
          }
        }
      }
    }
    &::v-deep {
      .countdown {
        margin-bottom: 1.5rem;
        .time {
          font-size: 40px;
          line-height: 1;
        }
        .labels {
          font-size: 16px;
          line-height: 1;
          text-transform: lowercase;
        }
      }
    }
  }
}

.relative {
  position: relative;
  color: $text-secondary-color;
}
.green-circle {
  height: 12px;
  width: 12px;
  background: #27ae60;
  border-radius: 50%;
  display: inline-block;
  margin-right: 10px;
}
</style>
