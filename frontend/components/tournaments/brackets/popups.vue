<template>
  <div class="popup-wrapper">
    <default-modal
      :close-modal="()=> hostPopup = false"
      :show="hostPopup"
      min-width="auto"
      persistent
    >
      <host-popup />
    </default-modal>
    <default-modal
      :close-modal="()=> creatingPopup = false"
      :show="creatingPopup"
      min-width="auto"
      persistent
    >
      <create-popup />
    </default-modal>
    <default-modal
      :close-modal="()=> inviationPopup = false"
      :show="inviationPopup"
      min-width="auto"
      persistent
    >
      <host-popup />
    </default-modal>

    <div class="modals-wrapper">
      <default-button
        type="button"
        class="default-banger-btn"
        :on-click="host"
      >
        Host popup
      </default-button>
      <default-button
        type="button"
        class="default-banger-btn"
        :on-click="creating"
      >
        Creating Match popup
      </default-button>
      <default-button
        type="button"
        class="default-banger-btn"
        :on-click="inviation"
      >
        Inviation popup
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultModal from 'components/modals/DefaultModal';
import DefaultButton from 'components/DefaultButton.vue';
import HostPopup from './hostPopup.vue';
import CreatePopup from './createPopup.vue';
export default {
  components: {
    DefaultModal,
    DefaultButton,
    HostPopup,
    CreatePopup
  },
  data() {
    return {
      hostPopup: false,
      creatingPopup: false,
      inviationPopup: false,
    };
  },
  methods: {
    host() {
      this.hostPopup = true;
    },
    creating() {
      this.creatingPopup = true;
    },
    inviation() {
      this.inviationPopup = true;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
</style>
