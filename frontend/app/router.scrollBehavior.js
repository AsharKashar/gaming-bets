export default (to) => {
  let savePosition = false;
  if (to.params.savePosition !== undefined) {
    savePosition = to.params.savePosition;
  } else if (to.meta.savePosition) {
    savePosition = to.meta.savePosition;
  }

  if (!savePosition) {
    window.scrollTo({
      top:0,
      left:0,
      behavior:'smooth'
    });
  }
};
