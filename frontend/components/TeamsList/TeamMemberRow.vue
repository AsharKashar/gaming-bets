<template>
  <div class="team-member">
    <div class="member-rank">
      <img
        src="~/static/demo/rank.svg"
        alt="computer"
      >
    </div>
    <div
      class="member-avatar"
      :style="{'background-image': `url(${member.avatar_url})`}"
    />
    <div class="name">
      {{ member.name }}
    </div>
    <div
      v-if="!dotMenuOpen"
      class="actions"
    >
      <div
        v-if="currentUserCanManageMembers"
        @click="dotMenuOpen = true"
      >
        <dots
          v-if="!member.pivot.is_leader"
        />
      </div>
      <crown v-if="member.pivot.is_leader" />
    </div>
    <div
      v-if="dotMenuOpen"
      class="actions actions-menu"
    >
      <div
        class="cancel-action"
        @click="dotMenuOpen = false"
      >
        {{ $t('cancel') }}
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
        :question="'Delete memeber ' + member.name + ' from team ?'"
        :on-cancel="closeConfirmModal"
        :on-confirm="detachMember"
      />
    </default-modal>
  </div>
</template>

<script>
import teamMemberInvitedRow from '@/mixins/teamMemberInvitedRow';
import { createNamespacedHelpers } from 'vuex';
const teamModule = createNamespacedHelpers('team');
const authModule = createNamespacedHelpers('auth');

export default {
  name: 'TeamMember',
  mixins: [teamMemberInvitedRow],
  props: {
    member: {
      type: Object,
      default: () => ({})
    },
    team: {
      type: Object,
      default: () => ({})
    }
  },
  computed:{
    ...authModule.mapState(['user']),
    currentUserCanManageMembers(){
      const isOwner = this.team.owner_id === this.user.id;
      const currentUserInTeam = this.team.members.find(member => member.id === this.user.id);
      const isLeader = currentUserInTeam.pivot.is_leader;

      return isOwner || isLeader;
    }
  },
  methods:{
    ...teamModule.mapActions([
      'deleteMember'
    ]),
    detachMember(){
      this.dotMenuOpen = false;
      const { user_id, team_id } = this.member.pivot;
      this.deleteMember({ user_id, team_id });
    },
  }
};
</script>

<style scoped lang="scss" src="./css/TeamMemberRow.scss"/>
