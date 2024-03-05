<template>
  <default-modal
    :show="showModal"
    :close-modal="closeModal"
    minwidth="504"
    persistent
    :secondery-modal="true"
  >
    <ResultConfirmation
      v-if="showMatchResultModal === 'lost'"
      :title="$t('Match Lost Better Luck, Next Time')"
      coins="-10"
      :hide-banger="true"
      @finish="closeModal"
    />

    <ResultConfirmation
      v-else-if="showMatchResultModal === 'won'"
      :title="$t('Congratulations you won!')"
      coins="+10"
      xp="+100"
      @finish="closeModal"
    />
  </default-modal>
</template>

<script>
import DefaultModal from 'components/modals/DefaultModal';
import ResultConfirmation from '../confirmation/Confirmation';
import { createNamespacedHelpers } from 'vuex';
const { mapState, mapMutations } = createNamespacedHelpers('tournament');
export default {
  components: {
    DefaultModal,
    ResultConfirmation
  },
  computed: {
    ...mapState(['showMatchResultModal']),
    showModal() {
      return this.showMatchResultModal !== null;
    }
  },
  methods: {
    ...mapMutations(['setShowMatchResultModal']),
    closeModal() {
      this.setShowMatchResultModal(null);
    }
  }
};
</script>

<style lang="scss" scoped></style>
