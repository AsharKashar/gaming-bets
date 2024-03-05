<template>
  <div
    v-if="links.length"
    class="links-list"
  >
    <div
      v-if="title"
      class="links-list__heading heading"
      v-text="$t(title)"
    />
    <links-item
      v-for="(item, i) in links"
      :key="i"
      :link="item.link"
      :title="item.title"
      :type="item.type"
    />
  </div>
</template>

<script>
import LinksItem from 'components/list/items/LinksItem';
export default {
  name: 'LinksList',
  components: {LinksItem},
  props: {
    title: {
      type: String,
      default: undefined,
    },
    links: {
      type: Array,
      required: true,
    }
  }
};
</script>
