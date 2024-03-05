<template>
  <loader
    :loading="loading"
    :center="true"
    height="60px"
    :overlay="false"
  >
    <first-step
      v-if="currentTab === 1"
      @move-next="nextStep"
    />

    <upload-match-result
      v-else-if="currentTab === 2"
      @move-next="nextStep"
      @prev-tab="currentTab--"
    />

    <WaitingForResult
      v-else-if="currentTab === 3"
      @move-next="clearModal"
    />
  </loader>
</template>

<script>
import FirstStep from './steps/FirstStep.vue';
import UploadMatchResult from './steps/UploadMatchResult';
import WaitingForResult from './steps/WaitingForResult';

import { createNamespacedHelpers } from 'vuex';
const modalModule = createNamespacedHelpers('modal');
const authModule = createNamespacedHelpers('auth');
const boxfightModule = createNamespacedHelpers('boxfight');


import { STATE_STATUSES } from 'helpers/constants';
import Loader from 'components/Loader';


export default {
  components: {
    FirstStep,
    UploadMatchResult,
    WaitingForResult,
    Loader,
  },
  data() {
    return {
      currentTab: 1,
      matchResult: false,
    };
  },
  computed: {
    ...boxfightModule.mapState(['boxFightStatus' , 'currentBoxFight']),
    ...authModule.mapState(['user']),
    loading() {
      return this.boxFightStatus === STATE_STATUSES.PENDING;
    },
  },
  methods: {
    ...boxfightModule.mapMutations(['setBoxFightStatus']),
    ...boxfightModule.mapActions(['getCurrentBoxFight']),
    ...modalModule.mapMutations(['clearModal']),
    nextStep(result) {
      if (result) {
        this.matchResult = result === 'won';
      }
      this.currentTab++;
    },
  },
};
</script>

<style lang="scss" scoped></style>
