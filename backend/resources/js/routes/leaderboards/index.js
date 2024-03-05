const Leaderboards = () => import('Pages/Leaderboards/Leaderboards');

export default [
  {
    path: '/leaderboards',
    name: 'leaderboards',
    component: Leaderboards,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
