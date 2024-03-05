import Vue from 'vue';
import GlobalOptions from './components/global-options/';
import GameRules from './components/game-rules/';
import TournamentOptions from './components/tournament-options/';
import EvidenceFiles from './components/evidence-files/';
import MatchTeamEditable from './components/match-teams-editable/';

Vue.component('global-options', GlobalOptions);
Vue.component('game-rules', GameRules);
Vue.component('tournament-options', TournamentOptions);
Vue.component('evidence-files', EvidenceFiles);
Vue.component('match-teams-editable', MatchTeamEditable);
