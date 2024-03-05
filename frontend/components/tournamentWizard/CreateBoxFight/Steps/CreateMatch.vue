<template>
  <form
    @keyup.enter="handleEnter()"
  >
    <p>{{ $t("Step") }} 1 of 2</p>
    <h3 class="subtitles-primary mb-3">
      {{ $t("Create Fight") }}
    </h3>
    <p>{{ $t("Fill this form to create you own fight.") }}</p>
    <input-group
      is-auth
      :value="wager_name"
      name="wager_name"
      :on-change="setField"
      :label="$t('Wager Name')"
      :placeholder="$t('Type Wager Name')"
    />

    <div class="custom-radio">
      <div class="label">
        {{ $t("Match Type") }}
      </div>
      <v-progress-circular
        v-if="!gameTypes.length > 0"
        indeterminate
        size="24"
      />
      <div
        v-else
        class="radios"
      >
        <div
          v-for="type in gameTypes"
          :key="type.id"
          class="radio"
          :class="game_type_boxmatch === type.id && 'selected'"
          @click="setField('game_type_boxmatch', type.id)"
        >
          <span class="circle" />
          <div class="radio-title">
            {{ $t(type.description) }}
          </div>
        </div>
      </div>
    </div>

    <input-group
      is-menu
      is-auth
      :menu-items="platformsArr"
      :value="platform"
      name="platform"
      :on-change="setField"
      :label="$t('Platform')"
      :color-primary="true"
    />

    <input-group
      is-menu
      is-auth
      :menu-items="regionsArr"
      :value="region"
      name="region"
      :on-change="setField"
      :label="$t('Region')"
      placeholder="Select region"
      :color-primary="true"
    />

    <div class="relative date-time custom-forms">
      <v-text-field
        v-model="date"
        v-mask="'##/##/####'"
        masked="true"
        placeholder="DD/MM/YYYY"
        name="Date"
        :label="$t('Date')"
      />


      <div class="time-field">
        <v-text-field
          v-model="time"
          v-mask="'## : ##'"
          masked="true"
          placeholder="HH : MM"
          name="Time"
          :label="$t('Time')"
        />
      </div>
    </div>

    <input-group
      is-menu
      is-auth
      :menu-items="bombs"
      :value="bid_amount"
      name="bid_amount"
      :on-change="setField"
      :color-primary="true"
      :label="$t('Challenge Bombs*')"
      class="bid-amount"
    />

    <input-group
      is-auth
      :value="epic_username"
      name="epic_username"
      :on-change="setField"
      :label="$t('Epic Username')"
      :placeholder="$t('Epic Username')"
    />

    <copy-right-checkbox
      :copy-right="copyRight"
      :toggle-copyright="() => (copyRight = !copyRight)"
    />

    <div class="errors">
      <p
        v-for="(err, i) in errors"
        :key="err + i"
        class="m-0 bold"
      >
        {{ err }}
      </p>
    </div>

    <default-button
      type="button"
      :btn-class="btnClasses"
      :disabled="!validateForm"
      :on-click="handleEnter"
      :loading="isLoading"
    >
      {{ $t("Create Fight") }}
    </default-button>
  </form>
</template>

<script>
import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
dayjs.extend(utc);

import DefaultButton from 'components/DefaultButton.vue';
import InputGroup from 'components/forms/parts/InputGroup.vue';
import CopyRightCheckbox from 'components/forms/parts/CopyRightCheckbox.vue';

import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('auth');
import mixinForm from '@/mixins/mixinForm';
export default {
  components: {
    DefaultButton,
    InputGroup,
    CopyRightCheckbox,
  },
  mixins:[mixinForm],
  props: {
    isLoading: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      wager_name: '',
      game_type_boxmatch: '',
      platform: '',
      region: '',
      bid_amount: '',
      epic_username: '',
      date: '',
      time: '',
      copyRight: false,
      platforms: [],
      regions: [],
      gameTypes: [],
      errors: [],
    };
  },
  computed: {
    ...mapState(['user']),
    platformsArr() {
      return this.platforms.map((platform) => platform.name);
    },
    regionsArr() {
      return this.regions.map((region) => region.name);
    },
    bombs() {
      let bombArr = [];
      for (let i = 1; i <= 10; i++) {
        bombArr.push((i * 10).toString());
      }
      return bombArr;
    },
    btnClasses() {
      return `default-banger-btn button-block ${
        !this.validateForm ? 'button-disabled' : ''
      }`;
    },
    validateForm() {
      let valid = true;
      if (
        !this.copyRight ||
        !this.wager_name ||
        !this.game_type_boxmatch ||
        !this.platform ||
        !this.region ||
        !this.bid_amount ||
        !this.epic_username ||
        !this.validateDate() ||
        !this.validateTime()
      ) {
        valid = false;
      }
      return valid;
    },
  },
  created() {
    this.fetchData();
  },
  methods: {
    setField(name, value) {
      this[name] = value;
    },
    fetchData() {
      this.$bangerApi
        .get(`box-matches/get-game-platforms/${this.$route.params.gameId}`)
        .then(({ data }) => (this.platforms = data));
      this.$bangerApi
        .get('box-matches/get-game-regions')
        .then(({ data }) => (this.regions = data));
      this.$bangerApi
        .get('box-matches/get-game-types')
        .then(({ data }) => (this.gameTypes = data));
    },
    validateDate() {
      const date = this.date.split('/');
      const enteredDate = dayjs(`${date[2]} ${date[1]} ${date[0]} ${this.time.split(':').map(t => t.trim()).join(':')+':00'}`);
      const today = dayjs();

      const valid = enteredDate.isValid();
      const diff = enteredDate.diff(today, 'minute' , true);
      let errorMsg = 'Date is invalid ...!';

      if (!valid && this.time) {
        this.errorHandler(errorMsg);
        return false;
      } else {
        this.errors = this.errors.filter((msg) => msg !== errorMsg);
      }

      if (diff < 6) {
        errorMsg = 'Please enter the future date...!';
        this.errorHandler(errorMsg);
        return false;
      } else {
        this.errors = this.errors.filter((msg) => msg !== 'Please enter the future date...!');
        return true;
      }
    },
    validateTime() {
      const time = this.time.split(':');
      let errorMsg = 'Please enter the correct time...!';
      if (time[0] > 23 || time[0] < 0 || time[1] < 0 || time[1] > 59) {
        this.errorHandler(errorMsg);
        return false;
      } else {
        this.errors = this.errors.filter((msg) => msg !== errorMsg);
        return true;
      }
    },
    handleEnter() {
      if (this.validateForm) {
        this.createBoxMatch();
      }
    },
    errorHandler(msg) {
      let err = this.errors.find((err) => err === msg);
      if (err) return;
      this.errors.push(msg);
    },
    createBoxMatch() {
      let platform_id = this.platforms.find(
        (platform) => this.platform === platform.name
      ).id;
      let region_id = this.regions.find((region) => this.region === region.name)
        .id;
      // converting LOCAL to UTC
      let local = this.date.split('/').reverse().join('-') + ' ' + this.time.split(':').map(t => t.trim()).join(':')+':00';
      let UTC_TIME = dayjs(local).utc().format('YYYY-MM-DD HH:mm');

      

      const payload = {
        user_id: this.user.id,
        game_id: parseInt(this.$route.params.gameId),
        date: UTC_TIME.split(' ')[0],
        time: UTC_TIME.split(' ')[1],
        bid_amount: this.bid_amount,
        game_type_boxmatch_id: this.game_type_boxmatch,
        platform_id,
        region_id,
        username: this.epic_username,
        boxmatch_name: this.wager_name,
      };
      this.$emit('createMatch', payload);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

@import '~/components/global-modal/forms/forms.scss';

form {
  p,
  h3 {
    color: $text-secondary-color;
  }

  &::v-deep .custom-input-group {
    .label {
      &-title {
        text-transform: capitalize;
      }
    }
    .input-select,
    input{
      color: $text-primary-color !important;
    }


  }

  .custom-radio {
    display: flex;
    height: 43px;
    align-items: center;
    border-bottom: 1px solid rgba(161, 175, 211, 0.2);

    .label {
      display: flex;
      flex-direction: column;
      flex-basis: 37%;
      color: $text-primary-color;
      text-align: right !important;
      padding-right: 15px;
    }
  }
  .radios {
    display: flex;
    align-items: center;
    .radio {
      display: flex;
      align-items: center;
      margin-right: 10px;
      cursor: pointer;
      &-title {
        font-size: 16px;
        line-height: 140%;
        color: $text-hover-color;
      }
      .circle {
        display: inline-block;
        height: 16px;
        width: 16px;
        border-radius: 50%;
        border: 1px solid $text-hover-color;
        margin-right: 5px;
        position: relative;
      }

      &.selected {
        .radio-title {
          color: $text-secondary-color;
          font-family: Telegraf-UltraBold;
        }
        .circle {
          border: 1px solid $text-secondary-color;

          &:before {
            content: "";
            position: absolute;
            height: 9px;
            width: 9px;
            background: $text-secondary-color;
            border-radius: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
          }
        }
      }
    }
  }
  .errors {
    max-width: 75%;
    margin-left: auto;
    p {
      color: $text-primary-color;
    }
  }

  .time-field{
    position: absolute;
    top: 0;
    right: 0;
    width: 33%;
  }
}

.relative{
   position:relative;
}

.bid-amount::v-deep .input-select .v-input__control .v-select__selections .v-select__selection{
  color: $text-secondary-color;
  font-weight: bold;
}

@media all and (max-width: $tablet-small-width) {
  .v-application  .custom-forms {
    .form-heading {
      margin-bottom: 44px;
    }

    .v-text-field {  
      margin-bottom: 20px;
    }
  }
  .actions {
    margin: 24px 0 4px;
  }
}

 .custom-forms::v-deep {
  color: $text-primary-color;
  .error--text {
    color: $text-secondary-color!important;
    caret-color: $text-secondary-color!important;
  }

  .form-heading {
      margin-bottom: 15px;
  }

  a {
    text-decoration: none;
    color: $text-secondary-color;
  }

  .v-text-field {
    padding-top: 0;
    margin: 0 0 5px;
    & > .v-input__control {
      padding-bottom: 18px;
      position: relative;
      & > .v-input__slot {
        margin-bottom: 0;
        &::before {
          border-color: currentColor;
        }
        & > .v-text-field__slot {
          align-items: center;
          padding: 0;
          .v-label {
            @media all and (min-width: $tablet-small-width) {
              position: static !important;
              width: 100%;
              flex: 0 0 200px;
              max-width: 200px;
              text-align: right;
              color: $text-primary-color;
              line-height: 1.4;
              transform-origin: unset;
              height: auto;
              transform: none;
              padding-right: 33px;
            }
            &.error--text + input {
              &::-webkit-input-placeholder,
              &::-moz-placeholder,
              &:-moz-placeholder,
              &:-ms-input-placeholder,
              &::placeholder {
                color: $text-secondary-color;
                opacity: 1;
              }
            }
          }
          input {
            @media all and (min-width: $tablet-small-width) {
              width: 100%;
              flex: 0 0 calc(100% - 200px);
              max-width: calc(100% - 200px);
            }
          }
        }
      }
      & > .v-text-field__details {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -8px;
        .v-messages__message {
          text-align: center;
        }
      }
    }
  }

  .member {
    text-align: center;
    font-weight: 800;
  }

  .form-error {
    padding: 15px;
    text-align: center;
    font-weight: bold;
    color: $text-secondary-color;
  }

    .actions {
        margin: 15px 0 5px;
    }
}

@media all and (max-width: $tablet-small-width) {
  .v-application  .custom-forms {
    .form-heading {
      margin-bottom: 44px;
    }

    .v-text-field {
      margin-bottom: 20px;
    }
  }
  .actions {
    margin: 24px 0 4px;
  }
}

.custom-forms.date-time{
 border-bottom: 1px solid rgba(161, 175, 211, 0.2);
  &::v-deep .v-text-field:hover > .v-input__control > .v-input__slot::before{
    border-color: transparent;
  }

 &::v-deep .v-text-field > .v-input__control > .v-input__slot:before,
  &::v-deep .v-text-field > .v-input__control > .v-input__slot:after{
    content: unset;
  }

    &::v-deep .v-text-field > .v-input__control{
      padding-top: 10px;
      padding-bottom: 0;
      & > .v-input__slot > .v-text-field__slot .v-label{
        padding-right: 21px;
        max-width: 175px;
      }
    }

    & .time-field {
       &::v-deep .v-text-field > .v-input__control > .v-input__slot::before,
       &::v-deep .v-text-field > .v-input__control > .v-input__slot::before{
         content:unset;
         border-color: transparent;
       }

      &::v-deep .v-text-field > .v-input__control > .v-input__slot > .v-text-field__slot{
        .v-label{
          max-width: 70px;
        }
        input{
          max-width: 186px;
          display: block;
          flex: unset;
        }
      }
    }
    
}
</style>



