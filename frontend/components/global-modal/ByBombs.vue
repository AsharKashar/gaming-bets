<template>
  <div class="modal-content">
    <div class="modal-banner">
      <div
        class="modal-banner__image"
        :style="`background: linear-gradient(180deg, rgba(1, 4, 50, 0.25) -83.6%, #010432 100%), url(${tournament.image_url}) no-repeat 50% 50%;`"
      />
      <div
        class="modal-banner__heading"
      >
        <div
          class="modal-banner__title"
          v-text="tournament.name"
        />
        <div class="modal-banner__info">
          <div>
            {{ $t('This tournament cost') }}:
          </div>
          <bomb-icons
            class="modal-banner__info-icon"
            :count-bomb="tournament.entry_fee"
          />
          <div class="font-weight-bold">
            {{ tournament.entry_fee }} {{ $t('bombcoins') }}
          </div>
        </div>
      </div>
    </div>
    <bombs-choice-tabs />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import BombIcons from 'components/svgIcons/BombIcons';
import BombsChoiceTabs from './bombs-choice-tabs/BombsChoiceTabs';

const { mapState } = createNamespacedHelpers('modal');

export default {
  name: 'ByBombs',
  components: {BombsChoiceTabs, BombIcons},
  computed: {
    ...mapState({
      tournament: ({commonData}) => commonData.tournament,
    }),
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.modal-banner {
  position: relative;
  margin-bottom: 32px;
  &__image {
    background-size: cover;
    background: linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%) no-repeat 50% 50%;
    height: 186px;
    width: 100%;
    border-radius: 16px;
  }
  &__heading {
    position: absolute;
    bottom: -12px;
    padding: 0 24px;
    left: 0;
    right: 0;
  }
  &__title {
    font-size: 20px;
    line-height: 1.1;
    font-weight: 800;
    margin-bottom: 8px;
    color: $text-hover-color;
  }
  &__info {
    display: flex;
    align-items: center;
    color: $text-secondary-color;
    &-icon {
      max-width: 40px;
      margin: 0 15px;
    }
  }
}
@media all and (max-width: $mobile-width) {
  .modal-banner {
    &__heading {
      padding: 0;
      position: unset;
      margin-top: -30px;
    }
    &__info {
      font-size: 14px;
      padding: 16px;
      background: rgba(17, 21, 66, 0.24);
      backdrop-filter: blur(32px);
      border-radius: 16px;
      &-icon {
        max-width: 30px;
        margin: 0 5px;
      }
    }
    &__title {
      position: absolute;
      left: 0;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;
    }
  }
}
</style>
