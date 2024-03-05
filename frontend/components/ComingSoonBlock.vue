<template>
  <div>
    <div class="coming-soon">
      <div class="header-container-mobile">
        <img
          src="~/static/icons/banger_games_text.svg"
          alt="Banger games"
          class="banger-logo"
        >
      </div>
      <div class="left-box">
        <coming-soon class="coming-soon-svg" />
      </div>
      <div class="right-box">
        <div class="right-box-title">
          <div class="right-box-text">
            {{ $t('First month') }}
          </div>
          <div class="right-box-text-accent">
            {{ $t('€100K') }}
          </div>
          <div class="right-box-text">
            {{ $t('cash rewards!') }}
          </div>
        </div>
        <div class="right-box-subtitle">
          {{ $t('Sign Up today and secure your position in the first month of cash prize giveaways') }}
        </div>
        <!-- <default-button
          v-if="isAuthenticated"
          type="button"
          class="sign-up-btn"
          :on-click="logout"
          >Sign out</default-button
        >-->
        <default-button
          type="button"
          :on-click="openModal"
          class="sign-up-btn"
        >
          {{ $t('Sign up') }}
        </default-button>
      </div>
      <default-modal
        :show="showRegisterModal"
        :close-modal="closeModal"
        from-demo
        minwidth="auto"
      >
        <register-form
          from-demo
          :on-submit="closeModal"
        />
      </default-modal>
    </div>
    <coming-soon-games-block />

    <Banger
      :time="13000"
      path="comming-soon"
      :initial="showBanger"
    />
  </div>
</template>

<script>
import ComingSoon from 'components/svgIcons/ComingSoon';
import DefaultButton from 'components/DefaultButton.vue';
import DefaultModal from 'components/modals/DefaultModal.vue';
import RegisterForm from 'components/forms/RegisterForm.vue';
import ComingSoonGamesBlock from 'components/ComingSoonGamesBlock';

import { createNamespacedHelpers } from 'vuex';
const authModule = createNamespacedHelpers('auth');
const animationModule = createNamespacedHelpers('bangerAnimation');

import Banger from 'components/Banger/Banger.vue';

export default {
  name: 'ComingSoonBlock',
  components: {
    ComingSoon,
    DefaultButton,
    DefaultModal,
    RegisterForm,
    ComingSoonGamesBlock,
    Banger
  },
  data: () => ({
    showRegisterModal: false
  }),
  computed: {
    ...authModule.mapState(['user', 'isAuthenticated']),
    ...animationModule.mapState(['showBanger'])
  },
  mounted() {
    if (this.$cookies.get('cookiesAccepted')) {
      this.showAnimation();
    }
  },
  methods: {
    ...authModule.mapActions(['logout']),
    ...animationModule.mapMutations(['showAnimation']),
    openModal() {
      this.showRegisterModal = true;
    },
    closeModal() {
      this.showRegisterModal = false;
    },
    onSubmit() {
      this.closeModal();
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes";

.coming-soon {
  display: flex;
  position: relative;
  overflow: hidden;

  .header-container-mobile {
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
  }

  .right-box {
    .right-box-title {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      line-height: 46px;
      display: flex;
      color: $border-primary-color;
      flex-direction: column;
      text-transform: uppercase;
    }

    .right-box-subtitle {
      font-family: Telegraf-Regular, serif;
      font-style: normal;
      font-weight: normal;
      line-height: 94%;
      text-transform: uppercase;
      color: $text-primary-color;
    }
  }
}

@media all and (min-width: $min-resolution) {
  .coming-soon {
    flex-direction: column;
    padding: 28px 5% 0 4.4%;

    .left-box {
      width: 100%;
      padding: 11px 0 0;
      .coming-soon-svg {
        width: 100%;
        height: 100%;
        padding: 0;
      }
    }

    .right-box {
      width: 100%;
      padding-left: 0;
      .right-box-title {
        margin-top: 7px;

        .right-box-text {
          font-size: 34px;
        }
        .right-box-text-accent {
          font-size: 52px;
        }
      }
      .right-box-subtitle {
        font-size: 18px;
        padding-top: 5px;
      }
      .sign-up-btn {
        margin-top: 21px;
        font-size: 17px;
        letter-spacing: 0.05em;
        padding: 17px 45px;
      }
    }
  }

  .header-container-mobile {
    display: flex;

    img {
      max-height: 33px;
      margin-right: 34px;
    }
  }
}

@media all and (min-width: $desktop-width) {
  .coming-soon {
    flex-direction: row;
    padding: 0 5% 0 4.4%;

    .left-box {
      width: 61%;
      padding: 0;

      .coming-soon-svg {
        width: 103%;
        height: 100%;
        padding: 1.5% 1% 0 7%;
      }
    }

    .right-box {
      width: 39%;
      padding-left: 4.5%;

      .right-box-title {
        margin-top: 136px;

        .right-box-text {
          font-size: 34px;
        }
        .right-box-text-accent {
          font-size: 52px;
        }
      }

      .right-box-subtitle {
        font-size: 24px;
        padding-top: 26px;
      }

      .sign-up-btn {
        margin-top: 28px;
        font-size: 18px;
        letter-spacing: 0.05em;
        padding: 19px 34px;
      }
    }
  }
  .header-container-mobile {
    display: none;
  }
}
</style>
