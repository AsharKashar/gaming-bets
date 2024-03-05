const About = () => import('Pages/About/About');

export default [
  {
    path: '/about',
    name: 'about',
    component: About,
    meta: {
      permission: 'guest',
      fail: '/404.html',
    },
  }
];
