<template>
  <v-app v-cloak>
    <main>
      <notifications group="error" position="top center" :duration="15000"/>
      <notifications group="app" position="top center" :duration="20000"/>
      <login/>
      <navbar/>
      <v-container
        transition="slide-x-transition"
        fluid
        pa-0
        ma-0
      >
        <slot />
      </v-container>
    </main>
  </v-app>
</template>

<script>
import Navbar from 'Partials/Navbar';
import Login from 'Components/modal/Login';

export default {
  components: {
    Navbar,
    Login,
  }
};
</script>
