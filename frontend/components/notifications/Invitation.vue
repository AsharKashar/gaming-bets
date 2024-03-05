<template>
  <div
    class="invitation-box"
    :class="{'show-tournament-details' :details}"
  >
    <div
      v-if="details"
      class="invitation-body"
    >
      <div class="tournament-title">
        <img
          :src="tournamentDetails.cover"
          :alt="tournamentDetails.name"
        >
        <img
          src="~/static/icons/xbox.svg"
          alt="Notification"
        >
      </div>
      <div class="tournament-details">
        <div class="single-tile">
          <div class="heading">
            {{ $t('Match') }}:
          </div>
          <div class="text">
            {{ $t(tournamentDetails.match) }}
          </div>
        </div>
        <div class="single-tile">
          <div class="heading">
            {{ $t('Date') }}:
          </div>
          <div class="text">
            {{ tournamentDetails.date }}
          </div>
        </div>
        <div class="single-tile">
          <div class="heading">
            {{ $t('Time') }}:
          </div>
          <div class="text">
            {{ tournamentDetails.time }}
          </div>
        </div>
        <div class="single-tile">
          <div
            class="text"
          >
            {{ tournamentDetails.joinedPlayers +'/'+ tournamentDetails.totalPlayers }}
          </div>
          <div class="heading">
            {{ $t('Player joined') }}
          </div>
        </div>
      </div>
    </div>
    <div class="invitation-actions">
      <div class="action-btn accept-btn">
        {{ $t('Accept') }}
      </div>
      <div class="action-btn reject-btn">
        {{ $t('reject') }}
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from 'dayjs';

export default {
  name: 'SingleNotification',
  components: {},
  props: {
    tournament: {
      type: Object,
      default: () => {},
    },
    details: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({}),
  computed: {
    tournamentDetails() {
      return {
        name: this.tournament.name,
        cover: this.tournament.game.cover,
        match: '25wd',
        date: dayjs(this.tournament.start_at).format('DD MMM'),
        time: dayjs(this.tournament.start_at).format('HH:mm'),
        joinedPlayers: this.tournament.tournament_size.players_actual_count,
        totalPlayers: this.tournament.tournament_size.players_count,
      };
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.invitation-box {
  display: flex;
  margin: 8px 0;
  position: relative;
  min-height: 49px;
  flex-direction: column;

  .invitation-actions {
    display: flex;
    align-items: center;
    margin: 4px 0;

    .action-btn {
      display: flex;
      align-items: center;
      margin: 0 16px;
      font-weight: 800;
      font-size: 12px;
      line-height: 100%;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
    }

    .accept-btn {
      display: flex;
      align-items: center;
      flex-direction: row;
      padding: 14px 24px;
      width: 102px;
      height: 36px;
      border: 2px solid $text-secondary-color;
      color: $text-secondary-color;
      box-sizing: border-box;
      border-radius: 59px;
      cursor: pointer;
    }

    .reject-btn {
      text-decoration-line: underline;
      cursor: pointer;
      color: $text-primary-color;
    }
  }
}
.show-tournament-details {
  min-height: 142px;
  background: #212652;
  border-radius: 14px;
  padding: 16px;
}

.tournament-title {
  display: flex;
  align-items: center;

  img {
    height: 30px;
    margin-right: 8px;
  }
}

.tournament-details {
  display: flex;
  justify-content: space-between;
  margin: 8px 0;

  .single-tile {
    .heading {
      font-size: 14px;
      line-height: 100%;
      letter-spacing: 0.02em;
      color: $text-primary-color;
    }
    .text {
      font-weight: 800;
      font-size: 14px;
      line-height: 100%;
      display: flex;
      align-items: center;
      letter-spacing: 0.02em;
      color: #e7e7e7;
    }
  }
}
</style>
