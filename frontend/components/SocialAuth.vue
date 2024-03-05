<template>
  <div
    v-if="!isProd"
    class="social-icons"
  >
    <div class="social-icons__heading">
      {{ $t('Or') }} {{ isSignUp ? 'sign up' : 'sign up' }} {{ $t('with') }}
    </div>
    <div class="social-icons__list">
      <social-btn
        color="#1877F2"
        @click.native="setOAuth('facebook')"
      >
        <img
          src="~/static/icons/facebook_login.svg"
          alt="Facebook"
        >
      </social-btn>
      <social-btn @click.native="setOAuth('google')">
        <img
          class="social-icon--google"
          src="~/static/icons/google_login.svg"
          alt="Google"
        >
      </social-btn>
      <social-btn @click.native="setOAuth('twitch')">
        <img
          src="~/static/icons/twitch.svg"
          alt="Twitch"
        >
      </social-btn>
      <social-btn @click.native="setOAuth('discord')">
        <img
          class="social-icon--discord"
          src="~/static/icons/discord.svg"
          alt="Discord"
        >
      </social-btn>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import SocialBtn from './SocialBtn';
import { VUE_MODE } from 'configs/config';

const authModule = createNamespacedHelpers('auth');

export default {
  name: 'SocialAuth',
  components: { SocialBtn },
  props: {
    isSignUp: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    activeAuth: null,
    isProd: VUE_MODE === 'production',
  }),
  created() {
    window.addEventListener('storage', this.setStorage);
  },
  beforeDestroy() {
    window.removeEventListener('storage', this.setStorage);
  },
  methods: {
    ...authModule.mapActions(['socialOAuth', 'callbackOAuth']),
    setOAuth(provider) {
      this.activeAuth = provider;
      this.socialOAuth(provider);
    },
    setStorage({ key, newValue }) {
      if (key === 'oAuthApi' && newValue) {
        const data = JSON.parse(newValue)[this.activeAuth];
        if (data) {
          this.callbackOAuth({
            token_aut: data.access_token,
            provider: data.state.network
          });
        }
      }
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.social-icons {
  padding-top: 16px;
  &__list {
    display: flex;
    align-items: center;
    justify-content: center;
    padding-bottom: 16px;
  }
  &__heading {
    font-weight: 900;
    font-size: 20px;
    line-height: .94;
    color: $text-primary-color;
    text-align: center;
    padding-bottom: 16px;
  }
  @media all and (max-width: $tablet-small-width) {
    padding-top: 30px;
    &__heading {
      padding-bottom: 20px;
    }
  }
}
</style>
