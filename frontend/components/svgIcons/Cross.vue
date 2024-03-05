<template>
  <svg
    width="35"
    height="35"
    viewBox="0 0 35 35"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M4 4L31 31"
      :stroke="color"
      :stroke-width="strokeWidth"
      stroke-linecap="round"
    />
    <path
      d="M31 4L4 31"
      :stroke="color"
      :stroke-width="strokeWidth"
      stroke-linecap="round"
    />
  </svg>
</template>

<script>
export default {
  name: 'Cross',
  props: {
    color: {
      type: String,
      default: '#BE1338',
    },
    strokeWidth: {
      type: String,
      default: '8',
    },
  },
};
</script>