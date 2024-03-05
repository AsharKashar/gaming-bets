<template>
  <img
    :src="iconPath"
    alt="bombs"
  >
</template>

<script>
import bombMediumIcon from '~/static/icons/medium_bombs_bunch.png';
import bombLargeIcon from '~/static/icons/large_bombs_bunch.png';
import bombSmallIcon from '~/static/icons/small_bombs_bunch.png';
export default {
  name: 'BombIcons',
  props: {
    countBomb: {
      type: Number,
      default: 10,
    }
  },
  computed: {
    iconPath() {
      if (this.countBomb >= 100 && this.countBomb < 500) {
        return bombMediumIcon;
      }
      if(this.countBomb >= 500) {
        return bombLargeIcon;
      }
      return bombSmallIcon;
    }
  }
};
</script>
