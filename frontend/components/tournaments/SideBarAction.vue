<template>
  <div class="register-info__action">
    <default-button
      v-if="joinBtn"
      class="default-banger-btn--sidebar default-banger-btn--join"
      :class="joinBtn.class"
      :disabled="joinBtn.disabled"
      @click.native="openJoinTournamentWizard(currentTournament)"
    >
      <span
        class="inner-btn-dynamic"
        v-html="joinBtn.text"
      />
    </default-button>
  </div>
</template>
<script>
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');
const modalModule = createNamespacedHelpers('modal');
const authModule = createNamespacedHelpers('auth');
import mixinsTournament from 'mixins/tournamentMixin';

export default {
  name: 'SideBarAction',
  components: {
    DefaultButton
  },
  mixins: [mixinsTournament],
  props: {
    registration: {
      type: Boolean,
      required: true,
    }
  },
  computed: {
    ...tournamentModule.mapState(['currentTournament']),
    ...authModule.mapState(['isAuthenticated']),
    joinBtn(){
      return this.actionButtonText(this.currentTournament);
    }
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal', 'setCommonData']),
    join() {
      this.joinMatchState.action(this.currentTournament.id);
    },
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors.scss";
  .register-info__action {
    &::v-deep {
      .default-banger-btn {
        font-size: 20px;
        padding: 15px;
        //white-space: nowrap;
        text-transform: uppercase;

        &--sidebar {
          width: 100%;
          font-size: 20px;
          min-height: 56px;
          color: #010432;
        }
        &--join {
          justify-content: center;
          align-items: center;
          /*&::after {
            content: '';
            margin-top: -5px;
            width: 24px;
            height: 24px;
            display: inline-block;
            background-image: url("data:image/svg+xml,%3Csvg width='25' height='25' viewBox='0 0 25 25' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11.9845 23.666C16.6888 23.666 20.5139 19.8761 20.5139 15.187C20.5139 10.4979 16.6888 6.70801 11.9845 6.70801C7.28018 6.70801 3.45508 10.4979 3.45508 15.187C3.45508 19.8761 7.28018 23.666 11.9845 23.666Z' stroke='%23171931' stroke-width='2'/%3E%3Cpath d='M7.4668 13.6914C7.4668 13.6914 7.09033 14.1843 7.09033 15.5612C7.09033 16.938 7.4668 17.4309 7.4668 17.4309' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M11.9844 5.09112V3.4197C11.9844 2.48407 12.7429 1.72559 13.6785 1.72559V1.72559C14.6141 1.72559 15.3726 2.48407 15.3726 3.4197V3.7823C15.3726 4.9182 16.2934 5.83902 17.4293 5.83902H19.1373' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M18.7612 1.35449V2.85028' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M21.02 3.96942L22.5259 2.47363' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M22.5259 9.20383L21.02 7.70801' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M21.4597 5.77599H23.5921' stroke='%23171931' stroke-width='2' stroke-linecap='round'/%3E%3Cmask id='path-8-inside-1' fill='white'%3E%3Cellipse cx='11.9844' cy='6.58655' rx='3.01176' ry='1.86975'/%3E%3C/mask%3E%3Cpath d='M12.9962 6.58655C12.9962 6.15791 13.2698 6.07874 13.0592 6.20948C12.8785 6.32162 12.5037 6.4563 11.9844 6.4563V10.4563C13.1285 10.4563 14.2595 10.1724 15.1689 9.60785C16.0484 9.06187 16.9962 8.04782 16.9962 6.58655H12.9962ZM11.9844 6.4563C11.4651 6.4563 11.0903 6.32162 10.9097 6.20948C10.6991 6.07874 10.9727 6.15791 10.9727 6.58655H6.97266C6.97266 8.04782 7.92045 9.06187 8.7999 9.60785C9.70931 10.1724 10.8403 10.4563 11.9844 10.4563V6.4563ZM10.9727 6.58655C10.9727 7.01518 10.6991 7.09436 10.9097 6.96362C11.0903 6.85147 11.4651 6.7168 11.9844 6.7168V2.7168C10.8403 2.7168 9.70931 3.00068 8.7999 3.56525C7.92045 4.11123 6.97266 5.12528 6.97266 6.58655H10.9727ZM11.9844 6.7168C12.5037 6.7168 12.8785 6.85147 13.0592 6.96362C13.2698 7.09436 12.9962 7.01518 12.9962 6.58655H16.9962C16.9962 5.12528 16.0484 4.11123 15.1689 3.56525C14.2595 3.00068 13.1285 2.7168 11.9844 2.7168V6.7168Z' fill='%23010432' mask='url(%23path-8-inside-1)'/%3E%3C/svg%3E%0A");
          }*/
        }
        &--joined {
          color: $text-primary-color;
          background: #a1afd333;
        }
      }
    }
  }
</style>
