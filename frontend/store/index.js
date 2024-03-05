import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import blog from './blog';
import game from './game';
import team from './team';
import profile from './profile';
import bombs from './bombs';
import membership from './membership';
import tournament from './tournament';
import faq from './faq';
import bangerAnimation from './bangerAnimation';
import modal from './modal';
import notifications from './notifications';
import payments from './payments';
import matches from './matches';
import country from './country';
import layout from './layout';

Vue.use(Vuex);

export const createStore = () => {
  return new Vuex.Store({
    auth,
    blog,
    game,
    team,
    profile,
    bombs,
    membership,
    bangerAnimation,
    tournament,
    modal,
    faq,
    notifications,
    payments,
    matches,
    country,
    layout
  });
};
