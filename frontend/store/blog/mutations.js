export default {
  setCategories(state, payload) {
    state.categories = payload.categories;
  },
  setCategoryItem(state, payload) {
    state.categoryItem = payload.categoryItem;
  },
  setStatus(state, status){
    state.status = status;
  },
  setPostsStatus(state, status) {
    state.postsStatus = status;
  },
  setPostItem(state, payload) {
    const initialItem = {
      main_category:{}
    };

    state.postItem = { ...initialItem, ...payload.postItem };
  },
  setLatestPosts(state, payload) {
    state.latestPosts = payload.posts;
  },
  setCategoryPosts(state, payload) {
    state.categoryPosts = payload.posts;
  }
};
