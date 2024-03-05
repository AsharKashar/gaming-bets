<template>
  <div class="modal-content">
    <div class="icon">
      <img
        src="~/static/icons/not-enough-coins.svg"
        alt="not coins"
      >
    </div>
    <div
      v-if="tournament.entry_fee"
      class="modal-heading"
    >
      <div
        class="modal-title"
        v-text="$t('Not Enough Coins')"
      />
      <div
        class="description"
        v-text="$t('You need {bomb} bombs to join this tournament', {bomb: tournament.entry_fee_item.fee})"
      />
    </div>
    <div class="actions">
      <default-button
        type="button"
        @click.native="setActiveModal({type:'ByBombs'})"
      >
        {{ $t('Buy Bombs') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';

import { createNamespacedHelpers } from 'vuex';
const { mapMutations, mapState } = createNamespacedHelpers('modal');

export default {
  name: 'NotEnoughCoins',
  components: {
    DefaultButton
  },
  computed: mapState({
    tournament: ({commonData}) => commonData.tournament,
  }),
  methods: mapMutations(['setActiveModal'])
};
</script>

<style scoped lang="scss">
  @import '~/components/global-modal/modal.scss';
  @import "~/assets/styles/colors";

  .modal {
    &-content {
      position: relative;
      color: $text-primary-color;
      z-index: 1;
      padding-top: 154px;
      .icon {
        position: absolute;
        z-index: -1;
        top: -96px;
        left: 0;
        right: 0;
        text-align: center;
      }
    }
    &-heading {
      text-align: center;
      margin-bottom: 32px;
      .description {
        padding-top: 10px;
        color: $text-primary-color;
        font-size: 20px;
        line-height: .94;
      }
    }
  }
</style>
