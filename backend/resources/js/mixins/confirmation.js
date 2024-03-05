export default {
  methods: {
    confirmed(cb) {
      return params => {
        cb(params);
      };
    },
    openDialog(item) {
      window.Bus.$emit('open-confirmation', item);
    }
  }
};
