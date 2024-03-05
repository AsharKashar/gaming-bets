<template>
  <v-row class="profile">
    <v-col cols="12">
      <h1 class="subtitles-primary mb-6">
        General Info
      </h1>
    </v-col>
    <v-col
      cols="12"
      class="pt-0"
    >
      <v-row>
        <v-col
          cols="3"
          style="flex: 0"
          class="pt-0"
        >
          <v-avatar
            height="97"
            width="97"
            :class="{ 'profile-picture': user && !!user.avatar_url }"
            @click.native="showDetailModal = true"
          >
            <img
              v-if="user && user.avatar_url"
              :src="user.avatar_url"
              :alt="user.name ? user.name : 'John Doe'"
            >
            <UserIcon
              v-else
              class="user-icon"
              color="#be1338"
            />
          </v-avatar>
        </v-col>
        <v-col style="padding-left: 0">
          <div class="profile-action">
            <span>Profile Picture</span>
            <a @click="showAvatarModal = true">Edit</a>
          </div>
        </v-col>
        <default-modal
          :show="showAvatarModal"
          :close-modal="closeAvatarModal"
        >
          <upload-photo :on-submit="onSubmit" />
        </default-modal>
      </v-row>
    </v-col>

    <detail-statistic
      v-if="showDetailModal"
      :on-submit="onSubmit"
    />
  </v-row>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import DefaultModal from 'components/modals/DefaultModal';
import UploadPhoto from './General/UploadPhoto';
import UserIcon from 'components/svgIcons/UserIcon.vue';
import DetailStatistic from 'components/Profile/DetailStatistic';
const { mapState, mapActions } = createNamespacedHelpers('auth');
export default {
  name: 'ProfilePicture',
  components: {
    DefaultModal,
    UploadPhoto,
    DetailStatistic,
    UserIcon,
  },
  data() {
    return {
      showAvatarModal: false,
      showDetailModal: false,
    };
  },
  computed: {
    ...mapState(['user', 'isAuthenticated']),
  },
  methods: {
    ...mapActions(['getMe']),
    closeAvatarModal() {
      this.showAvatarModal = false;
    },
    closeDetailModal() {
      this.showDetailModal = false;
    },
    onSubmit() {
      this.getMe();
      this.showDetailModal = false;
      this.closeAvatarModal();
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";
.profile-picture {
  border: 3px solid #be1338;
}
.span {
  color: #a1afd3;
  font-size: 24px;
}
a {
  clear: both;
  color: #be1338;
  text-decoration: none;
}
.profile-action {
  display: flex;
  flex-direction: column;
  padding: 10px 0px;
  color: $text-primary-color;
  font-size: 20px;
  a {
    text-transform: lowercase;
  }
}

@media only screen and (max-width: $mobile-width) {
  .profile {
    .col.col-12 {
      padding-top: 0;
      padding-bottom: 0;
    }

    &-picture {
      width: 72px !important;
      height: 72px !important;
    }
    &-action {
      padding-left: 2rem;
    }
  }
}
.subtitles-primary {
  text-transform: capitalize;
}
</style>
