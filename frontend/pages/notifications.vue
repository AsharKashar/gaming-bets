<template>
  <div class="notification-page">
    <NotificationHeader @close-menu="$emit('close-menu')" />

    <NotificationFilter
      ref="filter"
      :loading="loading"
      :filters-params="filtersParams"
      :available-filters="availableFilters"
      :available-dates="availableDates"
      :set-filter-key="(val, key) => preFormatFilter(val, key)"
    />
    <div
      v-if="!noNotifications && filtersParams.read === 1"
      class="read-all"
    >
      <button @click="readAll()">
        mark all as read
      </button>
    </div>

    <loader
      :loading="loading"
      :overlay="false"
      :center="true"
      height="200px"
    >
      <div
        class="notifications-list"
        :class="{ 'no-notification-list': noNotifications }"
      >
        <template v-for="(notification, index) in notificationsList.data">
          <SingleNotification
            :key="index"
            :notification="notification"
            :index="index"
          />
        </template>
      </div>
    </loader>

    <pagination
      v-if="!noNotifications"
      :page="currentPage"
      :total="lastPage"
      :set-page="(page) => setPage(page, $refs.filter.offsetTop, true)"
    />

    <div
      v-if="noNotifications && !loading"
      class="no-notification"
    >
      No Notifications
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const notificationsModule = createNamespacedHelpers('notifications');
const authModule = createNamespacedHelpers('auth');
import { STATE_STATUSES } from 'helpers/constants';
import mixinFilterRout from '@/mixins/mixinFilterRout';
import Loader from 'components/Loader.vue';
import NotificationHeader from 'components/notifications/NotificationHeader';
import NotificationFilter from 'components/notifications/NotificationFilter';
import SingleNotification from 'components/notifications/SingleNotitifcation';
import Pagination from 'components/Pagination';
import moment from 'dayjs';
import get from 'lodash/get';
import { APP_URL } from 'configs/config';

const availableDates = [
  {
    title: 'Today',
    name: 'today',
  },
  {
    title: 'Yesterday',
    name: 'Yesterday',
  },
  {
    title: 'Week ago',
    name: 'weekAgo',
  },
  {
    title: 'Two Weeks ago',
    name: 'twoWeekAgo',
  },
  {
    title: 'Month ago',
    name: 'monthAgo',
  },
];

export default {
  name: 'NotificationsPage',
  components: {
    NotificationHeader,
    NotificationFilter,
    SingleNotification,
    Loader,
    Pagination,
  },
  mixins: [mixinFilterRout],
  async asyncData({store, route}) {
    await store.dispatch('notifications/getFilters');

    return ({
      initFilter: {
        read: 1,
        from_date: '',
        to_date: '',
        page: 1,
        types: '',
        date: availableDates[0].name,
        ...route.query,
      },
      debounceTime: 1000,
      availableDates,
    });
  },
  computed: {
    ...notificationsModule.mapState([
      'notificationsList',
      'status',
      'availableFilters',
    ]),

    loading() {
      return this.status === STATE_STATUSES.PENDING;
    },

    noNotifications() {
      return (
        !this.notificationsList.data || !this.notificationsList.data.length
      );
    },

    currentPage() {
      return +this.filtersParams.page;
    },

    lastPage() {
      return get(this, 'notificationsList.last_page', 1);
    },
  },
  methods: {
    ...notificationsModule.mapActions([
      'getUserNotifications',
      'markNotificationsAsRead',
    ]),
    ...authModule.mapActions(['getMe']),

    async readAll() {
      await this.markNotificationsAsRead();
      await this.getMe();
      await this.callbackFilter(this.initFilter);
    },

    callbackFilter(filter) {
      this.getUserNotifications({
        ...filter,
        types: [filter.types],
        perPage: 8,
      });
    },
    preFormatFilter(val, key) {
      if (key === 'date') {
        this.setFilterKey(val, key, true);
        this.setDates(val);
        return;
      }
      this.setFilterKey(val, key, true);
    },
    setDates(date) {
      this.setFilterKey(moment().format('YYYY-MM-DD'), 'to_date', true);
      let fromDate = '';
      switch (date) {
        case 'today':
          fromDate = moment();
          break;
        case 'Yesterday':
          fromDate = moment();
          break;
        case 'weekAgo':
          fromDate = moment().subtract(1, 'weeks');
          break;
        case 'twoWeekAgo':
          fromDate = moment().subtract(2, 'weeks');
          break;
        case 'monthAgo':
          fromDate = moment().subtract(1, 'months');
          break;
        default:
          break;
      }
      this.setFilterKey(moment(fromDate).format('YYYY-MM-DD'), 'from_date', true);
    },
  },
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Notifications',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors";

.notification-page {
  margin-bottom: 16px;

  &::v-deep {
    .pagination-container {
      justify-content: flex-end;
    }
  }

  .read-all {
    font-weight: 800;
    font-size: 14px;
    line-height: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    letter-spacing: 0.05em;
    text-decoration-line: underline;
    color: $text-secondary-color;
    margin-top: 40px;
    margin-bottom: 20px;

    button {
      text-transform: uppercase;
    }
  }
  .no-notification {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 24px;
    line-height: 110%;
    margin-top: 32px;
    color: $text-primary-color;
  }

  .notifications-list {
    margin: 20px 0;
  }
}
</style>
