<template>
  <section class="team-members">
    <div class="team-members__inner">
      <team-members-heading />
      <team-members-list />
    </div>
  </section>
</template>

<script>

import TeamMembersHeading from './TeamMembersHeading';
import TeamMembersList from './TeamMembersList';
export default {
  name: 'TeamMembers',
  components: {
    TeamMembersList,
    TeamMembersHeading
  },
};
</script>

<style scoped lang="scss">

</style>
