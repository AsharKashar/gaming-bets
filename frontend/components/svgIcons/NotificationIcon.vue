<template>
  <!-- <div>
  {{$attrs}}

  </div>-->
  <svg
    width="50"
    height="40"
    viewBox="0 0 40 40"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      opacity="0.5"
      d="M14.6127 28.694C14.6127 30.796 16.3167 32.5 18.4186 32.5C20.5206 32.5 22.2246 30.796 22.2246 28.694"
      :stroke="$attrs.color"
      stroke-width="2"
    />
    <path
      d="M26.8022 18.7551C26.8022 14.8482 25.7888 12.1018 24.2727 10.3438C22.7643 8.59473 20.6967 7.75031 18.4179 7.75031C16.1391 7.75031 14.0715 8.59473 12.5632 10.3438C11.0471 12.1018 10.0336 14.8482 10.0336 18.7551C10.0336 19.9053 9.61209 20.9183 9.18614 21.9421C9.14144 22.0495 9.0967 22.157 9.05238 22.2649C8.57332 23.4306 8.0579 24.7962 7.84742 26.7764C7.78363 27.3766 8.2837 27.9443 9 27.9443H27.8358C28.5571 27.9443 29.0395 27.3758 28.9633 26.7962C28.7344 25.0533 28.224 23.6712 27.7475 22.416C27.7261 22.3597 27.7047 22.3034 27.6833 22.2471C27.2418 21.0871 26.8022 19.9319 26.8022 18.7551Z"
      :stroke="$attrs.color"
      stroke-width="1.5"
    />

    <circle
      v-if="$attrs.hasNotification"
      cx="28.3133"
      cy="27.9324"
      r="5.31716"
      :fill="$attrs.color"
      :stroke="$attrs.color"
      stroke-width="1.5"
    />
  </svg>
</template>


<script>
export default {
  name: 'NotificationIcon',
  props: {
    color: {
      type: String,
      default: '#BE1338',
    },
    hasNotification: {
      type: Boolean,
      default: false,
    },
  },
};
