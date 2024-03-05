export default {
  rules: {
    type: Object,
    required: true,
  },
  load: {
    type: Boolean,
    required: false,
  },
  propsFormData: {
    type: Object,
    default: () => ({})
  },
  errors: {
    type: Object,
    default: () => ({})
  }
};
