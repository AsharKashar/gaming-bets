<template>
  <default-button
    v-if="!isBoxFight"
    :disabled="joinBtn.disabled"
    :class="joinBtn.class"
    @click.native="openJoinTournamentWizard(item)"
  >
    <span
      class="inner-btn-dynamic"
      v-html="joinBtn.text"
    />
  </default-button>
  <default-button
    v-else
    :disabled="joinMatchState.disabled"
    @click.native="joinMatchState.action(item.id)"
  >
    {{ joinMatchState.title }}
  </default-button>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import tournamentMixin from '@/mixins/tournamentMixin';
import boxFightMixin from '@/mixins/openTournament';

export default {
  name: 'TournamentAction',
  components: { DefaultButton },
  mixins: [tournamentMixin, boxFightMixin],
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  computed: {
    joinBtn() {
      return this.actionButtonText(this.item);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
