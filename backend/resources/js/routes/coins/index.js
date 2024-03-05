const Coins = () => import('Pages/Coins/Coins');

export default [
  {
    path: '/coins',
    name: 'coins',
    component: Coins,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
