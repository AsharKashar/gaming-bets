<template>
  <v-footer
    :class="[footerClass]"
    app
  >
    <v-spacer />
    <span>© {{ year }} {{ domain }} ®™</span>
    <v-spacer />
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    footerClass: { 'white--text': true, red: true, 'lighten-2': true },
    year: new Date().getFullYear(),
    domain: 'bangergames.com',
    trademark: 'mytrademark'
  }),
  created() {
    /* Emit On a Child Component If You Want This To Be Visible */
    window.Bus.$on('footer-content-visible', visibility => {
      this.contentVisible = visibility;
    });
  }
};
</script>

<style>
</style>
