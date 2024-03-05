<template>
  <v-form
    ref="form"
    class="evidence-form"
    @submit.prevent="onSubmit"
  >
    <component
      :is="currentStepComponent"
      :rules="rules"
      :load="loading"
      :errors="allErrors"
      :props-form-data="formData"
      @setStep="setStep"
      @setError="setErrors($event)"
      @setData="setDataForm($event)"
      @nextStep="nextStep($event)"
    />
  </v-form>
</template>

<script>
import mixinForm from '@/mixins/mixinForm';
import steps from './evidence-upload-steps';
import get from 'lodash/get';
import {createNamespacedHelpers} from 'vuex';

const matchesModule = createNamespacedHelpers('matches');
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'EvidenceUpload',
  components: {
    ...steps,
  },
  mixins: [mixinForm],
  computed: modalModule.mapState({
    matchId: ({commonData}) => get(commonData, 'evidence.matchId', null),
  }),
  methods: {
    ...matchesModule.mapActions(['uploadEvidence', 'getMatches']),
    async onSubmit() {
      if (this.isError() || this.loading) {
        return;
      }
      this.loading = true;
      try {
        if (await this.uploadEvidence({matchId: this.matchId, data: this.formData})) {
          const { tournamentId, matchesType } = this.$route.params;
          await this.getMatches({tournamentId, params: { matchesType } });
          this.setStep(3);
        }
      } finally {
        this.loading = false;
      }
    },
  }
};
</script>

<style lang="scss" scoped>


</style>
