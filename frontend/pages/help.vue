<template>
  <div class="page-container">
    <div class="page-tite-section">
      <v-row>
        <v-col
          md="6"
          class="static-page-title pr-8"
        >
          {{ $t('Help Centre') }}
        </v-col>
        <v-col
          md="6"
          class="static-page-title pl-8"
        >
          {{ $t('FAQ/Questions') }}
        </v-col>
      </v-row>
    </div>
    <div class="page-detail-section">
      <v-row>
        <v-col
          class="pr-8"
          md="6"
          sm="6"
          xs="12"
        >
          <p
            class="normal-text"
          >
            {{ $t('If you need help and can’t find what you’re looking for on our website, you can use our live chat facility or email customer services.') }}
          </p>
          <p class="mt-10 small-heading">
            {{ $t('Live Support Opening Hours (CET)') }}
          </p>
          <v-row class="timeline mt-4">
            <v-col md="6">
              <p>{{ $t('Monday') }} 8:00 - 18:00</p>
              <p>{{ $t('Tuesday') }} 8:00 - 18:00</p>
              <p>{{ $t('Wednesday') }} 8:00 - 18:00</p>
              <p>{{ $t('Thursday') }} 8:00 - 18:00</p>
            </v-col>
            <v-col md="6">
              <p>{{ $t('Friday') }} 8:00 - 18:00</p>
              <p>{{ $t('Saturday') }} 8:00 - 18:00</p>
              <p>{{ $t('Sunday') }} 8:00 - 18:00</p>
            </v-col>
          </v-row>
          <p
            class="small-text mt-6"
          >
            {{ $t('Game Play Eligibility Banger Games welcomes players who abide by our Terms and Conditions to take part in online tournaments through our website.') }}
          </p>
          <p
            class="small-text mt-5"
          >
            {{ $t('Terms and Conditions to take part in online tournaments through our website.') }}
          </p>
          <p
            class="small-text mt-5"
          >
            {{ $t('Players must be aged 14 years or over, can be of any skill level and located anywhere in the world. Players under 18 years of age must have the express permission of a parent or legal guardian who has read and agrees to Banger Games Terms and Conditions. The tournaments which players below the age of 18 are permitted to take part in may be limited; please refer to the rules for each tournament individually. For some tournaments geographic restrictions may also apply, this is dependant upon the laws in your home location. For further guidance, please refer to our Terms and Conditions and individual tournament rules.') }}
          </p>
          <p class="small-text mt-5">
            {{ $t('Multiple Accounts') }}
            {{ $t('It is not permitted to have more than one account on Banger Games. If you create more than one account, you will be in contradiction of our Terms and Conditions. People with multiple accounts will have all of their accounts deleted and will no longer be eligible to play on Banger Games.') }}
            {{ $t('Latest Banger Games Tournament Information') }}
            {{ $t('To discover all the latest tournaments, visit our Tournaments Page where you will discover full information on all our current and upcoming tournaments.') }}
          </p>
        </v-col>
        <v-col
          class="pl-8"
          md="6"
          sm="6"
          xs="12"
        >
          <p class="normal-text">
            {{ $t('Have a question? Tell us what you want to know.') }}
          </p>
          <div class="contact-us-from-wrapper">
            <ContactForm
              form-color-class="primary-card"
              page-tite="Contact us"
            />
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import ContactForm from 'components/StaticPages/ContactForm.vue';
import { APP_URL } from 'configs/config';

export default {
  name: 'Help',
  components: {
    ContactForm
  },
  data: () => ({
  }),
  methods: {
    goToAllGames() {
      this.$router.push('/game');
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Help',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors";
.page-container {
  color: $text-primary-color;
}

.static-page-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  text-align: start;
  font-weight: 900;
  color: $text-primary-color;
  font-size: 56px;
  line-height: 59px;
}
.page-container p {
  margin: 0;
}
.page-tite-section {
  margin-top: 56px;
}

.page-detail-section {
  margin: 28px 0;
  .normal-text {
    font-size: 20px;
    line-height: 120%;
  }
  .small-text {
    font-size: 16px;
    line-height: 140%;
  }

  .small-heading {
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
  }
  .medium-heading {
    font-weight: 900;
    font-size: 24px;
    line-height: 100%;
  }
  .timeline {
    font-size: 16px;
    line-height: 120%;
  }

  .contact-us-from-wrapper {
    margin: 32px 0;
  }
}
</style>
