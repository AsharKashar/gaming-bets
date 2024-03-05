<template>
  <div class="team-card">
    <div
      class="team-header"
      @click="openTeamDetails"
    >
      <div
        class="team-avatar"
        :style="{'background-image': `url(${team.avatar_url})`}"
      />
      <div class="team-titles">
        <v-clamp
          autoresize
          :max-lines="2"
          class="team-title"
        >
          {{ team.name }}
        </v-clamp>
        <div
          v-if="teamLength < team.sizes.size"
          class="add-member"
          @click.stop="openModal"
        >
          <div class="add-text">
            {{ $t('Add Member') }}
          </div>
          <plus />
        </div>
        <div
          v-else-if="team.invitations.length"
          class="copy-link add-member"
          @click.stop="copyInvitationLink"
        >
          {{ $t('Copy invite link') }}
        </div>
      </div>
      <div class="members-count">
        {{ teamLength }}/{{ team.sizes.size }}
      </div>
    </div>
    <div class="team-members">
      <team-member-row
        v-for="(member,i) in team.members"
        :key="i"
        :member="member"
        :team="team"
      />
      <template v-if="team.invitations.length">
        <team-invited-user-row
          v-for="invitedUser in team.invitations"
          :key="invitedUser.email"
          :invited-user="invitedUser"
        />
      </template>
    </div>
    <default-modal
      persistent
      invisible-scrollbar
      secondery-modal
      :show="showModal"
      :close-modal="closeModal"
    >
      <add-member-in-team-form :team="team" />
    </default-modal>
  </div>
</template>

<script>
import Plus from 'components/svgIcons/Plus';
import TeamMemberRow from './TeamMemberRow';
import DefaultModal from 'components/modals/DefaultModal';
import AddMemberInTeamForm from 'components/forms/AddMemberInTeamForm';
import VClamp from 'vue-clamp';
import TeamInvitedUserRow from './TeamInvitedUserRow';
import mixinModal from '@/mixins/modal';
import minxInviteLink from '@/mixins/inviteLink';

import { createNamespacedHelpers } from 'vuex';
const { mapMutations } = createNamespacedHelpers('team');

export default {
  name: 'TeamCard',
  components: {
    Plus,
    DefaultModal,
    TeamMemberRow,
    AddMemberInTeamForm,
    VClamp,
    TeamInvitedUserRow,
  },
  mixins: [mixinModal, minxInviteLink],
  props: {
    team: {
      type: Object,
      default: () => ({}),
    },
  },
  computed: {
    teamLength() {
      return this.team.invitations.length + this.team.members.length;
    }
  },
  methods: {
    ...mapMutations(['setActiveTeam']),
    openTeamDetails() {
      const teamId = this.team.team_id;
      this.$router.push({
        query: {
          ...this.$route.query,
          teamId,
        },
      });
      this.setActiveTeam(teamId);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.team-card {
  flex-basis: 48.5%;
  margin-bottom: 16px;
  min-width: 330px;
}

.team-header {
  display: flex;
  background: rgba(161, 175, 211, 0.1);
  height: 85px;
  border-bottom: 2px solid $border-primary-color;
  padding: 0 13px;
  justify-content: space-between;
  align-items: center;

  .team-avatar {
    height: 54px;
    width: 54px;
    border: 2px solid $text-primary-color;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 50%;
  }

  .team-titles {
    flex-basis: 57%;
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;

    .add-member {
      display: flex;
      align-items: center;
      font-size: 16px;
      line-height: 94%;
      color: $button-primary-background;
      margin-top: 7px;
      cursor: pointer;

      .add-text {
        font-size: 12px;
        margin-right: 10px;
      }

      svg {
        height: 12px;
        width: 12px;
      }
    }

    .team-title {
      font-size: 15px;
      line-height: 100%;
      display: block;
      letter-spacing: 0.05em;
    }
  }

  .members-count {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 18px;
    line-height: 94%;
    display: flex;
    align-items: center;
    margin-bottom: 23px;
    flex-basis: 16%;
  }
}
.team-members {
  max-height: 215px;
  overflow-y: auto;
  clip-path: polygon(100% 0%, 100% 89%, 94% 100%, 0 100%, 0 0);

  .team-member {
    &:nth-child(even) {
      background: rgba(161, 175, 211, 0.2);
    }
    &:nth-child(odd) {
      background: rgba(161, 175, 211, 0.1);
    }
  }
}
</style>
