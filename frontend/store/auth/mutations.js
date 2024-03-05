import get from 'lodash/get';

export default {
  setMe(state, payload) {
    state.isAuthenticated = payload.isAuthenticated;
    state.user = payload.user;
  },
  setCallbackOAuthStatus(state, payload) {
    state.callbackOAuthStatus = payload;
  },
  setAuthenticated(state, payload) {
    state.isAuthenticated = payload;
  },
  setCheckStatus(state, payload) {
    state.checkStatus = payload;
  },
  increaseUnreadNotifications(state) {
    const currentCount = get(state, 'user.unread_notifications_count', 0);
    state.user = {
      ...state.user,
      unread_notifications_count: currentCount+1
    };
  },
  updateUserBombs(state , payload){
    return state.user.all_bombs = payload;
  }
};
