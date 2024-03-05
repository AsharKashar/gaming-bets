<template>
  <div
    class="match-date"
    v-text="formatDate"
  />
</template>

<script>
import dayjs from 'dayjs';

export default {
  name: 'MatchDate',
  props: {
    date: {
      type: String,
      required: true,
    },
    format: {
      type: String,
      default: 'dddd, YYYY-MM-DD'
    },
  },
  computed: {
    formatDate() {
      return dayjs(this.date).format(this.format);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";

.match-date {
  font-weight: 800;
  font-size: 20px;
  color: $text-hover-color;
  margin-bottom: 40px;
}
</style>
