<template>
  <div class="title-bar">
    <div
      class="text-counter"
      :class="{'mb-4' : !menuHeader}"
    >
      <div
        class="title-text"
        :class="{'secondery--text' : menuHeader, 'primary--text' : !menuHeader}"
      >
        {{ $t('Notifications') }}
      </div>
      <div
        v-if="menuHeader"
        class="title-counter"
      >
        {{ totalCount }}
      </div>
    </div>
    <div
      class="cross"
      @click="$emit('close-menu')"
    >
      <Cross
        height="22"
        width="22"
      />
    </div>
  </div>
</template>

<script>
import Cross from 'components/svgIcons/Cross';

export default {
  name: 'NotificationHeader',
  components: {
    Cross,
  },
  props: {
    menuHeader: {
      type: Boolean,
      default: false,
    },
    totalCount: {
      type: Number,
      default: 0,
    },
  },
  data: () => ({}),
  computed: {},
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.title-bar {
  .title-text,
  .view-all {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
  }
}

.view-all {
  font-size: 14px;
  line-height: 100%;
  padding: 0 40px;
  letter-spacing: 0.05em;
  text-decoration-line: underline;
  color: $text-secondary-color;
  cursor: pointer;
}

.title-bar {
  justify-content: space-between;
  display: flex;
  align-items: center;
  // padding: 0 40px;

  .text-counter {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .title-text {
    font-size: 32px;
    line-height: 115%;
    letter-spacing: 0.02em;
    font-feature-settings: "ss03" on;
  }

  .title-counter {
    width: 28px;
    height: 28px;
    background: $text-secondary-color;
    color: "#E7E7E7";
    border-radius: 50%;
    margin-left: 13px;
    display: flex;
    align-items: center;
    padding: 0 10px;
    justify-content: center;
  }
  .cross {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    cursor: pointer;
  }
}
</style>
