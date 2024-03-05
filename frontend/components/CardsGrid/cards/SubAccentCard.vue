<template>
  <div
    class="sub-accent"
    @click="openCard"
  >
    <div
      class="grid-card accent-card default-card"
      :style="cardStyle"
    />
    <div class="category-title">
      {{ title }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'SubAccentCard',
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    title: {
      type: String,
      default: 'Untitled',
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
        'background-image': `url(${this.backgroundImage})`,
        'mix-blend-mode': 'luminosity',
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
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.sub-accent {
  .grid-card {
    background-size: cover;
    background-position: center;
    border: 0;
    border-radius: 16px;
    cursor: pointer;
  }

  .category-title {
    font-style: normal;
    font-weight: normal;
    line-height: 120%;
    letter-spacing: 0.05em;
    padding: 23px 3px 0;
    color: $text-primary-color;
    word-break: break-all;
  }
}

@media only screen and (min-width: $min-resolution) {
  .sub-accent {
    .grid-card {
      height: 144px;
    }

    .category-title {
      font-size: 14px;
      padding: 15px 3px 0;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .sub-accent {
    .grid-card {
      height: 120px;
    }

    .category-title {
      font-size: 14px;
      padding: 15px 3px 0;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .sub-accent {
    .grid-card {
      height: 158px;
    }

    .category-title {
      font-size: 16px;
    }
  }
}
</style>
