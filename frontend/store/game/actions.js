import { STATE_STATUSES } from 'helpers/constants';
import get from 'lodash/get';


export default {
  async getCurrentGame({commit}, gameId) {
    try {
      await commit('setGamesStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('games/'+ gameId);
      await commit('setCurrentGame', get(response, 'data.data', []));
    } catch (e) {
      await commit('setGamesStatus', STATE_STATUSES.ERROR);
      console.log(e);
    } finally {
      await commit('setGamesStatus', STATE_STATUSES.READY);
    }
  },
  async getGames({commit}, data = { params: {}, commitName: 'setGames'}) {
    try {
      commit('setGamesStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('games', {params: data.params});
      const games  = get(response, 'data.data', []);
      commit(data.commitName, games);
      commit('setGamesStatus', STATE_STATUSES.READY);
      return games;
    } catch (e) {
      commit('setGamesStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
};
