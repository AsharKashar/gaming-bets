<template>
  <div class="register-info__action">
    <default-button
      v-if="currentBoxFight.remarks !== matchState.RESULT_REQUIRED"
      class="d-block"
      :disabled="joinMatchState.disabled"
      @click.native="joinMatchState.action(currentBoxFight.id)"
    >
      {{ joinMatchState.title }}
    </default-button>

    <div v-else>
      <default-button
        class="d-block mb-4"
        @click.native="joinMatchState.action(currentBoxFight.id, 'won')"
      >
        {{ $t('I Won') }}
      </default-button>
      <default-button
        class="d-block btn-lost"
        @click.native="joinMatchState.action(currentBoxFight.id, 'lost')"
      >
        {{ $t('I lost') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
const boxfightModule = createNamespacedHelpers('boxfight');
import mixinsTournament from '@/mixins/openTournament';
import { JOINING_MATCH_STATES } from 'helpers/constants';

export default {
  name: 'BoxFightAction',
  components: {
    DefaultButton,
  },
  mixins: [mixinsTournament],
  computed: {
    ...boxfightModule.mapState(['currentBoxFight']),
    matchState() {
      return JOINING_MATCH_STATES;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
.d-block {
  width: 100%;
  display: block;
  margin: 10px 0;

  &.btn-lost {
    background: transparent;
    border: 1px solid $text-secondary-color;
    color: $text-secondary-color;
    font-weight: 900;
  }
}
</style>
