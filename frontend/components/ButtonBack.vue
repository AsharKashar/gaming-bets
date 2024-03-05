<template>
  <div
    class="button__back"
    @click="back"
  >
    <div class="button__back-inner">
      <div class="button__back-text">
        <arrow class="arrow" />
        <span v-text="$t('back')" />
      </div>
    </div>
  </div>
</template>

<script>
import Arrow from 'components/svgIcons/Arrow';
export default {
  name: 'ButtonBack',
  components: {Arrow},
  props:{
    to:{
      type:String,
      default:''
    }
  },
  methods: {
    back() {
      if(!this.to){
        this.$router.back();
      } else {
        this.$router.push(this.to);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.button__back {
  position: absolute;
  z-index: 1;
  left: 0;
  top: 0;
  background: $text-primary-color;
  clip-path: polygon(100% 0, 90% 100%, 0 100%, 0 0);
  padding: 0 2px 2px 0;
  cursor: pointer;
  &:hover {
    background: $text-secondary-color;
  }
  &-text {
    display: flex;
    align-items: center;
    margin-left: auto;
  }
  &-inner {
    display: flex;
    align-items: center;
    padding: 20px 55px 20px 96px;
    color: $text-secondary-color;
    background: $app-background;
    min-width: 333px;
    min-height: 87px;
    clip-path: polygon(100% 0, 90% 100%, 0 100%, 0 0);
    display: flex;
    align-items: flex-end;
    .arrow {
      transform: rotate(180deg);
    }
    span {
      margin-left: 16px;
      font-weight: 800;
      font-size: 20px;
      line-height: 1;
      text-transform: uppercase;
    }
  }
}
</style>
