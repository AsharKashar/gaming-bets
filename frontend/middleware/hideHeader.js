export default async ({store}) => {
  store.commit('layout/setLayoutProps', {showHeader:false});
};
