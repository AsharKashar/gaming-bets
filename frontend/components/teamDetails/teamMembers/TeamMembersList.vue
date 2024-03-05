<template>
  <v-row class="team-members__list">
    <team-members-item
      v-for="member in members"
      :key="member.id"
      :member="member"
    />
  </v-row>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
import TeamMembersItem from './TeamMembersItem';
const { mapState } = createNamespacedHelpers('team');
export default {
  name: 'TeamMembersList',
  components: {TeamMembersItem},
  computed: {
    ...mapState({
      members: ({activeTeam}) => activeTeam.members,
    }),
  },
};
</script>

<style scoped>

</style>
