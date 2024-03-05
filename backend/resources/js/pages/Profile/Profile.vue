<template>
  <banger-layout :class="[contentClass]">
    <profile-header/>
    <b-container>
      <b-row>
        <b-col cols="6" offset="3">
          <profile-picture></profile-picture>
          <profile-detail></profile-detail>
        </b-col>
      </b-row>
    </b-container>

  </banger-layout>
</template>

<script>
  import BangerLayout from 'Layouts/BangerLayout'
  import ProfileHeader from 'Partials/ProfileHeader'
  import ProfilePicture from 'Components/profile/ProfilePicture'
  import ProfileDetail from 'Components/profile/ProfileDetail'

  import { createNamespacedHelpers } from 'vuex'

  const { mapActions, mapState } = createNamespacedHelpers('auth')

  export default {
    components: {
      ProfileHeader,
      BangerLayout,
      ProfilePicture,
      ProfileDetail,
    },
    computed: {
      ...mapState({
        isAuthenticated: 'isAuthenticated',
      }),
    },
    data: () => ({
      contentClass: { grey: true, 'lighten-4': true, 'accent--text': true },
    }),
    created () {
      if (!this.isAuthenticated) {
        this.$router.push({ name: 'home' })
      }
    },

  }
</script>
<style scoped>
  h2{
    color:black;
  }
</style>
