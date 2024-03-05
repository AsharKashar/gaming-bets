<template>
  <div class="match-grid">
    <div
      v-for="(matches, key) in sortMatchesByDate"
      :key="key"
      class="match-grid__inner"
    >
      <match-date
        v-if="key !== 'rest'"
        :date="key"
      />
      <match-card
        v-for="match in matches"
        :key="match.match_id"
        :match-id="match.match_id"
        :title="match.title || `Match-${match.id}`"
        :date="match.start_at"
        :conflict-end="match.conflict_end_at"
        :teams="match.teams"
        :match-status-type="match.status.type"
        :match-status-text="match.status.name"
        :winers-ids="match.winner_users_ids"
        :winner-team-id="match.winner_team_id"
        :hosted-team-id="match.host_team_id"
        :tournament-id="+data.tournamentId"
        :matches-type="data.matchesType"
        :user-team-id="data.userTeamId"
      />
    </div>
  </div>
</template>

<script>
import MatchCard from 'components/CardsGrid/cards/MatchCard';
import MatchDate from 'components/tournaments/MatchDate';
import dayjs from 'dayjs';
import _ from 'lodash';

export default {
  name: 'MatchGrid',
  components: {MatchDate, MatchCard},
  props: {
    items: {
      type: Array,
      default: () => ([]),
    },
    data: {
      type: Object,
      default: () => ({}),
    }
  },
  computed: {
    sortMatchesByDate() {
      const matches = {};
      this.items.forEach((match) => {
        if (match.start_at) {
          const key = dayjs(match.start_at).format('M-D-YY');
          matches[key] = [ ...matches[key] || [], match];
        } else {
          matches.rest = [ ...matches.rest || [], match];
        }
      });
      return _(matches).toPairs().sortBy(0).fromPairs().value();
    }
  }
};
</script>

<style lang="scss" scoped>
.match-grid {
  &::v-deep {
    .match-date {
      padding-left: 15px;
    }
  }
}
</style>
