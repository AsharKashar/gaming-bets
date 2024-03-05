<template>
  <v-row>
    <v-simple-table
      v-if="!tournaments.data.message && tournaments.data.length"
      class="tournament-table my-5"
    >
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left" />
            <th class="text-left">
              {{ $t('Name') }}
            </th>
            <th class="text-left">
              {{ $t('Time Start') }}
            </th>
            <th class="text-left">
              {{ $t('Teams') }}
            </th>
            <th class="text-left" />
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="tournament in tournaments.data"
            :key="tournament.id"
          >
            <td class="px-0">
              <div
                class="tournament-image"
                :style="{ backgroundImage: 'linear-gradient(270deg, rgb(17, 21, 66) 0%, rgba(17, 21, 66, 0.28) 100%), url('+ tournament.image_url +')'}"
              />
            </td>
            <td>
              <div class="tournament-title">
                {{ tournament.name }}
              </div>
            </td>
            <td>
              <div
                v-if="tournament.check_in === 10"
                class="tournament-date"
              >
                {{ tournament.formated_start }}
                <span>{{ $t('starts') }}</span>
              </div>
              <div
                v-else
                class="tournament-time"
              >
                00 : 10 : 00
                <span>{{ $t('hrs min sec') }}</span>
              </div>
            </td>
            <td>
              <div class="tournament-teams">
                105
                <span>{{ $t('TEAMS') }}:</span>
              </div>
            </td>
            <td>
              <div class="check-in">
                <button v-if="tournament.check_in === 10">
                  {{ $t('CHECK IN') }}
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-row>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState, mapActions } = createNamespacedHelpers('profile');

export default {
  name: 'ListJoinedTournaments',
  props: {
    gameId:{
      type: Number,
      default: null
    },
    gameSize:{
      type: Number,
      default: null
    },
    page:{
      type: Number,
      default: null
    },
  },
  data() {
    return {};
  },
  computed: {
    ...mapState(['tournaments']),
  },
  mounted() {
    this.getTournaments({
      game_id: this.game_id,
      game_size: this.game_size,
      page: this.page,
    });
  },
  methods: {
    ...mapActions(['getTournaments']),
  }
};
</script>

<style scoped lang="scss">
.tournament-table {
  &.v-data-table {
    &::v-deep .v-data-table__wrapper {
      background: #111643;
      & > table {
        & > thead > tr:last-child > th {
          border: none;
          font-size: 16px;
          line-height: 110%;
          text-transform: uppercase;
          vertical-align: bottom;
          padding-bottom: 10px;
          background: #010432;
        }
        & > tbody > tr {
          &:nth-child(even) {
            background: #a1afd32e;
          }
          &:hover:not(.v-data-table__expanded__content):not(.v-data-table__empty-wrapper) {
            background: rgba(161, 175, 211, 0.2);
          }
          & td {
            border: none !important;
          }
          & td:nth-child(2) {
            max-width: 290px;
          }
          td:nth-child(3) {
            min-width: 175px;
          }
        }
        .tournament-teams,
        .tournament-title {
          padding: 0;
        }
      }
    }
  }
}

.tournament-data-head {
  display: grid;
  grid-template-columns: 483px 0.4fr 1fr;
  align-items: end;
  padding: 1rem 0;
}

.tournaments-tabs {
  &::v-deep .item-icon {
    height: 42px;
    width: 42px;
  }
  &::v-deep .item-name {
    font-size: 12px;
    margin: 0 29px 0 13px;
  }
}
.mobile-scroll {
  max-width: 100vw;
  overflow: hidden;
  width: 100%;
}

.loaderbox {
  display: flex;
  justify-content: center;
  padding: 20% 0;
}
.tournament-data {
  cursor: pointer;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  background: rgba(161, 175, 211, 0.1);
  min-width: -webkit-fit-content;
  min-width: -moz-fit-content;
  min-width: fit-content;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  &:hover {
    background: rgba(161, 175, 211, 0.2);
  }
}
.tournament-image {
  width: 207px;
  height: 104px;
  background-size: contain;
}
.tournament-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 900;
  font-size: 20px;
  line-height: 94%;
  display: flex;
  align-items: center;
  color: #e7e7e7;
  flex-basis: 27%;
  padding: 0 12px;
}
.tournament-date {
  position: relative;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 900;
  font-size: 16px;
  line-height: 94%;
  display: flex;
  align-items: center;
  color: #e7e7e7;
  span {
    position: absolute;
    top: 25px;
    color: #a1afd3;
    font-style: normal;
    font-weight: 900;
    font-size: 14px;
    line-height: 94%;
    display: flex;
    align-items: center;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }
}
.tournament-time {
  position: relative;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 800;
  font-size: 24px;
  line-height: 94%;
  display: flex;
  align-items: center;
  color: #be1338;

  span {
    top: 25px;
    position: absolute;
    font-size: 14px;
    word-spacing: 20px;
    padding: 0px 5px;
  }
}
.tournament-teams {
  position: relative;
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 900;
  font-size: 24px;
  line-height: 94%;
  display: flex;
  align-items: center;
  color: #e7e7e7;
  padding: 0 40px;
  span {
    position: absolute;
    top: 25px;
    font-style: normal;
    font-weight: 900;
    font-size: 11px;
    line-height: 94%;
    display: flex;
    align-items: center;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #a1afd3;
  }
}
.check-in {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 800;
  font-size: 14px;
  line-height: 100%;
  display: flex;
  align-items: center;
  text-align: center;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #010432;
  button {
    padding: 18px 30px;
    left: 82.28%;
    right: 2.28%;
    top: 21.25%;
    bottom: 21.25%;
    background: #be1338;
    border-radius: 59px;
  }
}
</style>
