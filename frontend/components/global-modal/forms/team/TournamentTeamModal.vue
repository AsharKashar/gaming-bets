<template>
  <loader
    height="60vh"
    :center="true"
    :loading="loading"
    :overlay="false"
  >
    <component
      :is="currentStep"
      @setStep="setStep($event)"
    />
  </loader>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import Loader from 'components/Loader';
import SelectedTeam from './SelectedTeam';
import CreateTeam from './CreateTeam';
const { mapState, mapActions, mapMutations } = createNamespacedHelpers('tournament');

export default {
  name: 'TournamentTeamModal',
  components: { CreateTeam, SelectedTeam, Loader },
  data: () => ({
    currentStep: 'CreateTeam',
    loading: false,
  }),
  computed: {
    ...mapState(['currentUserTeamsTournament']),
  },
  mounted() {
    this.innitModal();
  },
  beforeDestroy() {
    this.setCurrentUserTeamsTournament([]);
  },
  methods: {
    ...mapMutations(['setCurrentUserTeamsTournament']),
    ...mapActions(['getCurrentUserTeamsTournament']),
    setStep(nameSteps) {
      this.currentStep = nameSteps;
    },
    async innitModal() {
      this.loading = true;
      try {
        await this.getCurrentUserTeamsTournament();
      } finally {
        this.loading = false;
      }
      if (this.currentUserTeamsTournament.data.length) {
        this.setStep('SelectedTeam');
        return;
      }
      this.setStep('CreateTeam');
    }
  }
};
</script>
