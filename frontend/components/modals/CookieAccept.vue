<template>
  <v-dialog
    :value="showModal"
    persistent
    overlay-color="#BE1338"
    overlay-opacity=".9"
    scrollable
    internal-activator
  >
    <div class="cookie-accept-content">
      <div class="cookie-accept-modal">
        <div class="info-block">
          <div class="cookie-title">
            {{ $t('Do you accept cookies?') }}
          </div>
          <div class="description">
            {{ $t('We use our own and third party cookies to improve the browsing experience and provide content and advertising of interest. By continuing to browse we understand that you accept our cookie policy.') }}
          </div>
          <default-button
            class="accept-btn"
            @click.native="acceptCookies"
          >
            {{ $t('Accept cookies') }}
          </default-button>
        </div>
        <img
          src="~/static/images/bangerman.png"
          alt="computer"
          class="bangerman"
        >
      </div>
    </div>
  </v-dialog>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';

const { mapMutations } = createNamespacedHelpers('bangerAnimation');

export default {
  name: 'CookieAccept',
  components: {
    DefaultButton
  },
  data: () => ({
    showModal: false
  }),
  created() {
    this.showModal = !this.$cookies.get('cookiesAccepted');
  },
  methods: {
    ...mapMutations(['showAnimation']),
    acceptCookies() {
      this.$cookies.set('cookiesAccepted', true);
      this.showModal = false;
      this.showAnimation();
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.cookie-accept-content {
  display: flex;
  justify-content: center;
}
.cookie-accept-modal {
  background-color: $text-primary-color;
  border: 8px solid $border-primary-color;
  box-sizing: border-box;
  border-radius: 32px;
  position: relative;

  .bangerman {
    position: absolute;
  }

  .info-block {
    .cookie-title,
    .description {
      font-style: normal;
      line-height: 25px;
    }

    .cookie-title {
      font-family: Telegraf-UltraBold, serif;
      font-weight: 900;
      color: #000000;
    }

    .description {
      font-weight: normal;
      margin: 33px 0 38px;
      color: #000000;
    }
  }
}

@media all and (min-width: $min-resolution) {
  .cookie-accept-modal {
    max-width: 300px;

    .bangerman {
      max-width: 100px;
      top: 15px;
      left: 10px;
    }

    .info-block {
      padding: 25px;

      .cookie-title,
      .description {
        font-size: 15px;
        letter-spacing: 0.2px;
        padding-right: 0px;
      }

      .cookie-title {
        padding-left: 90px;
      }
    }
  }
}
@media all and (min-width: $tablet-small-width) {
  .cookie-accept-modal {
    max-width: 500px;

    .bangerman {
      max-width: 324px;
      top: -50px;
      left: -150px;
    }

    .info-block {
      padding: 30px 0 25px 140px;

      .cookie-title {
        padding-left: 0px;
      }
      .cookie-title,
      .description {
        font-size: 20px;
        letter-spacing: 0.2px;
        padding-right: 70px;
      }
      .accept-btn {
        padding: 24px 31px;
      }
    }
  }
}
@media all and (min-width: $tablet-large-width) {
  .cookie-accept-modal {
    max-width: 500px;

    .bangerman {
      max-width: 324px;
      top: -50px;
      left: -150px;
    }

    .info-block {
      padding: 30px 0 25px 140px;

      .cookie-title,
      .description {
        font-size: 20px;
        letter-spacing: 0.2px;
      }
    }
  }
}
@media all and (min-width: $desktop-width) {
  .cookie-accept-modal {
    max-width: 730px;

    .bangerman {
      max-width: 524px;
      top: -53px;
      left: -191px;
    }

    .info-block {
      padding: 84px 0 50px 279px;

      .cookie-title,
      .description {
        font-size: 24px;
        letter-spacing: 0.05em;
      }
    }
  }
}
</style>
