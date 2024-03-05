<template>
  <div class="card">
    <Tag />
    <Header />
    <Body />
    <Footer />
  </div>
</template>

<script>
import Tag from './tag';
import Header from './header';
import Body from './body';
import Footer from './footer';
export default {
  name: 'MyTournamentCard',
  components: {
    Tag,
    Header,
    Body,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.card {
  position: relative;
  //   padding: 1em 2em;
  background: #a1afd326;
  box-sizing: border-box;
  clip-path: polygon(100% 0, 100% 90%, 90% 100%, 0 100%, 0 0);
  cursor: pointer;
  transition: 0.3s all;
  &:hover {
    background: #a1afd330;
  }
}
</style>
