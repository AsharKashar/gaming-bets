const ProfileIndex = () => import('Pages/Profile/Profile');
const ProfilePayment = () => import('Pages/Profile/Payment');
const ProfileTournament = () => import('Pages/Profile/Tournament');
const ProfileCash = () => import('Pages/Profile/Cash');
const ProfileWithdrawal = () => import('Pages/Profile/Withdrawal');

export default [
  /* Front End Routes */
  {
    path: '/profile',
    component: ProfileIndex,
    name: 'profile',
    meta: {
      permission: 'guest',
      fail: '/404.html'
    }
  },
  {
    path: '/profile/payment',
    component: ProfilePayment,
    name: 'profile-payment',
    meta: {
      permission: 'guest',
      fail: '/404.html'
    }
  },
  {
    path: '/profile/tournament',
    component: ProfileTournament,
    name: 'profile-tournament',
    meta: {
      permission: 'guest',
      fail: '/404.html'
    }
  },
  {
    path: '/profile/cash',
    component: ProfileCash,
    name: 'profile-cash',
    meta: {
      permission: 'guest',
      fail: '/404.html'
    }
  },
  {
    path: '/profile/withdrawal',
    component: ProfileWithdrawal,
    name: 'profile-withdrawal',
    meta: {
      permission: "guest",
      fail: "/404.html"
    }
  },
  {
    path: "/profile/profileTeams",
    component: profileTeams,
    name: "profile-teams",
    meta: {
      permission: "guest",
      fail: "/404.html"
    }
  },
  {
    path: "/profile/changePassword",
    component: changePassword,
    name: "profile-changePassword",
    meta: {
      permission: "guest",
      fail: "/404.html"
      permission: 'guest',
      fail: '/404.html'
    }
  }
];
