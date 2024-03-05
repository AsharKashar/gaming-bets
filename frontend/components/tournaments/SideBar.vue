<template>
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
            <div>
              <b>
                {{ teamCount }}
              </b>
            </div>
            <div> {{ $t("Teams joined") }} </div>
          </div>
          <div>
            <div
              v-if="teamJoined.length"
              class="register-info__team-icons"
            >
              <div
                v-for="team in teamJoined"
                :key="team.id"
                class="register-info__team-join"
              >
                <v-tooltip top>
                  <template v-slot:activator="{ on }">
                    <v-avatar
                      width="40"
                      height="40"
                      min-width="40"
                      class="register-info__team-join-avatar"
                      v-on="on"
                    >
                      <img
                        :src="team.avatar_url || '~/static/icons/userIcon.svg'"
                        :alt="team.name"
                      >
                    </v-avatar>
                  </template>
                  <span>{{ team.name }}</span>
                </v-tooltip>
              </div>
            </div>
            <div
              v-else
              class="register-info__team-not-joined"
            >
              Be the first one to join this tournament
            </div>
          </div>
          <side-bar-action
            :registration="status"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Countdown from 'components/Countdown';
import SideBarAction from './SideBarAction';
export default {
  name: 'TournamentsSideBar',
  components: { SideBarAction, Countdown },
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
    registration() {
      let finishDate = this.registerDateFinished;

      const reg = {
        status: 'Registration Open',
        date: new Date(finishDate),
      };

      if (!this.status) {
        reg.status = 'Registration Closed';
        reg.date = null;
      }

      return reg;
    },
    teamCount() {
      if (this.teamJoinedTotal <= this.maxTeam) {
        return `${this.teamJoinedTotal}/${this.maxTeam}`;
      }
      return this.teamJoinedTotal;
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
        &-heading {
          display: flex;
          justify-content: space-between;
          margin-bottom: 8px;
          font-size: 20px;
          line-height: 1.1;
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
            padding-bottom: 68px;
          }
          &__team {
            &-icons {
              margin-bottom: 78px;
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
        margin-bottom: 33px;
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
