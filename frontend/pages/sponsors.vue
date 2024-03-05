<template>
  <div class="page-container">
    <div class="page-tite-section">
      <v-row>
        <v-col
          md="6"
          class="static-page-title"
        >
          {{ $t('Our sponsors') }}
        </v-col>
        <v-col md="6">
          <span
            class="heading-text"
          >{{ $t('Id enim nulla tempor veniam labore enim aute. Minim minim laboris ut elit aute reprehenderit nulla eiusmod.') }}</span>
        </v-col>
      </v-row>
    </div>
    <div class="page-detail-section">
      <v-row>
        <v-col
          md="3"
          sm="6"
          xs="6"
        >
          <div class="sponsor-card">
            <img
              v-lazy-load
              src="~/static/icons/originsFruit.svg"
              class="origins-fruit"
            >
          </div>
        </v-col>
        <v-col
          md="3"
          sm="6"
          xs="6"
        >
          <div class="sponsor-card">
            <img
              v-lazy-load
              src="~/static/icons/rent4wear.svg"
              class="rent"
            >
          </div>
        </v-col>
        <v-col
          md="3"
          sm="6"
          xs="6"
        >
          <div class="sponsor-card">
            <img
              v-lazy-load
              src="~/static/icons/sponsor_image.svg"
              class="another-sponsor"
            >
          </div>
        </v-col>
        <v-col
          md="3"
          sm="6"
          xs="6"
        >
          <div class="sponsor-card">
            <img
              v-lazy-load
              src="~/static/icons/tydlos.svg"
              class="tydlos"
            >
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'Sponsors',
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Sponsors',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors";
.page-container {
  color: $text-primary-color;
}
.page-tite-section {
  margin-top: 56px;
}

.static-page-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  text-align: start;
  font-weight: 900;
  color: $text-primary-color;
  font-size: 56px;
  line-height: 59px;
}

.page-detail-section {
  margin: 56px 0;

  .sponsor-card {
    border: 2px solid $text-primary-color;
    box-sizing: border-box;
    border-radius: 32px;
    min-width: 260px;
    height: 216px;
    display: flex;
    align-items: center;
    justify-content: center;

    .origins-fruit {
      width: 240px;
    }
    .rent {
      height: 80px;
    }
    .tydlos {
      height: 85px;
    }
    .another-sponsor {
      width: 151px;
    }
  }
}

.heading-text {
  font-size: 24px;
  line-height: 25px;
  letter-spacing: 0.05em;
}
</style>
