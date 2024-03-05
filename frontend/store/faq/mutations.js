export default {
  setFaqs(state, payload) {
    state.faqs = payload.faqs;
  },
  setFaqStatus(state, payload) {
    state.faqStatus = payload;
  },
  setCategoryDetails(state, payload) {
    state.categoryDetails = payload;
  },
  setFaqSearched(state, payload) {
    state.faqSearched = payload;
  },
  setAllCategories(state, payload) {
    state.allCategories = payload;
  }
};
