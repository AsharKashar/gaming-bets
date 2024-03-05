<template>
  <loader
    :loading="loading"
    height="80px"
    :overlay="false"
    :center="true"
  >
    <form
      v-if="currentBoxFight"
      @keyup.enter="joinMatch"
    >
      <div class="join-modal">
        <h2 class="subtitles-primary mb-6">
          {{ $t('Join Box Fight') }}
        </h2>
        <h4 class="subtitles-sm-bold mb-2">
          {{ currentBoxFight.boxmatch_name }}
        </h4>
        <p>{{ $t('Match ID') }}: {{ currentBoxFight.id }}</p>
        <div class="content">
          <div class="fight-owner mb-3">
            <p class="sm created text-right pr-4 m-0">
              {{ $t('Created By') }}
            </p>
            <div class="detail">
              <div>
                <v-avatar
                  tile
                  size="50"
                >
                  <img
                    src="~/static/icons/userIcon.svg"
                    class="user-image"
                    alt
                  >
                </v-avatar>
                <div class="ml-3">
                  <p class="name mb-1 bold">
                    {{ currentBoxFight.user.name }}
                  </p>
                  <p class="epic-name sm">
                    {{ currentBoxFight.username }}
                  </p>
                </div>
              </div>
              <v-avatar
                tile
                size="30"
              >
                <img
                  src="~/static/images/badges-rank-bronze.png"
                  class="user-image"
                  alt
                >
              </v-avatar>
            </div>
          </div>
          <input-group
            is-auth
            label="Match Type"
            :value="currentBoxFight.game_type_boxmatch.description"
            :disabled="true"
          />
          <input-group
            is-auth
            label="Platform"
            :value="currentBoxFight.platform.name"
            :disabled="true"
          />
          <input-group
            is-auth
            label="Region"
            :value="currentBoxFight.region.name"
            :disabled="true"
          />

          <div class="relative">
            <input-group
              is-auth
              label="Date"
              :value="boxFightTime.date"
              :disabled="true"
            />
            <div class="time-field">
              <input-group
                is-auth
                label="Time"
                :value="boxFightTime.time"
                :disabled="true"
                no-border
              />
            </div>
          </div>
          <input-group
            is-auth
            label="Challenge bombs*"
            :value="currentBoxFight.bid_amount"
            :disabled="true"
          />
          <input-group
            is-auth
            label="Epic Username"
            placeholder="Enter Username"
            :value="challengerEpicName"
            name="challengerEpicName"
            :on-change="setField"
            color-primary
          />
          <copy-right-checkbox
            :copy-right="copyRight"
            :toggle-copyright="() => (copyRight = !copyRight)"
          />
          <default-button
            type="button"
            :btn-class="btnClasses"
            :on-click="joinMatch"
          >
            {{ $t('Join Fight') }}
          </default-button>
        </div>
      </div>
    </form>
  </loader>
</template>

<script>
import CopyRightCheckbox from 'components/forms/parts/CopyRightCheckbox.vue';
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton.vue';
import Loader from 'components/Loader';
import { STATE_STATUSES } from 'helpers/constants';

import { createNamespacedHelpers } from 'vuex';
const boxfightModule = createNamespacedHelpers('boxfight');
const authModule = createNamespacedHelpers('auth');
const modalModule = createNamespacedHelpers('modal');

export default {
  components: {
    CopyRightCheckbox,
    InputGroup,
    DefaultButton,
    Loader
  },
  props: {
    token: {
      type: String,
      default: ''
    }
  },
  data: () => ({
    challengerEpicName: '',
    copyRight: false
  }),
  computed: {
    ...boxfightModule.mapState(['boxFightId']),
    ...authModule.mapState(['user']),
    btnClasses() {
      return `default-banger-btn button-block ${
        !this.isFormValid ? 'banger-btn-disabled' : ''
      }`;
    },
    isFormValid() {
      if (!this.challengerEpicName || !this.copyRight) {
        return false;
      } else {
        return true;
      }
    },
    ...authModule.mapState(['user']),
    ...boxfightModule.mapState(['boxFightStatus', 'currentBoxFight']),
    loading() {
      return this.boxFightStatus === STATE_STATUSES.PENDING;
    },
    boxFightTime(){
      let date = this.currentBoxFight.time.split(' ')[0];
      let time = this.currentBoxFight.time.split(' ')[1];
      date = date.split('-').reverse().join('-');
      return {
        time ,
        date
      };
    }
  },

  methods: {
    ...boxfightModule.mapMutations(['setBoxFightStatus']),
    ...modalModule.mapMutations(['setActiveModal']),
    ...authModule.mapMutations(['updateUserBombs']),
    setField(name, value) {
      this[name] = value;
    },
    joinMatch() {
      if (this.isFormValid) {
        let token = this.token;
        let payload = {
          url: `box-matches/join-using-link/${this.user.id}`,
          payload: {
            invite_token: token,
            username: this.challengerEpicName
          }
        };
        // checking if the user is joining via link...
        if (token) {
          this.joinBoxFightGame(payload);
        } else {
          payload = {
            url: `box-matches/join-using-button/${this.currentBoxFight.id}`,
            payload: {
              username: this.challengerEpicName,
              user_id: this.user.id
            }
          };
          this.joinBoxFightGame(payload);
        }
      }
    },

    async joinBoxFightGame(payload) {
      try {
        this.setBoxFightStatus(STATE_STATUSES.PENDING);
        await this.$bangerApi.post(payload.url, payload.payload);
        // updating user bombs
        const remainingBombs = this.user.all_bombs - this.currentBoxFight.bid_amount;
        this.updateUserBombs(remainingBombs);
        this.setActiveModal({ type: false });
        this.$router.push(`/tournaments/boxfight/${this.currentBoxFight.id}?gameMode=${this.boxFightId}`);
        this.setBoxFightStatus(STATE_STATUSES.READY);
      } catch (err) {
        console.log(err);
        this.setBoxFightStatus(STATE_STATUSES.ERROR);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.relative{
  position: relative;
}
.join-modal {
  .subtitles-primary{
    text-transform: capitalize;
  }

  &::v-deep .custom-input-group {
    .label {
      &-title {
        text-transform: capitalize;
      }
    }
  }
  h2 {
    color: $text-secondary-color;
  }
  & > p {
    color: $text-secondary-color;
  }
  .content {
    .fight-owner {
      display: flex;

      align-items: flex-end;
      .created {
        display: flex;
        flex-direction: column;
        flex-basis: 37%;
        margin-bottom: 5px;
      }
      .detail {
        display: flex;
        flex-basis: 63%;
        justify-content: space-between;
        align-items: center;
        padding-right: 10px;
        div:first-child {
          display: flex;
          align-items: center;
        }
        .name {
          color: $text-hover-color;
        }
        p {
          margin: 0;
        }
      }
    }
  }

    .time-field{
    position: absolute;
    top: 0;
    right: 0;
    width: 33%;
  }
}
</style>
