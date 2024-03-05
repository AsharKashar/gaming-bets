<template>
  <svg
    width="14"
    height="24"
    viewBox="0 0 14 24"
    fill="none"
  >
    <path
      d="M14 10.2858L0.285714 20.5715V24.0001L14 13.7143V10.2858Z"
      :fill="iconFill"
    />
    <path
      d="M0.285645 0L13.9999 10.2857V13.7143L0.285645 3.42857V0Z"
      :fill="iconFill"
    />
  </svg>
</template>

<script>
export default {
  name: 'Arrow',
  props: {
    iconFill: {
      type: String,
      default: '#BE1338'
    }
  }
};
</script>