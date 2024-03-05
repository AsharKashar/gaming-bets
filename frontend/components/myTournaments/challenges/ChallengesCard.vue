<template>
  <div
    v-ripple
    class="card"
  >
    <challenges-tag :status="challenge.status" />
    <challenges-header />
    <challenges-body />
    <challenges-footer :status="challenge.status" />
  </div>
</template>

<script>

import ChallengesTag from 'components/myTournaments/challenges/tag';
import ChallengesHeader from 'components/myTournaments/challenges/header';
import ChallengesBody from 'components/myTournaments/challenges/body';
import ChallengesFooter from 'components/myTournaments/challenges/footer';
export default {
  name: 'ChallengesCard',
  components: {
    ChallengesFooter,
    ChallengesBody,
    ChallengesHeader,
    ChallengesTag,
  },
  props: {
    challenge: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.card {
  position: relative;
  padding: 1em 2em;
  background: #a1afd326;
  min-height: 100%;
  box-sizing: border-box;
  clip-path: polygon(5% 0, 100% 0, 100% 95%, 95% 100%, 0 100%, 0 5%);
  -webkit-clip-path: polygon(5% 0, 100% 0, 100% 95%, 95% 100%, 0 100%, 0 5%);
  cursor: pointer;
  transition: 0.3s all;
  &:hover {
    background: #a1afd330;
  }
}
</style>
