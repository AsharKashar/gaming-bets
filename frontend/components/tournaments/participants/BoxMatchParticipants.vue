<template>
  <div class="tournament-item-tab tournament-item-tab--participants">
    <div class="teams-container">
      <div class="teams">
        <div
          v-for="(team, n) in formatedTeams.team1"
          :key="team.id + n"
          class="team"
          :class="+team.user.id === +currentBoxFight.user.id ? 'host' : ''"
        >
          <div
            v-if="!team.empty"
            class="team-inner"
          >
            <v-avatar
              v-if="team.user.avatar_url"
              round
              size="80"
            >
              <img
                :src="team.user.avatar_url"
                class="img-fluid"
                alt
              >
            </v-avatar>

            <v-avatar
              v-else
              round
              size="80"
            >
              <img
                src="~/static/icons/userIcon.svg"
                class="img-fluid"
                alt
              >
            </v-avatar>

            <div class="detail">
              <p class="name bold">
                {{ team.user.name }}
              </p>
              <p class="epic-name sm-bold mb-0">
                {{ team.username }}
              </p>
            </div>
            <div class="rank">
              <v-avatar
                round
                size="20"
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
            <p class="sm-bold mb-0 text-secondary">
              {{ $t('Invite Participant') }}
            </p>
          </div>
        </div>
      </div>

      <h2 class="subtitles-primary text-center mr-4 text-secondary">
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
              round
              size="80"
            >
              <img
                :src="team.user.avatar_url"
                class="img-fluid"
                alt
              >
            </v-avatar>

            <v-avatar
              v-else
              round
              size="80"
            >
              <img
                src="~/static/icons/userIcon.svg"
                class="img-fluid"
                alt
              >
            </v-avatar>

            <div class="detail">
              <p class="name bold">
                {{ team.user.name }}
              </p>
              <p class="epic-name sm-bold mb-0">
                {{ team.username }}
              </p>
            </div>
            <div class="rank">
              <v-avatar
                round
                size="20"
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
            <p class="sm-bold mb-0 text-secondary">
              {{ $t('Invite Participant') }}
            </p>
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
const boxfightModule = createNamespacedHelpers('boxfight');
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
    ...boxfightModule.mapState([
      'currentBoxFightTeams',
      'currentBoxFight',
      'boxFightStatus',
    ]),
    formatedTeams() {
      let teamA = [...this.currentBoxFightTeams.team1];
      let teamB = [...this.currentBoxFightTeams.team2];

      const matchTypeId = this.currentBoxFight.game_type_boxmatch.id;
      if (+matchTypeId === 1) {
        if (teamB.length <= 0) {
          teamB.push({ empty: true, id: Date.now() + Math.random(), user: { id: '0' } });
        }
      } else {
        if (teamA.length < 2) {
          teamA.push({ empty: true, id: Date.now() + Math.random(), user: { id: '0' } });
        }
        for (let i = 0; i < 2; i++) {
          if (teamB.length < 2) {
            teamB.push({ empty: true, id: Date.now() + Math.random(), user: { id: '0' } });
          }
        }
      }
      return {
        team1: teamA,
        team2: teamB,
      };
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

$bg-shape :polygon(6% 0, 100% 0, 100% 94%, 94% 100%, 0 100%, 0 6%);

.text-secondary{
  color: $text-secondary-color;
}
.teams-container {
    display: flex;
    align-items: center;
    margin-bottom: 4rem;

  .teams{
      display: flex;


    .team{
      clip-path: $bg-shape;
      background: transparent;
      padding: 2px;
      margin-right: 0.5rem;

      &.host{
        background: $text-secondary-color;
      }

      .team-inner{
        clip-path: $bg-shape;
        background: $secondary-background;
        height: 225px;
        width: 225px;
        padding: 1rem;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;

        .detail{
          text-align: center;
          .name{
            font-weight: 900;
            font-size: 20px;
            line-height: 110%;
            color: #E7E7E7;
            margin-bottom: 10px;
          }
        }
          .rank{
            position: absolute;
            top: 2rem;
            right: 2rem;
          }

      }
      .invite-friend {
        text-align: center;
        cursor: pointer;
        p{
          font-weight: 900;
        font-size: 20px;
        line-height: 110%;
        color: #E7E7E7;
        }

        .sm-bold{
          font-weight: 900;
          font-size: 16px;
          line-height: 120%;
          color: $text-secondary-color;
        }
      }
    }

  }
}

@media only screen and(max-width:$laptop-width){
    .teams-container {
    .teams{
      .team{
        .team-inner{
          height: 190px;
          width: 190px;

           & > .v-avatar{
            height: 60px !important;
            width: 60px !important;
          }
          }
        }
      }
    }
}

@media only screen and (max-width: $tablet-large-width) {
  .teams-container {
    .teams{
      .team{
        .team-inner{
          height: 170px;
          width: 170px;
            .rank{
              top: 1rem;
              right: 1rem;
            }
          }
        }
      }
    }
  }
@media only screen and (max-width: $tablet-large-width - 50) {
  .teams-container{
    flex-direction: column;
  }
}

@media only screen and (max-width : $mobile-width){
  .teams-container {
    .teams {
      flex-direction: column;
      .team{
        margin-bottom: 1rem;
      }
    }
  }
}
</style>
