<template>
  <div class="notifications-wrapper">
    <NotificationHeader
      menu-header
      :total-count="notificationsList.length"
      @close-menu="$emit('close-menu')"
    />

    <div
      class="notifications-list"
      :class="{ 'no-notification-list': noNotifications }"
    >
      <template v-for="(notification, index) in notificationsList">
        <SingleNotitifcation
          :key="index"
          :is-menu="true"
          :notification="notification"
          :index="index"
          :mark-read="markRead"
        />
      </template>
      <div
        v-if="noNotifications"
        class="no-notification"
      >
        <notification-icon
          :has-notification="true"
          :color="'#A1AFD3'"
        />
        <div class="no-notification-title">
          No Notifications
        </div>
        <div class="no-notification-subtitle">
          Your recent notifications will show up here
        </div>
      </div>
    </div>
    <div class="d-flex justify-end mt-4">
      <div
        class="view-all"
        @click="viewAll"
      >
        {{ $t("view all") }}
      </div>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const authModule = createNamespacedHelpers('auth');
const notificationsModule = createNamespacedHelpers('notifications');
import SingleNotitifcation from './SingleNotitifcation';
import NotificationHeader from './NotificationHeader';
import NotificationIcon from 'components/svgIcons/NotificationIcon.vue';

export default {
  name: 'NotificationsMenu',
  components: {
    SingleNotitifcation,
    NotificationHeader,
    NotificationIcon,
  },
  data: () => ({}),
  computed: {
    ...authModule.mapState(['user']),
    ...notificationsModule.mapState(['notifications']),

    noNotifications() {
      return !this.notificationsList.length;
    },

    notificationsList() {
      return this.notifications.data
        ? this.notifications.data.filter((item) => item.read !== 1)
        : [];
    },
  },
  methods: {
    ...notificationsModule.mapActions([
      'getUserNotifications',
      'markNotificationsAsRead',
    ]),

    markRead(notification) {
      const params = {
        read_notifications_ids: [notification.id],
      };
      this.markNotificationsAsRead(params);
    },
    viewAll() {
      if (this.$route.name !== 'notifications') {
        this.$router.push('/notifications');
      }
      this.$emit('close');
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.notifications-wrapper {
  padding: 40px 0;
  width: 540px;
  height: 567px;
  background: #010431;
  border: 4px solid $text-primary-color;
  border-radius: 32px;

  .no-notification-list {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .no-notification {
    display: flex;
    color: $text-primary-color;
    flex-direction: column;
    align-items: center;

    .no-notification-title {
      font-style: normal;
      font-weight: 800;
      font-size: 20px;
      line-height: 110%;
    }
    .no-notification-subtitle {
      font-weight: normal;
      font-size: 16px;
      line-height: 140%;
    }
  }

  .title-text,
  .view-all {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    color: $text-secondary-color;
  }

  .view-all {
    font-size: 14px;
    line-height: 100%;
    padding: 0 40px;
    letter-spacing: 0.05em;
    text-decoration-line: underline;
    cursor: pointer;
  }

  .title-bar {
    justify-content: space-between;
    display: flex;
    align-items: center;
    padding: 0 40px;

    .text-counter {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .title-text {
      font-size: 32px;
      line-height: 115%;
      letter-spacing: 0.02em;
      font-feature-settings: "ss03" on;
    }

    .title-counter {
      width: 28px;
      height: 28px;
      background: $text-secondary-color;
      color: "#E7E7E7";
      border-radius: 50%;
      margin-left: 13px;
      display: flex;
      align-items: center;
      padding: 0 10px;
      justify-content: center;
    }
    .cross {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      cursor: pointer;
    }
  }

  .notifications-list {
    height: 80%;
    overflow-y: auto;
    padding: 0 40px;
    margin: 20px 0;

    &::-webkit-scrollbar {
      width: 6px;
      border-radius: 22px;
    }

    &::-webkit-scrollbar-track {
      background: #010431; /* color of the tracking area */
    }
    &::-webkit-scrollbar-thumb {
      background-color: $text-secondary-color; /* color of the scroll thumb */
      border-radius: 20px; /* roundness of the scroll thumb */
    }
    &::-webkit-scrollbar-thumb:hover {
      background-color: #920a27;
    }
  }
}
</style>
