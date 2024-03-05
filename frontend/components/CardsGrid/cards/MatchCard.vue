<template>
  <div class="match-card">
    <div class="match-card__inner">
      <div
        class="match-title"
        v-text="title"
      />
      <div
        v-if="isAuthenticated && isWinner"
        class="match-result"
      >
        <div
          class="match-result__inner"
          v-text="$t('Won')"
        />
      </div>
      <div
        class="match-row"
      >
        <div class="match-col match-col--first">
          <div class="match-col__inner">
            <div
              v-if="date"
              class="match-time"
              v-text="dateTime"
            />
            <button class="btn-match btn-match--small">
              <svg-icon name="list" />
              {{ $t('Report') }}
            </button>
          </div>
        </div>
        <div class="match-col match-col--second">
          <div class="match-col__inner">
            <div
              class="match-status"
              :class="`match-status--${matchStatusType}`"
              v-text="matchStatusText"
            />
            <match-teams
              :team-first="getTeamsData(0)"
              :team-second="getTeamsData(1)"
              :winner-team-id="winnerTeamId"
              :hosted-team-id="hostedTeamId"
            />
            <div class="match-action">
              <button
                v-if="isFinish"
                class="btn-match"
                v-text="$t('I did not receive an invite')"
              />
              <template v-if="isWaiting && isAuthenticated && !isHideEvidence">
                <default-button
                  type="button"
                  class="mx-4"
                  :on-click="getEvidenceUpload"
                >
                  i’ve won
                </default-button>
                <default-button
                  type="button"
                  class="mx-4"
                  :on-click="getEvidenceUpload"
                >
                  i’ve lost
                </default-button>
              </template>
            </div>
          </div>
        </div>
        <div
          v-if="isConflict && conflictEnd"
          class="match-col match-col--time"
        >
          <countdown-math :date="conflictEnd" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SvgIcon from 'components/svgIcons/SvgIcon';
import dayjs from 'dayjs';
import DefaultButton from 'components/DefaultButton';
import CountdownMath from 'components/tournaments/matches/CountdownMath';
import get from 'lodash/get';
import { createNamespacedHelpers } from 'vuex';
import MatchTeams from 'components/tournaments/matches/MatchTeams';

const modalModule = createNamespacedHelpers('modal');
const authModule = createNamespacedHelpers('auth');

export default {
  name: 'MatchCard',
  components: {MatchTeams, CountdownMath, DefaultButton, SvgIcon},
  props: {
    matchId: {
      type: Number,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    date: {
      type: String,
      default: null,
    },
    conflictEnd: {
      type: String,
      default: null,
    },
    matchStatusType: {
      type: String,
      required: true,
    },
    matchStatusText: {
      type: String,
      required: true,
    },
    winnerTeamId: {
      type: Number,
      default: null,
    },
    hostedTeamId: {
      type: Number,
      default: null,
    },
    winnerIds: {
      type: Array,
      default: () => ([]),
    },
    teams: {
      type: Array,
      default: () => ([]),
    },
    tournamentId: {
      type: Number,
      required: true,
    },
    userTeamId: {
      type: Number,
      default: null,
    },
    matchesType: {
      type: String,
      required: true,
    }
  },
  computed: {
    ...authModule.mapState({
      userId: (state) => get(state, 'user.id', null),
      isAuthenticated: ({isAuthenticated}) => isAuthenticated
    }),
    dateTime() {
      return dayjs(this.date).format('HH:MMA');
    },
    isFinish() {
      return this.matchStatusType === 'ended';
    },
    isWaiting() {
      return this.matchStatusType === 'pending_results';
    },
    isConflict() {
      return this.matchStatusType === 'conflict';
    },
    isWinner() {
      return this.winnerIds.includes(this.userId);
    },
    isHideEvidence() {
      if (!this.userTeamId) {
        return true;
      }
      return !!get(this.teams.find(({team_id}) => team_id === this.userTeamId), 'evidence.id', false);
    }
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal', 'setCommonData']),
    getEvidenceUpload() {
      this.setActiveModal({
        type: 'EvidenceUpload',
      });
      this.setCommonData({
        evidence: {
          tournamentId: this.tournamentId,
          matchesType: this.matchesType,
          matchId: this.matchId,
          firstTeam: this.getTeamsData(0),
          secondTeam: this.getTeamsData(1),
        }
      });
    },
    getTeamsData(index) {
      const team = get(this.teams, index, {});
      return ({
        ...team,
        ...team.team
      });
    }
  }
};
</script>

<style scoped lang="scss">
@import '~/assets/styles/sizes';
@import '~/assets/styles/colors';

.match {
  &-card {
    &__inner {
      padding-bottom: 25px;
      border-bottom: 1px solid rgba(161, 175, 211, .5);
      margin-bottom: 24px;
      font-weight: 900;
      position: relative;
    }
  }
  &-title {
    text-transform: uppercase;
    color: $text-primary-color;
    letter-spacing: 1px;
    padding: 5px 16px;
    margin-bottom: 45px;
    border-bottom: 1px solid rgba(161, 175, 211, .5);
  }
  &-result {
    position: absolute;
    right: 0;
    top: 35px;
    &__inner {
      text-transform: uppercase;
      min-width: 160px;
      text-align: center;
      padding: 7px 15px 7px 40px;
      background: #2f3156;
      clip-path: polygon(0 0, 100% 0%, 100% 99%, 25% 100%);
    }
  }
  &-row {
    display: flex;
    flex-wrap: wrap;
  }
  &-col {
    padding: 0 15px 15px;
    width: 100%;
    &--first {
      max-width: 130px;
      flex: 0 0 130px;
    }
    &--second {
      max-width: calc(100% - 250px);
      flex: 0 0 calc(100% - 250px);
      padding-left: 0;
      padding-right: 0;
    }
    &--time {
      max-width: 120px;
      flex: 0 0 120px;
    }
  }

  &-status {
    margin: 0 auto 17px;
    font-size: 12px;
    width: max-content;
    padding: 4px 12px;
    color: $text-hover-color;
    border-radius: 12px;
    background: #27AE60;
    &--waiting {
      color: $app-background;
      background: #FFE600;
    }
  }

  &-time {
    font-size: 14px;
    line-height: 1.2;
    letter-spacing: .08em;
    margin-bottom: 32px;
  }
  &-action {
    text-align: center;
    padding: 5px;
    display: flex;
    justify-content: center;
  }
}

.btn-match {
  color: $text-secondary-color;
  letter-spacing: 2px;
  text-decoration: underline;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  &--small {
    font-size: 14px;
    text-transform: uppercase;
  }
  svg {
    margin-right: 8px;
  }
}
</style>
