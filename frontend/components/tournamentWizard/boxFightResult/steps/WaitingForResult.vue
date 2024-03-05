<template>
  <div class="p-10">
    <img
      src="~/static/images/bangerman.png"
      class="img-fluid"
      alt
    >
    <h2
      class="subtitles-primary"
    >
      {{ $t('Thank You for uploading proof. Admin will judge the results from both teams') }}
    </h2>

    <default-button
      btn-class="default-banger-btn button-block my-5"
      :on-click="() => $emit('move-next')"
    >
      {{ $t('Continue') }}
    </default-button>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
export default {
  components: {
    DefaultButton,
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.p-10 {
  padding: 20px;
  text-align: center;
  .img-fluid{
    margin-bottom: 2rem;
        height: auto;
    max-width: 100%;
    max-height: 200px;
  }
  h2 {
    color: $text-secondary-color;
    text-align: center;
    word-break: unset;
    text-transform: inherit;
  }
}
</style>
