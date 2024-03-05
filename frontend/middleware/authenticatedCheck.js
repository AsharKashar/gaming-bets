export default async ({ store, redirect, app }) => {
  if (!store.state.auth.isAuthenticated) {
    return redirect(app.localeRoute('/'));
  }
};
