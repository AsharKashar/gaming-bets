export default async ({ store }) => {
  await store.dispatch('auth/checkAuth');
  store.commit('layout/setLayoutProps');
};
