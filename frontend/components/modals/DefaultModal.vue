<template>
  <div
    v-if="show"
    class="modal-wrapper"
    :style="{'min-width' : minwidth}"
  >
    <v-dialog
      :value="show"
      :max-width="maxWidth"
      width="90%"
      class="default-modal"
      overlay-opacity="0.4"
      :overlay-color="seconderyModal ? '#A1AFD3' : 'rgb(33, 33, 33)'"
      :persistent="fromDemo || persistent"
      @click:outside="fromDemo ? () => {} : closeModal"
    >
      <div
        :class="{'modal-body': true, 'custom-body' : fromDemo, 'invisible-scrollbar' : fromDemo || invisibleScrollbar, 'secondery-modal' : seconderyModal}"
      >
        <slot :closeModal="closeModal" />
      </div>
      <div @click="closeModal">
        <cross class="close-btn" />
      </div>
    </v-dialog>
  </div>
</template>

<script>
import Cross from 'components/svgIcons/Cross.vue';

export default {
  name: 'DefaultModal',
  components: {
    Cross,
  },
  props: {
    closeModal: {
      type: Function,
      default: () => {},
    },
    minwidth: {
      type: String,
      default: '550px',
    },
    maxWidth: {
      type: String,
      default: '550',
    },
    fromDemo: {
      type: Boolean,
      default: false,
    },
    persistent: {
      type: Boolean,
      default: false,
    },
    invisibleScrollbar: {
      type: Boolean,
      default: false,
    },
    seconderyModal: {
      type: Boolean,
      default: false,
    },
    show: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.modal-body {
  background: $app-background;
  border: 8px solid $border-primary-color;
  border-radius: 23px;
  position: relative;
  overflow: auto;
  max-height: 77vh;
}

.secondery-modal {
  border: 4px solid $border-secondary-color;
}

.custom-body {
  padding: 44px;
}

.close-btn {
  position: absolute;
  height: 40px;
  width: 40px;
}

@media all and (max-width: $tablet-small-width) {
  .close-btn {
    top: -46px;
    right: 5px;
    height: 30px;
    width: 30px;
  }
  .custom-body {
    padding: 20px;
  }
  .modal-body {
    border: 2px solid $border-primary-color;
  }
  .secondery-modal {
    border: 2px solid $border-secondary-color;
  }
}
@media all and (min-width: $tablet-small-width) {
  .close-btn {
    top: 0;
    right: -65px;
  }
}
</style>
