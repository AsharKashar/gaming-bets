<template>
  <nuxt-link
    :to="localeRoute({name: data.name, params: data.params})"
    class="tournament-nav__item"
  >
    <span class="tournament-nav__item-inner">
      <span
        class="tournament-nav__item-link"
        v-text="data.title"
      />
    </span>
  </nuxt-link>
</template>

<script>
export default {
  name: 'ChildLinks',
  props: {
    data: {
      type: Object,
      required: true,
    }
  },
};
</script>
