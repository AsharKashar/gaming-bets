import formRules from 'helpers/formRules';

export default {
  data: () => ({
    rules: formRules,
    loading: false,
    allErrors: {},
    formData: {},
    form: null,
    isFormValid: false,
    currentStep: 1,
    prefixStep: 'Step'
  }),
  computed: {
    currentStepComponent() {
      return this.prefixStep + this.currentStep;
    }
  },
  methods: {
    nextStep(data) {
      if (this.form.validate()) {
        this.setDataForm(data);
        this.currentStep+=1;
      }
    },
    setStep(step) {
      this.setDataForm();
      this.currentStep = step;
    },
    setDataForm(data) {
      const setFormData = (name, value) => this.$set(this.formData, name, value);
      if(data) {
        Object.keys(data).map((key) => setFormData(key, data[key]));
      }
      this.form.inputs.map((el) => {
        const name = el.$attrs.name;
        if (!name) return;
        setFormData(name, el.lazyValue);
      });
    },
    setErrors({name, error}) {
      if (error) {
        this.$set(this.allErrors, name, error);
      } else {
        this.$delete(this.allErrors, name);
      }
    },
    isError() {
      return !this.form.validate() || Object.keys(this.allErrors).length || this.loading;
    }
  },
  mounted() {
    this.form = this.$refs.form;
  }
};
