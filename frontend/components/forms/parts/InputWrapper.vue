<template>
  <div
    class="input-wrapper"
  >
    <div class="wrapper-label">
      <div class="label-title">
        {{ label }}
      </div>
      <div
        v-if="subtitle"
        class="label-subtitle"
      >
        {{ subtitle }}
      </div>
    </div>
    <div class="wrapper-input">
      <slot />
    </div>
  </div>
</template>

<script>

export default {
  name: 'InputWrapper',
  props: {
    label: {
      type: String,
      default: ''
    },
    subtitle: {
      type: String,
      default: ''
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes";

  .input-wrapper {
    display: flex;
    align-items: center;
    min-height: 43px;
    border-bottom: 1px solid $text-primary-color;
    font-style: normal;
    font-size: 18px;
    line-height: 100%;
    letter-spacing: 0.05em;
    color: $text-primary-color;
    margin-bottom: 9px;

    .wrapper-label {
      display: flex;
      flex-direction: column;
      font-family: Telegraf-UltraBold, serif;
      flex-basis: 37%;
    }
    .wrapper-input {
      font-family: Telegraf-Regular, serif;
      outline: none;
      color: $text-primary-color;
      flex-basis: 63%;

      &::placeholder {
        font-family: Telegraf-Regular, serif;
        text-transform: uppercase;
        color: $text-primary-color;
      }
    }

    .input-select {
      display: flex;
      color: #be1338;
      align-items: center;
    }

    .label-subtitle{
      font-family: Telegraf-Regular, serif;
      font-style: normal;
      font-weight: normal;
      font-size: 13px;
      line-height: 94%;
      color: #BE1338;
      text-transform: lowercase;
      padding: 15px 0;
    }
  }

  @media all and (max-width: $tablet-small-width) {
    .input-wrapper {
      flex-direction: column;
      align-items: flex-start;

      .wrapper-label {
        margin: 10px 0;
        text-align: left !important;
      }

      .wrapper-input{
        margin: 10px 0;
        width: 100%;
      }

    }
  }
</style>
