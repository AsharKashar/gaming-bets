<template>
  <div
    class="membership-packages-container"
    :class="{
      'hide-packages-list': currentPackage.id,
    }"
  >
    <div
      class="back-btn"
      @click="setPackage({})"
    >
      back
    </div>
    <div
      v-if="showInfoMessage"
      class="info-message"
    >
      <p>
        {{
          $t(
            "If like us you want to play every day, then becoming a member can help you save money and give you the most opportunities of winning,"
          )
        }}
        <br>
        <span class="bold"> {{ $t("up to 35 chances every month!") }}</span>

        {{ $t("We have three levels of membership to suit your needs.") }}

        {{ $t("Choose from Novice,") }}
        <span class="bold">{{ $t("Elite or God!") }}'</span>
      </p>
    </div>
    <div class="membership-packages">
      <div
        v-for="membershipPackage in membershipPackages"
        :key="membershipPackage.id"
        class="membership-package"
        :class="{
          'active-package': currentPackage.id === membershipPackage.id,
        }"
        @click="setPackage(membershipPackage)"
      >
        <div class="package-price">
          {{ membershipPackage.pay }}€/month
        </div>
        <v-clamp
          :autoresize="true"
          :max-lines="2"
          class="package-name"
        >
          {{ membershipPackage.name }}
        </v-clamp>
      </div>
    </div>
    <div
      v-if="currentPackage.id"
      class="plan-info"
      :class="{
        'plan-info-mobile': currentPackage.id,
      }"
    >
      <div
        v-for="(item, i) in selectedPlanInfo"
        :key="i"
        class="info-row"
      >
        <div class="info-row-title">
          {{ item.title }}
        </div>
        <div class="info-row-value">
          {{ item.value }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const membershipModule = createNamespacedHelpers('membership');
import VClamp from 'vue-clamp';

export default {
  name: 'MemberShipPlans',
  components: {
    VClamp,
  },
  props: {
    showInfoMessage: {
      type: Boolean,
      default: false,
    },
    setSelectedMembership: {
      type: Function,
      default: () => {},
    },
  },
  data() {
    return {
      currentPackage: {},
    };
  },
  computed: {
    ...membershipModule.mapState([
      'membershipPackages',
      'activeMemberShipData',
      'memberShipIsActive',
    ]),
    selectedPlanInfo() {
      return [
        {
          title: 'Money saved',
          value: `save ${this.currentPackage.daily_save} euros if you were to pay daily`,
        },
        {
          title: 'Chances to win money',
          value: `${this.currentPackage.money_win_chance} chances to win money every month `,
        },
        {
          title: 'Daily Tournaments',
          value: `Access to one ${this.currentPackage.daily_allowed} euro entrance daily tournament per day `,
        },
        {
          title: 'Weekly Tournaments',
          value: `Access to one ${this.currentPackage.weekly_allowed} euro weekly tournament three times per month ( As when there is a monthly tournament we do not have weekly. `,
        },
        {
          title: 'Monthly Tournaments',
          value: `Access to one ${this.currentPackage.monthly_allowed} euro monthly tournament per month `,
        },
        {
          title: 'Wagers',
          value: `${this.currentPackage.wagers} wagers per month`,
        },
      ];
    },
  },
  mounted() {
    if (window.innerWidth >= 768) {
      if (this.memberShipIsActive == true) {
        this.currentPackage =
          this.membershipPackages[
            this.activeMemberShipData.membership_package_id - 1
          ] || {};
      } else {
        this.currentPackage = this.membershipPackages[0] || {};
      }
    }
  },
  methods: {
    ...membershipModule.mapMutations(['selectMemberShip']),
    setPackage(membershipPackage) {
      this.currentPackage = membershipPackage;
      this.setSelectedMembership(membershipPackage);
      this.selectMemberShip(this.currentPackage.id);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.info-message {
  p {
    margin: 0;
    font-style: normal;
    font-weight: normal;
    line-height: 110%;
    letter-spacing: 0.05em;
    color: $text-primary-color;
    font-size: 24px;
  }
}
.bold {
  font-weight: 900;
}
.membership-packages {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;

  .membership-package {
    flex-basis: 31%;
    border-radius: 12px;
    border: 2px solid $text-primary-color;
    min-height: 152px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-width: 193px;
    cursor: pointer;
  transition: 0.3s all;
  &:hover
      { 
        background: #a1afd31a;
      }
   
    &.active-package,
    &:hover {
      border-color: $border-primary-color;
      background: #a1afd31a;
      .package-price {
        background: $accent-error-color;
      }
    }

    .package-price {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translate(-50%, 0);
      clip-path: polygon(
        4.5% 0,
        93% 0,
        90% 93%,
        89.5% 95%,
        89% 97%,
        87% 100%,
        100% 100%,
        10% 100%,
        8% 96%,
        7.3% 90%,
        7.2% 91%
      );
      background: $text-primary-color;
      width: 100%;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      line-height: 100%;
      display: flex;
      align-items: center;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      justify-content: center;
      color: #010432;
    }

    .package-name {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      margin-top: 20px;
      line-height: 34px;
      display: block;
      max-width: 90%;
      text-align: center;
      text-transform: uppercase;
      color: $accent-error-color;
    }

    &::v-deep .default-banger-btn {
      position: absolute;
      bottom: -25px;
      left: 50%;
      transform: translate(-50%, 0);
      font-size: 18px;
      letter-spacing: 0.05em;
      padding: 9px 34px;
      display: none;
    }

    &:hover {
      &::v-deep .default-banger-btn {
        display: block;
      }
    }
  }
}

.plan-info {
  .info-row {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #a1afd31a;
    line-height: 100%;

    .info-row-value {
      color: $accent-error-color;
      font-weight: 900;
      font-size: 16px;
      line-height: 120%;
    }
    .info-row-title {
      color: $text-primary-color;
      font-size: 16px;
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .hide-packages-list {
    .info-message {
      display: none;
    }
    .membership-packages {
      display: none;
    }
    .back-btn {
      display: block;
    }
  }

  .back-btn {
    margin: 13px 0 11px;
    text-transform: uppercase;
    font-size: 20px;
    display: none;
    color: $accent-error-color;
  }

  .info-message {
    font-size: 15px;
    line-height: 110%;
    margin-bottom: 41px;
  }

  .membership-packages {
    .membership-package {
      flex-basis: 99%;
      margin-bottom: 40px;
    }
    .package-price {
      min-height: 39px;
      font-size: 15px;
      width: 50%;
    }
  }
  .plan-info {
    display: none;
    &.plan-info-mobile {
      display: block;
    }
    .info-row {
      flex-direction: column;
      border-bottom: 2px solid;
      // border-color: $text-primary-color;
      padding: 0 0 8px;

      .info-row-value,
      .info-row-title {
        padding: 14px 0;
      }
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .hide-packages-list {
    .info-message {
      display: flex;
    }
    .membership-packages {
      display: flex;
    }
    .back-btn {
      display: none;
    }
  }

  .info-message {
    margin: 0 0 64px;
    font-size: 18px;
    line-height: 111%;
  }

  .membership-packages {
    .membership-package {
      flex-basis: 31%;
      margin-bottom: 20px;
    }
    .package-price {
      min-height: 39px;
      font-size: 15px;
      width: 100%;
    }
    .package-name {
      font-size: 32px;
    }
  }
  .plan-info {
    display: block;
    margin-top: 28px;

    .info-row {
      flex-direction: row;
      padding: 16px 0;
      margin: 0px 0px;
      font-size: 16px;
      border-bottom: 1px solid;

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
  .info-message {
    margin: 0 0 31px;
    font-size: 22px;
    line-height: 110%;
  }

  .membership-packages {
    .membership-package {
      flex-basis: 30%;
      min-height: 202px;
      margin-bottom: 40px;
    }

    .package-price {
      min-height: 39px;
      font-size: 24px;
    }
  }
  .plan-info {
    margin-top: 32px;

    .info-row {
      padding: 13px 0;
      margin: 0 4px;
      font-size: 20px;

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
  .info-message {
    font-size: 24px;
    line-height: 120%;
    margin: 10px 0 39px;
  }

  .membership-packages {
    .membership-package {
      flex-basis: 31%;
      min-height: 152px;
      margin-bottom: 20px;

      .package-price {
        min-height: 29px;
        font-size: 18px;
      }

      .package-name {
        font-size: 24px;
      }
    }
  }

  .plan-info {
    margin-top: 15px;

    .info-row {
      padding: 14px 0;
      margin: 0;
      font-size: 15px;

      .info-row-value {
        flex-basis: 54%;
      }
    }
  }
}
</style>
