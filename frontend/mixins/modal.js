export default {
  data: () => ({
    showModal: false
  }),
  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
  }
};
