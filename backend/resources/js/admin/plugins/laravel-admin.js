// eslint-disable-next-line no-undef
$(document).on('pjax:beforeReplace',  (e) => {
  const freshPaths = [
    'global-options',
    'games',
    'tournaments\\/[0-9]\\d{0,9}\\/edit',
    'evidence\\/[0-9]\\d{0,9}\\/edit',
    'matches\\/[0-9]\\d{0,9}\\/edit'
  ];
  freshPaths.forEach((page) => {
    const path = new RegExp(`\\/admin.*\\/${page}`);
    if (path.test(e.state.url)) {
      location.reload();
      return false;
    }
  });
});
