<template>
  <div>
    <v-row
      v-if="!showOnlyMobileHeader"
      class="header-container"
    >
      <links-columns
        v-if="!isDemo"
        colors-class="font-gray"
        font-class="font-header"
        :links="links"
      />
      <div
        v-if="!isDemo"
        class="auth-block"
      >
        <default-button
          v-if="isAuthenticated"
          type="button"
          :on-click="logout"
        >
          {{ $t("Sign out") }}
        </default-button>
        <default-button
          v-else
          type="button"
          :on-click="login"
        >
          {{ $t("Sign in") }}
        </default-button>
        <switch-language class="set-lang language-switcher" />
      </div>
      <UserDetailStatistic v-if="profile" />
    </v-row>
    <div class="header-container-mobile">
      <img
        src="~/static/icons/banger_games_text.svg"
        alt="Banger games"
        class="banger-logo"
      >
      <div>
        <default-button
          v-if="!isAuthenticated && !isDemo"
          type="button"
          :on-click="login"
        >
          SIGN IN
        </default-button>
        <avatar v-else />
        <!-- <switch-language /> -->
      </div>
    </div>
  </div>
</template>

<script>
import LinksColumns from 'components/LinksColumns.vue';
import DefaultButton from 'components/DefaultButton.vue';
import UserDetailStatistic from './UserDetailStatistic.vue';
import SwitchLanguage from 'components/languages/switchLanguages';
import Avatar from 'components/Avatar.vue';
import { headerLinks } from 'helpers/links';
import { createNamespacedHelpers } from 'vuex';
import { VUE_MODE } from 'configs/config';
const { mapState, mapActions } = createNamespacedHelpers('auth');
const moduleModal = createNamespacedHelpers('modal');

export default {
  name: 'DefaultHeader',
  components: {
    LinksColumns,
    DefaultButton,
    UserDetailStatistic,
    SwitchLanguage,
    Avatar,
  },
  props: {
    showOnlyMobileHeader: {
      type: Boolean,
      default: false,
    },
    profile: {
      type: Boolean,
      default: false,
    },
  },
  data: () => ({
    isDemo: VUE_MODE === 'production',
  }),
  computed: {
    ...mapState(['user', 'isAuthenticated']),
    links() {
      const result = [...headerLinks];

      if (this.isAuthenticated) {
        result.push({
          title: 'profile',
          to: '/profile',
        });
      }

      return result;
    },
  },
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
    ...mapActions(['logout']),
    login() {
      this.setActiveModal({ type: 'LoginForm' });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";


.auth-block {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  position: relative;
   .language-switcher {
  position: absolute;
  left: 50%;
  top: 60%;
  .switcher-box {
    width: 60px;
    display: flex;
    .language-icon {
      margin-right: 5px;
    }
  }
}

.set-lang
{
  position: absolute;
    left: 40%;
    top: 60%;
}
}

.header-container {
  display: flex;
  justify-content: space-between;
}
.header-container > * {
  z-index: 1;
}

.header-container-mobile {
  height: 96px;
  justify-content: space-between;
  align-items: center;
  padding: 10px 19px 0 14px;

  .banger-logo {
    max-width: 208px;
  }
}

@media all and (min-width: $min-resolution) {
  .header-container {
    display: none;
  }
  .header-container-mobile {
    display: flex;
  }
}

@media all and (min-width: $tablet-small-width) {
  .header-container {
    display: none;
  }
  .header-container-mobile {
    display: none;
  }
}

@media all and (min-width: $tablet-large-width) {
  .header-container {
    display: flex;
    padding: 40px 11.5%;
  }
}

@media all and (min-width: $desktop-width) {
  .header-container {
    padding: 40px 11.5%;

    .default-banger-btn {
      margin-right: 23px;
    }
  }
}
</style>
