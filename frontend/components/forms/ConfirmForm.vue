<template>
  <div class="confirm-wrapper">
    <div class="confirm-question">
      {{ question }}
    </div>
    <div class="bottom-block">
      <default-button
        type="button"
        :on-click="onConfirm"
        class="confirm-btn"
      >
        {{ $t('Yes') }}
      </default-button>
      <default-button
        type="button"
        :on-click="onCancel"
        class="cancel-btn"
      >
        {{ $t('no') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';

export default {
  name: 'ConfirmForm',
  components: {
    DefaultButton
  },
  props: {
    onConfirm: {
      type: Function,
      default: () => {}
    },
    onCancel: {
      type: Function,
      default: () => {}
    },
    question: {
      type: String,
      default: 'Are you sure?'
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";

  .confirm-wrapper{
    padding: 28px 37px;

    .confirm-question{
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      color: $border-primary-color;
      font-size: 36px;
      line-height: 40px;
      margin-bottom: 28px;
    }

    .bottom-block{
      display: flex;
      justify-content: space-between;
      margin-top: 20px;

      &::v-deep .confirm-btn,
      &::v-deep .cancel-btn {
        font-size: 19px;
        letter-spacing: 0.05em;
        padding: 15px 20px;
      }

      &::v-deep .confirm-btn{
        opacity: 0.5;
        &:hover{
          opacity: 1;
        }
      }
    }
  }
</style>
