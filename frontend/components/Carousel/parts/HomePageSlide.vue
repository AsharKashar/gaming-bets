<template>
  <v-carousel-item
    class="blog-slide"
    :style="{ backgroundImage: `linear-gradient(180.11deg, rgba(1, 4, 50, 0.55) 44.53%, rgba(1, 4, 50, 0.78) 99.8%), url(${slide.image})` }"
    @click="openTournament(slide.id)"
  >
    <div class="blog-content">
      <div class="slide-details">
        <div class="details-section">
          <div class="small-headers">
            {{ $t('Host') }}
          </div>
          <div class="large-headers">
            {{ slide.hosted_by }}
          </div>
        </div>
        <div class="details-section">
          <div class="small-headers">
            {{ $t('Starts') }}
          </div>
          <div class="large-headers">
            {{ new Date(slide.start_at).toDateString().substr(4) }}
          </div>
        </div>
        <div>
          <div class="details-section">
            <div class="small-headers">
              {{ $t('Rewards') }}
            </div>
            <div class="large-headers">
              {{ firstPrize.prize }}
            </div>
          </div>
        </div>
        <div class="join-btn-mobile">
          <default-button
            :class="actionButtonText(slide).class"
            type="button"
            :disabled="actionButtonText(slide).disabled"
            @click.native.stop="openJoinTournamentWizard(slide)"
          >
            <span
              class="inner-btn-dynamic"
              v-html="actionButtonText(slide).text"
            />
          </default-button>
        </div>
      </div>
      <div class="slide-title">
        <div>{{ slide.name + ' ' + regions }}</div>
        <div>
          {{ slide.game_type.name + ' ' }}
          <span class="slide-title-prize">{{ firstPrize.prize }}</span>
        </div>

        <div class="join-btn-desktop">
          <default-button
            :class="actionButtonText(slide).class"
            type="button"
            :disabled="actionButtonText(slide).disabled"
            @click.native.stop="openJoinTournamentWizard(slide)"
          >
            <span
              class="inner-btn-dynamic"
              v-html="actionButtonText(slide).text"
            />
          </default-button>
        </div>
      </div>
      <div class="slide-title-prize-mobile">
        <span>{{ firstPrize.prize }}</span>
      </div>
      <!-- <div class="slide-action">
        <default-button
          :class="actionButtonText(slide).class"
          type="button"
          :disabled="actionButtonText(slide).disabled"
          @click.native.stop="openJoinTournamentWizard(slide)"
        >
          <span
            class="inner-btn-dynamic"
            v-html="actionButtonText(slide).text"
          />
        </default-button>
      </div> -->
    </div>
  </v-carousel-item>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import get from 'lodash/get';
import tournamentMixin from '@/mixins/tournamentMixin';

export default {
  name: 'HomePageSlide',
  components: {
    DefaultButton,
  },
  mixins: [tournamentMixin],
  props: {
    slide: {
      type: Object,
      default: () => ({}),
    },
  },
  computed: {
    firstPrize() {
      return this.slide.prizes.find((item) => item.position === 1) || {};
    },
    regions() {
      const regionsList = get(this, 'slide.regions', []);
      let regionsStr = '';
      regionsList.map((region) => {
        regionsStr = regionsStr + region.name + ' ';
      });

      return regionsStr;
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.blog-slide {
  background-blend-mode: normal, luminosity;
  mix-blend-mode: normal;
  border-radius: 16px;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  // user-select: none;
  // cursor: pointer;

  .blog-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    width: 100%;

    .slide-details {
      font-family: Telegraf-UltraBold, serif;
      display: flex;
      align-items: center;
      justify-content: space-between;

      font-style: normal;
      color: $text-primary-color;
      cursor: pointer;
      text-decoration: none;

      .small-headers {
        font-weight: 900;
        line-height: 25px;
      }
      .large-headers {
        font-weight: 800;
        line-height: 120%;
      }
      
      .join-btn-mobile
      {
        width: 100%;
        padding-top: 15px;
        button
        {
          width: 100%
        }
      }
    }

    .slide-title {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      color: #e7e7e7;
      cursor: pointer;
      font-weight: 900;
      text-decoration: none;
      position: absolute;
      top: calc(50% - 60px);


      .join-btn-desktop
      {
            padding-top: 25px;
      }

    }

    .slide-title-prize-mobile {
      display: none;
    }

    .slide-action {
      position: absolute;
      bottom: 101px;

      button {
        font-size: 20px;
        padding: 15px 30px;
        white-space: nowrap;
        text-transform: uppercase;
      }
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .slide-details {
    padding: 32px 40px 0 40px;

    .small-headers {
      font-size: 14px;
    }
    .large-headers {
      font-size: 22px;
    }
  }
  .slide-title {
    font-size: 22px;
    line-height: 40px;
    padding-left: 40px;
  }

  .slide-action {
    padding: 0 40px;
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .join-btn-mobile
  {
    display: none;
  }
  .slide-details {
    padding: 54px 70px 0 70px;

    .small-headers {
      font-size: 20px;
    }
    .large-headers {
      font-size: 28px;
    }
  }

  .slide-title {
    padding-left: 70px;
    font-weight: 900;
    font-size: 52px;
    line-height: 55px;
  }

  .slide-action {
    padding-left: 70px;
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .slide-details {
    padding: 64px 80px 0 80px;

    .small-headers {
      font-size: 24px;
    }
    .large-headers {
      font-size: 32px;
    }
  }

  .slide-title {
    padding-left: 74px;
    font-weight: 900;
    font-size: 56px;
    line-height: 59px;
  }

  .slide-action {
    padding-left: 74px;
  }
}

@media only screen and (max-width: $tablet-small-width) {

  .join-btn-desktop
  {
    display: none;
  }
  .blog-content {
    .slide-details {
      position: absolute;
      top: calc(50% + -10px) !important;
      flex-direction: column;
      justify-content: center;
      text-align: center;
      width: 100%;

      .small-headers {
        font-weight: 800;
        font-size: 12px;
        line-height: 94%;
        letter-spacing: 0.04em;

        color: #a1afd3;
      }
      .large-headers {
        font-weight: 800;
        font-size: 20px;
        line-height: 115%;
      }
    }

    .slide-title {
      top: calc(45% - 121px) !important;

      width: 100%;
      padding: 0 40px;
      text-align: center;
      flex-direction: column;

      font-weight: 800;
      font-size: 24px;
      line-height: 110%;
      //
      .slide-title-prize {
        display: none;
      }
    }

    .slide-title-prize-mobile {
      display: block !important;
          top: 43%;
      position: absolute;
      color: transparent;

      -webkit-text-stroke: 3px #e7e7e7;

      width: 100%;
      text-align: center;

      font-weight: 800;
      font-size: 60px;
      line-height: 74px;
      display: flex;
      align-items: center;
    }

    .slide-action {
      bottom: 60px !important;
      width: 100%;
      padding: 0 20px;

      button {
        width: 100%;
        font-size: 20px;
        padding: 15px 30px;
        white-space: nowrap;
        text-transform: uppercase;
      }
    }
  }
}
</style>
