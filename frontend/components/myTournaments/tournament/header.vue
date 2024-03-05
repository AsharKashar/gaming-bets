<template>
  <div class="header-wrapper">
    <img
      src="~/static/images/brackets/popups/game1.svg"
      alt=""
      class="header-image"
    >
    <Tag />
  </div>
</template>

<script>
import Tag from './tag';
export default {
  components: {
    Tag,
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.header-wrapper {
  max-height: 225px;
  width: 100%;
  position: relative;
  overflow: hidden;
  .header-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}
</style>
