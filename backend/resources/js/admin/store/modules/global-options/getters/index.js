export default {
  filterType(state) {
    const excludeType = state.options.map(el => el.type);
    return state.types.filter(({type}) => excludeType.indexOf(type) < 0);
  },
};
