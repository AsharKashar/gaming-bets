<template>
  <div class="participants__list">
    <div class="participants__list-inner">
      <template v-if="solo">
        <participant-solo-card
          v-for="team in participants"
          :key="team.team_id"
          :nickname="team.members[0].username"
          :avatar-url="team.members[0].avatar_url"
          :name="team.members[0].name"
        />
      </template>
      <template v-else>
        <participant-team-card
          v-for="team in participants"
          :key="team.team_id"
          :members="team.members"
          :avatar-url="team.avatar_url"
          :name="team.name"
        />
      </template>
    </div>
  </div>
</template>

<script>
import ParticipantTeamCard from 'components/CardsGrid/cards/participants/ParticipantTeamCard';
import ParticipantSoloCard from 'components/CardsGrid/cards/participants/ParticipantSoloCard';
export default {
  name: 'ParticipantsGrid',
  components: {ParticipantSoloCard, ParticipantTeamCard},
  props: {
    participants: {
      type: Array,
      required: true,
    },
    solo: {
      type: Boolean,
      default: false,
    }
  }
};
</script>

<style lang="scss" scoped>
  .participants__list {
    padding: 19px 0 24px;
    &-inner {
      display: flex;
      flex-wrap: wrap;
      margin: -12px -15px;
    }
  }
</style>