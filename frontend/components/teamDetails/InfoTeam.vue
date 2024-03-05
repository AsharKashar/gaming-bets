<template>
  <section class="info-team">
    <div class="info-team__inner">
      <!-- <div class="info-team__image">
        <v-img
          :src="info.icon"
          contain
          aspect-ratio="1"
        />
      </div>-->
      <div class="info-team__stats">
        <!-- <div class="info-team__heading">
          <h2
            class="main-heading"
            v-text="info.title"
          />
          <div class="info-team__xp">
            {{ currentRank }}
            <span class="info-team__xp--total">/ {{ totalRank }} XP</span>
          </div>
        </div>-->
        <div class="info-team__content">
          <div class="info-team__list">
            <div class="info-team__item">
              <div class="info-team__item-heading">
                {{ $t("TOTAL POINTS EARNED") }}
              </div>
              <div
                class="info-team__item-res"
                v-text="info.pointsEarned"
              />
            </div>
            <div class="info-team__item">
              <div class="info-team__item-heading">
                {{ $t("TOTAL WINS") }}
              </div>
              <div
                class="info-team__item-res"
                v-text="info.totalWins"
              />
            </div>
            <div class="info-team__item">
              <div class="info-team__item-heading">
                {{ $t("TEAM LIST") }}
              </div>
              <div
                class="info-team__item-res"
                v-text="info.teamList"
              />
            </div>
            <div class="info-team__item">
              <div class="info-team__item-heading">
                {{ $t("WIN - RATIO") }}
              </div>
              <div
                class="info-team__item-res"
                v-text="info.winRatio + ' %'"
              />
            </div>
          </div>
          <v-progress-linear
            :value="progressValue"
            height="4"
            background-color="#59628a"
            color="#be1338"
            class="info-team__progress"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'InfoTeam',
  props: {
    info: {
      type: Object,
      required: true,
    },
    currentRank: {
      type: Number,
      required: true,
    },
    totalRank: {
      type: Number,
      required: true,
    },
    progressValue: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

@import "~/assets/styles/mixins";

.info-team {
  padding: 80px 0;
  &__inner {
    display: flex;
    flex-wrap: wrap;
    // padding: 79px 55px 86px;
    // @include beveled-corners($secondary-background, 25px, 0);
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
    // flex: 0 0 calc(100% - 183px);
    width: 100%;
    // max-width: calc(100% - 183px);
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
      color: $text-primary-color;
      padding-bottom: 12px;
    }
    &-res {
      font-weight: 900;
      font-size: 32px;
      line-height: 115%;
      display: flex;
      align-items: center;
      letter-spacing: 0.02em;
      color: $button-primary-background;
    }
  }
  &__progress {
    // transform: skew(-35deg);
    margin-top: 28px;
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

@media only screen and (max-width: $mobile-width) {
  .info-team {
    &__inner {
      padding: 20px;
      display: block;
    }
    &__image {
      margin: auto;
      padding: 0;
      max-width: 78px;
    }
    &__stats {
      max-width: 100%;
      position: relative;
    }
    &__heading {
      display: block;
      .main-heading {
        font-size: 24px !important;
      }
    }
    &__xp {
      font-size: 16px;
      position: absolute;
      right: 0;
      transform: translateY(42px);
      &--total {
        color: $text-primary-color;
      }
    }

    &__progress {
      margin-bottom: 40px;
    }

    &__content::v-deep .v-progress-linear {
      height: 8px !important;
    }

    &__list {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }
    &__item {
      text-align: center;
      padding: 1rem 0;

      &:first-child,
      &:nth-child(3) {
        border-right: 1px solid #e7e7e7;
      }

      &:first-child,
      &:nth-child(2) {
        border-bottom: 1px solid #e7e7e7;
      }

      &-res {
        font-size: 24px;
      }

      &-heading {
        font-size: 14px;
      }
    }
  }
}
</style>
