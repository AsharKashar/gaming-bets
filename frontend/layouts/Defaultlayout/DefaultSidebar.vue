<template>
  <div class="default-sidebar">
    <v-navigation-drawer
      v-touch="{left: () => setDrawer(false), right: () => setDrawer(true)}"
      hide-overlay
      app
      touchless
      :mini-variant="!drawer"
      :mobile-breakpoint="767"
      :clipped="true"
      mini-variant-width="96"
      :width="drawer ? 280 : 96"
      bottom
      color="#111542"
      class="default-side-drawer"
      dense
      @mouseover.native="setDrawer(true)"
      @mouseleave.native="setDrawer(false)"
      @click.native="setDrawer(!drawer)"
    >
      <template v-slot:prepend>
        <router-link
          to="/"
          class="mt-4 d-block"
        >
          <v-list-item>
            <v-list-item-icon
              v-show="!drawer"
              class="banger_games_logo"
            >
              <v-avatar
                tile
                :width="30"
                height="30"
              >
                <img
                  src="~/static/icons/banger_games.svg"
                  alt="BangerGamesLogo"
                >
              </v-avatar>
            </v-list-item-icon>
            <v-list-item-content
              class="banger-games-logo-text"
            >
              <v-avatar
                tile
                :width="300"
                height="35"
              >
                <img
                  src="~/static/icons/banger_games_text.svg"
                  alt="BangerGamesLogo"
                >
              </v-avatar>
            </v-list-item-content>
          </v-list-item>
        </router-link>
      </template>

      <div class="drawer-inner-section invisible-scrollbar">
        <v-list width="100%">
          <!--  -->
          <v-list-item
            link
            nuxt
            :class="{ 'button-active': $route.path === '/' }"
            to="/"
          >
            <v-list-item-icon>
              <v-avatar
                tile
                size="40"
              >
                <img
                  v-if="$route.path === '/'"
                  src="~static/icons/Home.svg"
                  alt="Home"
                >
                <img
                  v-else
                  src="~static/icons/Home_p.svg"
                  alt="Home"
                >
              </v-avatar>
            </v-list-item-icon>
            <div class="sidebar-selection" />
            <v-list-item-content class="sidebar-list-text">
              <v-list-item-title>
                {{
                  $t("Home")
                }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <!--  -->
          <v-tooltip
            right
            :disabled="!isDemo"
            :nudge-right="60"
            content-class="custom-tooltip"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item
                link
                nuxt
                :class="{
                  'button-disabled': isDemo,
                  'button-active': $route.path === '/coins'
                }"
                v-bind="attrs"
                to="/coins"
                v-on="on"
              >
                <v-list-item-icon>
                  <v-avatar
                    tile
                    size="40"
                  >
                    <img
                      v-if="$route.path === '/coins'"
                      src="~/static/icons/Bombcoins.svg"
                      alt="Bombcoins"
                    >
                    <img
                      v-else
                      src="~/static/icons/Bombcoins_p.svg"
                      alt="Bombcoins"
                    >
                  </v-avatar>
                </v-list-item-icon>
                <div class="sidebar-selection" />
                <v-list-item-content class="sidebar-list-text">
                  <v-list-item-title>
                    {{
                      $t("Bomb Coins")
                    }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <span>Feature Coming Soon</span>
          </v-tooltip>
          <!--  -->
          <v-tooltip
            right
            :disabled="!isDemo"
            :nudge-right="60"
            content-class="custom-tooltip"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item
                nuxt
                link
                :class="{
                  'button-disabled': isDemo,
                  'button-active': $route.path === '/tournaments'
                }"
                v-bind="attrs"
                to="/tournaments"
                v-on="on"
              >
                <v-list-item-icon>
                  <v-avatar
                    tile
                    size="40"
                  >
                    <img
                      v-if="
                        $route.path === '/tournaments'
                      "
                      src="~/static/icons/Gamepad.svg"
                      alt="Gamepad"
                    >
                    <img
                      v-else
                      src="~/static/icons/Gamepad_p.svg"
                      alt="Gamepad"
                    >
                  </v-avatar>
                </v-list-item-icon>
                <div class="sidebar-selection" />
                <v-list-item-content class="sidebar-list-text">
                  <v-list-item-title>
                    {{
                      $t("Games")
                    }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <span>Feature Coming Soon</span>
          </v-tooltip>
          <!--  -->
          <v-list-item
            link
            nuxt
            :class="{ 'button-active': $route.path === '/news' }"
            to="/news"
          >
            <v-list-item-icon>
              <v-avatar
                tile
                size="40"
              >
                <img
                  v-if="$route.path === '/news'"
                  src="~/static/icons/News.svg"
                  alt="News"
                >
                <img
                  v-else
                  src="~/static/icons/News_p.svg"
                  alt="News"
                >
              </v-avatar>
            </v-list-item-icon>
            <div class="sidebar-selection" />
            <v-list-item-content class="sidebar-list-text">
              <v-list-item-title>
                {{
                  $t("News")
                }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <!--  -->
          <v-tooltip
            right
            :disabled="!isDemo"
            :nudge-right="60"
            content-class="custom-tooltip"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item
                link
                nuxt
                :class="{
                  'button-disabled': isDemo || true,
                  'button-active': $route.path === '/leaderboards'
                }"
                v-bind="attrs"
                to="/leaderboards"
                v-on="on"
              >
                <v-list-item-icon>
                  <v-avatar
                    tile
                    size="40"
                  >
                    <img
                      v-if="$route.name === '/leaderboards'"
                      src="~/static/icons/Leaderboards.svg"
                      alt="Leaderboards"
                    >
                    <img
                      v-else
                      src="~/static/icons/Leaderboards_p.svg"
                      alt="Leaderboards"
                    >
                  </v-avatar>
                </v-list-item-icon>
                <div class="sidebar-selection" />
                <v-list-item-content class="sidebar-list-text">
                  <v-list-item-title>
                    {{
                      $t("Leaderboards")
                    }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <span>Feature Coming Soon</span>
          </v-tooltip>
          <!--  -->
          <v-tooltip
            right
            :disabled="!isDemo"
            :nudge-right="60"
            content-class="custom-tooltip"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item
                nuxt
                link
                :class="{
                  'button-disabled': isDemo || true,
                  'button-active': $route.name === '/shop'
                }"
                v-bind="attrs"
                to="/"
                v-on="on"
              >
                <v-list-item-icon>
                  <v-avatar
                    tile
                    size="40"
                  >
                    <img
                      v-if="$route.name === '/shop'"
                      src="~/static/icons/Store.svg"
                      alt="Leaderboards"
                    >
                    <img
                      v-else
                      src="~/static/icons/Store_p.svg"
                      alt="Store"
                    >
                  </v-avatar>
                </v-list-item-icon>
                <div class="sidebar-selection" />
                <v-list-item-content class="sidebar-list-text">
                  <v-list-item-title>
                    {{
                      $t("Shop")
                    }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <span>Feature Coming Soon</span>
          </v-tooltip>
          <!--  -->
        </v-list>
      </div>

      <template
        v-if="!isDemo"
        v-slot:append
      >
        <v-list>
          <v-list-item
            v-if="isAuthenticated"
            link
            :class="{ 'button-active': $route.path === '/my-tournament', 'button-disabled': true }"
            to="/my-tournament"
          >
            <v-list-item-icon>
              <v-avatar
                tile
                size="40"
              >
                <img
                  v-if="$route.path === '/my-tournament'"
                  src="~/static/icons/Tournaments.svg"
                  alt="Tournaments"
                >
                <img
                  v-else
                  src="~/static/icons/Tournaments_p.svg"
                  alt="Tournaments"
                >
              </v-avatar>
            </v-list-item-icon>
            <div class="sidebar-selection" />
            <v-list-item-content class="sidebar-list-text">
              <v-list-item-title>
                {{
                  $t("My Tournaments")
                }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <!--  -->
          <v-menu
            v-if="isAuthenticated"
            v-model="notificationsMenu"
            :close-on-content-click="false"
            :nudge-width="346"
            :nudge-right="0"
            offset-x
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item
                link
                nuxt
                v-bind="attrs"
                :class="{ 'button-active': $route.path === '/notifications', 'sidebar-list-active': notificationsMenu }"
                to=""
                v-on="on"
              >
                <v-list-item-icon>
                  <notification-icon
                    :has-notification="totalNotificationCount && totalNotificationCount > 0"
                    :color="$route.path === 'notifications' ? '#BE1338' : '#A1AFD3'"
                  />
                </v-list-item-icon>
                <div class="sidebar-selection" />
                <v-list-item-content class="sidebar-list-text">
                  <v-list-item-title>
                    {{
                      $t("Notifications")
                    }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>

            <Notifications
              @close-menu="close"
              @close="close"
            />
          </v-menu>
          <!--  -->
          <v-list-item
            v-if="isAuthenticated"
            to="/profile"
            :class="{ 'button-active': $route.path === '/profile' }"
          >
            <v-list-item-icon>
              <v-avatar
                v-if="isAuthenticated && avatarUser"
                round
                class="user-icon"
              >
                <img
                  :src="avatarUser"
                  :alt="nameUser"
                >
              </v-avatar>
              <UserIcon
                v-else
                class="user-icon"
                color="#A1AFD3"
              />
            </v-list-item-icon>
            <v-list-item-content class="sidebar-list-text sidebar-list-text-user">
              <v-list-item-title>
                {{ nameUser }}
              </v-list-item-title>
            </v-list-item-content>
            <v-list-item-action v-if="isAuthenticated">
              <v-btn
                icon
                @click="logout"
              >
                <v-avatar
                  tile
                  size="35"
                >
                  <img
                    src="~/static/icons/Log_Out.svg"
                    alt="User"
                  >
                </v-avatar>
              </v-btn>
            </v-list-item-action>
          </v-list-item>
        </v-list>
      </template>
    </v-navigation-drawer>
  </div>
</template>

<script>
import Notifications from 'components/notifications/NotificationMenu';
import NotificationIcon from 'components/svgIcons/NotificationIcon.vue';
import { get } from 'lodash';
import { createNamespacedHelpers } from 'vuex';
import UserIcon from 'components/svgIcons/UserIcon.vue';
const { mapState, mapActions } = createNamespacedHelpers('auth');
const notificationsModule = createNamespacedHelpers('notifications');
import { VUE_MODE } from 'config';
import Vue from 'vue';

export default {
  name: 'DefaultSidebar',
  components: {
    Notifications,
    NotificationIcon,
    UserIcon,
  },
  data: () => ({
    drawer: false,
    notificationsMenu: false,
    buttonActive: null,
  }),
  computed: {
    ...mapState(['user', 'isAuthenticated']),
    ...notificationsModule.mapState(['notifications']),
    smallDevices() {
      return this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.xs;
    },
    isDemo() {
      return VUE_MODE === 'production';
    },
    totalNotificationCount() {
      return this.notifications && this.notifications.data
        ? this.notifications.data.length
        : 0;
    },
    avatarUser() {
      return get(this, 'user.avatar_url', '');
    },
    nameUser() {
      return get(this, 'user.name', 'John Doe');
    }
  },
  methods: {
    ...mapActions(['logout']),
    goToPage(page) {
      if (this.isDemo) {
        this.showComingSoonNotice();
        this.buttonActive = page.replace('/', '');
      } else this.$router.push(page);
    },
    showComingSoonNotice() {
      Vue.notify({
        group: 'custom-notification',
        title: 'Feature Coming Soon',
        text: 'The best is yet to come, hold tight',
        type: 'info',
      });
    },
    close()
    {
      this.notificationsMenu=false;
    },
    setDrawer(payload) {
      this.drawer = payload;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

$desktop-standerd-width: 1024px;
$desktop-smaller-width: 900px;
$tablet-standerd-width: 768px;

.default-side-drawer {
  height: 100vh;
  clip-path: polygon(0 0, 84% 0, 100% 4%, 100% 96%, 84% 100%, 0 100%);
  color: $text-primary-color;
  min-width: 96px;

  .v-list-item__title {
    color: $text-primary-color;
  }
  .button-active {
    background-color: #be133847 !important;
  }
  .button-active,
  .button-active .v-list-item__title,
  .button-active .v-btn__content {
    color: $button-primary-background !important;
  }
  .button-disabled {
    opacity: 0.5;
  }

  .user-icon {
    width: 56px;
    height: 56px;
  }

  .profile-picture {
    border: 2px solid #be1338;
  }
}

.notification-icon {
  position: relative;

  .notification-circle {
    position: absolute;
    width: 15px;
    height: 15px;
    right: 0;
    bottom: 8px;
  }
}

.custom-tooltip {
  background: $button-primary-background;
  width: 251px;
  height: 42px;
  border-radius: 57px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  line-height: 94%;
  left: 350px !important;
}

.sidebar-list-text {
  font-weight: 800;
  font-size: 16px;
  margin-left: 20px;
  letter-spacing: 0.004em;
  text-transform: uppercase;
}
.sidebar-list-text-user {
  margin-right: -5px;
  font-size: 20px;
  color: #e7e7e7;
}
.sidebar-selection {
  display: none !important;
  // important is used to overwrite it with default vuetify styles which should't
  clip: auto !important;
  position: absolute;
  background: $border-primary-color;
  left: 0;
  border-radius: 5px 20px 20px 5px;
  width: 5px !important;
  height: 41px !important;
}
.button-active > .sidebar-selection {
  display: block !important;
  color: $border-primary-color;
}
.drawer-inner-section {
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow-x: hidden;
  width: 100%;
  height: calc(100vh - 320px);
  overflow-y: auto;
}
// .default-side-drawer:before {
//   // content: "";
//   position: absolute;
//   height: 100%;
//   top: 0;
//   right: 0;
//   z-index: 0;
//   border-top: 30px solid $app-background;
//   border-bottom: 30px solid $app-background;
//   border-left: 20px solid #111542;
// }

.default-sidebar .v-navigation-drawer--is-mouseover {
  clip-path: polygon(0 0, 94% 0, 100% 4%, 100% 96%, 94% 100%, 0 100%);
}
// not applying media queries for now
@media all and (min-width: $desktop-standerd-width) {
  .default-side-drawer {
    height: $desktop-standerd-width;
  }
}
@media all and (max-width: $desktop-standerd-width) {
  .default-side-drawer {
    height: $desktop-standerd-width;
  }
}
@media all and (max-width: $tablet-standerd-width) {
  .default-side-drawer {
    height: $desktop-standerd-width;
  }
}
@media all and (max-width: $tablet-small-width - 1) {
  .default-sidebar {
    display: none;
  }
}
</style>
<style lang="scss">
.default-side-drawer .v-navigation-drawer__border {
  display: none !important;
  background: none !important;
}
.default-sidebar .v-navigation-drawer--is-mouseover .banger_games_logo {
  display: none;
}
@media all and (max-height: 768px) {
  .default-side-drawer {
    background: #333;
    .v-list-item__icon {
      margin: 10px 0 !important;
    }
  }

  .drawer-inner-section {
    height: calc(100vh - 292px) !important;
  }
}
</style>
