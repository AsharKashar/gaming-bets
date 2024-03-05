<template>
  <div>
    <v-container class="pt-0">
      <v-row>
        <v-col
          cols="12"
          class="profile-box pt-0"
        >
          <v-card>
            <v-list>
              <v-list-item class="px-0">
                <v-list-item-content>
                  <v-list-item-title>{{ $t('Name') }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>{{ user.name }}</v-list-item-action>
              </v-list-item>

              <v-divider class="c-divider" />

              <v-list-item class="px-0">
                <v-list-item-content>
                  <v-list-item-title>{{ $t('Username ID') }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <div class="username pr-0">
                    <span>{{ user.username }}</span>
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <img
                          src="~/static/icons/username.svg"
                          class="info-icon"
                          v-bind="attrs"
                          v-on="on"
                        >
                      </template>
                      <span>This is your user Id used in Database  </span>
                    </v-tooltip>
                  </div>
                </v-list-item-action>
              </v-list-item>

              <v-divider class="c-divider" />

              <v-list-item class="px-0">
                <v-list-item-content>
                  <v-list-item-title>{{ $t('Email') }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>{{ user.email }}</v-list-item-action>
              </v-list-item>

              <v-divider class="c-divider" />

              <v-list-item class="px-0">
                <v-list-item-content>
                  <v-list-item-title>{{ $t('Password') }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action class="text-primary">
                  * * * * * * * *
                </v-list-item-action>
              </v-list-item>

              <v-divider class="c-divider" />

              <router-link
                to="profile/change-password"
                class="reset-password"
              >
                {{ $t('change password') }}
              </router-link>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('auth');

export default {
  name: 'ProfileDetail',
  data: () => ({
    data: {
      name: '',
      email: '',
      image: '',
    },
  }),
  computed: {
    ...mapState(['user']),
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";
.v-card,
.v-list,
.v-sheet,.theme--dark {
  background: transparent;
  box-shadow: none;
}
.text-primary {
  color: $text-primary-color !important;
}
.c-divider {
  border-color: $text-primary-color;
  border-width: 1px;
}
.profile-links {
  flex-direction: column;
}
a {
  color: #be1338;
  text-decoration: none;
}

.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: none;
}
.v-list-item__content {
  color: #a1afd3;
}
.v-list-item__action {
  color: #be1338;
  font-size: 20px;
}
.v-list-item {
  font-size: 24px;
}
.info-icon {
  width: 20px;
  height: 20px;
  top: 12px;
}

.container {
  .profile-box {
    .reset-password {
      margin-top: 1rem;
      display: inline-block;
      font-size: 20px;
      line-height: 100%;
      font-weight: 800;
    }
    .username {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding-right: 1rem;
    }

    .v-list-item {
      &__action,
      &__content {
        width: 50%;
      }
      &__action {
        word-break: break-all;
      }
      &__content {
        .v-list-item__title {
          font-size: 20px;
          line-height: 100%;
          letter-spacing: 0.05em;
        }
      }
    }
  }
}

@media only screen and (max-width: $mobile-width) {
  .container {
    padding-left: 0;
    padding-top: 0;
    .profile-box {
      padding-left: 0;
      padding-top: 0;

      .username {
        padding: 0;
      }

      .v-list-item {
        display: block;
        font-size: 16px;

        &__content {
          padding-bottom: 0;
        }

        &__action {
          margin: 5px 0;
          word-break: break-all;
          width: 100%;
        }
      }
    }
  }
}
</style>
