<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    @input="closeModal"
  >
    <div class="user-details__wrap">
      <div class="user-details__content">
        <div style="height: 100%">
          <div class="top-header">
            <div class="header-avatar">
              <v-avatar
                height="97"
                width="97"
                :class="{'profile-picture' : user && !!user.avatar_url}"
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
            <div class="header-statics">
              <v-row>
                <v-col cols="2">
                  <img
                    src="~/static/images/UserXp.svg"
                    class="user-xp"
                  >
                </v-col>
                <v-col>
                  <v-row class="rank-tab">
                    <v-col>
                      <h2 class="title">
                        {{ $t('XP Earned') }}
                      </h2>
                    </v-col>
                    <v-col>
                      <span class="rank-xp">200/500 XP</span>
                    </v-col>
                  </v-row>
                  <v-row class="rank-tab">
                    <v-progress-linear
                      :value="30"
                      height="10"
                      background-color="#59628a"
                      color="#be1338"
                      class="info-user__progress"
                    />
                  </v-row>
                </v-col>
              </v-row>
            </div>
          </div>
          <v-row>
            <tournament-tab-button
              v-for="(game,i) in games"
              :key="i"
              :value="currentGame.id"
              :item="game"
              :v-value="game.id"
              name="test-radio"
              :on-click="() => {updateFilters({'gameId':game.id, 'page':1})}"
            />
          </v-row>
          <v-row>
            <v-col>
              <game-data :game_id="this.$route.query.gameId" />
            </v-col>
          </v-row>
        </div>
        <cross
          class="close-btn"
          @click.native="closeModal"
        />
      </div>
    </div>
    <v-dialog />
  </v-dialog>
</template>

<script>
import GameData from 'components/Profile/DetailStatistic/GameData';
import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';
import gameFilter from '@/mixins/gameFilter';
import UserIcon from 'components/svgIcons/UserIcon.vue';
import Cross from '../svgIcons/Cross';
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('auth');

export default {
  name: 'DetailStatistic',
  components: {
    Cross,
    UserIcon,
    GameData,
    TournamentTabButton,
  },
  mixins: [gameFilter],
  props: {
    onSubmit: {
      type: Function,
      default: () => {},
    },
  },
  data: () => ({
    dialog: true,
    currentRank: 1999,
    totalRank: 3000,
  }),
  computed: {
    ...mapState(['user', 'isAuthenticated']),
  },
  methods: {
    closeModal() {
      this.dialog = false;
      this.onSubmit();
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";
@import "~/assets/styles/mixins";
.title {
  font-family: Telegraf-Regular;
  font-style: normal;
  font-weight: 800;
  font-size: 20px;
  line-height: 110%;
  align-items: center;
  color: #be1338;
}
.rank-tab {
  padding: 5px 10px;
}
.rank-xp {
  float: right;
  font-family: Telegraf-Regular;
  font-style: normal;
  font-weight: 800;
  font-size: 20px;
  line-height: 110%;
  display: flex;
  align-items: center;
  text-align: right;
  color: #a1afd3;
}
.tournaments-tabs {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 83px;
  padding: 22px;
}

.tournaments-tabs {
  &::v-deep .item-icon {
    height: 32px;
    width: 32px;
  }
  &::v-deep .item-name {
    font-size: 12px;
    margin: 0 29px 0 13px;
  }
}
.info-user {
  padding-bottom: 80px;
  &__inner {
    display: flex;
    flex-wrap: wrap;
    padding: 79px 55px 86px;
    @include beveled-corners($secondary-background, 25px, 0);
  }
  &__heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding-bottom: 25px;
  }
  &__image {
    flex: 0 0 183px;
    width: 100%;
    max-width: 183px;
    padding-right: 48px;
  }
  &__stats {
    flex: 0 0 calc(100% - 183px);
    width: 100%;
    max-width: calc(100% - 183px);
  }
  &__xp {
    font-size: 32px;
    font-weight: 800;
    letter-spacing: 0.05em;
    &-total {
      color: $text-primary-color;
    }
  }
  &__list {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  &__item {
    &-heading {
      font-weight: 800;
      font-size: 20px;
      line-height: 1.02;
    }
    &-res {
      font-weight: 800;
      font-size: 56px;
      line-height: 1.06;
      color: $button-primary-background;
      padding-bottom: 12px;
    }
  }
  &__progress {
    transform: skew(-35deg);
    margin-bottom: 28px;
    &::v-deep {
      .v-progress-linear__background::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        display: block;
        background: #363c67;
        width: 20px;
      }
    }
  }
}

.profile-n {
  padding: 20px;
}
.profile-name {
  font-family: Telegraf-UltraBold;
  font-style: normal;
  font-weight: 900;
  font-size: 32px;
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
  color: #be1338;
}

.profile-picture {
  border: 3px solid #be1338;
}
.span {
  color: #a1afd3;
  font-size: 24px;
}
a {
  clear: both;
  color: #be1338;
  text-decoration: none;
}
.profile-action {
  display: flex;
  flex-direction: column;
  padding: 10px 0px;
}
.v-dialog__content::v-deep {
  .v-dialog {
    overflow: auto;
  }
}

.user-details {
  &__wrap {
    background: $app-background;
    padding: 75px 0 143px;
  }
  &__content {
    height: 100%;
    margin: 0 auto;
    max-width: 1100px;
    position: relative;
    &::v-deep {
      .main-heading {
        font-size: 56px;
        line-height: 1.06;
        font-weight: 900;
        color: $text-primary-color;
      }
    }
    .close-btn {
      position: absolute;
      right: -43px;
      top: -27px;
      width: 43px;
      height: 43px;
      cursor: pointer;
    }
  }
}

.top-header {
  display: flex;
  align-items: center;
  justify-content: center;

  .header-avatar {
    display: flex;
    flex-basis: 30%;
  }
  .header-statics {
    flex-basis: 70%;
  }
}

@media only screen and (max-width: $mobile-width) {
  .user-details__content {
    padding: 0 20px;
    z-index: 2;

    .close-btn {
      right: 32px;
      top: 0;
      width: 24px;
      height: 24px;
    }
  }

  .tournaments-tabs {
    padding: 22px 0;
  }
}
@media only screen and (max-width: $mobile-width) {
  .profile {
    .col.col-12 {
      padding-top: 0;
      padding-bottom: 0;
    }

    &-picture {
      width: 72px !important;
      height: 72px !important;
    }
    &-action {
      padding-left: 2rem;
    }
  }
}
</style>
