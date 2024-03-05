export default {
  setMembershipPackages(state, payload) {
    state.membershipPackages = payload;
    if (payload.length > 0) {
      state.selectMemberShip = payload[0].id;
    }
  },
  selectMemberShip(state, payload) {
    state.selectMemberShip = payload;
  },
  setStatus(state, payload) {
    state.membershipStatus = payload;
  },
  setIsSubscribed(state, payload) {
    state.isSubscribed = payload;
  },
  checkMemberShipActive(state, payload) {
    state.memberShipIsActive = payload;
  },
  activeMemberShipData(state, payload) {
    state.activeMemberShipData = payload;
  }
};
