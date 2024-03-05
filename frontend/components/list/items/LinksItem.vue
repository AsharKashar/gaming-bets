<template>
  <div class="link-item">
    <div
      class="link-item__title"
      v-text="title"
    />
    <div class="link-item__content">
      <div class="link-item__content-inner">
        <div class="link-item__icon">
          <svg-icon :name="type" />
        </div>
        <div class="link-item__action">
          <a
            target="_blank"
            :href="link"
            v-text="link"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SvgIcon from 'components/svgIcons/SvgIcon';
export default {
  name: 'LinksItem',
  components: {SvgIcon},
  props: {
    link: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      default: undefined,
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
.link-item {
  &__title {
    line-height: 1.2;
    font-weight: 900;
    margin-bottom: 8px;
    font-size: 16px;
  }
  &__content {
    margin-bottom: 20px;
    &-inner {
      border: 1px solid rgba(161, 175, 211, 0.2);
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      padding: 12px 6px;

      line-height: 1;
      & > div {
        padding: 0 6px;
        width: 100%;
      }
    }
  }
  &__icon {
    max-width: 38px;
    flex: 0 0 38px;
  }
  &__action {
    max-width: calc(100% - 38px);
    flex: 0 0 calc(100% - 38px);
    a {
      font-size: 14px;
      color: $text-secondary-color;
      word-break: break-all;
    }
  }
}
</style>
