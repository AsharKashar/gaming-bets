<template>
  <div class="user-statistic">
    <div
      class="user-details"
      @click="showDetailModal = true"
    >
      <svg class="svg">
        <clipPath
          id="my-clip-path"
          clipPathUnits="objectBoundingBox"
        >
          <path d="M0,0.216 V1 H0.943 L1,0.784 V0 H0.053 L0,0.216" />
        </clipPath>
      </svg>
      <div class="clipped-wrapper">
        <div class="clipped">
          <div class="user-profile">
            <v-avatar
              height="97"
              width="97"
              :class="{ 'profile-picture': user && !!user.avatar_url }"
            >
              <img
                v-if="user && user.avatar_url"
                :src="user.avatar_url"
                :alt="user.name ? user.name : 'John Doe'"
              >
              <UserIcon
                v-else
                class="user-icon"
                color="#be1338"
              />
            </v-avatar>
            <div class="profile-n">
              <p class="profile-name">
                {{ user.name }}
              </p>
              <p class="username">
                @{{ user.username }}
              </p>
            </div>
          </div>

          <div class="rank">
            <Rank />
          </div>

          <div class="rank-details">
            <div class="experience">
              <div>SX Earned</div>
              <div>200/500 XP</div>
            </div>
            <div class="progress-bar">
              <v-progress-linear
                v-model="valueDeterminate"
                color="#be1338"
                background-color="#59628a"
                class="linear-xp"
              />
            </div>
            <div class="points-earns">
              <div>
                <p>Total Points</p>
                51
              </div>
              <div>
                <p>Bomb Coins</p>
                03
              </div>
              <div>
                <p>Total Wins</p>
                24
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <detail-statistic
      v-if="showDetailModal"
      :on-submit="onSubmit"
    />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import Rank from 'components/svgIcons/Rank';
import DetailStatistic from 'components/Profile/DetailStatistic';
const { mapState, mapActions } = createNamespacedHelpers('auth');
import UserIcon from 'components/svgIcons/UserIcon.vue';
export default {
  name: 'UserDetailStatistic',
  components: {
    Rank,
    DetailStatistic,
    UserIcon,
  },
  data() {
    return {
      valueDeterminate: 50,
      showDetailModal: false,
    };
  },
  computed: {
    ...mapState(['user', 'isAuthenticated']),
  },
  methods: {
    ...mapActions(['getMe']),
    onSubmit() {
      this.showDetailModal = false;
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.linear-xp {
  transform: skew(-35deg);
  height: 8px;
}
.profile-picture {
  border: 3px solid $text-secondary-color;
}
.profile-n {
  padding: 10px 0px;
}
.profile-name {
  font-family: Telegraf-UltraBold;
  font-style: normal;
  font-weight: 900;
  font-size: 24px;
  line-height: 115%;
  align-items: center;
  letter-spacing: 0.02em;
  font-feature-settings: "ss03" on;
  color: #e7e7e7;
}
.username {
  padding: 0;
  margin-top: -20px;
  font-family: Telegraf-Regular;
  font-style: normal;
  font-weight: 800;
  font-size: 20px;
  line-height: 110%;
  align-items: center;
  color: $text-secondary-color;
}
.svg {
  position: absolute;
  width: 0;
  height: 0;
}
.clipped-wrapper {
  height: 192px;
  position: relative;
  background: #414872;
  -webkit-clip-path: url(#my-clip-path);
  clip-path: url(#my-clip-path);
}
.clipped {
  cursor: pointer;
  height: 99%;
  top: 1px;
  left: 1px;
  right: 1px;
  bottom: 1px;
  background: #010432;
  background-size: cover;
  -webkit-clip-path: url(#my-clip-path);
  clip-path: url(#my-clip-path);
  position: absolute;
  display: flex;
  padding: 41px;
  .rank {
    margin-left: 8rem;
  }
}

.user-statistic {
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: center;

  .user-profile {
    display: flex;
    align-items: center;

    .profile-n {
      margin-left: 20px;
      p {
        margin: 0;
      }
    }
  }

  .user-details {
    width: 100%;
    margin-left: 3em;

    .rank-details {
      width: 100%;
      margin-left: 2rem;
      .experience {
        display: flex;
        justify-content: space-between;

        div {
          font-weight: 800;
          font-size: 20px;
          line-height: 110%;
          color: $text-secondary-color;
        }

        div:nth-child(2) {
          color: #a1afd3;
        }
      }
      .progress-bar {
        margin: 1rem 0;
      }
      .points-earns {
        display: flex;
        align-items: center;
        justify-content: space-between;
        div {
          font-weight: 900;
          font-size: 32px;
          line-height: 115%;
          letter-spacing: 0.02em;
          color: $text-secondary-color;

          p {
            margin: 0;
            font-weight: 900;
            font-size: 16px;
            line-height: 120%;
            color: #a1afd3;
          }
        }
      }
    }
  }
}
@media screen and (max-width: $desktop-width) {
  .user-statistic {
    .user-details {
        width: 100% !important;
     
    }
  }
}
@media screen and (max-width: $laptop-width) {
  .user-statistic {
    .user-details {
        width: 88% !important;
        margin-left: 8em;
     
    }
  }
}

@media screen and (max-width: $tablet-large-width) {
  .user-statistic {
    .user-details {
      width: 80% !important;
      margin-left: 0;
      margin: 0 auto;
      .clipped-wrapper {
        background: transparent;
        clip-path: none;
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        .clipped {
          position: relative;
          flex-direction: column;
          background: transparent;
          padding: 0px;
          clip-path: none;
          .rank {
            display: none;
          }
          .user-profile {
            margin-left: 2em;
            width: 100%;
            margin-bottom: 1em;
            flex-direction: row-reverse;
            justify-content: space-between;

            .profile-picture {
              width: 48px !important;
              height: 48px !important;
            }
            .profile-n {
              display: flex;
              margin-left: 0;
              .username {
                margin-left: 1em;
              }
            }
          }
        }
      }
    }
  }
}
@media screen and (max-width: $tablet-small-width) {
  .user-statistic {
    .user-details {
    width: 90% !important;
      .clipped-wrapper
      {
        .clipped
        {
          .user-profile,.rank-details
          {
            margin-left: 0;
          }
        }
      }
    }
  }
}


</style>
