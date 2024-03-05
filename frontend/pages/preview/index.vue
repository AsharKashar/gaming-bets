<script>
import PreviewBlogPost from 'components/PreviewBlogPost';
import {APP_URL} from 'configs/config';

export default {
  name: 'Preview',
  head() {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Preview',
      link: [
        {
          rel: 'canonical',
          href: route
        },
      ],
    };
  },
  render (h) {
    const { query } = this.$route;
    if (!query) return this.$router.push('/');
    switch (query.page) {
      case 'news':
        return h(PreviewBlogPost);
      default:
        return null;
    }
  },
};
</script>
