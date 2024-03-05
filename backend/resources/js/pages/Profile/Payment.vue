<template>
  <banger-layout :class="[contentClass]">
    <profile-header />
    <b-container>
      <b-row>
        Payment
      </b-row>
    </b-container>
  </banger-layout>
</template>

<script>
import BangerLayout from 'Layouts/BangerLayout';
import ProfileHeader from 'Partials/ProfileHeader';

export default {
  components: {
    ProfileHeader,
    BangerLayout,
  },
  data: () => ({
    contentClass: { grey: true, 'lighten-4': true, 'accent--text': true },
  }),
};
</script>
