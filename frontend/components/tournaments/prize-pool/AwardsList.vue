<template>
  <div class="awards-list">
    <div
      v-for="item in awards"
      :key="item.place"
      class="awards-item"
    >
      <div class="awards-item__icon">
        <img
          :src="item.icon"
          :alt="`award ${item.place}`"
        >
      </div>
      <div class="awards-item__heading">
        <span>
          {{ item.place }}
          <sup v-text="sup(item.place)" />
        </span>
        <span class="text-uppercase">
          {{ $t('Place') }}
        </span>
      </div>
      <div class="awards-item__description">
        {{ item.reward }} {{ $t('reward') }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AwardsList',
  props: {
    awards: {
      type: Array,
      default: () => ([
        {
          icon: 'https://cdn.bangergames.com/blog-posts/2020/8/a3956dec8407d03ec0203b6cab4dee94-1597130679.png',
          place: 1,
          reward: '100€',
        },
        {
          icon: 'https://cdn.bangergames.com/blog-posts/2020/8/a3956dec8407d03ec0203b6cab4dee94-1597130679.png',
          place: 2,
          reward: '50€',
        },
        {
          icon: 'https://cdn.bangergames.com/blog-posts/2020/8/a3956dec8407d03ec0203b6cab4dee94-1597130679.png',
          place: 3,
          reward: '25€',
        },
      ])
    }
  },
  methods: {
    sup(place) {
      return ({
        1: 'st',
        2: 'nd',
        3: 'rd',
      })[place];
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors.scss";
  .awards {
    &-list {
      display: flex;
      margin: 0 -15px 35px;
    }
    &-item {
      width: 100%;
      flex: 0 0 33.333333%;
      max-width: 33.333333%;
      padding: 0 15px 15px;

      line-height: 1.2;
      font-weight: 800;
      &__heading {
        font-size: 32px;
        color: $text-secondary-color;
        &>:first-child {
          font-size: 46px;
          sup {
            font-size: 24px;
          }
        }
      }
      &__description {
        text-transform: uppercase;
        font-size: 24px;
        color: $text-primary-color;
      }
    }
  }
</style>
