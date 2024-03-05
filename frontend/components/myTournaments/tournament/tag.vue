<template>
  <div class="tag">
    <!-- <p class="status">JOINED</p> -->
    <p class="live">
      live
    </p>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.tag {
  position: absolute;
  width: 160px;
  right: 0;
  top: 0;
  background: $secondary-background;
  display: flex;
  align-items: center;
  justify-content: center;
  clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%);

  .status {
    color: #fff;
    text-transform: uppercase;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    margin: 0;
    color: $text-hover-color;
    margin-top: 1px;
    padding: 5px 0;
  }
  .live {
    text-transform: uppercase;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    margin: 0;
    color: $text-secondary-color;
    margin-top: 1px;
    padding: 5px 0;
    position: relative;
    &::before {
      position: absolute;
      content: "";
      left: -15px;
      top: 8px;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: $text-secondary-color;
    }
  }
}
</style>
