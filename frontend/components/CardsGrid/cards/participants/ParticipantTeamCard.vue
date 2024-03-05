<template>
  <div class="team__item">
    <v-hover v-slot:default="{ hover }">
      <div class="team__item-inner">
        <div class="team__item-content">
          <img
            v-if="avatarUrl"
            :src="avatarUrl"
            :alt="name"
          >
          <div
            class="team__name"
            v-text="name"
          />
        </div>
        <v-scale-transition>
          <div
            v-if="hover"
            class="team__member-wrap"
          >
            <div class="team__member-inner">
              <div
                class="team__name"
              />
              <div class="team__member-list">
                <div
                  v-for="member in members"
                  :key="member.name"
                  class="team__member-item"
                >
                  <country-flag
                    size="small"
                    :country="member.country_code"
                  />
                  {{ member.name }}
                </div>
              </div>
            </div>
          </div>
        </v-scale-transition>
      </div>
    </v-hover>
  </div>
</template>

<script>
import CountryFlag from 'vue-country-flag';

export default {
  name: 'ParticipantTeamCard',
  components: {
    CountryFlag
  },
  props: {
    members: {
      type: Array,
      required: true,
    },
    avatarUrl: {
      type: String,
      default: ''
    },
    name: {
      type: String,
      required: true,
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .team {
    &__item {
      width: 100%;
      max-width: 25%;
      flex: 0 0 25%;
      padding: 12px 15px;
      &-inner {
        background: #121642;
        padding: 15px 15px 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 240px;
        clip-path: polygon(7% 0, 100% 0, 100% 93%, 92% 100%, 0 100%, 0 9%);
        position: relative;
        font-weight: 900;
        line-height: 1.2;
        color: $text-hover-color;
        &:hover {
          .team__name {
            visibility: hidden;
          }
        }
      }
      &-content {
        text-align: center;
        & > img {
          padding-bottom: 22px;
        }
        .team__name {
          padding-bottom: 11px;
        }
      }
    }
    &__name {
      font-size: 20px;
    }
    &__member {
      &-wrap {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background:  rgba(161, 175, 211, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        .team__name {
          color: $text-primary-color;
        }
      }
      &-item {
        position: relative;
        padding-left: 25px;
        .flag {
          transform: scale(.3);
          position: absolute;
          left: -20px;
          top: -10px;
        }
      }
    }
  }
</style>
