<template>
  <svg
    width="30"
    height="30"
    viewBox="0 0 30 30"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M28.3327 28.3333L20.1597 20.1603M20.1597 20.1603C22.1201 18.1998 23.3327 15.4915 23.3327 12.5C23.3327 6.51687 18.4824 1.66663 12.4993 1.66663C6.51626 1.66663 1.66602 6.51687 1.66602 12.5C1.66602 18.483 6.51626 23.3333 12.4993 23.3333C15.4909 23.3333 18.1992 22.1207 20.1597 20.1603Z"
      :stroke="color"
      stroke-width="1.8"
      stroke-linecap="round"
      stroke-linejoin="round"
    />
  </svg>
</template>

<script>
export default {
  name: 'Search',
  props: {
    color: {
      type: String,
      default: '#BE1338'
    }
  }
};
</script>