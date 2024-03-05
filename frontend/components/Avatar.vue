<template>
  <div>
    <v-menu
      transition="slide-x-transition"
      absolute
      bottom
    >
      <!-- TODO: make proper menu -->
      <template v-slot:activator="{ on, attrs}">
        <v-avatar
          height="48"
          width="48"
          v-bind="attrs"
          round
          v-on="on"
        >
          <img
            v-if="avatarUser"
            :src="avatarUser"
            :alt="nameUser"
          >
          <UserIcon
            v-else
            class="user-icon"
            color="#be1338"
          />
        </v-avatar>
      </template>
      <v-list class="primary">
        <template v-if="isAuthenticated">
          <v-list-item link>
            <v-list-item-title class="secondery--text">
              {{ nameUser }}
            </v-list-item-title>
          </v-list-item>
          <v-list-item
            link
            @click="goProfile"
          >
            <v-list-item-title class="secondery--text">
              {{ $t('Profile') }}
            </v-list-item-title>
          </v-list-item>
          <v-list-item
            link
            @click="logout"
          >
            <v-list-item-title class="secondery--text">
              {{ $t('Logout') }}
            </v-list-item-title>
          </v-list-item>
        </template>
        <v-list-item
          v-else
          link
        >
          <v-list-item-title>
            <auth-modal />
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
import AuthModal from 'components/modals/AuthModal.vue';
import UserIcon from 'components/svgIcons/UserIcon.vue';

import { createNamespacedHelpers } from 'vuex';
import {get} from 'lodash';
const { mapState, mapActions } = createNamespacedHelpers('auth');

export default {
  name: 'Avatar',
  components: {
    AuthModal,
    UserIcon,
  },
  computed: {
    ...mapState(['user', 'isAuthenticated']),
    avatarUser() {
      return get(this, 'user.avatar_url', '');
    },
    nameUser() {
      return get(this, 'user.name', 'user');
    }
  },
  methods: {
    ...mapActions(['logout']),
    goProfile() {
      this.$router.push('/profile');
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.avatar-item {
  height: 48px;
  width: 48px;
  // pointer-events: none  ;

  img {
    width: 100%;
  }
}
</style>
