<template>
  <svg
    width="17"
    height="56"
    viewBox="0 0 17 56"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      opacity="0.2"
      d="M16 0H17L1 56H0L16 0Z"
      fill="#E7E7E7"
    />
  </svg>
</template>

<script>
export default {
  name: 'FrowordBar',
  props: {
    color: {
      type: String,
      default: '#BE1338'
    }
  }
};
</script>