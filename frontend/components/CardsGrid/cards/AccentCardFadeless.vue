<template>
  <div
    class="grid-card accent-card default-card"
    :style="{'background-image': `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), url(${backgroundImage})`}"
    @click="openCard"
  >
    <div class="titles-block">
      <v-clamp
        autoresize
        :max-lines="7"
        class="category-title"
      >
        {{ title }}
      </v-clamp>
      <div class="read-time">
        {{ $t('read time 5 min') }}
      </div>
      <v-clamp
        autoresize
        :max-lines="5"
        class="category-subtitle"
      >
        {{ subtitle }}
      </v-clamp>
    </div>
  </div>
</template>

<script>
import VClamp from 'vue-clamp';

export default {
  name: 'AccentCardFadeless',
  components: {
    VClamp,
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
  methods: {
    openCard() {
      this.$router.push(this.slug);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";

.accent-card {
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-end;
  cursor: pointer;
  width: 100%;

  .category-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    line-height: 120%;
    letter-spacing: 0.05em;
    color: #fff;
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
    .read-time,
    .category-subtitle {
      display: none;
    }

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
    height: 240px;
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .accent-card {
    height: 426px;

    .titles-block {
      padding: 0 33px 33px;
    }

    .category-title {
      font-weight: 800;
      font-size: 24px;
      margin-bottom: 13px;
    }

    .read-time,
    .category-subtitle {
      display: none;
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
      margin-bottom: 13px;
    }

    .category-subtitle {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 16px;
      line-height: 94%;
      color: #ffffff;
    }

    .read-time {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 900;
      font-size: 16px;
      line-height: 94%;
      margin-bottom: 16px;
    }

    .accent-card-btn,
    .read-time,
    .category-subtitle {
      display: block;
    }

    .titles-block {
      padding: 0 33px 27px;
    }
  }
}
</style>
