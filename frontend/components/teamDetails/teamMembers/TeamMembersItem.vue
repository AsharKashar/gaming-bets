<template>
  <v-col
    md="4"
    class="team-members__item"
  >
    <div class="team-members__item-inner">
      <div class="team-members__item-action">
        <v-menu
          v-if="!member.pivot.is_leader"
          offset-y
          attach
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              icon
              v-bind="attrs"
              v-on="on"
            >
              <dots fill="#A1AFD3" />
            </v-btn>
          </template>
          <v-list>
            <v-list-item
              v-for="{name, action} in menuItems"
              :key="name"
            >
              <v-list-item-title
                @click="menuClick(action, member.id)"
                v-text="name"
              />
            </v-list-item>
          </v-list>
        </v-menu>
        <crown v-else />
      </div>
      <div class="team-members__item-avatar">
        <v-avatar size="100%">
          <v-img
            contain
            aspect-ratio="1"
            :src="member.avatar_url || ''"
            :alt="member.name"
          />
        </v-avatar>
      </div>

      <div class="team-members__item-info">
        <div class="team-members__item-info-heading">
          <div class="member-rank">
            <v-img
              contain
              aspect-ratio="1"
              src="~/static/demo/rank.svg"
              alt="computer"
            />
          </div>
          <div class="team-members__item-nickname">
            <div class="team-heading">
              {{ $t('FLAMIE') }}
            </div>
            <div
              class="team-members__item-name"
              v-text="member.name"
            />
          </div>
        </div>
        <div class="team-members__item-info-date">
          <div>
            <div class="team-heading">
              {{ $t('Joined Team') }}
            </div>
            <div v-text="joinedDate" />
          </div>
          <div style="text-align: center;">
            <div class="team-heading">
              {{ $t('Played Games') }}
            </div>
            <div>24</div>
          </div>
        </div>
      </div>
    </div>
  </v-col>
</template>

<script>
import Crown from '../../svgIcons/Crown';
import Dots from '../../svgIcons/Dots';
import moment from 'dayjs';

export default {
  name: 'TeamMembersItem',
  components: {
    Crown,
    Dots,
  },
  props: {
    member: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    menuItems: [
      {
        name: 'Make Captain',
        action: 'MAKE_CAPITAN',
      },
      {
        name: 'Make Bench Player',
        action: 'MAKE_PLAYER',
      },
      {
        name: 'Remove Member',
        action: 'DELETE',
      },
    ],
  }),
  computed: {
    joinedDate() {
      return moment(this.member.created_at).format('DD/MM/YYYY');
    },
  },
  methods: {
    menuClick(action, id) {
      console.log(action, id);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/mixins";
.team-members__item {
  &-inner {
    padding: 35px 24px 20px;
    @include beveled-corners($secondary-background, 25px, 0);
    display: flex;
    flex-wrap: wrap;
    height: 100%;
    position: relative;
  }

  &-action {
    position: absolute;
    right: 26px;
    top: 16px;
    .v-btn {
      margin: -5px -16px -5px 0;
    }
    .v-list {
      background: $button-primary-background;
      .v-list-item {
        color: $app-background!important;
      }
    }
  }

  &-avatar {
    width: 88px;
    height: 88px;
    margin-right: 16px;
    margin-top: -6px;
  }

  .team-heading {
    color: $text-hover-color;
    font-weight: 800;
  }

  &-nickname {
    width: 100%;
    max-width: calc(100% - 48px);
    flex: 0 0 calc(100% - 48px);
  }

  &-name {
    font-size: 20px;
    line-height: 1;
  }

  &-info {
    width: 100%;
    max-width: calc(100% - 104px);
    flex: 0 0 calc(100% - 104px);
    padding: 0 10px;

    &-heading {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      padding-bottom: 20px;
      margin: 0 -10px;
      .member-rank {
        width: 32px;
        margin-right: 16px;
      }
    }
    &-date {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -10px;
      & > div {
        width: 100%;
        max-width: 50%;
        flex: 0 0 50%;
        padding: 0 10px;
        font-weight: 800;
        color: $text-primary-color;
        .team-heading {
          font-size: 12px;
        }
      }
    }
  }
}
</style>
