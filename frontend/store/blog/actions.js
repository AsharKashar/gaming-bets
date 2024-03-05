import get from 'lodash/get';
import snakeCase from 'lodash/snakeCase';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  async getBlogCategories({commit}) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('blog/categories');
      const categories = get(response, 'data.data', []);
      commit('setCategories', {
        categories
      });
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getBlogCategoryDetail({commit}, { categorySlug }) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get(`blog/${categorySlug}`);
      const categoryItem = get(response, 'data.data', []);
      commit('setCategoryItem', {
        categoryItem
      });
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getBlogPost({commit}, { categorySlug, postSlug }) {
    try {
      commit('setPostItem', { postItem:{} });
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get(`blog/${categorySlug}/${postSlug}`);
      const postItem = get(response, 'data.data', []);
      commit('setPostItem', {
        postItem
      });
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getPreviewPost({commit}, { postId, locale }) {
    try {
      commit('setPostItem', { postItem:{} });
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get(`preview/news/${postId}`,{
        headers: { locale },
      });
      const postItem = get(response, 'data.data', []);
      commit('setPostItem', {
        postItem
      });
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getLatestPosts({dispatch}, params) {
    const postsParams = {
      ...params,
      orderBy: 'updated_at',
      orderDirection: 'desc',
    };
    await dispatch('getPosts', { params:postsParams, commit:'setLatestPosts' });
  },
  async getPosts(ctx, { params, commit }) {
    const snakeCaseParams = {};
    Object.keys(params).map(param => {
      snakeCaseParams[snakeCase(param)] = params[param];
    });

    ctx.commit('setPostsStatus', STATE_STATUSES.PENDING);

    try {
      const response = await this.$bangerApi.get('blog/posts', {
        params: snakeCaseParams
      });
      const posts = get(response, 'data.data', []);
      ctx.commit(commit, {posts});
    } catch (e) {
      console.log(e);
    }

    ctx.commit('setPostsStatus', STATE_STATUSES.READY);
  },
  async subscribeEmail(ctx, email) {
    return  await this.$bangerApi.post('blog/subscribe', {
      email
    });
  },
  async getPostsForCategoryGrid({ state, dispatch },customProps = {}) {
    const { latestPosts } = state;
    const exclude = latestPosts.data.map(item => item.id);

    await dispatch('getPosts', {
      params: {
        perPage: 7,
        ...customProps,
        exclude
      },
      commit: 'setCategoryPosts'
    });
  }
};
