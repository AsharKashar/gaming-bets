<template>
  <div>
    <loader
      :loading="loading"
      class="blog-post-container"
    >
      <blog-post-content
        v-if="postItem.content_detail"
        :post-item="postItem"
      />
    </loader>
  </div>
</template>

<script>
import BlogPostContent from '@/components/BlogPostContent';
import Loader from '@/components/Loader';

import {createNamespacedHelpers} from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const { mapActions, mapState } = createNamespacedHelpers('blog');

export default {
  name: 'PreviewBlogPost',
  components: {Loader, BlogPostContent},
  computed: {
    ...mapState(['postItem', 'status']),
    loading () {
      return this.status === STATE_STATUSES.PENDING;
    },
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    ...mapActions([
      'getPreviewPost',
    ]),
    fetchData(){
      this.getPreviewPost({ ...this.$route.query });
    }
  },
};
</script>

<style scoped>

</style>
