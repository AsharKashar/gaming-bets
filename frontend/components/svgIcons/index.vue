<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :width="width"
    :height="height"
    :viewBox="`0 0 ${width} ${height}`"
    :aria-labelledby="iconName"
    role="presentation"
    fill="none"
  >
    <title
      :id="iconName"
      lang="en"
    >{{ iconName }}</title>
    <!-- <g :fill="iconColor">
      <slot />
    </g>-->
    <component
      :is="componentName"
      :color="iconColor"
    />
  </svg>
</template>

<script>
import camelCase from 'lodash/camelCase';
import Home from './Home';
import Notification from './Notification';
export default {
  components: {
    Home,
    Notification
  },
  props: {
    iconName: {
      type: String,
      default: 'box'
    },
    width: {
      type: [Number, String],
      default: 18
    },
    height: {
      type: [Number, String],
      default: 18
    },
    iconColor: {
      type: String,
      default: 'none'
    }
  },
  computed: {
    componentName() {
      return camelCase(this.iconName);
    }
  }
};
</script>