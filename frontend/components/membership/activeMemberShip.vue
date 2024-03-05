<template>
  <div>
    <div class="plan-info plan-info-mobile">
      <div class="info-row">
        <div class="info-row-title">
          {{ memberShipTitle }}
        </div>
        <div class="info-row-value">
          <div class="double-track">
            <div>{{ activeMemberShipData.membership_package_name }}</div>
            <div>{{ activeMemberShipData.membership_price }}</div>
          </div>
        </div>
      </div>
      <div class="info-row">
        <div class="info-row-title">
          {{ paymentTitle }}
        </div>
        <div class="info-row-value">
          <div class="double-track">
            <div>{{ activeMemberShipData.next_payment_due }}</div>
          </div>
        </div>
      </div>
      <div class="info-row">
        <div class="info-row-title">
          <div class="info-row-value">
            <div
              v-if="activeMemberShipData && activeMemberShipData.card_details"
              class="double-track"
            >
              <div>{{ activeMemberShipData.card_details.brand }}</div>
              <div>**** **** **** {{ activeMemberShipData.card_details.last_four }}</div>
            </div>
          </div>
        </div>
        <div class="info-row-value red-label-down">
          <div class="double-track">
            <div>
              <a
                href="#"
                class="lint-btn lin-red"
              >{{ $t('Change payment method') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="button-wrapper">
      <default-button
        type="button"
        class="get-membership secondary-banger-btn"
        :on-click="changeMembership"
      >
        {{ $t('change membership') }}
      </default-button>

      <a
        class="lint-btn"
        @click="checkAndcancelMemberShip(userId)"
      >{{ $t('Cancel membership') }}</a>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import moment from 'dayjs';
import Vue from 'vue';
import { createNamespacedHelpers } from 'vuex';
const membershipModule = createNamespacedHelpers('membership');

export default {
  components: { DefaultButton },
  props: {
    activeMemberShipData:{
      type: Object,
      default: () => ({})
    },
    userId:{
      type:Number,
      default: null
    },
  },
  data() {
    return {
      memberShipTitle: 'Your membership',
      paymentTitle: 'Next Payment due:',
    };
  },

  methods: {
    ...membershipModule.mapActions(['cancelMemberShip']),
    changeMembership() {
      this.$emit('changeMembership');
    },
    checkAndcancelMemberShip(userId) {
      const date = this.activeMemberShipData.next_payment_due.split('-');
      const isExpired = moment(`${date[2]}-${date[1]}-${date[0]}`).isBefore();
      if(!isExpired) {
        Vue.notify({
          group: 'custom-notification',
          title: 'Cancle Membership',
          text: 'Membership can only be cenceled after it expired.',
          type: 'warning'
        });
        return;
      }
      this.cancelMemberShip(userId);
      return;
    }
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.button-wrapper {
  padding: 1.5em 0 0 0 ;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  justify-content: center;
  align-items: center;
  width: 100%;
}

.get-membership {
  font-size: 16px;
  text-transform: lowercase;
  padding: 1.2em 1.2em;
}
.lint-btn {
  font-size: 20px;
  color: $text-primary-color;
  font-size: 20px;
  color: $text-primary-color;
  text-decoration: none;
  padding: 1em;
  cursor: pointer;
  transition: 0.3s color;
  text-align: center;
  &:hover {
    color: $accent-error-color;
  }
}

.red-label-down {
  display: flex;
  align-items: flex-end;
}
.lin-red {
  color: $accent-error-color;
  font-size: 20px;
  padding: 0;
}
.plan-info {
  .info-row {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid $text-primary-color;
    line-height: 100%;

    .info-row-value {
      color: $text-primary-color;
    }
    .info-row-title {
      color: $text-primary-color;
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .plan-info {
    display: none;
    &.plan-info-mobile {
      display: block;
    }
    .info-row {
      flex-direction: column;
      border-bottom: 2px solid;
      border-color: $text-primary-color;
      padding: 0 0 8px;
      padding: 8px 0 8px;
      line-height: 130%;
      .info-row-title,
      .info-row-value {
        font-size: 16px;
      }
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .get-membership,
  .lint-btn {
    width: 100%;
    text-align: center;
  }

  .plan-info {
    display: block;

    .info-row {
      flex-direction: row;
      padding: 16px 0;
      margin: 0px 0px;
      font-size: 16px;
      border-bottom: 1px solid;
      .info-row-title,
      .info-row-value {
        font-size: 16px;
      }
      .info-row-value {
        flex-basis: 53%;
        padding: 0;
      }
      .info-row-title {
        flex-basis: 30%;
        padding: 0;
      }
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .plan-info {
    .info-row {
      padding: 13px 0;
      margin: 0 4px;
      font-size: 20px;
      .info-row-title,
      .info-row-value {
        font-size: 16px;
      }
      .info-row-value {
        flex-basis: 53%;
      }
      .info-row-title {
        flex-basis: 30%;
      }
    }
  }
}

@media all and (min-width: $desktop-width) {
  .get-membership {
    width: fit-content;
  }
  .plan-info {
    .info-row {
      padding: 18px 0;
      margin: 0;
      font-size: 15px;
      .info-row-title,
      .info-row-value {
        font-size: 18px;
        line-height: 120%;
      }
      .info-row-title {
        flex-basis: 70%;
      }
      .info-row-value {
        flex-basis: 54%;
      }
    }
  }
}
</style>
