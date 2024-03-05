const Game = () => import('Pages/Game/Game');
const CallOfDuty = () => import('Pages/Game/CallOfDuty');
const Fortnite = () => import('Pages/Game/Fortnite');
const CSGo = () => import('Pages/Game/CSGo');

export default [
  {
    path: '/game',
    name: 'game',
    component: Game,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  },
  {
    path: '/game/call-of-duty',
    name: 'game-call-of-duty',
    component: CallOfDuty,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  },
  {
    path: '/game/fortnite',
    name: 'game-fortnite',
    component: Fortnite,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  },
  {
    path: '/game/cs-go',
    name: 'game-cs-go',
    component: CSGo,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
