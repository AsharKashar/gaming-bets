<template>
  <div class="page-container">
    <div class="page-tite-section">
      <v-row>
        <v-col
          md="7"
          class="static-page-title"
        >
          {{ pageTitle }}
        </v-col>
        <v-col md="5">
          <slot name="right-title" />
        </v-col>
      </v-row>
    </div>
    <div class="page-detail-section">
      <v-row>
        <v-col md="6">
          <slot name="left-detail-section" />
        </v-col>
        <v-col md="6">
          <slot name="right-detail-section" />
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>

export default {
  name: 'StaticPageWrapper',
  props: {
    pageTitle: {
      type: String,
      default: 'page-title'
    }
  }
};
</script>


<style scoped lang="scss">
@import "~/assets/styles/colors";

.static-page-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  text-align: start;
  font-weight: 900;
  color: $text-primary-color;
  font-size: 56px;
  line-height: 59px;
}
.page-tite-section {
  margin-top: 56px;
}
.page-detail-section {
  color: $text-primary-color;
  font-style: normal;
  font-weight: normal;
  font-size: 20px;
  line-height: 94%;
  margin: 56px 0;
}
</style>

