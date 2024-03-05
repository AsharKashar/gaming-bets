<template>
  <v-form
    ref="form"
    class="custom-forms"
    @submit.prevent="onSubmit"
  >
    <div class="form-heading modal-heading">
      <div class="modal-subtitle">
        {{ $t('Step') }} {{ currentStep }} of 2
      </div>
      <div class="modal-title">
        {{ $t('Sign up') }}
      </div>
    </div>

    <component
      :is="currentStepComponent"
      :rules="rules"
      :loading="loading"
      :errors="allErrors"
      :props-form-data="formData"
      @setError="setErrors($event)"
      @setData="setDataForm($event)"
      @nextStep="nextStep($event)"
    />
  </v-form>
</template>

<script>
import mixinForm from '@/mixins/mixinForm';
import step from './steps';
import { createNamespacedHelpers } from 'vuex';
import { get } from 'lodash';

const { mapActions } = createNamespacedHelpers('auth');
const moduleModal = createNamespacedHelpers('modal');

export default {
  name: 'SignUp',
  components: {
    ...step,
  },
  mixins: [mixinForm],
  computed: moduleModal.mapState(['modalOptions']),
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
    ...mapActions(['register']),
    async onSubmit() {
      if (this.isError() || this.loading) {
        return;
      }
      this.loading = true;
      try {
        const res = await this.register(this.formData);
        const errors = get(res, 'data.errors');
        if (errors) {
          this.currentStep = 1;
          Object.keys(errors).map((key) => {
            this.setErrors({name: key, error: errors[key]});
          });
          return;
        }

        const callback = get(this, 'modalOptions.callback', null);

        if (callback) {
          callback();
          return;
        }
        this.setActiveModal({});

      } finally {
        this.loading = false;
      }
    }
  }
};
</script>
<style lang="scss" scoped>
  @import '~/components/global-modal/forms/forms.scss';
  @import '~/components/global-modal/modal.scss';
</style>
