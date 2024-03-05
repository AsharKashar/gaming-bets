<template>
  <div class="tournament-nav">
    <div class="tournament-nav__list">
      <nuxt-link
        v-for="({path, title}) in nav"
        :key="title"
        :to="`${navPrefix}${ tournamentId }${path || ''}${$route.query.gameMode ? '?gameMode='+ $route.query.gameMode : ''}`"
        class="tournament-nav__item"
      >
        <span class="tournament-nav__item-inner">
          <span
            class="tournament-nav__item-link"
            v-text="title"
          />
        </span>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BoxfightChildNavigation',
  meta: {
    savePosition: true,
  },
  props: {
    nav: {
      type: Array,
      default: () => [
        {
          title: 'Overview',
          path: '/overview',
        },
        {
          title: 'Rules',
          path: '/rules',
        },
        {
          title: 'Participants',
          path: '/participants',
        },
      ],
    },
    navPrefix: {
      type: String,
      default: '/tournaments/boxfight/'
    }
  },
  computed: {
    tournamentId() {
      return this.$route.params.id;
    },
  },
  methods:{
    navigation(name) {
      if (name === this.$route.name) return;
      let gameMode = this.$route.query.gameMode;
      this.$router.push({
        name,
        params: { savePosition: true },
        query: { gameMode },
      });
    },
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
.tournament-nav {
  margin-bottom: 49px;
  &__list {
    display: flex;
    font-size: 20px;
    line-height: 1.2;
    background: $secondary-background;
    clip-path: polygon(19px 0, calc(100% - 10px) 0, 100% 17px, calc(100% - 19px) 100%, 11px 100%, 0 61px);
    width: auto;
    max-width: max-content;
    flex-wrap: wrap;
  }
  &__item {
    display: block;
    text-align: center;
    position: relative;
    width: 188px;
    &:hover,
    &.nuxt-link-active {
      z-index: 2;
      &::before {
        display: none;
      }
      .tournament-nav__item-inner {
        background: $border-primary-color;
      }
    }
    &-inner {
      display: inline-block;
      width: 100%;
      padding: 3px;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
      transition: 0.5s easy;
    }
    &:not(:last-child) {
      margin-right: -16px;
      &::before {
        content: "";
        width: 2px;
        height: 28px;
        position: absolute;
        top: 50%;
        right: 0;
        z-index: 1;
        transform: translateY(-50%) rotate(20deg);
        background: $text-primary-color;
      }
    }
    &-link {
      display: block;
      padding: 24px 15px;
      cursor: pointer;
      background: $secondary-background;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
    }
  }
}
</style>
