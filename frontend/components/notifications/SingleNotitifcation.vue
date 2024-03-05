<template>
  <div class="notification-box">
    <div
      v-if="isMenu"
      class="cross"
      @click="markRead(notification)"
    >
      <Cross
        color="#A1AFD3"
        stroke-width="6"
        height="8"
        width="8"
      />
    </div>
    <div class="notitication-inner">
      <div class="notification-icon">
        <v-avatar
          tile
          size="20"
        >
          <img
            src="~/static/icons/Notification_p.svg"
            alt="Notification"
          >
        </v-avatar>
      </div>
      <div class="notification-details">
        <div class="text">
          {{ notificationTitle }}
        </div>
        <div class="notification-actions">
          <div class="time">
            {{ timeFromNow }}
          </div>
          <div
            v-if="isMenu"
            class="action-box"
          >
            <div
              v-if="isUpdate"
              class="action-btn secondery--text"
            >
              {{ $t("download") }}
            </div>
            <div
              v-if="isInvitation"
              class="action-btn primary--text"
              @click="details = !details"
            >
              {{ details ? $t("hide") : $t("details") }}
            </div>
            <div
              v-else
              class="action-btn primary--text"
              @click="notificationDetailsAction()"
            >
              {{ $t("details") }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <template v-if="isInvitation">
      <Invitation
        :tournament="notification.data ? notification.data.tournament : {}"
        :details="isMenu ? details : true"
      />
    </template>
  </div>
</template>

<script>
import Cross from 'components/svgIcons/Cross';
import Invitation from './Invitation';
import dayjs from 'dayjs';
import { notificationType } from 'helpers/notifications';
import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime);

export default {
  name: 'SingleNotification',
  components: {
    Cross,
    Invitation,
  },
  props: {
    notification: {
      type: Object,
      default: () => {},
    },
    isMenu: {
      type: Boolean,
      default: false,
    },
    markRead: {
      type: Function,
      default: () => {},
    },
  },
  data: () => ({
    details: false,
  }),
  computed: {
    notificationTitle() {
      let details = notificationType(this.notification.reason);
      return details.title;
    },

    notificationDetailsAction() {
      switch (this.notification.reason) {
        case 'tournament_started': {
          return () =>
            this.$router.push(
              `/tournaments/${this.notification.data.id}/overview`
            );
        }
        default:
          return () => {
            console.log('default');
          };
      }
    },

    isUpdate() {
      return !!this.notification.update;
    },

    isInvitation() {
      return this.notification.reason === 'join_tournament_invitation';
    },

    timeFromNow() {
      return dayjs(this.notification.created_at).fromNow();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.notification-box {
  padding: 5px 0;
  position: relative;
  min-height: 49px;
  border-bottom: 1px solid $text-primary-color;

  .notitication-inner {
    display: flex;
  }

  .cross {
    position: absolute;
    top: -3px;
    right: 0px;
    cursor: pointer;
  }

  .notification-icon {
    clip-path: polygon(25% 0, 100% 0%, 100% 100%, 0 100%, 0 25%);
    display: flex;
    justify-content: center;
    width: 32px;
    height: 32px;
    padding: 8px;
    background: $text-secondary-color;
    opacity: 0.2;
  }
  .notification-details {
    margin-left: 8px;
    width: 91%;

    .text {
      font-size: 14px;
      line-height: 100%;
      letter-spacing: 0.02em;
      color: #ffffff;
    }

    .notification-actions {
      margin-top: 8px;
      display: flex;

      .time {
        font-size: 14px;
        line-height: 100%;
        display: flex;
        align-items: center;
        letter-spacing: 0.02em;
        color: $text-primary-color;
        opacity: 0.5;
        flex-basis: 40%;
      }
      .action-box {
        flex-basis: 60%;
        display: flex;
        justify-content: flex-end;
      }

      .action-btn {
        font-weight: 800;
        font-size: 12px;
        line-height: 100%;
        letter-spacing: 0.05em;
        text-decoration-line: underline;
        cursor: pointer;
      }
      .action-btn:not(:last-child) {
        margin-right: 8px;
      }
    }
  }
}
</style>
