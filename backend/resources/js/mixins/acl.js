export default {
  methods: {
    isLoggedIn () {
      return !!this.$store.state.auth.isAuthenticated;
    },
    can (permission) {
      return this.$store.getters['auth/getMe'].can[permission];
    },
  },
};
