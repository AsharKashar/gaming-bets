<template>
  <div class="modal-content">
    <div class="icon">
      <img src="~/static/icons/SuccessCheck.svg">
    </div>
    <div class="modal-heading">
      <div class="modal-title">
        {{ $t('You Have Joined This Tournament') }}
      </div>
      <div class="description">
        {{ $t('Make Sure To Regulary Check Your notifications for updates about the tournament') }}
      </div>
    </div>
    <div class="actions">
      <default-button
        type="button"
        @click.native="setRout"
      >
        {{ $t('My Tournaments') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';

import { createNamespacedHelpers } from 'vuex';
const { mapMutations } = createNamespacedHelpers('modal');

export default {
  name: 'JoinedSuccessfully',
  components: {
    DefaultButton
  },
  methods: {
    ...mapMutations(['setActiveModal']),
    setRout() {
      this.setActiveModal();
      this.$router.push('/my-tournaments');
    }
  }
};
</script>
<style lang="scss" src="./modal.scss" />

<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .modal {
    &-content {
      color: $text-primary-color;
      .icon {
        text-align: center;
        filter: drop-shadow(0px 56px 120px #BE1338);
        margin-bottom: 34px;
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
