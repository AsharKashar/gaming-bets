<template>
  <div class="tournament-item-tab tournament-item-tab--participants">
    <div class="teams-container">
      <div
        v-if="currentBoxFightTeams && currentBoxFight"
        class="teams"
      >
        <div
          v-for="(team, n) in formatedTeams.team1"
          :key="team.id + n"
          class="team"
          :class="+team.user.id === +currentBoxFight.user_id ? 'host' : ''"
        >
          <div
            v-if="!team.empty"
            class="team-inner"
          >
            <v-avatar
              v-if="team.user.avatar_url"
              tile
              size="60"
            >
              <img
                :src="team.user.avatar_url"
                class="img-fluid pr-3"
                alt
              >
            </v-avatar>

            <v-avatar
              v-else
              tile
              size="60"
            >
              <img
                src="~/static/icons/userIcon.svg"
                class="img-fluid pr-3"
                alt
              >
            </v-avatar>

            <div class="detail">
              <p class="name sm-bold">
                {{ team.user.name }}
              </p>
              <p class="epic-name sm">
                {{ team.username }}
              </p>
            </div>
            <div class="rank">
              <v-avatar
                tile
                size="30"
              >
                <img
                  src="~/static/images/badges-rank-bronze.png"
                  class="img-fluid"
                  alt
                >
              </v-avatar>
            </div>
          </div>

          <div
            v-else
            class="team-inner invite-friend"
            @click="getInviteLinks"
          >
            {{ $t('Invite Participant') }}
          </div>
        </div>
      </div>

      <h2 class="subtitles-primary text-center">
        VS
      </h2>

      <div class="teams">
        <div
          v-for="(team, n) in formatedTeams.team2"
          :key="team.id + n"
          class="team"
        >
          <div
            v-if="!team.empty"
            class="team-inner"
          >
            <v-avatar
              v-if="team.user.avatar_url"
              tile
              size="60"
            >
              <img
                :src="team.user.avatar_url"
                class="img-fluid pr-3"
                alt
              >
            </v-avatar>

            <v-avatar
              v-else
              tile
              size="60"
            >
              <img
                src="~/static/icons/userIcon.svg"
                class="img-fluid pr-3"
                alt
              >
            </v-avatar>

            <div class="detail">
              <p class="name sm-bold">
                {{ team.user.name }}
              </p>
              <p class="epic-name sm">
                {{ team.username }}
              </p>
            </div>
            <div class="rank">
              <v-avatar
                tile
                size="30"
              >
                <img
                  src="~/static/images/badges-rank-bronze.png"
                  class="img-fluid"
                  alt
                >
              </v-avatar>
            </div>
          </div>

          <div
            v-else
            class="team-inner invite-friend"
            @click="getInviteLinks"
          >
            {{ $t('Invite Participant') }}
          </div>
        </div>
      </div>
    </div>


    <default-modal
      :show="inviteFriendModal"
      :close-modal="() => (inviteFriendModal = false)"
    >
      <loader
        :loading="!inviteLinks"
        :overlay="false"
        :center="true"
        height="200px"
      >
        <invite-friends
          :links="inviteLinks"
          @nextTab="() => (inviteFriendModal = false)"
        />
      </loader>
    </default-modal>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');

import DefaultModal from 'components/modals/DefaultModal.vue';
import InviteFriends from 'components/tournamentWizard/CreateBoxFight/Steps/InviteFriends';
import Loader from 'components/Loader';

export default {
  name: 'TournamentsParticipants',
  components: {
    DefaultModal,
    InviteFriends,
    Loader,
  },
  data() {
    return {
      inviteFriendModal: false,
      inviteLinks: null,
    };
  },
  computed: {
    ...tournamentModule.mapState([
      'currentBoxFightTeams',
      'currentBoxFight',
      'boxFightStatus',
    ]),
    formatedTeams() {
      if (this.currentBoxFightTeams) {
        const { team1, team2 } = this.currentBoxFightTeams;
        let teamA = [...team1];
        let teamB = [...team2];

        const matchTypeId = this.currentBoxFight.game_type_boxmatch.id;
        const placeholder = { empty: true, id: Date.now(), user: { id: '0' } };
        if (+matchTypeId === 1) {
          if (teamB.length <= 0) {
            teamB.push(placeholder);
          }
        } else {
          if (teamA.length < 2) {
            teamA.push(placeholder);
          }
          for (let i = 0; i < 2; i++) {
            if (teamB.length < 2) {
              teamB.push(placeholder);
            }
          }
        }
        return {
          team1: teamA,
          team2: teamB,
        };
      }
      return '';
    },
  },
  methods: {
    async getInviteLinks() {
      this.inviteFriendModal = true;
      const response = await this.$bangerApi.get(
        `/box-matches/boxfights-invite-links/${this.currentBoxFight.id}`
      );
      this.inviteLinks = {
        friends: response.data['same_team'],
        opponent: response.data['team 2'],
      };
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.teams-container {
  max-width: 600px;
  p {
    margin-bottom: 0;
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
      &.host {
        background: $button-primary-background;
      }

      .team-inner {
        padding: 20px;
        display: flex;
        align-items: center;
        background: $app-background;
        clip-path: polygon(10% 0%, 100% 1%, 100% 87%, 92% 100%, 0 100%, 0 16%);
        position: relative;
        min-height: 100px;
        &.invite-friend {
          justify-content: center;
          color: $text-secondary-color;
          cursor: pointer;
        }
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
}
</style>
