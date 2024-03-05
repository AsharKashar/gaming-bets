<template>
  <div class="bomb-choice">
    <div class="bomb-choice__heading modal-heading modal-title">
      {{ $t('Select your best choice') }}
    </div>
    <div class="bomb-choice__tabs">
      <div class="bomb-choice__tabs-list">
        <div
          v-for="(val, key) in tabs"
          :key="key"
          class="bomb-choice__tab-item"
          :class="{active: key === activeTab}"
          @click="setActiveTab(key)"
          v-text="val"
        />
      </div>
      <div class="bomb-choice__tabs-content">
        <component :is="activeTab" />
      </div>
    </div>
  </div>
</template>

<script>
import BombsTabPlansList from './BombsTabPlansList';
import BombsTabWithdrawal from './BombsTabWithdrawal';
export default {
  name: 'BombsChoiceTabs',
  components: {
    BombsTabPlansList,
    BombsTabWithdrawal,
  },
  data: () => ({
    tabs: {
      BombsTabPlansList: 'Plans',
      BombsTabWithdrawal: 'Withdrawal information'
    },
    activeTab: 'BombsTabPlansList'
  }),
  methods: {
    setActiveTab(tabName) {
      this.activeTab = tabName;
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";
  .bomb-choice {
    &__heading {
      padding-bottom: 11px;
    }
    &__tabs-list {
      display: flex;
      margin-bottom: 32px;
      justify-content: center;
      position: relative;
      font-weight: 800;
      &::after {
        content: '';
        position: absolute;
        display: block;
        bottom: 0;
        left: -100%;
        right: -100%;
        height: 1px;
        width: 300%;
        background: $text-primary-color;
        opacity: .2;
      }
    }

    &__tab-item {
      padding: 0 20px 12px;
      position: relative;
      cursor: pointer;
      transition: .4s ease;
      &.active {
        color: $text-secondary-color;
        &::after {
          content: '';
          display: block;
          position: absolute;
          height: 1px;
          left: 0;
          right: 0;
          bottom: 0;
          width: 100%;
          background: $text-secondary-color;
        }
      }
    }
  }
  @media all and (max-width: $tablet-small-width) {
    .bomb-choice {
      &__tab-item {
        font-size: 14px;
      }
    }
  }
</style>
