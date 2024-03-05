<template>
  <section class="team-rank">
    <div class="team-rank__inner">
      <div class="team-rank__heading">
        <h3 class="heading-primary text-center mb-7 pr-10">
          {{ $t('Your Team Current rank') }}
        </h3>
      </div>
      <div class="team-rank__list-wrap">
        <div class="info-team__heading">
          <div class="info-team__image">
            <v-img
              :src="info.icon"
              contain
              aspect-ratio="1"
            />
          </div>
          <div class="info-box">
            <h2
              class="main-heading"
              v-text="info.title"
            />
            <div class="team-rank__item-xp">
              {{ currentRank }}
              <span class="info-team__xp--total">/ {{ totalRank }} XP</span>
            </div>
          </div>
        </div>
        <v-progress-linear
          class="team-rank__progress"
          :value="progressValue"
          height="5"
          background-color="#111542"
          color="#be1338"
        />
        <div class="team-rank__list">
          <div
            v-for="({icon, status, xp}, i) in ranks"
            :key="xp"
            class="team-rank__item"
            :class="getClassItemRank(xp, i)"
          >
            <div class="team-rank__item-wrap">
              <div class="team-rank__item-icon">
                <div class="team-rank__item-icon-inner">
                  <v-img
                    :src="icon"
                    contain
                    aspect-ratio="1"
                  />
                </div>
              </div>
              <div class="team-rank__item-detail">
                <div
                  class="team-rank__item-status"
                  v-text="status"
                />
                <div class="team-rank__item-xp">
                  {{ xp }} {{ $t('XP') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'TeamRank',
  props: {
    currentRank: {
      type: Number,
      required: true,
    },
    info: {
      type: Object,
      required: true,
    },
    totalRank: {
      type: Number,
      required: true,
    },
    ranks: {
      type: Array,
      required: true,
    },
    progressValue: {
      type: Number,
      required: true,
    },
  },
  methods: {
    getClassItemRank(xp, index) {
      const isPast = xp <= this.currentRank;
      let active = true;
      if (this.ranks[index + 1]) {
        active = this.currentRank < this.ranks[index + 1].xp;
      }
      if (isPast && active) return 'team-rank__item--active';
      if (isPast) return 'team-rank__item--past';
      return '';
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.team-rank {
  &__item {
    padding: 0 32px;
    &--past {
      &:not(&--active) {
        .v-image {
          opacity: 0.5;
        }
      }
    }

    &-icon {
      width: 100px;
      position: relative;

      &-inner {
        height: 112px;
        width: 100%;
        position: relative;
        background: $secondary-background;
        clip-path: polygon(0 25%, 50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%);
        padding: 15px 10px;
        display: flex;
        align-items: center;
      }
    }

    &-detail {
      font-size: 20px;
      text-transform: uppercase;
      font-weight: 800;
      position: absolute;
      bottom: -70px;
    }

    &-status {
      color: #515982;
    }

    &-wrap {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    &-xp {
      color: #a1afd3;
    }

    &--active {
      .team-rank__item {
        &-icon {
          // width: 150px;
          &::before {
            content: "";
            position: absolute;
            left: -4px;
            top: 50%;
            transform: translateY(-50%);
            width: calc(100% + 8px);
            height: 120px;
            background: #be1338;
            display: block;
            clip-path: polygon(
              0 25%,
              50% 0,
              100% 25%,
              100% 75%,
              50% 100%,
              0 75%
            );
          }
          &-inner {
            // height: 170px;
          }
        }
        &-status {
          color: #e7e7e7;
        }
        &-detail {
          text-align: center;
        }
      }
    }
  }

  &__list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    &-wrap {
      margin-bottom: 120px;
      position: relative;
      display: flex;

      .info-team__heading {
        display: flex;
        flex-basis: 22%;
        flex-direction: column;

        .info-team__image {
          width: 100%;
          max-width: 183px;
          padding-right: 48px;
        }

        .info-box {
          position: absolute;
          bottom: -85px;

          .main-heading {
            font-weight: 800;
            font-size: 24px;
            line-height: 130%;
            color: #e7e7e7;
          }
          .team-rank__item-xp {
            font-size: 20px;
            text-transform: uppercase;
            font-weight: 800;
            color: #a1afd3;
          }
        }
      }
    }
  }

  &__progress {
    z-index: 0;
    position: absolute;
    top: 50%;
    left: 20%;
    width: 80%;
    transform: translateY(-50%) skew(-35deg);
  }
}

@media only screen and (max-width: $mobile-width) {
  .team-rank__heading {
    .heading-primary {
      text-align: left !important;
    }
  }
}
</style>
