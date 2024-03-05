<template>
  <div class="user-info__wrap">
    <div
      v-if="user"
      class="user-info"
    >
      <div class="user-info__heading">
        <div class="user-info__heading-col--left">
          <img
            src="~static/images/badges-rank-silver.png"
            alt="rang"
          >
        </div>
        <div class="user-info__heading-col--right">
          <div
            class="user-info__name"
            v-text="user.name"
          />
          <div class="user-info__rang">
            junior
          </div>
        </div>
      </div>
      <div
        v-for="(item, key) in items"
        :key="key"
        class="user-info__store-item"
      >
        <div class="user-info__store-item-inner">
          <img
            :src="item.imgSrc"
            :alt="item.type"
          >
          <div class="item-amount">
            {{ user[item.valueKey] || 0 }}
          </div>
          <img
            class="plus"
            src="~static/icons/plus.svg"
            alt="plus"
          >
        </div>
      </div>
    </div>
    <default-button
      v-else
      type="button"
      :on-click="login"
    >
      {{ $t("Sign in") }}
    </default-button>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import DefaultButton from 'components/DefaultButton';
const { mapState } = createNamespacedHelpers('auth');
const moduleModal = createNamespacedHelpers('modal');

export default {
  name: 'UserInfoHeading',
  components: { DefaultButton },
  data:() => ({
    items:[

      {
        type:'challenges',
        imgSrc:require('static/icons/challenge-cup.svg'),
        valueKey: 'all_challenges',
        redirectTo:''
      },
      {
        type:'bombs',
        imgSrc:require('static/icons/bomb.svg'),
        valueKey: 'all_bombs',
        redirectTo:''
      }
    ]
  }),
  computed: mapState(['user']),
  methods: {
    ...moduleModal.mapMutations(['setActiveModal']),
    login() {
      this.setActiveModal({ type: 'LoginForm' });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.user-info {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  &__heading {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;

    &-col {
      &--left {
        max-width: 41px;
        padding-right: 11px;
        flex: 0 0 59px;
        img {
          max-width: 100%;
          max-height: 42px;
        }
      }
      &--right {
        max-width: calc(100% - 59px);
        flex: 0 0 calc(100% - 59px);
        display: flex;
        flex-wrap: wrap;
        & > div {
          width: 100%;
        }
      }
    }
  }
  &__name {
    color: $text-primary-color;
    line-height: 1.2;
    font-weight: 800;
    font-size: 13px;
  }
  &__store-item {
    clip-path: polygon(9% 0, 100% 0, 100% 85%, 94% 99%, 0 100%, 0 22%);
    background: rgb(33,39,79);
    margin-right: 15px;
    padding: 2px;
    &-inner {
      padding: 5px 0 5px 8px;
      clip-path: polygon(9% 0, 100% 0, 100% 85%, 94% 99%, 0 100%, 0 22%);
      background: $app-background;
      display: flex;
      justify-content: center;
      align-items: center;
      img {
        height: 32px;
        width: 32px;
      }
      .plus{
        height: 16px;
        width: 16px;
        margin-right: 12px;
      }
      .item-amount{
        padding: 0 13px;
        font-size: 15px;
        font-style: normal;
        font-weight: 800;
        line-height: 22px;
        text-align: left;

      }
    }
    &:last-child{
      margin-right: 0;
    }
  }
}
</style>
