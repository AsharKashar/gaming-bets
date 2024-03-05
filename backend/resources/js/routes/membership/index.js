const Membership = () => import('Pages/Membership/Membership');

export default [
  {
    path: '/membership',
    name: 'membership',
    component: Membership,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
