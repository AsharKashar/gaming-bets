<template>
  <div class="team-member team-member--invited">
    <div class="member-rank">
      <img
        src="~/static/demo/rank.svg"
        alt="computer"
      >
    </div>
    <div
      class="name"
      v-text="invitedUser.email"
    />
    <div class="status">
      {{ $t('Invited') }}
    </div>
    <div
      v-if="!dotMenuOpen"
      class="actions"
    >
      <div @click="dotMenuOpen = true">
        <dots />
      </div>
    </div>
    <div
      v-else
      class="actions actions-menu"
    >
      <div
        class="cancel-action"
        @click="dotMenuOpen = false"
      >
        {{ $t('Cancel') }}
      </div>
      <div @click="showConfirmModal=true">
        <cross />
      </div>
    </div>
    <default-modal
      :show="showConfirmModal"
      :close-modal="closeConfirmModal"
    >
      <confirm-form
        :question="'Delete invitation for ' + invitedUser.email"
        :on-cancel="closeConfirmModal"
        :on-confirm="detachInvite"
      />
    </default-modal>
  </div>
</template>

<script>
import teamMemberInvitedRow from '@/mixins/teamMemberInvitedRow';
import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('team');

export default {
  name: 'TeamInvitedUserRow',
  mixins: [teamMemberInvitedRow],
  props: {
    invitedUser: {
      type: Object,
      required: true
    },
  },
  methods:{
    ...mapActions([
      'deleteInvite'
    ]),
    detachInvite(){
      this.dotMenuOpen = false;
      this.deleteInvite(this.invitedUser.id);
    },
  }
};
</script>

<style scoped lang="scss" src="./css/TeamMemberRow.scss"/>
