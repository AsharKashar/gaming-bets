<template>
  <div class="subscribe-card-wrapper">
    <div class="subscribe-card">
      <div class="logo">
        <img
          src="~/static/icons/banger_games.svg"
          alt="bangergames"
        >
      </div>
      <div class="subscribe-title">
        {{ $t('GameSpot Report & Deals Newsletters') }}
      </div>
      <div class="subscribe-description">
        {{ $t('Get the latest gaming news, reviews, and deals sent to your inbox, FREE!') }}
      </div>
      <form
        class="pseudo-form"
        @submit.prevent="sendEmail"
      >
        <input
          v-model="email"
          class="subscribe-email"
          type="email"
          placeholder="E-mail Address"
          required
        >
        <button
          class="subscribe-submit"
          type="submit"
        >
          {{ $t('subscribe') }}
        </button>
      </form>
      <div class="subscribe-terms">
        {{ $t('By signing up to receive newsletters, you agree to the CBS Terms of Use and acknowledge the data practices in our Privacy Policy. You may unsubscribe at any time.') }}
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import { createNamespacedHelpers } from 'vuex';
import { emailReg } from 'helpers/regExpRules';

const { mapActions } = createNamespacedHelpers('blog');

export default {
  name: 'SubscribeCard',
  props: {
    item: {
      type: Object,
      default: () => ({})
    }
  },
  data: () => ({
    email: '',
    emailReg
  }),
  methods: {
    ...mapActions(['subscribeEmail']),
    sendEmail(e) {
      e.preventDefault();

      if (this.emailReg.test(this.email)) {
        this.subscribeEmail(this.email).then(() => {
          Vue.notify({
            group: 'custom-notification',
            title: 'Successfully subscribed!',
            text:
              'Success is walking from failure to failure with no loss of enthusiasm.',
            type: 'success'
          });
          this.email = '';
        });
      } else {
        Vue.notify({
          group: 'custom-notification',
          title: 'Error...!',
          text: 'Please Enter a valid email address',
          type: 'error'
        });
      }
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.subscribe-card-wrapper {
  margin-right: 10px;
  background: $border-primary-color;
  display: flex;
  justify-content: center;
  align-items: center;

  .subscribe-card {
    height: calc(100% - 2px);
    width: calc(100% - 2px);
    background: $app-background;
    position: relative;

    .logo {
      img {
        margin: 7px 6px;
        max-height: 27px;
      }
    }

    .subscribe-title {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      line-height: 94%;
      margin-top: 8px;
    }

    .subscribe-email {
      color: $text-primary-color;
      outline: none;
    }

    .subscribe-description {
      font-style: normal;
      font-weight: normal;
      line-height: 94%;
    }

    .subscribe-submit {
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 16px;
      line-height: 94%;
      margin-top: 16px;
      color: $border-primary-color;
      outline: none;
      cursor: pointer;
    }

    .subscribe-terms {
      font-family: Telegraf-Regular, serif;
      font-style: normal;
      font-weight: normal;
      font-size: 12px;
      line-height: 94%;
      margin-top: 17px;
      color: $text-primary-color;
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .subscribe-card-wrapper {
    position: inherit;
    height: 339px;
    margin-top: 32px;
    margin-bottom: 35px;
    margin-left: 17px;
    width: calc(100% - 32px);
    clip-path: polygon(100% 0, 100% 92%, 93% 100%, 0 100%, 0 0);

    .subscribe-card {
      clip-path: polygon(100% 0, 100% 92%, 93% 100%, 0 100%, 0 0);
      padding: 13px 19px 0 10px;
    }

    .subscribe-title {
      font-size: 20px;
    }

    .subscribe-description {
      font-size: 16px;
      margin: 12px 0 23px;
    }

    .subscribe-email {
      height: 45px;
      width: 100%;
      border-bottom: 2px solid #e7e7e7;
      max-width: 290px;
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .subscribe-card-wrapper {
    position: inherit;
    height: 193px;
    margin-top: 47px;
    margin-left: 0;
    margin-bottom: 51px;
    width: 100%;
    clip-path: polygon(100% 0, 100% 88%, 97% 100%, 0 100%, 0 0);

    .subscribe-card {
      clip-path: polygon(100% 0, 100% 88%, 97% 100%, 0 100%, 0 0);
      padding: 21px 21px 0 72px;
    }

    .pseudo-form {
      display: flex;
      justify-content: space-between;
      padding-right: 78px;
      align-items: baseline;
    }

    .subscribe-terms {
      display: none;
    }

    .logo {
      position: absolute;
      left: 14px;
      top: 11px;
    }

    .subscribe-title {
      font-size: 24px;
    }

    .subscribe-description {
      font-size: 16px;
      margin: 12px 0 23px;
    }

    .subscribe-email {
      height: 45px;
      width: 100%;
      border-bottom: 2px solid #e7e7e7;
      max-width: 290px;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .subscribe-card-wrapper {
    .subscribe-card {
      padding: 24px 82px;
    }

    .pseudo-form {
      padding-right: 224px;
    }

    .logo {
      left: 29px;
      top: 25px;
    }

    .subscribe-description {
      font-size: 20px;
      margin: 17px 0 23px;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .subscribe-card-wrapper {
    position: absolute;
    top: 0;
    right: 0;
    height: 338px;
    width: 252px;
    clip-path: polygon(100% 0, 100% 93%, 91% 100%, 0 100%, 0 0);
    margin-top: 0;
    margin-bottom: 51px;

    .subscribe-card {
      clip-path: polygon(100% 0, 100% 93%, 91% 100%, 0 100%, 0 0);
      padding: 10px;
    }

    .subscribe-terms {
      display: block;
    }

    .pseudo-form {
      display: block;
      padding: 0;
    }

    .logo {
      position: relative;
      left: 0;
      top: 0;
    }

    .subscribe-title {
      font-size: 20px;
    }

    .subscribe-description {
      font-size: 16px;
      margin: 7px 0 18px;
    }

    .subscribe-email {
      height: 41px;
      width: 100%;
      border-bottom: 1px solid $text-hover-color;
    }
  }
}
</style>
