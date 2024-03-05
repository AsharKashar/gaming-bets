<template>
  <div
    class="grid-card accent-card default-card"
    :style="cardStyle"
  >
    <div class="category-title">
      {{ title }}
    </div>
    <default-button
      class="accent-card-btn"
      :on-click="openCard"
    >
      {{ $t('Read more') }}
    </default-button>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';

export default {
  name: 'AccentCard',
  components: {
    DefaultButton,
  },
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    title: {
      type: String,
      default: 'Untitled',
    },
    subtitle: {
      type: String,
      default: '',
    },
    slug: {
      type: String,
      default: '',
    },
    backgroundImage: {
      type: String,
      default: '',
    },
  },
  computed: {
    cardStyle() {
      return {
        'background-image': `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), url(${this.backgroundImage})`,
      };
    },
  },
  methods: {
    openCard() {
      this.$router.push(this.slug);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.hide-border {
  border: none;
}
.hide-buttons {
  .default-banger-btn {
    visibility: hidden;
  }
}
.accent-card {
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-end;

  .category-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    line-height: 120%;
    letter-spacing: 0.05em;
    color: #a1afd3;
    word-break: break-all;
  }

  .accent-card-btn {
    position: absolute;
    bottom: -27px;
    left: 25px;
  }
}

@media only screen and (min-width: $min-resolution) {
  .accent-card {
    height: 320px;
    border-color: $app-background;

    .category-title {
      font-weight: 800;
      font-size: 20px;
      line-height: 94%;
    }

    .accent-card-btn {
      display: none;
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .accent-card {
    .category-title {
      padding: 0 0 8px;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .accent-card {
    height: 320px;
    border-color: $border-primary-color;

    .category-title {
      font-weight: 800;
      font-size: 16px;
      line-height: 94%;
      padding: 0 25px 30px;
    }

    .accent-card-btn {
      display: none;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .accent-card {
    height: 406px;

    .category-title {
      font-weight: 800;
      font-size: 24px;
      margin-bottom: 62px;
      padding: 0 25px;
    }

    .accent-card-btn {
      display: block;
    }
  }
}
</style>
