<template>
  <div
    v-if="title || description"
    class="heading"
  >
    <div
      v-if="title"
      class="form-title"
      v-text="$t(title)"
    />
    <div
      v-if="description"
      class="form-description"
      v-text="$t(description)"
    />
  </div>
</template>

<script>
export default {
  name: 'EvidenceFormHeader',
  props: {
    title: {
      type: [String, Boolean],
      default: 'The results of the match'
    },
    description: {
      type: [String, Boolean],
      default: 'Write here your results of this match. Fill all the fields in order to confirm your win or loss'
    }
  }
};
</script>

<style lang="scss" scoped>
@import '~/assets/styles/colors';

.heading {
  padding-bottom: 32px;
  color: $text-secondary-color;
}

.form {
  &-title {
    font-weight: 900;
    font-size: 32px;
    line-height: 1.5;
    padding-bottom: 8px;
  }
  &-description {
    line-height: 1.4;
    padding-bottom: 12px;
  }
}
</style>
