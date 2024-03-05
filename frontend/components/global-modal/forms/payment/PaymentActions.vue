<template>
  <div class="action">
    <div class="action__col">
      <div class="summary-block">
        <div class="left-side">
          <img
            src="~/static/icons/small_bombs_bunch.png"
            alt="bunch"
          >
        </div>
        <div class="right-side">
          <div class="bombs">
            {{ commonData.bombsPackage.bombs }} bombs
          </div>
          <span class="color-red">Total: €{{ commonData.bombsPackage.price }}</span>
        </div>
      </div>
    </div>
    <div class="action__col">
      <default-button
        type="button"
        btn-class="default-banger-btn button-block"
        :on-click="onClick"
        :disabled="!complete"
        :loading="load"
      >
        {{ $t('Continue') }}
      </default-button>
    </div>
  </div>
</template>

<script>

import { createNamespacedHelpers } from 'vuex';
import DefaultButton from 'components/DefaultButton';

const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'PaymentActions',
  components: {DefaultButton},
  props: {
    complete: {
      type: Boolean,
      required: true,
    },
    submitPayment: {
      type: Function,
      required: true,
    },
  },
  data: () => ({
    load: false,
  }),
  computed: {
    ...modalModule.mapState(['commonData']),
  },
  methods: {
    async onClick() {
      if(this.load) {
        return;
      }
      this.load = true;
      try {
        await this.submitPayment();
      } finally {
        this.load = false;
      }
    }
  }
};
</script>

<style scoped lang="scss">

  .action {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin: 0 -9px;
    &__col {
      width: 100%;
      flex: 0 0 50%;
      max-width: 50%;
      padding: 0 9px;
    }
    .summary-block {
      display: flex;
    }
    .left-side img {
      max-width: 44px;
      margin-right: 24px;
    }
    .right-side {
      font-weight: 800;
    }
    .bombs {
      text-transform: uppercase;
    }
  }
</style>
