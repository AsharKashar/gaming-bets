<template>
  <div class="team-members__heading">
    <div class="team-members__heading-inner">
      <div class="main-heading">
        {{ $t('Team Members') }} {{ activeTeam.members.length }}/{{ activeTeam.sizes.size }}
      </div>
      <button class="default-banger-btn" />
      <default-button
        v-if="activeTeam.members.length < activeTeam.sizes.size"
        class="outline-banger-btn default-banger-btn--sm"
        @click.native="openModal"
      >
        {{ $t('Add Member') }} +
      </default-button>
    </div>
    <default-modal
      persistent
      invisible-scrollbar
      secondery-modal
      :show="showModal"
      :close-modal="closeModal"
    >
      <add-member-in-team-form
        :team="activeTeam"
        @formSend="closeModal"
      />
    </default-modal>
  </div>
</template>

<script>
import DefaultButton from '../../DefaultButton';
import DefaultModal from 'components/modals/DefaultModal';
import AddMemberInTeamForm from 'components/forms/AddMemberInTeamForm';

import mixinModal from '@/mixins/modal';
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('team');

export default {
  name: 'TeamMembersHeading',
  components: {
    DefaultButton,
    DefaultModal,
    AddMemberInTeamForm,
  },
  mixins: [mixinModal],
  computed: mapState(['activeTeam']),
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
.team-members__heading {
  &-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
  }
}

@media only screen and (max-width: $mobile-width) {
  .team-members__heading {
    &-inner {
      .main-heading {
        font-size: 24px !important;
      }
    }
  }
}
</style>
