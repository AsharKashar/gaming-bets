<template>
  <div>
    <profile-header />
    <div class="profile-content">
      <div class="profile-sublinks invisible-scrollbar">
        <sub-links-columns
          :links="links"
          colors-class="font-gray"
          class="profile-links"
        />
      </div>
      <div class="profile-subpage">
        <nuxt-child />
      </div>
    </div>
  </div>
</template>

<script>
import SubLinksColumns from 'components/SubLinksColumns.vue';
import ProfileHeader from 'components/Profile/ProfileHeader.vue';
import { profileLinks } from 'helpers/links';
import { APP_URL } from 'configs/config';

import { createNamespacedHelpers } from 'vuex';
const layoutModule = createNamespacedHelpers('layout');

export default {
  name: 'Profile',
  components: {
    SubLinksColumns,
    ProfileHeader,
  },
  middleware: ['authenticatedCheck', 'hideHeader'],
  computed: {
    links() {
      return profileLinks;
    },
  },
  methods: {
    ...layoutModule.mapMutations(['setLayoutProps']),
  },
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Profile',
      link: [
        {
          rel: 'canonical',
          href: route,
        },
      ],
    };
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";

.profile-content {
  display: flex;
  max-width: 1150px;
  margin-left: auto;
  margin-right: auto;
  padding-bottom: 5em;

  .profile-sublinks {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    z-index: 1;

    .profile-links {
      flex-direction: column;
      margin-top: 0;
    }
  }
  .profile-subpage {
     flex: 1;
     width: 100%;
     overflow: hidden;
     margin-top: 0;
  }
}

@media only screen and (min-width: $min-resolution) {
  .profile-content {
    flex-direction: column;

    .profile-sublinks {
      flex-basis: 100%;
      width: 100%;
      flex-direction: row;
      background-color: #0f113d;
      position: absolute;
      right: 0;
      overflow: auto;

      .profile-links {
        flex-direction: row;
        justify-content: space-around;
        max-width: fit-content;
        width: auto;
        overflow: visible;
      }
    }

    .profile-subpage {
      padding: 55px 16px;
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .profile-content {
    padding-top: 0;

    .profile-sublinks {
      width: calc(100vw - 96px);
     top: 350px;

      .profile-links {
        max-width: 100%;
        width: 100%;
      }
    }

    .profile-subpage {
      padding: 0;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .profile-content {
    .profile-sublinks {
      top: 288px;
    }
  }
}

@media all and (min-width: $tablet-large-width + 1) {
  .profile-content {
    flex-direction: row;
    align-items: flex-start;

    .profile-subpage {
      margin-left: 4rem;
    }

    .profile-sublinks {
      flex-direction: column;
      flex-basis: 16%;
      width: auto;
      position: inherit;
      background-color: transparent;
      align-items: end;

      .profile-links {
        flex-direction: column;
        max-width: 160px;
        width: auto;
      }
    }
  }
}
</style>
