export default async ({ route, $bangerApi, redirect }) => {
  const { forceUserToken } = route.query;

  if (forceUserToken) {
    $bangerApi.saveToken(forceUserToken);
    return redirect('/');
  }
};
