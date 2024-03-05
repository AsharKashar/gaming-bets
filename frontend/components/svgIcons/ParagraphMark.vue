<template>
  <svg
    width="8"
    height="100"
    viewBox="0 0 8 110"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M0 2.85922C0 1.07308 2.16323 0.182716 3.42054 1.45136L7.42054 5.48739C7.79174 5.86194 8 6.36792 8 6.89525V101.105C8 101.632 7.79174 102.138 7.42054 102.513L3.42054 106.549C2.16323 107.817 0 106.927 0 105.141V2.85922Z"
      :fill="iconColor"
    />
  </svg>
</template>

<script>
export default {
  name: 'ParagraphMark',
  props: {
    iconColor: {
      type: String,
      default: '#BE1338'
    }
  }
};
</script>