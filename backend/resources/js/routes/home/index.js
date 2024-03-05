const Home = () => import('Pages/Home/Home.vue');

export default [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  },
];
