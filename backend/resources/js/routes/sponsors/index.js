const Sponsors = () => import('Pages/Sponsors/Sponsors');

export default [
  {
    path: '/sponsors',
    name: 'sponsors',
    component: Sponsors,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
