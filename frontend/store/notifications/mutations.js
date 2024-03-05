export default {
  setNotifications(state, payload) {
    state.notifications = payload;
  },
  setNotificationsList(state, payload) {
    state.notificationsList = payload;
  },
  setFilters(state, payload) {
    state.availableFilters = payload;
  },
  setStatus(state, payload) {
    state.status = payload;
  },
};
