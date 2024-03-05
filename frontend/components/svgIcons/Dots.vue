<template>
  <svg
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <circle
      cx="12"
      cy="5"
      r="2"
      :fill="fill"
    />
    <circle
      cx="12"
      cy="12"
      r="2"
      :fill="fill"
    />
    <circle
      cx="12"
      cy="19"
      r="2"
      :fill="fill"
    />
  </svg>
</template>

<script>
export default {
  name: 'Dots',
  props: {
    fill: {
      type: String,
      default: '#BE1338',
    }
  }
};
</script>
